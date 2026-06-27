<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpertProfileCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for expert profile categories.
 */
class ExpertProfileCategoryController extends Controller
{
    /**
     * Display the list of profile categories.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $categories = ExpertProfileCategory::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.expert-profile-categories.index', compact('categories'));
    }

    /**
     * Show the form to create a new profile category.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.expert-profile-categories.create');
    }

    /**
     * Store a newly created profile category.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        ExpertProfileCategory::create([
            'title' => $validated['title'],
            'icon' => $validated['icon'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ]);

        return redirect()
            ->route('admin.expert-profile-categories.index')
            ->with('success', 'Profile category created successfully.');
    }

    /**
     * Show the form to edit a profile category.
     *
     * @return \Illuminate\View\View
     */
    public function edit(ExpertProfileCategory $expertProfileCategory): View
    {
        return view('admin.expert-profile-categories.edit', compact('expertProfileCategory'));
    }

    /**
     * Update the given profile category.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ExpertProfileCategory $expertProfileCategory): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $expertProfileCategory->title = $validated['title'];
        $expertProfileCategory->icon = $validated['icon'] ?? null;
        $expertProfileCategory->sort_order = $validated['sort_order'] ?? 0;
        $expertProfileCategory->status = (bool) $validated['status'];
        $expertProfileCategory->save();

        return redirect()
            ->route('admin.expert-profile-categories.index')
            ->with('success', 'Profile category updated successfully.');
    }

    /**
     * Delete a profile category.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ExpertProfileCategory $expertProfileCategory): RedirectResponse
    {
        $expertProfileCategory->delete();

        return redirect()
            ->route('admin.expert-profile-categories.index')
            ->with('success', 'Profile category deleted successfully.');
    }
}
