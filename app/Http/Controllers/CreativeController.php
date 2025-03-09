<?php

namespace App\Http\Controllers;

use App\Models\Creative;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreativeController extends Controller
{
    public function upload(Request $request, Item $item): JsonResponse
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,mp4,mov,webp,webm',
        ]);

        if ($request->file('file')->getSize() > 100_000_000) {
            return response()->json([
                'success' => false,
                'error' => 'File is bigger than 100Mb',
            ], 400);
        }

        $file = $request->file('file');

        // Determine file type
        $type = match (strtolower($file->getClientOriginalExtension())) {
            'mp4', 'mov', 'webm' => 'VIDEO',
            default => 'IMAGE',
        };

        // Generate a unique filename
        $randomFileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs("creatives", $randomFileName, 'public');

        Creative::create([
            'item_id' => $item->id,
            'name' => $file->getClientOriginalName(),
            'type' => $type,
            'path' => $path,
        ]);

        return response()->json([
            'message' => 'File uploaded successfully.',
            'type' => $type,
            'path' => Storage::url($path),
        ]);
    }
}
