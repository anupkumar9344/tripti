<?php

namespace App\Http\Controllers;

use App\Models\HotelAmenity;
use App\Models\PremiumService;
use App\Models\RoomType;
use App\Models\Setting;
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

        $roomType->load([
            'rooms' => function ($query) {
                $query
                    ->where('status', true)
                    ->with('bedType')
                    ->orderBy('sort_order')
                    ->orderBy('room_number');
            },
        ]);

        $amenities = HotelAmenity::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $premiumServices = PremiumService::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $contactSettings = Setting::getMany([
            'phone_1',
            'whatsapp_number',
            'opening_hours',
        ]);

        $relatedRooms = RoomType::query()
            ->where('status', true)
            ->where('id', '!=', $roomType->id)
            ->orderByRaw('CASE WHEN category = ? THEN 0 ELSE 1 END', [$roomType->category])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(3)
            ->get();

        $galleryImages = $roomType->galleryUrls();

        return view('rooms.show', compact(
            'roomType',
            'amenities',
            'premiumServices',
            'contactSettings',
            'relatedRooms',
            'galleryImages'
        ));
    }
}
