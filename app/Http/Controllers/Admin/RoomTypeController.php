<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for room types.
 */
class RoomTypeController extends Controller
{
    /**
     * Display the list of room types.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $roomTypes = RoomType::query()
            ->withCount('rooms')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.room-types.index', compact('roomTypes'));
    }

    /**
     * Show the form to create a new room type.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.room-types.create');
    }

    /**
     * Store a newly created room type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        RoomType::create($this->validatedData($request));

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type created successfully.');
    }

    /**
     * Show the form to edit a room type.
     *
     * @return \Illuminate\View\View
     */
    public function edit(RoomType $roomType): View
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    /**
     * Update the given room type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RoomType $roomType): RedirectResponse
    {
        $roomType->update($this->validatedData($request));

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type updated successfully.');
    }

    /**
     * Toggle the enabled status of a room type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(RoomType $roomType): RedirectResponse
    {
        $roomType->status = ! $roomType->status;
        $roomType->save();

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type status updated successfully.');
    }

    /**
     * Delete a room type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RoomType $roomType): RedirectResponse
    {
        $roomType->delete();

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'fare' => ['required', 'numeric', 'min:0'],
            'max_adults' => ['required', 'integer', 'min:1', 'max:20'],
            'max_children' => ['required', 'integer', 'min:0', 'max:20'],
            'is_featured' => ['required', 'boolean'],
            'category' => ['required', 'in:room,suite'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_featured'] = (bool) $validated['is_featured'];
        $validated['status'] = (bool) $validated['status'];

        return $validated;
    }
}
