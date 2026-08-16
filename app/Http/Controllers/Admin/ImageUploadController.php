<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        if (!$request->hasFile('upload')) {
            return response()->json(['error' => ['message' => 'No file uploaded']], 400);
        }

        $file = $request->file('upload');

        if (!$file->isValid()) {
            return response()->json(['error' => ['message' => 'Invalid file upload']], 400);
        }

        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowed)) {
            return response()->json(['error' => ['message' => 'Only JPG, PNG, WebP, GIF allowed']], 400);
        }

        if ($file->getSize() > 2048 * 1024) {
            return response()->json(['error' => ['message' => 'Image must be under 2MB']], 400);
        }

        $path = $file->store('blog-content-images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}