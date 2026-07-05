<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BedType;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin CRUD for rooms within a room type.
 */
class RoomController extends Controller
{
    /**
     * Display rooms for the given room type.
     *
     * @return \Illuminate\View\View
     */
    public function index(RoomType $roomType): View
    {
        $rooms = $roomType->rooms()->with('bedType')->get();

        return view('admin.rooms.index', compact('roomType', 'rooms'));
    }

    /**
     * Show the form to create a new room.
     *
     * @return \Illuminate\View\View
     */
    public function create(RoomType $roomType): View
    {
        $bedTypes = BedType::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.rooms.create', compact('roomType', 'bedTypes'));
    }

    /**
     * Store a newly created room.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, RoomType $roomType): RedirectResponse
    {
        $validated = $this->validatedData($request);

        $roomType->rooms()->create($validated);

        return redirect()
            ->route('admin.room-types.rooms.index', $roomType)
            ->with('success', 'Room created successfully.');
    }

    /**
     * Show the form to edit a room.
     *
     * @return \Illuminate\View\View
     */
    public function edit(RoomType $roomType, Room $room): View
    {
        $this->ensureRoomBelongsToRoomType($roomType, $room);

        $bedTypes = BedType::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.rooms.edit', compact('roomType', 'room', 'bedTypes'));
    }

    /**
     * Update the given room.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RoomType $roomType, Room $room): RedirectResponse
    {
        $this->ensureRoomBelongsToRoomType($roomType, $room);

        $room->update($this->validatedData($request));

        return redirect()
            ->route('admin.room-types.rooms.index', $roomType)
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Toggle the enabled status of a room.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(RoomType $roomType, Room $room): RedirectResponse
    {
        $this->ensureRoomBelongsToRoomType($roomType, $room);

        $room->status = ! $room->status;
        $room->save();

        return redirect()
            ->route('admin.room-types.rooms.index', $roomType)
            ->with('success', 'Room status updated successfully.');
    }

    /**
     * Delete a room.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RoomType $roomType, Room $room): RedirectResponse
    {
        $this->ensureRoomBelongsToRoomType($roomType, $room);

        $room->delete();

        return redirect()
            ->route('admin.room-types.rooms.index', $roomType)
            ->with('success', 'Room deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'room_number' => ['required', 'string', 'max:50'],
            'floor' => ['nullable', 'string', 'max:50'],
            'bed_type_id' => ['nullable', 'integer', 'exists:bed_types,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = (bool) $validated['status'];
        $validated['bed_type_id'] = $validated['bed_type_id'] ?? null;

        return $validated;
    }

    /**
     * Ensure the room belongs to the given room type.
     */
    private function ensureRoomBelongsToRoomType(RoomType $roomType, Room $room): void
    {
        if ((int) $room->room_type_id !== (int) $roomType->id) {
            abort(404);
        }
    }
}
