<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelFacility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for hotel facilities.
 */
class HotelFacilityController extends Controller
{
    /**
     * Display the list of facilities.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $facilities = HotelFacility::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.hotel-facilities.index', compact('facilities'));
    }

    /**
     * Show the form to create a new facility.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.hotel-facilities.create');
    }

    /**
     * Store a newly created facility.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        HotelFacility::create($this->validatedData($request));

        return redirect()
            ->route('admin.hotel-facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    /**
     * Show the form to edit a facility.
     *
     * @return \Illuminate\View\View
     */
    public function edit(HotelFacility $hotelFacility): View
    {
        return view('admin.hotel-facilities.edit', ['facility' => $hotelFacility]);
    }

    /**
     * Update the given facility.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HotelFacility $hotelFacility): RedirectResponse
    {
        $hotelFacility->update($this->validatedData($request));

        return redirect()
            ->route('admin.hotel-facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Toggle the enabled status of a facility.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(HotelFacility $hotelFacility): RedirectResponse
    {
        $hotelFacility->status = ! $hotelFacility->status;
        $hotelFacility->save();

        return redirect()
            ->route('admin.hotel-facilities.index')
            ->with('success', 'Facility status updated successfully.');
    }

    /**
     * Delete a facility.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HotelFacility $hotelFacility): RedirectResponse
    {
        $hotelFacility->delete();

        return redirect()
            ->route('admin.hotel-facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = (bool) $validated['status'];

        return $validated;
    }
}
