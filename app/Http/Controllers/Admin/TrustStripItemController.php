<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustStripItem;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for home page trust strip items.
 */
class TrustStripItemController extends Controller
{
    /**
     * Display the list of trust strip items.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $trustStripItems = TrustStripItem::query()
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get();

        return view('admin.trust-strip-items.index', compact('trustStripItems'));
    }

    /**
     * Show the form to create a new trust strip item.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.trust-strip-items.create');
    }

    /**
     * Store a newly created trust strip item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'image' => ['required', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = MediaPath::normalize($validated['image'] ?? null);

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please paste an image URL from the media library.'])
                ->withInput();
        }

        TrustStripItem::create([
            'label' => $validated['label'],
            'image' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ]);

        return redirect()
            ->route('admin.trust-strip-items.index')
            ->with('success', 'Trust strip item created successfully.');
    }

    /**
     * Show the form to edit a trust strip item.
     *
     * @return \Illuminate\View\View
     */
    public function edit(TrustStripItem $trustStripItem): View
    {
        return view('admin.trust-strip-items.edit', compact('trustStripItem'));
    }

    /**
     * Update the given trust strip item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TrustStripItem $trustStripItem): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = MediaPath::normalize($validated['image'] ?? null) ?: $trustStripItem->image;

        if (! $imagePath) {
            return back()
                ->withErrors(['image' => 'Please paste an image URL from the media library.'])
                ->withInput();
        }

        $trustStripItem->update([
            'label' => $validated['label'],
            'image' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => (bool) $validated['status'],
        ]);

        return redirect()
            ->route('admin.trust-strip-items.index')
            ->with('success', 'Trust strip item updated successfully.');
    }

    /**
     * Remove the given trust strip item.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TrustStripItem $trustStripItem): RedirectResponse
    {
        $trustStripItem->delete();

        return redirect()
            ->route('admin.trust-strip-items.index')
            ->with('success', 'Trust strip item deleted successfully.');
    }
}
