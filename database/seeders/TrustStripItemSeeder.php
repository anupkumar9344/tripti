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
            ['label' => '25+ Years Clinical Experience', 'image' => 'trusts/experience.webp', 'sort_order' => 1],
            ['label' => '3500+ Patients Successfully Treated', 'image' => 'trusts/successfull.webp', 'sort_order' => 2],
            ['label' => 'Multidisciplinary Expert Team', 'image' => 'trusts/expert.webp', 'sort_order' => 3],
            ['label' => 'Natural, Safe & Evidence-Based Treatments', 'image' => 'trusts/natural.webp', 'sort_order' => 4],
            ['label' => 'Multidimensional Treatment Approach', 'image' => 'trusts/extracted_icon.webp', 'sort_order' => 5],
            ['label' => 'Personalized Treatment protocols & Plans', 'image' => 'trusts/social-media-banner-3-1.webp', 'sort_order' => 6],
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
    }
}
