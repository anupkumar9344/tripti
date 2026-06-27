<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\ExpertProfileCategory;
use App\Models\ExpertProfileSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Handles admin CRUD for expert team members.
 */
class ExpertController extends Controller
{
    /**
     * Display the list of experts.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $experts = Expert::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.experts.index', compact('experts'));
    }

    /**
     * Show the form to create a new expert.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.experts.create');
    }

    /**
     * Store a newly created expert.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'photo' => ['required', 'image', 'max:2048'],
            'designation' => ['nullable', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slugSource = $validated['slug'] ?? $validated['name'];
        $slug = Expert::generateUniqueSlug($slugSource);

        Expert::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'photo' => $request->file('photo')->store('experts/photos', 'public'),
            'designation' => $validated['designation'] ?? null,
            'specialty' => $validated['specialty'] ?? null,
            'qualifications' => $validated['qualifications'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'status' => (bool) $validated['status'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.experts.index')
            ->with('success', 'Team member created successfully. Edit to add profile categories and details.');
    }

    /**
     * Show the form to edit an expert.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Expert $expert): View
    {
        $expert->load('profileSections');

        $profileCategories = ExpertProfileCategory::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $profileSectionContents = $expert->profileSections
            ->pluck('content', 'expert_profile_category_id')
            ->all();

        $selectedCategoryIds = old(
            'profile_category_ids',
            $expert->profileSections->pluck('expert_profile_category_id')->all()
        );

        return view('admin.experts.edit', compact(
            'expert',
            'profileCategories',
            'profileSectionContents',
            'selectedCategoryIds'
        ));
    }

    /**
     * Update the given expert.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Expert $expert): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'designation' => ['nullable', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'specialty_location' => ['nullable', 'string', 'max:255'],
            'experience_label' => ['nullable', 'string', 'max:255'],
            'patients_treated' => ['nullable', 'string', 'max:255'],
            'highlight_quote' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'profile_category_ids' => ['nullable', 'array'],
            'profile_category_ids.*' => ['integer', 'exists:expert_profile_categories,id'],
            'profile_sections' => ['nullable', 'array'],
            'profile_sections.*' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slugSource = $validated['slug'] ?? $validated['name'];
        $slug = Expert::generateUniqueSlug($slugSource, $expert->id);

        $expert->name = $validated['name'];
        $expert->slug = $slug;
        $expert->designation = $validated['designation'] ?? null;
        $expert->specialty = $validated['specialty'] ?? null;
        $expert->qualifications = $validated['qualifications'] ?? null;
        $expert->short_description = $validated['short_description'] ?? null;
        $expert->specialty_location = $validated['specialty_location'] ?? null;
        $expert->experience_label = $validated['experience_label'] ?? null;
        $expert->patients_treated = $validated['patients_treated'] ?? null;
        $expert->highlight_quote = $validated['highlight_quote'] ?? null;
        $expert->long_description = $validated['long_description'] ?? null;
        $expert->status = (bool) $validated['status'];
        $expert->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('photo')) {
            if (Storage::disk('public')->exists($expert->photo)) {
                Storage::disk('public')->delete($expert->photo);
            }

            $expert->photo = $request->file('photo')->store('experts/photos', 'public');
        }

        $expert->save();

        $this->syncProfileSections(
            $expert,
            $validated['profile_category_ids'] ?? [],
            $validated['profile_sections'] ?? []
        );

        return redirect()
            ->route('admin.experts.index')
            ->with('success', 'Expert updated successfully.');
    }

    /**
     * Delete an expert and its photo.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Expert $expert): RedirectResponse
    {
        if (Storage::disk('public')->exists($expert->photo)) {
            Storage::disk('public')->delete($expert->photo);
        }

        $expert->delete();

        return redirect()
            ->route('admin.experts.index')
            ->with('success', 'Expert deleted successfully.');
    }

    /**
     * Save selected categories and their content for an expert.
     *
     * @param  list<int|string>  $selectedCategoryIds
     * @param  array<int|string, string|null>  $sections
     */
    private function syncProfileSections(Expert $expert, array $selectedCategoryIds, array $sections): void
    {
        $selectedCategoryIds = array_map('intval', $selectedCategoryIds);

        if ($selectedCategoryIds === []) {
            ExpertProfileSection::query()
                ->where('expert_id', $expert->id)
                ->delete();

            return;
        }

        ExpertProfileSection::query()
            ->where('expert_id', $expert->id)
            ->whereNotIn('expert_profile_category_id', $selectedCategoryIds)
            ->delete();

        foreach ($selectedCategoryIds as $categoryId) {
            $content = isset($sections[$categoryId]) && is_string($sections[$categoryId])
                ? trim($sections[$categoryId])
                : '';

            ExpertProfileSection::query()->updateOrCreate(
                [
                    'expert_id' => $expert->id,
                    'expert_profile_category_id' => $categoryId,
                ],
                [
                    'content' => $content !== '' ? $content : null,
                ]
            );
        }
    }
}
