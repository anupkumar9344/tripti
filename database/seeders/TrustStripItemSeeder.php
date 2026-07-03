<?php

namespace Database\Seeders;

use App\Models\TrustStripItem;
use Illuminate\Database\Seeder;

/**
 * Seeds default home page trust strip items.
 */
class TrustStripItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['label' => '15+ Years of Hospitality', 'image' => 'trusts/experience.webp', 'sort_order' => 1],
            ['label' => '12,000+ Happy Guests', 'image' => 'trusts/successfull.webp', 'sort_order' => 2],
            ['label' => 'Dedicated Guest Services Team', 'image' => 'trusts/expert.webp', 'sort_order' => 3],
            ['label' => 'Premium Rooms & Amenities', 'image' => 'trusts/natural.webp', 'sort_order' => 4],
            ['label' => 'Banquet & Event Facilities', 'image' => 'trusts/extracted_icon.webp', 'sort_order' => 5],
            ['label' => '24/7 Front Desk Support', 'image' => 'trusts/social-media-banner-3-1.webp', 'sort_order' => 6],
        ];

        foreach ($items as $item) {
            TrustStripItem::query()->updateOrCreate(
                ['label' => $item['label']],
                [
                    'image' => $item['image'],
                    'sort_order' => $item['sort_order'],
                    'status' => true,
                ]
            );
        }

        TrustStripItem::query()
            ->whereNotIn('label', array_column($items, 'label'))
            ->delete();
    }
}
