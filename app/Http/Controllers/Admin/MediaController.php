<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Handles admin media library management.
 */
class MediaController extends Controller
{
    /**
     * Display the media library page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.media.index');
    }

    /**
     * Return paginated media items for the library or picker.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function browse(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'in:all,image,pdf,document,video,other'],
            'sort' => ['nullable', 'string', 'in:latest,oldest,name_asc,name_desc,size'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:6', 'max:48'],
            'picker_type' => ['nullable', 'string', 'in:all,image,file'],
        ]);

        $perPage = $validated['per_page'] ?? 24;
        $category = $validated['category'] ?? 'all';
        $sort = $validated['sort'] ?? 'latest';
        $pickerType = $validated['picker_type'] ?? 'all';

        $query = MediaFile::query()->browse(
            $validated['search'] ?? null,
            $category,
            $sort
        );

        if ($pickerType === 'image') {
            $query->where('file_category', MediaFile::CATEGORY_IMAGE);
        }

        $paginator = $query->paginate($perPage);

        return response()->json([
            'data' => $paginator->getCollection()->map->toLibraryArray()->values(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem() ?? 0,
                'to' => $paginator->lastItem() ?? 0,
            ],
        ]);
    }

    /**
     * Upload one or more files to the media library.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['file', 'max:51200'],
        ]);

        $allowed = MediaFile::allowedExtensions();
        $uploaded = [];

        foreach ($validated['files'] as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $extension = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: '');

            if (! in_array($extension, $allowed, true)) {
                return response()->json([
                    'message' => 'Unsupported file type: '.$file->getClientOriginalName(),
                ], 422);
            }

            $media = $this->persistUploadedFile($file, $extension);
            $uploaded[] = $media->toLibraryArray();
        }

        return response()->json([
            'message' => count($uploaded).' file(s) uploaded successfully.',
            'data' => $uploaded,
        ]);
    }

    /**
     * Update the display name of a media file.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, MediaFile $mediaFile): JsonResponse
    {
        $validated = $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
        ]);

        $mediaFile->display_name = trim($validated['display_name']);
        $mediaFile->save();

        return response()->json([
            'message' => 'Display name updated successfully.',
            'data' => $mediaFile->fresh()->toLibraryArray(),
        ]);
    }

    /**
     * Delete a media file record and its physical file.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MediaFile $mediaFile): JsonResponse
    {
        $mediaFile->deletePhysicalFile();
        $mediaFile->delete();

        return response()->json([
            'message' => 'Media file deleted successfully.',
        ]);
    }

    /**
     * Download a media file using its original filename.
     */
    public function download(MediaFile $mediaFile): BinaryFileResponse
    {
        abort_unless(File::exists($mediaFile->absolutePath()), 404);

        return response()->download($mediaFile->absolutePath(), $mediaFile->original_name);
    }

    /**
     * Store an uploaded file on disk and create its database record.
     */
    private function persistUploadedFile(UploadedFile $file, string $extension): MediaFile
    {
        $originalName = $file->getClientOriginalName();
        $category = MediaFile::categoryFromExtension($extension);
        $directory = 'media-management/'.$category.'/'.now()->format('Y/m');
        $absoluteDirectory = public_path($directory);

        if (! File::isDirectory($absoluteDirectory)) {
            File::makeDirectory($absoluteDirectory, 0755, true);
        }

        $storedName = Str::uuid()->toString().'-'.Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $storedName = Str::limit($storedName, 180, '').'.'.$extension;
        $file->move($absoluteDirectory, $storedName);

        $relativePath = $directory.'/'.$storedName;

        return MediaFile::create([
            'display_name' => MediaFile::displayNameFromOriginal($originalName),
            'original_name' => $originalName,
            'file_path' => $relativePath,
            'mime_type' => $file->getClientMimeType() ?: 'application/octet-stream',
            'extension' => $extension,
            'file_size' => File::size(public_path($relativePath)),
            'file_category' => $category,
            'usage_summary' => null,
        ]);
    }
}
