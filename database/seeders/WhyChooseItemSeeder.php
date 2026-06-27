<?php

namespace Database\Seeders;

use App\Models\WhyChooseItem;
use Illuminate\Database\Seeder;

/**
 * Seeds default Why Choose Sahaj Aarogyam items for home and about pages.
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
                'title' => 'Root-Cause Diagnosis',
                'icon' => 'fa-shield-halved',
                'short_description' => 'We identify what\'s actually causing the issue — not just suppress symptoms.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Integrated Specialists',
                'icon' => 'fa-user-doctor',
                'short_description' => 'Physiotherapists, Ayurveda doctors, nutritionists & therapists under one roof.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Personalised Protocols',
                'icon' => 'fa-hand-holding-heart',
                'short_description' => 'Every patient receives a treatment plan designed for their unique condition.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Non-Surgical & Natural',
                'icon' => 'fa-leaf',
                'short_description' => 'Avoid risky surgery wherever possible with safe, evidence-based therapies.',
                'sort_order' => 4,
            ],
            [
                'title' => '25+ Years Experience',
                'icon' => 'fa-award',
                'short_description' => 'Decades of clinical work treating complex pain and lifestyle disorders.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Long-Term Wellness',
                'icon' => 'fa-heart-pulse',
                'short_description' => 'Lasting results — we treat the body, mind, metabolism and aesthetics together.',
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
    }
}
