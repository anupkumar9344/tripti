<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for Why Choose Sahaj Aarogyam section items.
 */
class WhyChooseItemController extends Controller
{
    /**
     * Display the list of why choose items.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $items = WhyChooseItem::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.why-choose-items.index', compact('items'));
    }

    /**
     * Show the form to create a new why choose item.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.why-choose-items.create');
    }

    /**
     * Store a newly created why choose item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        WhyChooseItem::create([
            'title' => $validated['title'],
            'icon' => $validated['icon'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ]);

        return redirect()
            ->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item created successfully.');
    }

    /**
     * Show the form to edit a why choose item.
     *
     * @return \Illuminate\View\View
     */
    public function edit(WhyChooseItem $whyChooseItem): View
    {
        return view('admin.why-choose-items.edit', compact('whyChooseItem'));
    }

    /**
     * Update the given why choose item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, WhyChooseItem $whyChooseItem): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $whyChooseItem->title = $validated['title'];
        $whyChooseItem->icon = $validated['icon'] ?? null;
        $whyChooseItem->short_description = $validated['short_description'] ?? null;
        $whyChooseItem->sort_order = $validated['sort_order'] ?? 0;
        $whyChooseItem->status = (bool) $validated['status'];
        $whyChooseItem->save();

        return redirect()
            ->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item updated successfully.');
    }

    /**
     * Delete a why choose item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(WhyChooseItem $whyChooseItem): RedirectResponse
    {
        $whyChooseItem->delete();

        return redirect()
            ->route('admin.why-choose-items.index')
            ->with('success', 'Why Choose item deleted successfully.');
    }
}
