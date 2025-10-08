<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class FileUploadController extends Controller
{
    public function file_upload(Request $request)
    {
        $destinationPath = 'images';

        if (!empty($request->get('bucket'))) $destinationPath = $request->get('bucket');

        $files = $request->file();

        $uploaded = [];
        foreach ($files as $key => $value) {
            $destination = public_path('storage/' . $destinationPath . '/' . $value->hashName());
            $value->store($destinationPath, 'public');

            $data = [
                'name' => $key,
                'filename' => $value->hashName(),
                'bucket' => public_path('storage/' . $destination),
                'mime_type' => $value->getClientMimeType()
            ];
            $uploaded[] = $data;
        }

        return response($uploaded);
    }
}
