<?php

namespace Database\Seeders;

use App\Models\ExpertProfileCategory;
use Illuminate\Database\Seeder;

/**
 * Seeds default expert profile tab categories.
 */
class ExpertProfileCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Role in Integrated Healthcare System', 'icon' => 'fa-hospital', 'sort_order' => 1],
            ['title' => 'Core Areas of Expertise', 'icon' => 'fa-stethoscope', 'sort_order' => 2],
            ['title' => 'Professional Journey', 'icon' => 'fa-briefcase-medical', 'sort_order' => 3],
            ['title' => 'Education & Qualifications', 'icon' => 'fa-graduation-cap', 'sort_order' => 4],
            ['title' => 'Medical Nutrition Approach', 'icon' => 'fa-apple-whole', 'sort_order' => 5],
            ['title' => 'Additional Contributions & Achievements', 'icon' => 'fa-award', 'sort_order' => 6],
            ['title' => 'Conditions Managed', 'icon' => 'fa-heart-pulse', 'sort_order' => 7],
            ['title' => 'Impact & Patient Outcomes', 'icon' => 'fa-chart-line', 'sort_order' => 8],
            ['title' => 'Why Patients Trust This Expert', 'icon' => 'fa-hand-holding-heart', 'sort_order' => 9],
            ['title' => 'When to Consult', 'icon' => 'fa-calendar-check', 'sort_order' => 10],
        ];

        foreach ($categories as $category) {
            ExpertProfileCategory::query()->updateOrCreate(
                ['title' => $category['title']],
                [
                    'icon' => $category['icon'],
                    'sort_order' => $category['sort_order'],
                    'status' => true,
                ]
            );
        }
    }
}
