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
                'eyebrow' => 'Welcome to Tripti Hotel',
                'title' => 'Luxury Stays & Premium Hospitality',
                'text' => 'Experience elegant rooms, fine dining, and attentive service designed to make every visit comfortable and memorable.',
                'image' => asset('assets/img/hero/hero-1.png'),
                'primary_label' => 'Book Your Stay',
                'primary_url' => url('/contact-us'),
                'secondary_label' => 'Watch Video',
                'secondary_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'secondary_type' => 'video',
                'sort_order' => 1,
            ],
            [
                'eyebrow' => 'Rooms & Suites',
                'title' => 'Comfortable Rooms for Every Traveller',
                'text' => 'From deluxe rooms to premium suites, find the perfect space for business trips, family holidays, and weekend escapes.',
                'image' => asset('assets/img/hero/hero-2.png'),
                'primary_label' => 'Explore Rooms',
                'primary_url' => url('/rooms'),
                'secondary_label' => 'View Careers',
                'secondary_url' => url('/careers'),
                'secondary_type' => 'link',
                'sort_order' => 2,
            ],
            [
                'eyebrow' => 'Events & Dining',
                'title' => 'Celebrate, Dine, and Host with Ease',
                'text' => 'Discover banquet facilities, curated menus, and event support for weddings, meetings, and special occasions.',
                'image' => asset('assets/img/hero/hero-3.png'),
                'primary_label' => 'Contact Us',
                'primary_url' => url('/contact-us'),
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

        HeroBanner::query()
            ->whereNotIn('title', array_column($banners, 'title'))
            ->delete();
    }
}
