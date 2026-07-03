<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Seeds default room types for listing and home pages.
 */
class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'title' => 'Deluxe Room',
                'slug' => 'deluxe-room',
                'icon' => 'fa-bed',
                'source_image' => '1.jpg',
                'short_description' => 'Comfortable, well-appointed rooms ideal for business stays and short visits.',
                'long_description' => '<p>Our Deluxe Rooms offer a relaxing stay with elegant interiors, a plush bed, work desk, smart TV, and ensuite bathroom with premium toiletries.</p><p>Perfect for solo travellers and couples looking for comfort, convenience, and great value in the heart of the city.</p>',
                'sort_order' => 1,
                'display_on_home' => true,
            ],
            [
                'title' => 'Executive Suite',
                'slug' => 'executive-suite',
                'icon' => 'fa-couch',
                'source_image' => '2.jpg',
                'short_description' => 'Spacious suites with a separate living area for extended and business stays.',
                'long_description' => '<p>Executive Suites feature a bedroom and sitting area, ideal for guests who need extra space to work or unwind.</p><p>Enjoy upgraded amenities, priority service, and a refined atmosphere designed for discerning travellers.</p>',
                'sort_order' => 2,
                'display_on_home' => true,
            ],
            [
                'title' => 'Premium Suite',
                'slug' => 'premium-suite',
                'icon' => 'fa-star',
                'source_image' => '3.jpg',
                'short_description' => 'Luxury suites with panoramic views and premium in-room comforts.',
                'long_description' => '<p>Premium Suites are designed for guests who appreciate elevated comfort — featuring stylish décor, lounge seating, and enhanced room amenities.</p><p>A popular choice for anniversaries, celebrations, and premium leisure stays.</p>',
                'sort_order' => 3,
                'display_on_home' => true,
            ],
            [
                'title' => 'Family Room',
                'slug' => 'family-room',
                'icon' => 'fa-people-roof',
                'source_image' => '4.jpg',
                'short_description' => 'Spacious family-friendly rooms with flexible bedding and extra comfort.',
                'long_description' => '<p>Family Rooms provide generous space for parents and children, with thoughtful layouts and amenities for a stress-free stay.</p><p>Ideal for weekend trips, holidays, and guests travelling together.</p>',
                'sort_order' => 4,
                'display_on_home' => true,
            ],
            [
                'title' => 'Presidential Suite',
                'slug' => 'presidential-suite',
                'icon' => 'fa-crown',
                'source_image' => '5.jpg',
                'short_description' => 'Our most exclusive suite with premium furnishings and personalised service.',
                'long_description' => '<p>The Presidential Suite offers the ultimate Tripti Hotel experience — expansive living space, luxury finishes, and bespoke guest services.</p><p>Perfect for VIP guests, special occasions, and travellers seeking the finest stay.</p>',
                'sort_order' => 5,
                'display_on_home' => true,
            ],
            [
                'title' => 'Standard Room',
                'slug' => 'standard-room',
                'icon' => 'fa-door-open',
                'source_image' => '6.jpg',
                'short_description' => 'Smart, comfortable rooms with all essentials for a pleasant overnight stay.',
                'long_description' => '<p>Standard Rooms deliver clean, cosy accommodation with modern basics — ideal for budget-conscious travellers who still want quality hospitality.</p><p>Includes comfortable bedding, Wi-Fi, and attentive room service on request.</p>',
                'sort_order' => 6,
                'display_on_home' => true,
            ],
        ];

        foreach ($rooms as $room) {
            $storagePath = $this->storeSeedImage($room['slug'], $room['source_image']);

            Treatment::query()->updateOrCreate(
                ['slug' => $room['slug']],
                [
                    'title' => $room['title'],
                    'image' => $storagePath,
                    'icon' => $room['icon'] ?? null,
                    'short_description' => $room['short_description'],
                    'long_description' => $room['long_description'],
                    'sort_order' => $room['sort_order'],
                    'status' => true,
                    'display_on_home' => $room['display_on_home'],
                ]
            );
        }

        Treatment::query()
            ->whereNotIn('slug', array_column($rooms, 'slug'))
            ->delete();
    }

    /**
     * Copy a public image into storage for a seeded room.
     */
    private function storeSeedImage(string $slug, string $filename): string
    {
        $candidates = [
            public_path('images/'.$filename),
            public_path('assets/img/rooms/'.$filename),
        ];

        $extension = pathinfo($filename, PATHINFO_EXTENSION) ?: 'jpg';
        $destination = 'treatments/images/'.$slug.'.'.$extension;

        foreach ($candidates as $sourcePath) {
            if (! is_file($sourcePath)) {
                continue;
            }

            Storage::disk('public')->put($destination, file_get_contents($sourcePath));

            return $destination;
        }

        return $destination;
    }
}
