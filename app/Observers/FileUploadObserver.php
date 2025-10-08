<?php

namespace App\Observers;

use App\Models\Resources;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class FileUploadObserver
{
    /**
     * Handle the Resources "created" event.
     *
     * @param  \App\Models\Resources  $resources
     * @return void
     */
    protected $isNew;
    protected ImageManager $imageManager;

    public function __construct(Resources $resources, ImageManager $imageManager)
    {
        $this->isNew = request()->id ? false : true;
        $this->imageManager = $imageManager;
    }

    public function saving(Resources $resources)
    {
        $listFile = $resources->getFilesList();

        if (count($listFile) > 0) {
            for ($i = 0; $i < count($listFile); $i++) {
                $name = $listFile[$i];
                $removeFile = 'remove_' . $name;
                if (isset(request()->$removeFile)) {
                    $this->removeFile($resources->$name);
                    $resources->$name = NULL;
                }
            }
        }

        if (request()->file()) {
            foreach (request()->file() as $key => $file) {
                // Skip gallery_files as they are handled separately
                if ($key === 'gallery_files') {
                    continue;
                }
                
                $code = Str::random(15);
                $desc = $key . '_desc';
                $descriptions = isset(request()->$desc) ? request()->$desc : "";
                $resources->$key = $this->writeFile($file, $descriptions, $code);
            }
        }
    }

    public function saved(Resources $resources)
    {
        // ini untuk check apakah file nya berubah
        if (!$this->isNew && request()->file()) {
            foreach (request()->file() as $key => $file) {
                // Skip gallery_files as they are handled separately
                if ($key === 'gallery_files') {
                    continue;
                }
                
                if ($resources->isDirty($key)) {
                    $code = $resources->getOriginal($key);
                    $this->removeFile($code);
                }
            }
        }

        $fileList = $resources->getFilesList();
        if (!$this->isNew && $fileList) {
            for ($i = 0; $i < count($fileList); $i++) {
                $name = $fileList[$i] . '_desc';
                $fileField = $fileList[$i];
                if (!empty(request()->$name)) $this->updateFileDescription(request()->$name, $resources->$fileField);
            }
        }
    }

    public function writeFile($file, $desc = "", $code)
    {
        $imageType = ['jpg', 'jpeg', 'png', 'webp'];
        $files = ['pdf', 'doc', 'xls', 'xlsx', 'zip', 'mp4', 'mov'];

        $ext = $file->getClientOriginalExtension();

        if (in_array($ext, $imageType)) $this->saveAsImage($file, $code, $desc);
        if (in_array($ext, $files)) $this->saveAsFile($file, $code, $desc);

        return $code;
    }

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

    public function saveAsFile($file, $code)
    {
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $directory = public_path('storage/file/' . $ext);
        $file->move($directory, $filename);

        $dataFile = [
            'code' => $code,
            'name' => $file->getClientOriginalName(),
            'original_name' => $filename,
            'compressed_name' => "",
            'description' => "",
            'mimetype' => $file->getClientMimeType()
        ];

        DB::table('files')->insert($dataFile);

        return $code;
    }

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

    public function writeImageCompress($file)
    {
        $mimeType = $file->getClientMimeType();
        $extArray = explode('/', $mimeType);
        $ext = $extArray[1];

        $directory = public_path("storage/image/compress/{$ext}");
        File::ensureDirectoryExists($directory);

        $pathSquare = "{$directory}/square/";
        File::ensureDirectoryExists($pathSquare);

        $pathLandscape = "{$directory}/landscape/";
        File::ensureDirectoryExists($pathLandscape);

        $name = $file->hashName();

        $original = $this->imageManager->read($file->getRealPath());

        // Square (fit 900x900)
        $squareImage = clone $original;
        $squareImage->cover(900, 900)->toJpeg()->save($pathSquare . '/' . $name);

        // Landscape (resize 900x720 keeping aspect ratio)
        $landscapeImage = clone $original;
        $landscapeImage->scale(900, 720, true)
            ->toJpeg()->save($pathLandscape . '/' . $name);

        $result = (object) [
            'imageName' => $name,
            'pathSquare' => $pathSquare . $name,
            'pathLandscape' => $pathLandscape . $name
        ];

        return json_encode($result);
    }

    public function removeFile($code)
    {
        $file = DB::table('files')->where('code', $code);
        $data = $file->first();
        if (!$data) return;
        $originalFile = public_path('storage/origin/' . $data->mimetype . '/' . $data->original_name);
        $compressedFile = public_path('storage/compress/' . $data->mimetype . '/' . $data->compressed_name);
        $pdfFile = public_path('storage/file/pdf/' . $data->original_name);

        if (File::exists($originalFile)) File::delete($originalFile);
        if (File::exists($compressedFile)) File::delete($compressedFile);
        if (File::exists($pdfFile)) File::delete($pdfFile);

        $file->delete();
    }

    public function updateFileDescription($desc, $code)
    {
        $file = DB::table('files')->where('code', $code);
        $data = $file->first();
        if (!$data) return;
        if ($data->description == $desc) return false;

        $data = ['description' => $desc];
        $file->update($data);
    }
}
