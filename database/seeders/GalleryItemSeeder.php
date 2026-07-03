<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

/**
 * Seeds default gallery items for the home showcase and gallery page.
 */
class GalleryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homeItems = [
            [
                'title' => 'Luxury Rooms',
                'description' => 'Elegant rooms and suites designed for comfort, rest, and a premium stay experience.',
                'source' => asset('assets/img/rooms/1.jpg'),
                'sort_order' => 1,
            ],
            [
                'title' => 'Fine Dining',
                'description' => 'Enjoy flavourful multi-cuisine dining in a warm and inviting restaurant setting.',
                'source' => asset('assets/img/menu/2.jpg'),
                'sort_order' => 2,
            ],
            [
                'title' => 'Spa & Relaxation',
                'description' => 'Rejuvenating wellness spaces to help you unwind during your stay.',
                'source' => asset('assets/img/spa/2.jpg'),
                'icon_tags' => 'fa-spa, fa-leaf, fa-mug-hot, fa-bed, fa-star, fa-heart',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Banquet Hall',
                'description' => 'Beautifully arranged event spaces for weddings, celebrations, and gatherings.',
                'source' => asset('assets/img/gallery/4.jpg'),
                'sort_order' => 4,
            ],
            [
                'title' => 'Hotel Ambience',
                'description' => 'A welcoming atmosphere with thoughtful details throughout the property.',
                'source' => asset('assets/img/gallery/5.jpg'),
                'sort_order' => 5,
            ],
        ];

        foreach ($homeItems as $item) {
            GalleryItem::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'description' => $item['description'],
                    'type' => 'image',
                    'source' => $item['source'],
                    'thumbnail' => null,
                    'icon_tags' => $item['icon_tags'] ?? null,
                    'is_featured' => $item['is_featured'] ?? false,
                    'display_on_home' => true,
                    'sort_order' => $item['sort_order'],
                    'status' => true,
                ]
            );
        }

        for ($i = 1; $i <= 8; $i++) {
            $source = asset('assets/img/gallery/'.$i.'.jpg');

            if (GalleryItem::query()->where('source', $source)->exists()) {
                continue;
            }

            GalleryItem::query()->create([
                'title' => 'Hotel Gallery '.$i,
                'description' => null,
                'type' => 'image',
                'source' => $source,
                'thumbnail' => null,
                'icon_tags' => null,
                'is_featured' => false,
                'display_on_home' => false,
                'sort_order' => 10 + $i,
                'status' => true,
            ]);
        }

        $seedTitles = array_merge(
            array_column($homeItems, 'title'),
            array_map(fn (int $i) => 'Hotel Gallery '.$i, range(1, 8))
        );

        GalleryItem::query()
            ->whereNotIn('title', $seedTitles)
            ->delete();
    }
}
