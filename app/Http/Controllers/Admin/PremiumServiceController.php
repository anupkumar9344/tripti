<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for premium hotel services.
 */
class PremiumServiceController extends Controller
{
    /**
     * Display the list of premium services.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $services = PremiumService::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.premium-services.index', compact('services'));
    }

    /**
     * Show the form to create a new premium service.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.premium-services.create');
    }

    /**
     * Store a newly created premium service.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        PremiumService::create($this->validatedData($request));

        return redirect()
            ->route('admin.premium-services.index')
            ->with('success', 'Premium service created successfully.');
    }

    /**
     * Show the form to edit a premium service.
     *
     * @return \Illuminate\View\View
     */
    public function edit(PremiumService $premiumService): View
    {
        return view('admin.premium-services.edit', ['service' => $premiumService]);
    }

    /**
     * Update the given premium service.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PremiumService $premiumService): RedirectResponse
    {
        $premiumService->update($this->validatedData($request));

        return redirect()
            ->route('admin.premium-services.index')
            ->with('success', 'Premium service updated successfully.');
    }

    /**
     * Toggle the enabled status of a premium service.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(PremiumService $premiumService): RedirectResponse
    {
        $premiumService->status = ! $premiumService->status;
        $premiumService->save();

        return redirect()
            ->route('admin.premium-services.index')
            ->with('success', 'Premium service status updated successfully.');
    }

    /**
     * Delete a premium service.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PremiumService $premiumService): RedirectResponse
    {
        $premiumService->delete();

        return redirect()
            ->route('admin.premium-services.index')
            ->with('success', 'Premium service deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = (bool) $validated['status'];

        return $validated;
    }
}
