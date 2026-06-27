<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Support\MediaPath;
use App\Support\PageLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for home page hero banners.
 */
class HeroBannerController extends Controller
{
    /**
     * Display the list of hero banners.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $heroBanners = HeroBanner::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.hero-banners.index', compact('heroBanners'));
    }

    /**
     * Show the form to create a new hero banner.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.hero-banners.create');
    }

    /**
     * Store a newly created hero banner.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'image' => ['required', 'string', 'max:500'],
            'primary_label' => ['nullable', 'string', 'max:255'],
            'primary_url' => ['nullable', 'string', 'max:500'],
            'secondary_label' => ['nullable', 'string', 'max:255'],
            'secondary_url' => ['nullable', 'string', 'max:500'],
            'secondary_type' => ['nullable', 'string', 'in:link,video'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = MediaPath::normalize($validated['image'] ?? null);

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please paste an image URL from the media library.'])
                ->withInput();
        }

        HeroBanner::create($this->payloadFromValidated($validated, $imagePath));

        return redirect()
            ->route('admin.hero-banners.index')
            ->with('success', 'Hero banner created successfully.');
    }

    /**
     * Show the form to edit a hero banner.
     *
     * @return \Illuminate\View\View
     */
    public function edit(HeroBanner $heroBanner): View
    {
        return view('admin.hero-banners.edit', compact('heroBanner'));
    }

    /**
     * Update the given hero banner.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HeroBanner $heroBanner): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:500'],
            'primary_label' => ['nullable', 'string', 'max:255'],
            'primary_url' => ['nullable', 'string', 'max:500'],
            'secondary_label' => ['nullable', 'string', 'max:255'],
            'secondary_url' => ['nullable', 'string', 'max:500'],
            'secondary_type' => ['nullable', 'string', 'in:link,video'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = MediaPath::normalize($validated['image'] ?? null) ?: $heroBanner->image;

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please paste an image URL from the media library.'])
                ->withInput();
        }

        $heroBanner->update($this->payloadFromValidated($validated, $imagePath));

        return redirect()
            ->route('admin.hero-banners.index')
            ->with('success', 'Hero banner updated successfully.');
    }

    /**
     * Remove the given hero banner.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HeroBanner $heroBanner): RedirectResponse
    {
        $heroBanner->delete();

        return redirect()
            ->route('admin.hero-banners.index')
            ->with('success', 'Hero banner deleted successfully.');
    }

    /**
     * Build the persisted payload from validated input.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payloadFromValidated(array $validated, string $imagePath): array
    {
        return [
            'eyebrow' => $validated['eyebrow'] ?? null,
            'title' => $validated['title'],
            'text' => $validated['text'] ?? null,
            'image' => $imagePath,
            'primary_label' => $validated['primary_label'] ?? null,
            'primary_url' => PageLink::normalize($validated['primary_url'] ?? null),
            'secondary_label' => $validated['secondary_label'] ?? null,
            'secondary_url' => PageLink::normalize($validated['secondary_url'] ?? null),
            'secondary_type' => $validated['secondary_type'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ];
    }
}
