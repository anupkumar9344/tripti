<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\Setting;
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
        Setting::setValue('gallery_home_title', 'Gallery');

        $homeItems = [
            [
                'title' => 'Ayurveda & Panchakarma',
                'description' => 'Traditional detox and rejuvenation therapies for deep healing and balance.',
                'source' => 'gallery-2.jpg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Metabolic Wellness',
                'description' => 'Personalized nutrition and lifestyle guidance for sustainable health outcomes.',
                'source' => 'gallery-3.jpg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Mindfulness & Meditation',
                'description' => 'Reduce stress, improve focus, and cultivate inner peace through guided meditation practices.',
                'source' => 'gallery-4.jpg',
                'icon_tags' => 'fa-leaf, fa-spa, fa-person-praying, fa-heart-pulse, fa-seedling, fa-hand-holding-heart',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Hijama & Cupping',
                'description' => 'Natural detox and pain-relief therapies rooted in time-tested healing traditions.',
                'source' => 'gallery-5.jpg',
                'sort_order' => 4,
            ],
            [
                'title' => 'Therapeutic Massage',
                'description' => 'Expert manual therapy to relieve tension, restore mobility, and accelerate recovery.',
                'source' => 'gallery-6.jpg',
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

        for ($i = 1; $i <= 9; $i++) {
            if (GalleryItem::query()->where('source', 'gallery-'.$i.'.jpg')->exists()) {
                continue;
            }

            GalleryItem::query()->create([
                'title' => 'Gallery Image '.$i,
                'description' => null,
                'type' => 'image',
                'source' => 'gallery-'.$i.'.jpg',
                'thumbnail' => null,
                'icon_tags' => null,
                'is_featured' => false,
                'display_on_home' => false,
                'sort_order' => 10 + $i,
                'status' => true,
            ]);
        }
    }
}
