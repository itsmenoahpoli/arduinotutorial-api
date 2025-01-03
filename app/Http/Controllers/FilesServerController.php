<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FilesServerController extends Controller
{
    public function getFile(Request $request)
    {
        $filePath = $request->input('path');

        if (Storage::disk('public')->exists($filePath)) {
            $fileContent = Storage::disk('public')->get($filePath);
            $mimeType = Storage::disk('public')->mimeType($filePath);

            return response($fileContent, 200)->header('Content-Type', $mimeType);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}
