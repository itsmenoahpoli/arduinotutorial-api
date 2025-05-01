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
            $fullPath = Storage::disk('public')->path($filePath);
            $mimeType = mime_content_type($fullPath);
            $size = Storage::disk('public')->size($filePath);
            $fileName = basename($filePath);

            return response()->stream(function () use ($filePath) {
                $stream = Storage::disk('public')->readStream($filePath);
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }, 200, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
                'Content-Length' => $size,
            ]);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}
