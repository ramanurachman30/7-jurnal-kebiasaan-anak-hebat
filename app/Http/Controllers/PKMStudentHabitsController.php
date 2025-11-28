<?php

namespace App\Http\Controllers;

use App\Models\PKMGrades;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PKMHabits;
use App\Models\PKMStudentHabits;
use App\Models\PKMStudents;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PKMStudentHabitsController extends AppController
{
    protected $table_name = null;
    protected $model;
    protected $forms;
    protected $segment;
    protected $view;
    protected $segmentName;
    protected $reference;

    public function __construct(Request $request, PKMStudentHabits $model)
    {
        try {
            $this->segment = $request->segment(2);
            
            if (file_exists(app_path('Models/' . Str::studly($this->segment)) . '.php')) {
                $this->model = app("App\Models\\" . Str::studly($this->segment));
            } else {
                if ($model->checkTableExists($this->segment)) {
                    $this->model = $model;
                    $this->model->setTable($this->segment);
                }
            }

            if (!$this->model) abort(404);

            $this->view = 'backend.' . $this->segment;
            $this->table_name = $this->segment;
            $this->segmentName = Str::studly($this->segment);
            $this->forms = $this->model->getForms();
            $this->reference = $this->model->getReference();
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function list()
    {
        $grades = PKMGrades::get();
        // dd($grades);
        $this->view = view('backend.student_habits.list', [
            'forms' => $this->forms,
            'grades' => $grades,
        ]);
        return $this->view->with([
            'forms' => $this->forms,
            'segmentName' => $this->segmentName,
            'grades' => $grades,
        ]);
    }

    public function create()
    {
        $user = auth()->user()->id;
        $student = DB::table('p_k_m_students')->where('user_id', '=', $user)->first();
        // dd($student->student_name);
        $habits = PKMHabits::all();

        $data = [
            "student" => $student,
            "habits" => $habits,
        ];

        // dd($data);

        return view('backend.student_habits.create', compact('data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'student_id' => 'required',
                'date' => 'required|date',
                'habits' => 'required|array',
            ]);

            // Pastikan hanya murid yang dicek (role 2)
            $user = auth()->user();
            if ($user->role == 2) {
                $exists = PKMStudentHabits::where('student_id', $validated['student_id'])
                    ->whereDate('date', $validated['date'])
                    ->exists();

                if ($exists) {
                    return back()
                        ->withInput()
                        ->withErrors(['msg' => 'Kamu sudah mengisi checklist untuk tanggal ini.']);
                }
            }

            // Simpan data jika belum ada
            foreach ($validated['habits'] as $habit_id) {
                PKMStudentHabits::create([
                    'student_id' => $validated['student_id'], // langsung ID PKMStudents
                    'habit_id' => $habit_id,
                    'date' => $validated['date'],
                    'is_checked' => 1,
                ]);
            }

            DB::commit();

            return redirect('admin/p_k_m_student_habits')
                ->with('success', 'Data kebiasaan siswa berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Store StudentHabit Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $habit = PKMStudentHabits::findOrFail($request->id);
        $students = PKMStudents::all();
        $habits = PKMHabits::all();

        $data = [
            "students" => $students,
            "habits" => $habits,
            "habit" => $habit
        ];

        return view('backend.p_k_m_student_habits.edit', compact('data'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'id' => 'required',
                'student_id' => 'required',
                'habit_id' => 'required',
                'date' => 'required|date',
                'is_checked' => 'required|string',
            ]);

            $habit = PKMStudentHabits::findOrFail($validated['id']);
            $habit->update($validated);

            DB::commit();
            return redirect('admin/p_k_m_student_habits/list')->with('success', 'Data student habit berhasil diperbarui!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors('Update failed: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $habit = PKMStudentHabits::findOrFail($id);
            $habit->delete();

            return back()->with('success', 'Data student habit berhasil dihapus!');
        } catch (Exception $e) {
            return back()->withErrors('Gagal menghapus data: ' . $e->getMessage());
        }
    }

}