<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaFile;
use App\Models\Treatment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Handles admin CRUD for treatments.
 */
class TreatmentController extends Controller
{
    /**
     * Display the list of treatments.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $treatments = Treatment::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.treatments.index', compact('treatments'));
    }

    /**
     * Show the form to create a new treatment.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.treatments.create');
    }

    /**
     * Store a newly created treatment.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'media_id' => ['nullable', 'exists:media_files,id'],
            'image' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'display_on_home' => ['required', 'boolean'],
        ]);

        $imagePath = $this->resolveImagePath($request);

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please choose an image from the media library.'])
                ->withInput();
        }

        $slugSource = $validated['slug'] ?? $validated['title'];
        $slug = Treatment::generateUniqueSlug($slugSource);

        Treatment::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'image' => $imagePath,
            'icon' => $validated['icon'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'long_description' => $validated['long_description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
            'display_on_home' => (bool) $validated['display_on_home'],
        ]);

        return redirect()
            ->route('admin.treatments.index')
            ->with('success', 'Treatment created successfully.');
    }

    /**
     * Show the form to edit a treatment.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Treatment $treatment): View
    {
        return view('admin.treatments.edit', compact('treatment'));
    }

    /**
     * Update the given treatment.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Treatment $treatment): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'media_id' => ['nullable', 'exists:media_files,id'],
            'image' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'display_on_home' => ['required', 'boolean'],
        ]);

        $slugSource = $validated['slug'] ?? $validated['title'];
        $slug = Treatment::generateUniqueSlug($slugSource, $treatment->id);
        $imagePath = $this->resolveImagePath($request);

        $treatment->title = $validated['title'];
        $treatment->slug = $slug;
        $treatment->icon = $validated['icon'] ?? null;
        $treatment->short_description = $validated['short_description'] ?? null;
        $treatment->long_description = $validated['long_description'] ?? null;
        $treatment->sort_order = $validated['sort_order'] ?? 0;
        $treatment->status = (bool) $validated['status'];
        $treatment->display_on_home = (bool) $validated['display_on_home'];

        if ($imagePath && $imagePath !== $treatment->image) {
            $this->deleteLegacyImage($treatment->image);
            $treatment->image = $imagePath;
        }

        $treatment->save();

        return redirect()
            ->route('admin.treatments.index')
            ->with('success', 'Treatment updated successfully.');
    }

    /**
     * Delete a treatment and its image.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Treatment $treatment): RedirectResponse
    {
        $this->deleteLegacyImage($treatment->image);

        $treatment->delete();

        return redirect()
            ->route('admin.treatments.index')
            ->with('success', 'Treatment deleted successfully.');
    }

    /**
     * Resolve the stored image path from media picker inputs.
     */
    private function resolveImagePath(Request $request): ?string
    {
        $mediaId = $request->input('media_id');

        if ($mediaId) {
            $media = MediaFile::find($mediaId);

            if ($media) {
                return $media->file_path;
            }
        }

        $path = $request->input('image');

        return filled($path) ? $path : null;
    }

    /**
     * Delete legacy storage-based images without touching media library files.
     */
    private function deleteLegacyImage(?string $path): void
    {
        if (! $path || str_starts_with($path, 'media-management/')) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
