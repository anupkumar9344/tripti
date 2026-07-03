<?php

namespace Database\Seeders;

use App\Models\BedType;
use App\Models\HotelAmenity;
use App\Models\HotelFacility;
use App\Models\PremiumService;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

/**
 * Seeds default hotel management data.
 */
class HotelManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedAmenities();
        $this->seedFacilities();
        $bedTypes = $this->seedBedTypes();
        $this->seedRoomTypesAndRooms($bedTypes);
        $this->seedPremiumServices();
    }

    /**
     * Seed in-room amenities.
     */
    private function seedAmenities(): void
    {
        $items = [
            ['title' => 'AC', 'icon' => 'fa-snowflake', 'sort_order' => 1],
            ['title' => 'Freezer', 'icon' => 'fa-temperature-low', 'sort_order' => 2],
            ['title' => 'Pool', 'icon' => 'fa-person-swimming', 'sort_order' => 3],
            ['title' => 'TV', 'icon' => 'fa-tv', 'sort_order' => 4],
            ['title' => 'Unlimited Wifi', 'icon' => 'fa-wifi', 'sort_order' => 5],
            ['title' => 'Washing Machine', 'icon' => 'fa-shirt', 'sort_order' => 6],
        ];

        foreach ($items as $item) {
            HotelAmenity::query()->updateOrCreate(
                ['title' => $item['title']],
                ['icon' => $item['icon'], 'sort_order' => $item['sort_order'], 'status' => true]
            );
        }

        HotelAmenity::query()->whereNotIn('title', array_column($items, 'title'))->delete();
    }

    /**
     * Seed hotel facilities.
     */
    private function seedFacilities(): void
    {
        $items = [
            ['title' => 'Buffet', 'icon' => 'fa-utensils', 'sort_order' => 1],
            ['title' => 'Car Parking', 'icon' => 'fa-square-parking', 'sort_order' => 2],
            ['title' => 'Coffee Shop', 'icon' => 'fa-mug-hot', 'sort_order' => 3],
            ['title' => 'Interior Game Room', 'icon' => 'fa-gamepad', 'sort_order' => 4],
            ['title' => 'Poolside Bar', 'icon' => 'fa-martini-glass', 'sort_order' => 5],
            ['title' => 'SPA', 'icon' => 'fa-spa', 'sort_order' => 6],
            ['title' => 'Swimming Pool', 'icon' => 'fa-water-ladder', 'sort_order' => 7],
        ];

        foreach ($items as $item) {
            HotelFacility::query()->updateOrCreate(
                ['title' => $item['title']],
                ['icon' => $item['icon'], 'sort_order' => $item['sort_order'], 'status' => true]
            );
        }

        HotelFacility::query()->whereNotIn('title', array_column($items, 'title'))->delete();
    }

    /**
     * Seed bed types.
     *
     * @return array<string, \App\Models\BedType>
     */
    private function seedBedTypes(): array
    {
        $items = [
            ['name' => 'Single', 'sort_order' => 1],
            ['name' => 'Queen', 'sort_order' => 2],
            ['name' => 'Double', 'sort_order' => 3],
        ];

        $bedTypes = [];

        foreach ($items as $item) {
            $bedTypes[$item['name']] = BedType::query()->updateOrCreate(
                ['name' => $item['name']],
                ['sort_order' => $item['sort_order']]
            );
        }

        BedType::query()->whereNotIn('name', array_column($items, 'name'))->delete();

        return $bedTypes;
    }

    /**
     * Seed room types and their rooms.
     *
     * @param  array<string, \App\Models\BedType>  $bedTypes
     */
    private function seedRoomTypesAndRooms(array $bedTypes): void
    {
        $roomTypes = [
            [
                'name' => 'Deluxe Room',
                'image' => 'assets/img/rooms/1.jpg',
                'short_description' => 'Comfortable, well-appointed rooms ideal for business stays and short visits.',
                'fare' => 3500,
                'max_adults' => 2,
                'max_children' => 2,
                'is_featured' => true,
                'category' => 'room',
                'sort_order' => 1,
                'rooms' => [
                    ['room_number' => '101', 'floor' => '1st Floor', 'bed' => 'Queen'],
                    ['room_number' => '102', 'floor' => '1st Floor', 'bed' => 'Double'],
                    ['room_number' => '103', 'floor' => '1st Floor', 'bed' => 'Queen'],
                ],
            ],
            [
                'name' => 'Executive Suite',
                'image' => 'assets/img/rooms/2.jpg',
                'short_description' => 'Spacious suites with a separate living area for extended and business stays.',
                'fare' => 5500,
                'max_adults' => 2,
                'max_children' => 1,
                'is_featured' => true,
                'category' => 'suite',
                'sort_order' => 2,
                'rooms' => [
                    ['room_number' => '201', 'floor' => '2nd Floor', 'bed' => 'Queen'],
                    ['room_number' => '202', 'floor' => '2nd Floor', 'bed' => 'King'],
                ],
            ],
            [
                'name' => 'Standard Room',
                'image' => 'assets/img/rooms/3.jpg',
                'short_description' => 'Smart, comfortable rooms with all essentials for a pleasant overnight stay.',
                'fare' => 2500,
                'max_adults' => 2,
                'max_children' => 1,
                'is_featured' => false,
                'category' => 'room',
                'sort_order' => 3,
                'rooms' => [
                    ['room_number' => '104', 'floor' => '1st Floor', 'bed' => 'Single'],
                    ['room_number' => '105', 'floor' => '1st Floor', 'bed' => 'Single'],
                ],
            ],
            [
                'name' => 'Family Room',
                'image' => 'assets/img/rooms/4.jpg',
                'short_description' => 'Spacious family-friendly rooms with flexible bedding and extra comfort.',
                'fare' => 4500,
                'max_adults' => 4,
                'max_children' => 2,
                'is_featured' => true,
                'category' => 'room',
                'sort_order' => 4,
                'rooms' => [
                    ['room_number' => '301', 'floor' => '3rd Floor', 'bed' => 'Double'],
                    ['room_number' => '302', 'floor' => '3rd Floor', 'bed' => 'Double'],
                ],
            ],
            [
                'name' => 'Premium Suite',
                'image' => 'assets/img/rooms/5.jpg',
                'short_description' => 'Luxury suites with panoramic views and premium in-room comforts.',
                'fare' => 6500,
                'max_adults' => 2,
                'max_children' => 2,
                'is_featured' => true,
                'category' => 'suite',
                'sort_order' => 5,
                'rooms' => [
                    ['room_number' => '401', 'floor' => '4th Floor', 'bed' => 'Queen'],
                ],
            ],
            [
                'name' => 'Presidential Suite',
                'image' => 'assets/img/rooms/6.jpg',
                'short_description' => 'Our most exclusive suite with premium furnishings and personalised service.',
                'fare' => 12000,
                'max_adults' => 4,
                'max_children' => 4,
                'is_featured' => true,
                'category' => 'suite',
                'sort_order' => 6,
                'rooms' => [
                    ['room_number' => '501', 'floor' => '5th Floor', 'bed' => 'Queen'],
                ],
            ],
        ];

        $seededRoomTypeNames = [];
        $seededRoomKeys = [];

        foreach ($roomTypes as $index => $typeData) {
            $seededRoomTypeNames[] = $typeData['name'];

            $roomType = RoomType::query()->updateOrCreate(
                ['name' => $typeData['name']],
                [
                    'image' => $typeData['image'] ?? null,
                    'short_description' => $typeData['short_description'] ?? null,
                    'fare' => $typeData['fare'],
                    'max_adults' => $typeData['max_adults'],
                    'max_children' => $typeData['max_children'],
                    'is_featured' => $typeData['is_featured'],
                    'category' => $typeData['category'],
                    'sort_order' => $typeData['sort_order'],
                    'status' => true,
                ]
            );

            foreach ($typeData['rooms'] as $roomIndex => $roomData) {
                $bedName = $roomData['bed'] === 'King' ? 'Queen' : $roomData['bed'];
                $bedType = $bedTypes[$bedName] ?? null;
                $key = $roomType->id.'|'.$roomData['room_number'];
                $seededRoomKeys[] = $key;

                Room::query()->updateOrCreate(
                    [
                        'room_type_id' => $roomType->id,
                        'room_number' => $roomData['room_number'],
                    ],
                    [
                        'bed_type_id' => $bedType?->id,
                        'floor' => $roomData['floor'],
                        'sort_order' => $roomIndex + 1,
                        'status' => true,
                    ]
                );
            }
        }

        RoomType::query()->whereNotIn('name', $seededRoomTypeNames)->delete();

        Room::query()->get()->each(function (Room $room) use ($seededRoomKeys) {
            $key = $room->room_type_id.'|'.$room->room_number;

            if (! in_array($key, $seededRoomKeys, true)) {
                $room->delete();
            }
        });
    }

    /**
     * Seed premium services.
     */
    private function seedPremiumServices(): void
    {
        $items = [
            [
                'title' => 'Airport Pickup',
                'icon' => 'fa-car',
                'description' => 'Comfortable pickup and drop service from the airport.',
                'price' => 800,
                'sort_order' => 1,
            ],
            [
                'title' => 'Late Checkout',
                'icon' => 'fa-clock',
                'description' => 'Extend your checkout time subject to availability.',
                'price' => 500,
                'sort_order' => 2,
            ],
            [
                'title' => 'Room Decoration',
                'icon' => 'fa-gift',
                'description' => 'Special room setup for birthdays and anniversaries.',
                'price' => 1200,
                'sort_order' => 3,
            ],
            [
                'title' => 'Laundry Service',
                'icon' => 'fa-shirt',
                'description' => 'Same-day laundry and pressing service.',
                'price' => 300,
                'sort_order' => 4,
            ],
            [
                'title' => 'Breakfast in Bed',
                'icon' => 'fa-mug-saucer',
                'description' => 'Enjoy breakfast served in the comfort of your room.',
                'price' => 450,
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            PremiumService::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'icon' => $item['icon'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'sort_order' => $item['sort_order'],
                    'status' => true,
                ]
            );
        }

        PremiumService::query()->whereNotIn('title', array_column($items, 'title'))->delete();
    }
}
