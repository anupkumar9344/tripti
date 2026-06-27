<?php

namespace Database\Seeders;

use App\Models\HeroBanner;
use Illuminate\Database\Seeder;

/**
 * Seeds default home page hero banners.
 */
class HeroBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'eyebrow' => 'Welcome to Sahaj Aarogyam',
                'title' => 'Non-Surgical Healing for Pain & Chronic Conditions',
                'text' => 'Integrated physiotherapy, Ayurveda, and holistic therapies to help you recover safely, naturally, and with lasting results.',
                'image' => 'home-about-team.jpg',
                'primary_label' => 'Book Appointment',
                'primary_url' => url('/contact-us'),
                'secondary_label' => 'Watch Video',
                'secondary_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'secondary_type' => 'video',
                'sort_order' => 1,
            ],
            [
                'eyebrow' => 'Multidisciplinary Care',
                'title' => 'Ayurveda, Physiotherapy & Wellness Under One Roof',
                'text' => 'Expert-led treatments for back pain, metabolic disorders, detox, rehabilitation, and complete lifestyle wellness.',
                'image' => 'gallery-4.jpg',
                'primary_label' => 'Explore Services',
                'primary_url' => url('/services'),
                'secondary_label' => 'Meet Our Experts',
                'secondary_url' => url('/our-expert-team'),
                'secondary_type' => 'link',
                'sort_order' => 2,
            ],
            [
                'eyebrow' => 'Health Programs & Camps',
                'title' => 'Structured Programs for Long-Term Wellness',
                'text' => 'Join weight management, spine care, detox, and community wellness camps designed for sustainable healing.',
                'image' => 'faqs-image.jpg',
                'primary_label' => 'View Programs',
                'primary_url' => url('/health-programs'),
                'secondary_label' => 'Contact Us',
                'secondary_url' => url('/contact-us'),
                'secondary_type' => 'link',
                'sort_order' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            HeroBanner::query()->updateOrCreate(
                ['title' => $banner['title']],
                [
                    'eyebrow' => $banner['eyebrow'],
                    'text' => $banner['text'],
                    'image' => $banner['image'],
                    'primary_label' => $banner['primary_label'],
                    'primary_url' => $banner['primary_url'],
                    'secondary_label' => $banner['secondary_label'],
                    'secondary_url' => $banner['secondary_url'],
                    'secondary_type' => $banner['secondary_type'],
                    'sort_order' => $banner['sort_order'],
                    'status' => true,
                ]
            );
        }
    }
}
