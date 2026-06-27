<?php

namespace Database\Seeders;

use App\Models\HealthProgram;
use Illuminate\Database\Seeder;

/**
 * Seeds default health programs for the website.
 */
class HealthProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthProgram::query()->updateOrCreate(
            ['title' => 'Diabetes Reversal & Lifestyle Management Camp'],
            [
                'image' => 'gallery-4.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'eyebrow' => 'Health Programs & Camps',
                'section_title' => 'Group Healing. Lasting Wellness.',
                'section_lead' => 'Join our weekend wellness camps, weight-management programs, detox retreats and community healing sessions led by our multidisciplinary team.',
                'date_time' => '15 April 2026 · 10:00 AM – 2:00 PM',
                'location' => 'Agarwal Public School, Indore',
                'chief_consultant' => 'Dr Ravindra Verma',
                'key_benefits' => 'Diabetes Management, Personalized Diet Plan, Stress Reduction Techniques, Lifestyle Counseling, Health Screening',
                'button_text' => 'Explore Latest Programs',
                    'button_url' => url('/contact-us'),
                'sort_order' => 1,
                'status' => true,
                'active_on_home' => true,
            ]
        );

        HealthProgram::query()->updateOrCreate(
            ['title' => 'Weight Management Program'],
            [
                'image' => 'gallery-4.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'eyebrow' => 'Health Programs & Camps',
                'section_title' => 'Sustainable Weight Wellness.',
                'section_lead' => 'Structured nutrition, metabolism support, and lifestyle guidance for long-term weight management.',
                'date_time' => 'Ongoing Program',
                'location' => 'Sahaj Aarogyam, Indore',
                'chief_consultant' => 'Dr Rachana Verma',
                'key_benefits' => 'Personalized Diet Plan, Metabolism Support, Lifestyle Coaching, Progress Tracking',
                'button_text' => 'Explore Latest Programs',
                    'button_url' => url('/contact-us'),
                'sort_order' => 2,
                'status' => true,
                'active_on_home' => false,
            ]
        );
    }
}
