<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Seeder;

/**
 * Seeds default hotel team members for listing and home pages.
 */
class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experts = [
            [
                'name' => 'Rajesh Agarwal',
                'slug' => 'rajesh-agarwal',
                'photo' => asset('assets/img/team/1.jpg'),
                'designation' => 'Founder & Managing Director',
                'specialty' => 'Luxury Hospitality',
                'experience_label' => '20+ Years Experience',
                'short_description' => 'Leads the hotel vision with a focus on premium guest experiences and operational excellence.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Priya Sharma',
                'slug' => 'priya-sharma',
                'photo' => asset('assets/img/team/2.jpg'),
                'designation' => 'General Manager',
                'specialty' => 'Guest Experience',
                'experience_label' => '15+ Years Experience',
                'qualifications' => 'Hospitality Management | Luxury Hotel Operations',
                'short_description' => 'Oversees daily operations and ensures every guest enjoys seamless, five-star service.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Amit Patel',
                'slug' => 'amit-patel',
                'photo' => asset('assets/img/team/3.jpg'),
                'designation' => 'Executive Chef',
                'specialty' => 'Fine Dining & Banquets',
                'experience_label' => '18+ Years Experience',
                'qualifications' => 'Culinary Arts | Multi-Cuisine Specialist',
                'short_description' => 'Creates memorable dining experiences with curated menus and exceptional presentation.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Neha Mehta',
                'slug' => 'neha-mehta',
                'photo' => asset('assets/img/team/4.jpg'),
                'designation' => 'Front Office Manager',
                'specialty' => 'Guest Relations',
                'experience_label' => '12+ Years Experience',
                'qualifications' => 'Front Office Operations | VIP Guest Handling',
                'short_description' => 'Ensures smooth check-ins, personalised assistance, and attentive front-desk service.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Vikram Singh',
                'slug' => 'vikram-singh',
                'photo' => asset('assets/img/team/1.jpg'),
                'designation' => 'Housekeeping Manager',
                'specialty' => 'Room Standards & Comfort',
                'experience_label' => '14+ Years Experience',
                'qualifications' => 'Housekeeping Management | Quality Assurance',
                'short_description' => 'Maintains immaculate rooms and suites with consistent attention to detail and comfort.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Kiran Desai',
                'slug' => 'kiran-desai',
                'photo' => asset('assets/img/team/2.jpg'),
                'designation' => 'Guest Relations Manager',
                'specialty' => 'Concierge & Events',
                'experience_label' => '10+ Years Experience',
                'qualifications' => 'Concierge Services | Event Coordination',
                'short_description' => 'Helps guests with travel plans, local recommendations, and special occasion arrangements.',
                'sort_order' => 6,
            ],
        ];

        foreach ($experts as $expert) {
            Expert::query()->updateOrCreate(
                ['slug' => $expert['slug']],
                [
                    'name' => $expert['name'],
                    'photo' => $expert['photo'],
                    'designation' => $expert['designation'],
                    'specialty' => $expert['specialty'],
                    'experience_label' => $expert['experience_label'] ?? null,
                    'qualifications' => $expert['qualifications'] ?? null,
                    'short_description' => $expert['short_description'],
                    'status' => true,
                    'display_on_home' => true,
                    'sort_order' => $expert['sort_order'],
                ]
            );
        }

        Expert::query()
            ->whereNotIn('slug', array_column($experts, 'slug'))
            ->delete();
    }
}
