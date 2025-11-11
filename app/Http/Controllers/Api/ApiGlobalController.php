<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Models\Invitation;
use App\Models\PKMGrades;
use App\Models\PKMStudentHabits;
use App\Models\PKMStudents;
use App\Models\Resources;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use PDO;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class ApiGlobalController extends Controller
{
    private $model;
    protected $reference;
    protected $forms;
    protected $segment;
    protected $table_name;

    public function __construct(Request $request, Resources $model)
    {
        try {
            $this->segment = $request->segment(3);
            if (file_exists(app_path('Models/' . Str::studly($this->segment)) . '.php')) {
                $this->model = app("App\Models\\" . Str::studly($this->segment));
            } else {
                if ($model->checkTableExists($this->segment)) {
                    $this->model = $model;
                    $this->model->setTable($this->segment);
                }
            }

            $this->reference = $this->model->getReference();
            $this->forms = $this->model->getForms();
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function dataTable(Request $request)
    {
        $reference = $this->reference;
        $offset = $request->get('start', 0);
        $limit = min($request->get('length', 10), 100);
        $search = $request->get('search');
        $orderBy = $request->get('order');
        $params = $request->get('params');
        $status = $request->get('status');

        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $kelas = $request->get('class_id');

        $model = $this->model;
        $fields = $model->getFields();

        $forms = ['id'];
        foreach ($this->forms as $items) {
            if ($items['display']) $forms[] = $items['name'];
        }

        if ($status == 2) $model = $model->onlyTrashed();

        foreach ($reference as $ref) $model = $model->with($ref);

        // Search
        if (!empty($search)) {
            $table = $this->model->getTable();
            $columnsInfo = [];
            foreach ($fields as $field) {
                $columnsInfo[$field] = DB::getSchemaBuilder()->getColumnType($table, $field);
            }

            $model = $model->where(function ($query) use ($fields, $search, $columnsInfo, $reference) {
                foreach ($fields as $key => $item) {
                    if (isset($columnsInfo[$item]) && in_array($columnsInfo[$item], ['varchar', 'text'])) {
                        $method = $key == 0 ? 'where' : 'orWhere';
                        $query->$method($item, 'LIKE', "%$search%");
                    }
                }

                foreach ($reference as $relation) {
                    if (method_exists($this->model, $relation)) {
                        $displayField = collect($this->forms)->firstWhere('name', $relation)['options']['display'] ?? 'name';
                        $query->orWhereHas($relation, fn($q) => $q->where($displayField, 'LIKE', "%$search%"));
                    }
                }
            });
        }

        // Params
        if (!empty($params)) {
            foreach ($params as $key => $item) {
                if (!empty($item)) $model = $model->where($key, $item);
            }
        }

        // Date filter
        if (!empty($startDate) && !empty($endDate)) {
            $model = $model->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        } elseif (!empty($startDate)) {
            $model = $model->whereDate('created_at', '>=', $startDate);
        } elseif (!empty($endDate)) {
            $model = $model->whereDate('created_at', '<=', $endDate);
        }

        if (!empty($kelas)) {
            $model = $model->whereHas('student_id.grade', function ($q) use ($kelas) {
                $q->where('id', $kelas);
            });
        }

        // Role murid
        $user = auth()->user();
        $student = DB::table('p_k_m_students')->where('user_id', $user->id)->first();
        if ($user->role == 2 && $student) {
            $model = $model->where('student_id', $student->id);
        }

        $totalQuery = clone $model;
        $total = $totalQuery->count();

        // Order, Offset, Limit
        if (!empty($orderBy)) {
            $model = $model->orderBy(
                $forms[$request->get('order')[0]['column']],
                $request->get('order')[0]['column'] == 0 ? 'desc' : $request->get('order')[0]['dir']
            );
        }

        $model = $model->offset($offset)->limit($limit)->get();

        // Format output
        $formsDef = [];
        foreach ($this->forms as $items) {
            $formsDef[$items['name']]['type'] = $items['type'];
            $formsDef[$items['name']]['option'] = $items['options'] ?? [];
        }

        $dataTable = [];
        foreach ($model->toArray() as $key => $items) {
            foreach ($items as $q => $value) {
                if (isset($formsDef[$q])) {
                    $type = $formsDef[$q]['type'];
                    $opt = $formsDef[$q]['option'];
                    $dataTable[$key][$q] = match ($type) {
                        'thumbnail' => $this->thumbnail($value),
                        'select2' => !empty($value) ? $value[$opt['display']] : null,
                        'select' => $opt[$value] ?? $value,
                        default => is_string($value) ? strip_tags($value) : $value
                    };
                } else {
                    $dataTable[$key][$q] = $value;
                }
            }
            // dd($items);
            $dataTable[$key]['kelas'] = $items['student_id']['grade']['grade_name'] ?? '-';
            $dataTable[$key]['grade_id'] = $items['student_id']['grade']['id'] ?? '-';
        }

        return response()->json([
            'draw' => $request->get('draw', 1),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $dataTable
        ]);
    }

    public function dataTableMurid(Request $request)
    {
        $reference = $this->reference;
        $offset = $request->get('start') ? $request->get('start') : 0;
        $limit = $request->get('length') ? $request->get('length') : 10;
        $search = $request->get('search');
        $orderBy = $request->get('order');
        $params = $request->get('params');
        $status = $request->get('status');

        // Tambahan filter tanggal
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $kelas = $request->get('class_id');

        $model = $this->model;
        $fields = $model->getFields();

        $forms = ['id'];
        foreach ($this->forms as $items) {
            if ($items['display']) $forms[] = $items['name'];
        }

        if ($status == 2) {
            $model = $model->onlyTrashed();
        }

        if (count($reference) > 0) {
            for ($i = 0; $i < count($reference); $i++) {
                $model = $model->with($reference[$i]);
            }
        }

        // 🔍 Filter pencarian global
        if (!empty($search)) {
            $table = $this->model->getTable();
            $columnsInfo = [];
            foreach ($fields as $field) {
                $columnsInfo[$field] = DB::getSchemaBuilder()->getColumnType($table, $field);
            }

            $model = $model->where(function ($query) use ($fields, $search, $columnsInfo, $reference) {
                foreach ($fields as $key => $item) {
                    if (isset($columnsInfo[$item]) && in_array($columnsInfo[$item], ['varchar', 'text'])) {
                        if ($key == 0) {
                            $query->where($item, 'LIKE', '%' . $search . '%');
                        } else {
                            $query->orWhere($item, 'LIKE', '%' . $search . '%');
                        }
                    }
                }

                foreach ($reference as $relation) {
                    if (method_exists($this->model, $relation)) {
                        $displayField = null;
                        foreach ($this->forms as $form) {
                            if ($form['name'] === $relation && isset($form['options']['display'])) {
                                $displayField = $form['options']['display'];
                                break;
                            }
                        }

                        if (!$displayField) {
                            $displayField = 'name';
                        }

                        $query->orWhereHas($relation, function ($q) use ($search, $displayField) {
                            $q->where($displayField, 'LIKE', '%' . $search . '%');
                        });
                    }
                }
            });
        }

        // 🔹 Filter berdasarkan parameter tambahan
        if (!empty($params)) {
            foreach ($params as $key => $item) {
                if (!empty($item)) $model = $model->where($key, $item);
            }
        }

        // 🔹 Filter tanggal
        if (!empty($startDate) && !empty($endDate)) {
            $model = $model->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } elseif (!empty($startDate)) {
            $model = $model->whereDate('created_at', '>=', $startDate);
        } elseif (!empty($endDate)) {
            $model = $model->whereDate('created_at', '<=', $endDate);
        }

        if (!empty($kelas)) {
            $model = $model->where('grade_id', '=', $kelas);
        }

        // 🔹 Filter hanya user dengan role "murid"
        $model = $model->whereHas('user_id', function ($q) {
            $q->where('role', 2);
        });

        // 🔹 Jika yang login murid, hanya tampilkan datanya sendiri
        $user = auth()->user();
        if ($user && $user->role == 2) {
            $model = $model->where('user_id', $user->id);
        }

        // 🔹 Hitung total data
        $total = $model->count();

        // 🔹 Sorting
        if (!empty($orderBy)) {
            $model = $model->orderBy(
                $forms[$request->get('order')[0]['column']],
                $request->get('order')[0]['column'] == 0 ? 'desc' : $request->get('order')[0]['dir']
            );
        }

        // 🔹 Pagination
        $model = $model->offset($offset)->limit($limit)->get();

        // 🔹 Mapping form untuk display
        $forms = [];
        foreach ($this->forms as $items) {
            $forms[$items['name']]['type'] = $items['type'];
            $forms[$items['name']]['option'] = isset($items['options']) ? $items['options'] : [];
        }

        // 🔹 Konversi data ke format DataTable
        $dataTable = [];
        foreach ($model->toArray() as $key => $items) {
            foreach ($items as $q => $value) {
                if (isset($forms[$q]) && $forms[$q]['type'] == 'thumbnail') {
                    $dataTable[$key][$q] = $this->thumbnail($value);
                } elseif (isset($forms[$q]) && $forms[$q]['type'] == 'select2') {
                    $displayProperty = $forms[$q]['option']['display'];
                    $dataTable[$key][$q] = !empty($value) ? $value[$displayProperty] : null;
                } elseif (isset($forms[$q]) && $forms[$q]['type'] == 'select') {
                    $dataTable[$key][$q] = !empty($value) && isset($forms[$q]['option'][$value])
                        ? $forms[$q]['option'][$value]
                        : $value;
                } else {
                    $dataTable[$key][$q] = is_string($value) ? strip_tags($value) : $value;
                }
            }
        }

        // 🔹 Output JSON DataTables
        $draw = $request->get('draw') ?? 1;

        return response([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $dataTable
        ]);
    }

    public function naikKelasPerMurid($collection, $id)
    {
        DB::beginTransaction();

        try {
            // Ambil data murid berdasarkan ID
            $student = PKMStudents::findOrFail($id);

            // Ambil data grade sekarang
            $currentGrade = PKMGrades::find($student->grade_id);

            if (!$currentGrade) {
                return response()->json([
                    'status' => 400,
                    'message' => "❌ Murid belum memiliki kelas saat ini."
                ]);
            }

            // Ambil grade tertinggi (kelas terakhir)
            $maxGrade = PKMGrades::orderByDesc('level_order')->first();

            // Cek apakah murid sudah di kelas terakhir
            if ($currentGrade->id === $maxGrade->id) {
                return response()->json([
                    'status' => 400,
                    'message' => "⚠️ Murid sudah berada di kelas tertinggi ({$currentGrade->grade_name})."
                ]);
            }

            // Ambil kelas berikutnya berdasarkan level_order
            $nextGrade = PKMGrades::where('level_order', $currentGrade->level_order + 1)->first();

            if (!$nextGrade) {
                return response()->json([
                    'status' => 400,
                    'message' => "⚠️ Kelas berikutnya tidak ditemukan."
                ]);
            }

            // Update grade_id murid
            $student->update(['grade_id' => $nextGrade->id]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => "✅ Murid berhasil naik ke kelas <b>{$nextGrade->grade_name}</b>."
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => "❌ Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }

    public function naikKelasAll(Request $request)
    {
        DB::beginTransaction();

        try {
            $classId = $request->input('class_id'); // ambil filter kelas

            // Ambil semua siswa, jika ada filter kelas, batasi berdasarkan kelas itu
            $studentsQuery = PKMStudents::with('grade');

            if (!empty($classId)) {
                $studentsQuery->where('grade_id', $classId);
            }

            $students = $studentsQuery->get();

            // Ambil kelas dengan level tertinggi
            $maxGrade = PKMGrades::orderByDesc('level_order')->first();

            $promotedCount = 0;
            $skippedCount = 0;
            $skippedStudents = [];

            foreach ($students as $student) {
                if (!$student->grade) {
                    $skippedCount++;
                    $skippedStudents[] = [
                        'student_id' => $student->id,
                        'reason' => 'Belum memiliki kelas saat ini'
                    ];
                    continue;
                }

                if ($student->grade->id === $maxGrade->id) {
                    $skippedCount++;
                    $skippedStudents[] = [
                        'student_id' => $student->id,
                        'grade' => $student->grade->grade_name,
                        'reason' => 'Sudah di kelas tertinggi'
                    ];
                    continue;
                }

                $nextGrade = PKMGrades::where('level_order', $student->grade->level_order + 1)->first();

                if ($nextGrade) {
                    $student->update(['grade_id' => $nextGrade->id]);
                    $promotedCount++;
                } else {
                    $skippedCount++;
                    $skippedStudents[] = [
                        'student_id' => $student->id,
                        'reason' => 'Kelas berikutnya tidak ditemukan'
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "✅ Naik kelas selesai!<br>"
                    . "• Jumlah murid naik kelas: <b>{$promotedCount}</b><br>"
                    . "• Jumlah murid dilewati: <b>{$skippedCount}</b>"
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => '❌ Gagal menjalankan proses naik kelas: ' . $e->getMessage()
            ], 500);
        }
    }

    public function dataTableUser(Request $request)
    {
        $reference = $this->reference;
        $offset = $request->get('start') ? $request->get('start') : 0;
        $limit = $request->get('length') ? $request->get('length') : 10;
        $search = $request->get('search');
        $orderBy = $request->get('order');
        $params = $request->get('params');
        $status = $request->get('status');

        $model = $this->model;
        $fields = $model->getFields();

        $forms = ['id'];
        foreach ($this->forms as $items) {
            if ($items['display']) $forms[] = $items['name'];
        }

        if ($status == 2) {
            $model = $model->onlyTrashed();
        }

        if (count($reference) > 0) {
            for ($i = 0; $i < count($reference); $i++) {
                $model = $model->with($reference[$i]);
            }
        }

        if (!empty($search)) {
            $model = $model->where(function ($model) use ($fields, $search) {
                foreach ($fields as $key => $item) {
                    if ($key == 0) {
                        $model->where($item, 'LIKE', '%' . $search . '%');
                    } else {
                        $model->orWhere($item, 'LIKE', '%' . $search . '%');
                    }
                }
            });
        }

        if (!empty($params)) {
            foreach ($params as $key => $item) {
                if (!empty($item)) $model = $model->where($item['name'], $item['value']);
            }
        }

        $total = $model->count();

        if (!empty($orderBy)) {
            $model = $model->orderBy($forms[$request->get('order')[0]['column']], $request->get('order')[0]['column'] == 0 ? 'desc' : $request->get('order')[0]['dir']);
        }

        $model = $model->offset($offset);
        $model = $model->limit($limit);
        $model = $model->get();

        $forms = [];
        foreach ($this->forms as $items) {
            $forms[$items['name']]['type'] = $items['type'];
            $forms[$items['name']]['option'] = isset($items['options']) ? $items['options'] : [];
        }

        $dataTable = [];
        foreach ($model->toArray() as $key => $items) {
            foreach ($items as $q => $value) {
                if (isset($forms[$q]) && $forms[$q]['type'] == 'thumbnail') {
                    $dataTable[$key][$q] = $this->thumbnail($value);
                } elseif (isset($forms[$q]) && $forms[$q]['type'] == 'select2') {
                    $displayProperty = $forms[$q]['option']['display'];
                    $dataTable[$key][$q] = !empty($value) ? $value[$displayProperty] : null;
                } elseif (isset($forms[$q]) && $forms[$q]['type'] == 'select') {
                    $dataTable[$key][$q] = !empty($value) && isset($forms[$q]['option'][$value])
                        ? $forms[$q]['option'][$value]
                        : $value;
                } else {
                    $dataTable[$key][$q] = is_string($value) ? strip_tags($value) : $value;
                }
            }
        }

        $draw = 1;
        if (!empty($request->get('draw'))) {
            $draw = $request->get('draw');
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $dataTable
        ];

        return response($data);
    }

    public function dataTableEventGuest(Request $request)
    {
        $reference = $this->reference;
        $offset = $request->get('start') ? $request->get('start') : 0;
        $limit = $request->get('length') ? $request->get('length') : 10;
        $search = $request->get('search');
        $orderBy = $request->get('order');
        $params = $request->get('params');
        $status = $request->get('status');
        $eventId = $request->get('event_id');

        $model = new Invitation();
        $fields = $model->getFields();

        $forms = ['id'];
        foreach ($this->forms as $items) {
            if ($items['display']) $forms[] = $items['name'];
        }

        if ($status == 2) {
            $model = $model->onlyTrashed();
        }
        if (!empty($eventId)) {
            $model = $model->where('wedding_id', $eventId);
        }
        if (count($reference) > 0) {
            for ($i = 0; $i < count($reference); $i++) {
                $model = $model->with($reference[$i]);
            }
        }

        if (!empty($search)) {
            $table = $this->model->getTable();
            $columnsInfo = [];
            foreach ($fields as $field) {
                $columnsInfo[$field] = DB::getSchemaBuilder()->getColumnType($table, $field);
            }

            $model = $model->where(function ($query) use ($fields, $search, $columnsInfo, $reference) {
                foreach ($fields as $key => $item) {
                    if (isset($columnsInfo[$item]) && in_array($columnsInfo[$item], ['varchar', 'text'])) {
                        if ($key == 0) {
                            $query->where($item, 'LIKE', '%' . $search . '%');
                        } else {
                            $query->orWhere($item, 'LIKE', '%' . $search . '%');
                        }
                    }
                }

                foreach ($reference as $relation) {
                    if (method_exists($this->model, $relation)) {
                        $displayField = null;
                        foreach ($this->forms as $form) {
                            if ($form['name'] === $relation && isset($form['options']['display'])) {
                                $displayField = $form['options']['display'];
                                break;
                            }
                        }

                        if (!$displayField) {
                            $displayField = 'name';
                        }

                        $query->orWhereHas($relation, function ($q) use ($search, $displayField) {
                            $q->where($displayField, 'LIKE', '%' . $search . '%');
                        });
                    }
                }
            });
        }

        if (!empty($params)) {
            foreach ($params as $key => $item) {
                if (!empty($item)) $model = $model->where($key, $item);
            }
        }

        $total = $model->count();

        if (!empty($orderBy)) {
            $model = $model->orderBy($forms[$request->get('order')[0]['column']], $request->get('order')[0]['column'] == 0 ? 'desc' : $request->get('order')[0]['dir']);
        }

        $model = $model->offset($offset);
        $model = $model->limit($limit);
        $model = $model->get();

        $forms = [];
        foreach ($this->forms as $items) {
            $forms[$items['name']]['type'] = $items['type'];
            $forms[$items['name']]['option'] = isset($items['options']) ? $items['options'] : [];
        }

        $dataTable = [];
        foreach ($model->toArray() as $key => $items) {
            foreach ($items as $q => $value) {
                if (isset($forms[$q]) && $forms[$q]['type'] == 'thumbnail') {
                    $dataTable[$key][$q] = $this->thumbnail($value);
                } elseif (isset($forms[$q]) && $forms[$q]['type'] == 'select2') {
                    $displayProperty = $forms[$q]['option']['display'];
                    $dataTable[$key][$q] = !empty($value) ? $value[$displayProperty] : null;
                } elseif (isset($forms[$q]) && $forms[$q]['type'] == 'select') {
                    $dataTable[$key][$q] = !empty($value) && isset($forms[$q]['option'][$value])
                        ? $forms[$q]['option'][$value]
                        : $value;
                } else {
                    $dataTable[$key][$q] = is_string($value) ? strip_tags($value) : $value;
                }
            }
        }

        $draw = 1;
        if (!empty($request->get('draw'))) {
            $draw = $request->get('draw');
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $dataTable
        ];

        return response($data);
    }

    public function thumbnail($value)
    {
        $file = asset('assets/media/avatars/150-26.jpg');
        if (!empty($value)) {
            $image = json_decode($value, true);
            $file = asset('storage/avatar/' . $image['filename']);
        }

        $html = '
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50px me-3">
                    <img src="' . $file . '" class="" alt="">
                </div>
            </div>
        ';

        return $html;
    }

    public function trash(Request $request)
    {
        try {
            $selectedId = explode(',', $request->id);
            for ($i = 0; $i < count($selectedId); $i++) {
                $model = $this->model->findOrFail($selectedId[$i]);
                $model->delete();
            }

            $data = [
                'status' => 200
            ];
            return response($data);
        } catch (Exception $th) {
            return redirect($this->table_name)->withError(Str::title(Str::singular($this->table_name)) . ' failed to delete!');
        }
    }

    public function delete(Request $request)
    {
        try {
            $selectedId = explode(',', $request->id);
            $listFileCode = [];
            for ($i = 0; $i < count($selectedId); $i++) {
                $model = $this->model->onlyTrashed()->findOrFail($selectedId[$i]);

                if ($this->model->getFilesList()) {
                    $fileList = $this->model->getFilesList();
                    for ($x = 0; $x < count($fileList); $x++) {
                        $name = $fileList[$x];
                        $listFileCode[] = $model->$name;
                    }
                }

                $model->forceDelete();
            }

            if (count($listFileCode) > 0) $this->deleteFiles($listFileCode);

            $data = [
                'status' => 200,
                'message' => 'Rows Deleted'
            ];
            return response($data);
        } catch (Exception $e) {
            $data = [
                'status' => 500,
                'message' => $e->getMessage()
            ];
            return response($data);
        }
    }

    public function deleteFiles($listCode)
    {
        Files::whereIn('code', $listCode)->each(function ($data, $items) {
            $originalFile = public_path('storage/image/origin/' . $data->original_name);
            $compressedFile = public_path('storage/image/compress/' . $data->compressed_name);

            if (File::exists($originalFile)) File::delete($originalFile);
            if (File::exists($compressedFile)) File::delete($compressedFile);

            $data->delete();
        });
    }

    public function restore(Request $request)
    {
        try {
            $model = $this->model->onlyTrashed()->findOrFail($request->id);
            $model->restore();
            $data = [
                'status' => 200,
                'message' => 'Rows Restored'
            ];
            return response($data);
        } catch (Exception $e) {
            $data = [
                'status' => 500,
                'message' => $e->getMessage()
            ];
            return response($data);
        }
    }

    public function detail(Request $request, $collection, $id)
    {
        $status = 200;
        $model = $this->model->find($id);

        if (is_null($model)) {
            $status = 404;
        }

        $data = [
            'data' => $model,
        ];

        return response($data, $status);
    }

    public function checkSlug(Request $request)
    {
        if (empty($request->title)) return response(['slug' => '']);
        $slug =  SlugService::createSlug($this->model, 'slug', $request->title);
        return response(['slug' => $slug]);
    }

    public function checkToday(Request $request)
    {
        $user = auth()->user();
        $student = DB::table('p_k_m_students')->where('user_id', '=', $user->id)->first();

        // hanya untuk murid
        if ($user->role != 2) {
            return response()->json(['canAdd' => true]);
        }

        // gunakan timezone lokal
        $today = now('Asia/Jakarta')->toDateString();

        // jika user mengirim tanggal tertentu, gunakan itu
        $date = $request->input('date', $today);

        // cek apakah sudah ada data untuk tanggal tersebut
        $exists = PKMStudentHabits::where('student_id', $student->id)
            ->whereDate('date', $date)
            ->exists();

        return response()->json(['canAdd' => !$exists]);
    }
}
