<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request) {

        $file = $request->file('file');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $storeFile = $file->storeAs("test", $file_name . "." . $file->getClientOriginalExtension(), "gcs");
        return response()->json([
            'data' => $storeFile,
        ], 201);
    }
}