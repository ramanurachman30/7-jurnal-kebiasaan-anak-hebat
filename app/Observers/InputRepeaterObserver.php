<?php

namespace App\Observers;

use App\Models\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;

class InputRepeaterObserver
{
    protected ImageManager $imageManager;
    protected array $uploadedFileCodes = [];

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function saving(Resources $resources)
    {
        $requestData = request()->all();
        $repeaters = array_filter($resources->getForms(), function ($form) {
            return isset($form['type']) && $form['type'] === 'input-repeater';
        });

        if (empty($repeaters)) {
            return;
        }

        foreach ($repeaters as $form) {
            $this->processFileUploads($form, $resources);
        }
        $resources->setRelation('uploadedFileCodes', $this->uploadedFileCodes);
    }

    public function saved(Resources $resources)
    {
        $repeaters = array_filter($resources->getForms(), function ($form) {
            return isset($form['type']) && $form['type'] === 'input-repeater';
        });

        if (empty($repeaters)) {
            return;
        }

        foreach ($repeaters as $form) {
            $this->saveRepeaterData($form, $resources);
        }
        $resources->unsetRelation('uploadedFileCodes');

    }

    /**
     * Process file uploads and generate codes in saving method
     */
    protected function processFileUploads($form, $resources)
    {
        $formName = $form['name'];

        // Get file uploads
        $uploadFiles = request()->file($formName . '_upload', []);
        $inputTypes = request()->input($formName . '_input_type', []);
        $dataIds = request()->input($formName . '_id', []);

        // Get remove file flags
        $removeFiles = [];
        foreach (request()->all() as $key => $value) {
            if (strpos($key, 'remove_' . $formName . '_upload_') === 0 && $value) {
                $index = str_replace('remove_' . $formName . '_upload_', '', $key);
                $removeFiles[$index] = true;
            }
        }

        // Initialize upload codes array for this form
        $this->uploadedFileCodes[$formName] = [];
        foreach ($inputTypes as $index => $inputType) {
            if ($inputType === 'upload') {
                $fileCode = null;
                $id = $dataIds[$index] ?? null;

                // Get existing record to check for old files
                $existingRecord = null;
                if ($id) {
                    $existingRecord = $this->getExistingRecord($form, $resources, $id);
                }

                // Handle file removal
                if (isset($removeFiles[$index]) && $removeFiles[$index]) {
                    if ($existingRecord && !empty($existingRecord->file)) {
                        $this->removeFile($existingRecord->file);
                    }
                    $fileCode = null;
                }
                // Handle new file upload
                else if (isset($uploadFiles[$index]) && $uploadFiles[$index] instanceof UploadedFile) {
                    // Delete old file if exists
                    if ($existingRecord && !empty($existingRecord->file)) {
                        $this->removeFile($existingRecord->file);
                    }

                    // Upload new file and get code
                    $uploadedFile = $uploadFiles[$index];
                    $fileCode = $this->writeFile($uploadedFile);
                }
                // Keep existing file if no new upload and not removed
                else if ($existingRecord && !empty($existingRecord->file)) {
                    $fileCode = $existingRecord->file;
                }
                // dd($fileCode);
                // Store the file code for this index
                $this->uploadedFileCodes[$formName][$index] = $fileCode;
            }
        }
    }

    /**
     * Save repeater data using generated file codes from saving method
     */
    protected function saveRepeaterData($form, $resources)
    {
        $model = null;

        $className = "App\\Models\\" . Str::studly($form['name']);
        if (class_exists($className)) {
            $model = new $className;
        } elseif ($resources->checkTableExists($form['name'])) {
            $model = new class extends Model {
                protected $guarded = [];
                public $timestamps = false;
            };
            $model->setTable($form['name']);
        }

        if (!$model) {
            return;
        }

        $foreignKey = $form['foreign_key'] ?? 'resources_id';
        $formName = $form['name'];
        $uploadedFileCodes = $resources->getRelation('uploadedFileCodes') ?? [];

        // Get all input data
        $data = request()->input($formName, []);
        $dataLink = request()->input($formName . '_link', []);
        $dataLinkLabel = request()->input($formName . '_label', []);
        $dataIds = request()->input($formName . '_id', []);
        $inputTypes = request()->input($formName . '_input_type', []);

        if (!is_array($data)) {
            return;
        }

        $keptIds = [];

        foreach ($data as $index => $value) {
            if (empty(trim($value))) {
                continue;
            }

            $attributes = [
                $foreignKey => $resources->id,
            ];

            $inputType = isset($inputTypes[$index]) ? $inputTypes[$index] : 'link';

            // Initialize values
            $values = [
                'value' => trim($value),
                'input_type' => $inputType,
            ];

            // Handle link data
            if ($inputType === 'link') {
                $link = isset($dataLink[$index]) && !empty(trim($dataLink[$index]))
                    ? trim($dataLink[$index]) : null;
                $linkLabel = isset($dataLinkLabel[$index]) && !empty(trim($dataLinkLabel[$index]))
                    ? trim($dataLinkLabel[$index]) : null;

                $values['link'] = $link;
                $values['link_label'] = $linkLabel ? $linkLabel : $link;
                $values['file'] = null;
            }
            // Handle upload data - use pre-generated file code
            else if ($inputType === 'upload') {
                $values['link'] = null;
                $values['link_label'] = null;
                // Get file code that was generated in saving method
                $fileCode = isset($uploadedFileCodes[$formName][$index])
                    ? $uploadedFileCodes[$formName][$index]
                    : null;

                $values['file'] = $fileCode;
            }

            // Create or update record
            $id = $dataIds[$index] ?? null;
            $record = $id
                ? $model->newQuery()->updateOrCreate(['id' => $id], $attributes + $values)
                : $model->newQuery()->create($attributes + $values);

            if (!empty($record->id)) {
                $keptIds[] = $record->id;
            }
        }

        // Delete records that are no longer present
        $deletedRecords = $model->newQuery()
            ->where($foreignKey, $resources->id)
            ->whereNotIn('id', $keptIds)
            ->get();

        // Delete associated files before deleting records
        foreach ($deletedRecords as $deletedRecord) {
            if (!empty($deletedRecord->file)) {
                $this->removeFile($deletedRecord->file);
            }
        }

        // Delete the records
        $model->newQuery()
            ->where($foreignKey, $resources->id)
            ->whereNotIn('id', $keptIds)
            ->delete();
    }

