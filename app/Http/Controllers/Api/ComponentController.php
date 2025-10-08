<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class ComponentController extends Controller
{
    protected $model;
    protected $key;
    protected $display;
    protected ImageManager $imageManager;

    public function __construct(Request $request, ImageManager $imageManager)
    {
        $this->model = $request->get('model');
        $this->key = $request->get('key');
        $this->display = $request->get('display');
        $this->imageManager = $imageManager;
    }

    public function file_upload(Request $request)
    {
        $destinationPath = public_path('storage/upload');
        $bucket = [
            'upload',
            'avatar',
            'images',
            'editor'
        ];

        if (!empty($request->get('bucket'))) {
            if (!in_array($request->get('bucket'), $bucket)) return response(['error' => [
                'message' => 'Bucket / Path not permited!',
                'status_code' => 500
            ]]);

            $destinationPath = public_path('storage/' . $request->get('bucket'));
        }

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0766, true);
        }

        $files = $request->file();

        $uploaded = [];
        foreach ($files as $key => $value) {
            $extension = $value->getClientOriginalExtension();
            $mime = $value->getClientMimeType();
            $randomfile = time() . '.' . $extension;

            if ($mime === 'image/webp') {
                // Skip Intervention, langsung move file
                $value->move($destinationPath, $randomfile);
            } else {
                $file = $this->imageManager->read($value->getRealPath());
                $file->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $randomfile);
            }

            $data = [
                'name' => $key,
                'filename' => $randomfile,
                'bucket' => $destinationPath,
                'mime_type' => $mime
            ];
            $uploaded[] = $data;
        }

        return response($uploaded);
    }

    public function deleteFile(Request $request)
    {
        $bucket = 'storage/';
        if (!empty($request->get('bucket'))) $bucket .= $request->get('bucket') . '/';
        $bucket .= $request->get('filename');
        $dirFile = $bucket;

        $file = public_path($dirFile);
        if (File::exists($file)) {
            File::delete($file);

            $response = [
                'message' => 'File deleted successfully'
            ];
            return response($response);
        }
        return response(['message' => 'File not exist']);
    }

    public function select2($table, $key, $value, Request $request)
    {
        $whereRaw = 'deleted_at IS NULL ';
        $bindings = [];

        if (!empty($request->get('params'))) {
            foreach ($request->get('params') as $keys => $values) {
                $whereRaw .= "AND $keys = ? ";
                $bindings[] = $values;
            }
        }

        if (!empty($request->get('search'))) {
            $whereRaw .= 'AND lower(' . $value . ') LIKE ?';
            $bindings[] = "%" . strtolower($request->get('search')) . "%";
        }

        if (!empty($request->get('filter'))) {
            foreach ($request->get('filter') as $column => $filterValue) {
                if ($filterValue === 'IS NULL' || $filterValue === null) {
                    $whereRaw .= "AND $column IS NULL ";
                } elseif ($filterValue === 'IS NOT NULL') {
                    $whereRaw .= "AND $column IS NOT NULL ";
                } else {
                    $whereRaw .= "AND $column = ? ";
                    $bindings[] = $filterValue;
                }
            }
        }

        $result = DB::table($table)
            ->whereRaw($whereRaw, $bindings)
            ->get();

        $response = [];
        foreach ($result as $q => $items) {
            $response[$q]['id'] = $items->$key;
            $response[$q]['text'] = $items->$value;
        }

        return response(['results' => $response]);
    }

    public function sysparam($group, $value, Request $request)
    {
        $whereRaw = 'sysparams.deleted_at IS NULL AND sysparams.groups = ? ';
        $bindings = [$group];
        if (!empty($request->get('search'))) {
            $whereRaw .= 'AND lower(sysparams.' . $value . ') LIKE ?';
            $bindings[] = "%" . strtolower($request->get('search')) . "%";
        }

        $result = DB::table('sysparams')
            ->whereRaw($whereRaw, $bindings)
            ->get();

        $response = [];
        foreach ($result as $q => $items) {
            $response[$q]['id'] = $items->key;
            $response[$q]['text'] = $items->$value;
        }

        return response(['results' => $response]);
    }
}
