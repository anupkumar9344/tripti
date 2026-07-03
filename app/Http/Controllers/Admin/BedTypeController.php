<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BedType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for bed types.
 */
class BedTypeController extends Controller
{
    /**
     * Display the list of bed types.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $bedTypes = BedType::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.bed-types.index', compact('bedTypes'));
    }

    /**
     * Show the form to create a new bed type.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.bed-types.create');
    }

    /**
     * Store a newly created bed type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        BedType::create([
            'name' => $validated['name'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.bed-types.index')
            ->with('success', 'Bed type created successfully.');
    }

    /**
     * Show the form to edit a bed type.
     *
     * @return \Illuminate\View\View
     */
    public function edit(BedType $bedType): View
    {
        return view('admin.bed-types.edit', compact('bedType'));
    }

    /**
     * Update the given bed type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BedType $bedType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $bedType->name = $validated['name'];
        $bedType->sort_order = $validated['sort_order'] ?? 0;
        $bedType->save();

        return redirect()
            ->route('admin.bed-types.index')
            ->with('success', 'Bed type updated successfully.');
    }

    /**
     * Delete a bed type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BedType $bedType): RedirectResponse
    {
        $bedType->delete();

        return redirect()
            ->route('admin.bed-types.index')
            ->with('success', 'Bed type deleted successfully.');
    }
}
