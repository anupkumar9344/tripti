<?php

namespace App\Http\Controllers;

use App\Models\HotelAmenity;
use App\Models\RoomType;
use Illuminate\View\View;

/**
 * Handles the public rooms listing and detail pages.
 */
class RoomController extends Controller
{
    /**
     * Display all active room types.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $roomTypes = RoomType::query()->activeOrdered()->get();

        return view('rooms.index', compact('roomTypes'));
    }

    /**
     * Display a single room type detail page.
     *
     * @return \Illuminate\View\View
     */
    public function show(RoomType $roomType): View
    {
        abort_unless($roomType->status, 404);

        $amenities = HotelAmenity::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $relatedRooms = RoomType::query()
            ->activeOrdered()
            ->where('id', '!=', $roomType->id)
            ->limit(3)
            ->get();

        return view('rooms.show', compact('roomType', 'amenities', 'relatedRooms'));
    }
}
