<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'thumbnail' => ['required', 'image', 'max:2048'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:2048'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slugSource = $validated['slug'] ?? $validated['title'];
        $slug = Service::generateUniqueSlug($slugSource);

        $service = Service::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'thumbnail' => $request->file('thumbnail')->store('services/thumbnails', 'public'),
            'short_description' => $validated['short_description'] ?? null,
            'long_description' => $validated['long_description'] ?? null,
            'status' => (bool) $validated['status'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        $this->storeGalleryImages($service, $request->file('images'));

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
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:2048'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer', 'exists:service_images,id'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slugSource = $validated['slug'] ?? $validated['title'];
        $slug = Service::generateUniqueSlug($slugSource, $service->id);

        $service->title = $validated['title'];
        $service->slug = $slug;
        $service->short_description = $validated['short_description'] ?? null;
        $service->long_description = $validated['long_description'] ?? null;
        $service->status = (bool) $validated['status'];
        $service->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($service->thumbnail)) {
                Storage::disk('public')->delete($service->thumbnail);
            }

            $service->thumbnail = $request->file('thumbnail')->store('services/thumbnails', 'public');
        }

        $service->save();

        $this->removeGalleryImages($service, $validated['remove_images'] ?? []);
        $this->storeGalleryImages($service, $request->file('images'));

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Delete a service and its files.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service): RedirectResponse
    {
        if (Storage::disk('public')->exists($service->thumbnail)) {
            Storage::disk('public')->delete($service->thumbnail);
        }

        foreach ($service->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Store uploaded gallery images for a service.
     *
     * @param  array<int, \Illuminate\Http\UploadedFile>|null  $images
     */
    private function storeGalleryImages(Service $service, ?array $images): void
    {
        if (empty($images)) {
            return;
        }

        $nextOrder = (int) $service->images()->max('sort_order');

        foreach ($images as $image) {
            $nextOrder++;

            $service->images()->create([
                'image' => $image->store('services/gallery', 'public'),
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
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            $image->delete();
        }
    }
}
