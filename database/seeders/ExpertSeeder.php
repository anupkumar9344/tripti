<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Seeder;

/**
 * Seeds default expert team members for listing and home pages.
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
                'name' => 'Dr. Ravindra Verma',
                'slug' => 'dr-ravindra-verma',
                'photo' => 'team-1.jpg',
                'designation' => 'Founder & Chairman',
                'specialty' => 'Alternative Therapy Specialist',
                'experience_label' => '25+ Years Experience',
                'short_description' => 'Leads the overall integrated treatment system and treatment philosophy.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. Rachana Gangrade',
                'slug' => 'dr-rachana-gangrade',
                'photo' => 'team-2.jpg',
                'designation' => 'Co-Founder & Managing Director',
                'specialty' => 'Dietitian & Nutritionist',
                'experience_label' => '25+ Years Experience',
                'qualifications' => 'Ph.D. in Food & Nutrition | Weight Management Specialist',
                'short_description' => 'Expert in Integrated Nutrition for Metabolic Health, Weight Loss & Lifestyle Disorders.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Pankaj Jain',
                'slug' => 'dr-pankaj-jain',
                'photo' => 'team-3.jpg',
                'designation' => 'Director & Chief Medical Officer',
                'specialty' => 'Ayurveda & Panchakarma Specialist',
                'experience_label' => '25+ Years Experience',
                'qualifications' => 'Kerala Panchakarma Specialist | Senior Ayurveda Consultant',
                'short_description' => 'Expert in Integrated Ayurveda & Panchakarma for Chronic Diseases, Pain Management & Metabolic Disorders.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Dr. Shaziya Gandhi',
                'slug' => 'dr-shaziya-gandhi',
                'photo' => 'team-4.jpg',
                'designation' => 'Co-Founder & Director',
                'specialty' => 'Unani Medicine & Hijama Specialist',
                'experience_label' => '16+ Years Experience',
                'qualifications' => 'BUMS | Specialist in Unani Medicine & Hijama Therapy',
                'short_description' => 'Expert in Integrated Unani Healing for Detoxification, Pain Management & Lifestyle Disorders.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Dr. Sanjay Patel',
                'slug' => 'dr-sanjay-patel',
                'photo' => 'team-5.jpg',
                'designation' => 'Head of Physiotherapy',
                'specialty' => 'Pain & Rehabilitation Specialist',
                'experience_label' => '18+ Years Experience',
                'qualifications' => 'MPT Orthopedics | Neuro Rehab Expert',
                'short_description' => 'Specialist in non-surgical pain relief, spine disorders, and advanced physiotherapy rehabilitation.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Dr. Neha Singh',
                'slug' => 'dr-neha-singh',
                'photo' => 'team-6.jpg',
                'designation' => 'Senior Wellness Consultant',
                'specialty' => 'Acupuncture & Acupressure Specialist',
                'experience_label' => '12+ Years Experience',
                'qualifications' => 'Certified Acupuncturist | Holistic Pain Management',
                'short_description' => 'Expert in acupuncture, acupressure, and integrative therapies for chronic pain and wellness recovery.',
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
    }
}
