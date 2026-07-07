<?php

namespace Database\Seeders;

use App\Models\CareerOpening;
use Illuminate\Database\Seeder;

/**
 * Seeds default hotel job openings.
 */
class CareerOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $openings = [
            [
                'title' => 'Front Desk Executive',
                'department' => 'Front Office',
                'job_type' => 'Full Time',
                'location' => 'Rajkot',
                'description' => 'Handle guest check-in, reservations, and front desk operations with a warm and professional approach.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Housekeeping Staff',
                'department' => 'Housekeeping',
                'job_type' => 'Full Time',
                'location' => 'Rajkot',
                'description' => 'Maintain room cleanliness, guest comfort, and housekeeping standards across the property.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Food & Beverage Associate',
                'department' => 'F&B',
                'job_type' => 'Full Time',
                'location' => 'Rajkot',
                'description' => 'Support restaurant service, guest dining experiences, and banquet operations.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Kitchen Helper',
                'department' => 'Kitchen',
                'job_type' => 'Full Time',
                'location' => 'Rajkot',
                'description' => 'Assist the kitchen team with food preparation, hygiene, and smooth service support.',
                'sort_order' => 4,
            ],
        ];

        foreach ($openings as $opening) {
            CareerOpening::query()->updateOrCreate(
                ['title' => $opening['title']],
                array_merge($opening, ['status' => true])
            );
        }
    }
}
