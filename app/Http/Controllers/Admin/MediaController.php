<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadMediaRequest;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display a listing of media files or return JSON for the media select modal.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = Media::query()->latest('id');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        if ($type = $request->input('type')) {
            if ($type === 'images') {
                $query->where('mime_type', 'like', 'image/%');
            } elseif ($type === 'documents') {
                $query->where('mime_type', 'not like', 'image/%');
            }
        }

        if ($request->expectsJson() || $request->query('format') === 'json') {
            $perPage = (int) $request->input('per_page', 24);
            $perPage = min(max($perPage, 6), 60);

            return response()->json($query->paginate($perPage));
        }

        $media = $query->paginate(24)->withQueryString();
        $totalCount = Media::count();
        $imageCount = Media::where('mime_type', 'like', 'image/%')->count();
        $totalSize = (int) Media::sum('size');

        return view('admin.media.index', compact('media', 'totalCount', 'imageCount', 'totalSize'));
    }

    /**
     * Store a newly uploaded media file.
     */
    public function store(UploadMediaRequest $request): JsonResponse|RedirectResponse
    {
        $file = $request->file('file');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $name = $request->filled('name') ? (string) $request->input('name') : $originalName;
        $extension = strtolower($file->getClientOriginalExtension());
        $safeName = Str::slug($name);

        if (empty($safeName)) {
            $safeName = 'media';
        }

        $filename = "{$safeName}-".time().'-'.Str::random(6).".{$extension}";
        $path = $file->storeAs('media', $filename, 'public');

        $width = null;
        $height = null;
        if (str_starts_with($file->getMimeType() ?? '', 'image/') && $extension !== 'svg') {
            $realPath = $file->getRealPath();
            if ($realPath && file_exists($realPath)) {
                $imageSize = @getimagesize($realPath);
                if ($imageSize) {
                    $width = (int) $imageSize[0];
                    $height = (int) $imageSize[1];
                }
            }
        }

        $media = Media::create([
            'name' => $name,
            'file_name' => $path,
            'disk' => 'public',
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'width' => $width,
            'height' => $height,
            'alt_text' => $request->input('alt_text'),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Media uploaded successfully.',
                'media' => $media,
            ], 201);
        }

        return redirect()->route('admin.media.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Update the specified media's metadata.
     */
    public function update(Request $request, Media $medium): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $medium->update($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Media updated successfully.',
                'media' => $medium,
            ]);
        }

        return redirect()->route('admin.media.index')->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified media from storage.
     */
    public function destroy(Request $request, Media $medium): JsonResponse|RedirectResponse
    {
        if (Storage::disk($medium->disk)->exists($medium->file_name)) {
            Storage::disk($medium->disk)->delete($medium->file_name);
        }

        $medium->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Media deleted successfully.',
            ]);
        }

        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully.');
    }
}
