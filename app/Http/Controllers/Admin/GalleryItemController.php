<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Setting;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for website gallery items.
 */
class GalleryItemController extends Controller
{
    /**
     * Setting keys for the home gallery section.
     *
     * @var list<string>
     */
    private const HOME_SECTION_SETTING_KEYS = [
        'gallery_home_title',
    ];

    /**
     * Display gallery items and home section settings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $items = GalleryItem::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $homeSectionSettings = Setting::getMany(self::HOME_SECTION_SETTING_KEYS);

        return view('admin.gallery-items.index', compact('items', 'homeSectionSettings'));
    }

    /**
     * Update the home gallery section settings.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_home_title' => ['nullable', 'string', 'max:255'],
        ]);

        Setting::setValue('gallery_home_title', $validated['gallery_home_title'] ?? null);

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('success', 'Home gallery section settings updated successfully.');
    }

    /**
     * Show the form to create a new gallery item.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.gallery-items.create');
    }

    /**
     * Store a newly created gallery item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateItem($request);

        GalleryItem::create($this->itemAttributes($validated));

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('success', 'Gallery item created successfully.');
    }

    /**
     * Show the form to edit a gallery item.
     *
     * @return \Illuminate\View\View
     */
    public function edit(GalleryItem $galleryItem): View
    {
        return view('admin.gallery-items.edit', compact('galleryItem'));
    }

    /**
     * Update the given gallery item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $validated = $this->validateItem($request);

        $galleryItem->fill($this->itemAttributes($validated));
        $galleryItem->save();

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Delete a gallery item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $galleryItem->delete();

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('success', 'Gallery item deleted successfully.');
    }

    /**
     * Validate gallery item form input.
     *
     * @return array<string, mixed>
     */
    private function validateItem(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', 'string', 'in:image,video'],
            'source' => ['required', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'icon_tags' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['required', 'boolean'],
            'display_on_home' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);
    }

    /**
     * Map validated input to model attributes.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function itemAttributes(array $validated): array
    {
        return [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'source' => MediaPath::normalize($validated['source']) ?? $validated['source'],
            'thumbnail' => MediaPath::normalize($validated['thumbnail'] ?? null),
            'icon_tags' => $validated['icon_tags'] ?? null,
            'is_featured' => (bool) $validated['is_featured'],
            'display_on_home' => (bool) $validated['display_on_home'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ];
    }
}
