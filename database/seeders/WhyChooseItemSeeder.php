<?php

namespace Database\Seeders;

use App\Models\WhyChooseItem;
use Illuminate\Database\Seeder;

/**
 * Seeds default Why Choose Us items for home and about pages.
 */
class WhyChooseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Prime City Location',
                'icon' => 'fa-location-dot',
                'short_description' => 'Conveniently located with easy access to business hubs, dining, and local attractions.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Luxury Rooms & Suites',
                'icon' => 'fa-bed',
                'short_description' => 'Elegantly designed accommodations with modern amenities and premium comfort.',
                'sort_order' => 2,
            ],
            [
                'title' => '24/7 Guest Support',
                'icon' => 'fa-headset',
                'short_description' => 'Our front desk and concierge team are available around the clock for every need.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Fine Dining Experience',
                'icon' => 'fa-utensils',
                'short_description' => 'Enjoy curated menus, room service, and banquet dining crafted by expert chefs.',
                'sort_order' => 4,
            ],
            [
                'title' => '15+ Years of Trust',
                'icon' => 'fa-award',
                'short_description' => 'A hospitality legacy built on consistent service, comfort, and guest satisfaction.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Events & Celebrations',
                'icon' => 'fa-champagne-glasses',
                'short_description' => 'Spacious banquet and meeting facilities for weddings, conferences, and gatherings.',
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            WhyChooseItem::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'icon' => $item['icon'],
                    'short_description' => $item['short_description'],
                    'sort_order' => $item['sort_order'],
                    'status' => true,
                ]
            );
        }

        WhyChooseItem::query()
            ->whereNotIn('title', array_column($items, 'title'))
            ->delete();
    }
}
