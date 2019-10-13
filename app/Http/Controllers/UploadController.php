<?php

namespace App\Http\Controllers;

use App\Http\Requests\uploads\FileRequest;
use App\Http\Requests\uploads\ImageRequest;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(ImageRequest $request)
    {
        $file = $request->file('image');

        $path = $file->store($this->mainDir() . "/images", "public");

        return response()->json([
            'path'          => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function file(FileRequest $request)
    {
        $file = $request->file('file');

        $path = $file->store($this->mainDir() . "/docs", "public");

        return response()->json([
            'path'          => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function mainDir()
    {
        return explode("/", url()->previous())[3];
    }
}