    /**
     * Get existing record for update operations
     */
    protected function getExistingRecord($form, $resources, $id)
    {
        $model = null;

        $className = "App\\Models\\" . Str::studly($form['name']);
        if (class_exists($className)) {
            $model = new $className;
        } elseif ($resources->checkTableExists($form['name'])) {
            $model = new class extends Model {
                protected $guarded = [];
                public $timestamps = false;
            };
            $model->setTable($form['name']);
        }

        if (!$model) {
            return null;
        }

        return $model->newQuery()->find($id);
    }

    /**
     * Store uploaded file (similar to FileUploadObserver)
     */
    public function writeFile($file, $desc = "")
    {
        $imageType = ['jpg', 'jpeg', 'png', 'webp'];
        $files = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'mp4', 'mov'];

        $code = Str::random(15);
        $ext = strtolower($file->getClientOriginalExtension());

        if (in_array($ext, $imageType)) {
            $this->saveAsImage($file, $code, $desc);
        } else if (in_array($ext, $files)) {
            $this->saveAsFile($file, $code, $desc);
        }

        return $code;
    }

    /**
     * Save image file
     */
    public function saveAsImage($file, $code, $desc)
    {
        $path = 'image/origin/';
        $mimeType = $file->getClientMimeType();
        $extArray = explode('/', $mimeType);
        $ext = $extArray[1];
        $path .= $ext;

        $file->store($path, 'public');

        $dataFile = [
            'code' => $code,
            'name' => $file->getClientOriginalName(),
            'original_name' => $file->hashName(),
            'compressed_name' => $this->writeFileCompress($file),
            'description' => $desc,
            'mimetype' => $file->getClientMimeType()
        ];

        DB::table('files')->insert($dataFile);

        return $code;
    }

    /**
     * Save regular file
     */
    public function saveAsFile($file, $code, $desc = "")
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $filename = time() . '_' . Str::random(10) . '.' . $ext;
        $directory = public_path('storage/file/' . $ext);

        // Ensure directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $file->move($directory, $filename);

        $dataFile = [
            'code' => $code,
            'name' => $file->getClientOriginalName(),
            'original_name' => $filename,
            'compressed_name' => "",
            'description' => $desc,
            'mimetype' => $file->getClientMimeType()
        ];

        DB::table('files')->insert($dataFile);

        return $code;
    }

    /**
     * Compress image file
     */
    public function writeFileCompress($file)
    {
        $mimeType = $file->getClientMimeType();
        $extArray = explode('/', $mimeType);
        $ext = $extArray[1];
        $directory = public_path('storage/image/compress/' . $ext);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $name = $file->hashName();
        $path = $directory . '/' . $name;

        $image = $this->imageManager->read($file->getRealPath());
        $image->scale(900, 720, true);
        $image->toJpeg()->save($path);

        return $name;
    }

    /**
     * Remove file from storage and database
     */
    public function removeFile($code)
    {
        if (empty($code)) return;

        $file = DB::table('files')->where('code', $code);
        $data = $file->first();
        if (!$data) return;

        // Construct file paths
        $mimeTypeArray = explode('/', $data->mimetype);
        $ext = $mimeTypeArray[1] ?? '';

        $originalFile = public_path('storage/image/origin/' . $ext . '/' . $data->original_name);
        $compressedFile = public_path('storage/image/compress/' . $ext . '/' . $data->compressed_name);
        $regularFile = public_path('storage/file/' . $ext . '/' . $data->original_name);

        // Delete files if they exist
        if (File::exists($originalFile)) File::delete($originalFile);
        if (File::exists($compressedFile)) File::delete($compressedFile);
        if (File::exists($regularFile)) File::delete($regularFile);

        // Delete from database
        $file->delete();
    }

    /**
     * Handle model deletion - clean up associated files
     */
    public function deleting(Resources $resources)
    {
        $repeaters = array_filter($resources->getForms(), function ($form) {
            return isset($form['type']) && $form['type'] === 'input-repeater';
        });

        if (empty($repeaters)) {
            return;
        }

        foreach ($repeaters as $form) {
            $model = null;

            $className = "App\\Models\\" . Str::studly($form['name']);
            if (class_exists($className)) {
                $model = new $className;
            } elseif ($resources->checkTableExists($form['name'])) {
                $model = new class extends Model {
                    protected $guarded = [];
                    public $timestamps = false;
                };
                $model->setTable($form['name']);
            }

            if (!$model) {
                continue;
            }

            $foreignKey = $form['foreign_key'] ?? 'resources_id';

            // Get all related records
            $records = $model->newQuery()
                ->where($foreignKey, $resources->id)
                ->get();

            // Delete associated files
            foreach ($records as $record) {
                if (!empty($record->file)) {
                    $this->removeFile($record->file);
                }
            }

            // Delete the records
            $model->newQuery()
                ->where($foreignKey, $resources->id)
                ->delete();
        }
    }
}
