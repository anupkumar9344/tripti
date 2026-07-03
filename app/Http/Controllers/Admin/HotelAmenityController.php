<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelAmenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for in-room amenities.
 */
class HotelAmenityController extends Controller
{
    /**
     * Display the list of amenities.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $amenities = HotelAmenity::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.hotel-amenities.index', compact('amenities'));
    }

    /**
     * Show the form to create a new amenity.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.hotel-amenities.create');
    }

    /**
     * Store a newly created amenity.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        HotelAmenity::create($validated);

        return redirect()
            ->route('admin.hotel-amenities.index')
            ->with('success', 'Amenity created successfully.');
    }

    /**
     * Show the form to edit an amenity.
     *
     * @return \Illuminate\View\View
     */
    public function edit(HotelAmenity $hotelAmenity): View
    {
        return view('admin.hotel-amenities.edit', ['amenity' => $hotelAmenity]);
    }

    /**
     * Update the given amenity.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HotelAmenity $hotelAmenity): RedirectResponse
    {
        $hotelAmenity->update($this->validatedData($request));

        return redirect()
            ->route('admin.hotel-amenities.index')
            ->with('success', 'Amenity updated successfully.');
    }

    /**
     * Toggle the enabled status of an amenity.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(HotelAmenity $hotelAmenity): RedirectResponse
    {
        $hotelAmenity->status = ! $hotelAmenity->status;
        $hotelAmenity->save();

        return redirect()
            ->route('admin.hotel-amenities.index')
            ->with('success', 'Amenity status updated successfully.');
    }

    /**
     * Delete an amenity.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HotelAmenity $hotelAmenity): RedirectResponse
    {
        $hotelAmenity->delete();

        return redirect()
            ->route('admin.hotel-amenities.index')
            ->with('success', 'Amenity deleted successfully.');
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
