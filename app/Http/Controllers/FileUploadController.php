<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class FileUploadController extends Controller
{
    public function uploadFileToCloud(Request $request)
    {

        try {
            $file = $request->file('file');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $storeFile = $file->storeAs("test", $file_name, "gcs");

            $disk = Storage::disk('gcs');
            $fetchFile = $disk->url($storeFile);
        } catch(\Throwable $error) {
            dd($error);
        }

        return response()->json([
                'data' => $fetchFile,
            ], 201);
    }
}