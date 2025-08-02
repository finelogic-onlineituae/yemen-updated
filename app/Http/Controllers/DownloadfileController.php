<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadfileController extends Controller
{

    public function servePdf(Request $request)
    {
        $path = $request->query('path');

        // Basic path validation
        if (!preg_match('/^[\w\-\/\.]+$/', $path)) {
            abort(400, 'Invalid file path');
        }

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return response()->file(storage_path("app/public/{$path}"));
    }

    public function download(Request $request)
    {
       //return response()->json(['error' => 'File not found.'], 404);
        // 1. Check for valid signed URL
        // if (! $request->hasValidSignature()) {
        //     return response()->json(['error' => 'Invalid or expired signature.'], 403);
        // }
        // 2. Check for valid CERTIFICATE_ACCESS token in headers
        $headerToken = $request->header('CERTIFICATE_ACCESS');
        $expectedToken = config('certificate.token');

        if ($headerToken !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized. Invalid certificate access token.'], 403);
        }

        // 3. Get file path from query string
        $file = $request->query('file');
        $fullPath = storage_path("app/public/{$file}");

        // 4. Check if file exists
        if (! file_exists($fullPath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }
        return response()->file($fullPath);

        // 5. Serve the file
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Valid request. File exists.',
        //     'path' =>$fullPath
        // ]);
    }
}
