<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Support\MediaPath;
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
        $validated = $this->validatedData($request);

        RoomType::create($validated);

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
        $validated = $this->validatedData($request, $roomType);
        $roomType->update($validated);

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
    private function validatedData(Request $request, ?RoomType $roomType = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => [$roomType ? 'nullable' : 'required', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:5000'],
            'gallery_images' => ['nullable', 'string', 'max:5000'],
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

        if (filled($validated['gallery_images'] ?? null)) {
            $galleryPaths = MediaPath::parseUrlLines($validated['gallery_images']);
            $validated['gallery_images'] = $galleryPaths !== [] ? implode("\n", $galleryPaths) : null;
        } else {
            $validated['gallery_images'] = null;
        }

        $imagePath = MediaPath::normalize($validated['image'] ?? null);

        if ($imagePath) {
            $validated['image'] = $imagePath;
        } elseif ($roomType) {
            $validated['image'] = $roomType->image;
        } else {
            $validated['image'] = null;
        }

        return $validated;
    }
}
