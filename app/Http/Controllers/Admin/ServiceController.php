<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for services.
 */
class ServiceController extends Controller
{
    /**
     * Display the list of services.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $services = Service::query()
            ->withCount('images')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form to create a new service.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'gallery_images_text' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'display_on_home' => ['required', 'boolean'],
            'show_faq_section' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $thumbnailPath = MediaPath::normalize($validated['thumbnail'] ?? null);

        if (! $thumbnailPath) {
            return back()
                ->withErrors(['thumbnail' => 'Please paste a thumbnail URL from the media library.'])
                ->withInput();
        }

        $slugSource = $validated['slug'] ?? $validated['title'];
        $slug = Service::generateUniqueSlug($slugSource);

        $service = Service::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'thumbnail' => $thumbnailPath,
            'icon' => $validated['icon'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'long_description' => $validated['long_description'] ?? null,
            'status' => (bool) $validated['status'],
            'display_on_home' => (bool) $validated['display_on_home'],
            'show_faq_section' => (bool) $validated['show_faq_section'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        $this->storeGalleryPaths($service, MediaPath::parseUrlLines($validated['gallery_images_text'] ?? null));

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Show the form to edit a service.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Service $service): View
    {
        $service->load('images');

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the given service.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'gallery_images_text' => ['nullable', 'string'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer', 'exists:service_images,id'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'display_on_home' => ['required', 'boolean'],
            'show_faq_section' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slugSource = $validated['slug'] ?? $validated['title'];
        $slug = Service::generateUniqueSlug($slugSource, $service->id);
        $thumbnailPath = MediaPath::normalize($validated['thumbnail'] ?? null);

        $service->title = $validated['title'];
        $service->slug = $slug;
        $service->icon = $validated['icon'] ?? null;
        $service->short_description = $validated['short_description'] ?? null;
        $service->tags = $validated['tags'] ?? null;
        $service->long_description = $validated['long_description'] ?? null;
        $service->status = (bool) $validated['status'];
        $service->display_on_home = (bool) $validated['display_on_home'];
        $service->show_faq_section = (bool) $validated['show_faq_section'];
        $service->sort_order = $validated['sort_order'] ?? 0;

        if ($thumbnailPath && $thumbnailPath !== $service->thumbnail) {
            MediaPath::deleteLegacyFile($service->thumbnail);
            $service->thumbnail = $thumbnailPath;
        }

        $service->save();

        $this->removeGalleryImages($service, $validated['remove_images'] ?? []);
        $this->storeGalleryPaths($service, MediaPath::parseUrlLines($validated['gallery_images_text'] ?? null));

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Delete a service and its legacy files.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service): RedirectResponse
    {
        MediaPath::deleteLegacyFile($service->thumbnail);

        foreach ($service->images as $image) {
            MediaPath::deleteLegacyFile($image->image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Store gallery image paths pasted from the media library.
     *
     * @param  list<string>  $paths
     */
    private function storeGalleryPaths(Service $service, array $paths): void
    {
        if ($paths === []) {
            return;
        }

        $nextOrder = (int) $service->images()->max('sort_order');

        foreach ($paths as $path) {
            $nextOrder++;

            $service->images()->create([
                'image' => $path,
                'sort_order' => $nextOrder,
            ]);
        }
    }

    /**
     * Remove selected gallery images from a service.
     *
     * @param  list<int>  $imageIds
     */
    private function removeGalleryImages(Service $service, array $imageIds): void
    {
        if ($imageIds === []) {
            return;
        }

        $images = ServiceImage::query()
            ->where('service_id', $service->id)
            ->whereIn('id', $imageIds)
            ->get();

        foreach ($images as $image) {
            MediaPath::deleteLegacyFile($image->image);
            $image->delete();
        }
    }
}
