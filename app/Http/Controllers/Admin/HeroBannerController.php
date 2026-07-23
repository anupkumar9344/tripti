<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Support\MediaPath;
use App\Support\PageLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $validated = $this->validateBanner($request);

        HeroBanner::create($this->payloadFromValidated($validated));

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
        $validated = $this->validateBanner($request, $heroBanner);

        $heroBanner->update($this->payloadFromValidated($validated, $heroBanner));

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
     * Validate hero banner form input.
     *
     * @return array<string, mixed>
     */
    private function validateBanner(Request $request, ?HeroBanner $heroBanner = null): array
    {
        $mediaType = $request->input('media_type', $heroBanner->media_type ?? 'image');

        return $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'media_type' => ['required', 'string', 'in:image,video'],
            'image' => [
                Rule::requiredIf($mediaType === 'image' && ! $heroBanner),
                'nullable',
                'string',
                'max:500',
            ],
            'video' => [
                Rule::requiredIf($mediaType === 'video'),
                'nullable',
                'string',
                'max:500',
            ],
            'primary_label' => ['nullable', 'string', 'max:255'],
            'primary_url' => ['nullable', 'string', 'max:500'],
            'secondary_label' => ['nullable', 'string', 'max:255'],
            'secondary_url' => ['nullable', 'string', 'max:500'],
            'secondary_type' => ['nullable', 'string', 'in:link,video'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);
    }

    /**
     * Build the persisted payload from validated input.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payloadFromValidated(array $validated, ?HeroBanner $heroBanner = null): array
    {
        $mediaType = $validated['media_type'];
        $imagePath = MediaPath::normalize($validated['image'] ?? null);
        $videoPath = $validated['video'] ?? null;

        if ($mediaType === 'video') {
            $videoPath = trim((string) $videoPath) ?: null;
            $imagePath = $imagePath ?: ($heroBanner?->image);
        } else {
            $videoPath = null;
            $imagePath = $imagePath ?: ($heroBanner?->image);
        }

        return [
            'eyebrow' => $validated['eyebrow'] ?? null,
            'title' => $validated['title'],
            'text' => $validated['text'] ?? null,
            'media_type' => $mediaType,
            'image' => $imagePath,
            'video' => $videoPath,
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
