<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

/**
 * Seeds default blog posts for the website.
 */
class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'top-reasons-to-choose-tripti-hotel-for-your-stay',
                'title' => 'Top Reasons to Choose Tripti Hotel for Your Stay',
                'featured_image' => asset('assets/img/blog/1.jpg'),
                'excerpt' => 'From comfortable rooms to attentive service, discover what makes Tripti Hotel a preferred choice for business and leisure travellers.',
                'tags' => 'hotel stay, hospitality, travel',
                'published_at' => '2026-05-29',
                'display_on_home' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'planning-a-perfect-weekend-getaway-in-rajkot',
                'title' => 'Planning a Perfect Weekend Getaway in Rajkot',
                'featured_image' => asset('assets/img/blog/2.jpg'),
                'excerpt' => 'Make the most of your short break with the right room, dining, and local experiences around the city.',
                'tags' => 'weekend getaway, rajkot, travel tips',
                'published_at' => '2026-05-29',
                'display_on_home' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'how-to-host-a-memorable-hotel-banquet-event',
                'title' => 'How to Host a Memorable Hotel Banquet Event',
                'featured_image' => asset('assets/img/blog/3.jpg'),
                'excerpt' => 'Tips for planning weddings, receptions, and celebrations with smooth coordination and great guest experience.',
                'tags' => 'banquet, events, weddings',
                'published_at' => '2026-05-29',
                'display_on_home' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'business-travel-made-comfortable',
                'title' => 'Business Travel Made Comfortable',
                'featured_image' => asset('assets/img/blog/4.jpg'),
                'excerpt' => 'What business guests should look for in a hotel — connectivity, service, dining, and meeting support.',
                'tags' => 'business travel, corporate stay, hotel tips',
                'published_at' => '2026-05-15',
                'display_on_home' => false,
                'sort_order' => 4,
            ],
            [
                'slug' => 'best-room-types-for-families-and-groups',
                'title' => 'Best Room Types for Families and Groups',
                'featured_image' => asset('assets/img/blog/1.jpg'),
                'excerpt' => 'A quick guide to choosing the right room or suite when travelling with family, friends, or colleagues.',
                'tags' => 'family stay, rooms, hotel guide',
                'published_at' => '2026-05-10',
                'display_on_home' => false,
                'sort_order' => 5,
            ],
            [
                'slug' => 'make-your-anniversary-stay-extra-special',
                'title' => 'Make Your Anniversary Stay Extra Special',
                'featured_image' => asset('assets/img/blog/2.jpg'),
                'excerpt' => 'Simple ways to elevate a romantic stay with room upgrades, dining, and personalised hotel services.',
                'tags' => 'anniversary, celebration, luxury stay',
                'published_at' => '2026-04-28',
                'display_on_home' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::query()->updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'featured_image' => $post['featured_image'],
                    'author' => 'Tripti Hotel',
                    'excerpt' => $post['excerpt'],
                    'content' => '<p>'.$post['excerpt'].'</p>',
                    'tags' => $post['tags'],
                    'published_at' => $post['published_at'],
                    'display_on_home' => $post['display_on_home'],
                    'sort_order' => $post['sort_order'],
                    'status' => true,
                    'seo_meta_title' => $post['title'].' | Tripti Hotel',
                    'seo_meta_description' => $post['excerpt'],
                    'seo_meta_keywords' => $post['tags'],
                    'seo_og_title' => $post['title'],
                    'seo_og_description' => $post['excerpt'],
                    'seo_og_image' => $post['featured_image'],
                    'seo_robots' => 'index, follow',
                ]
            );
        }

        BlogPost::query()
            ->whereNotIn('slug', array_column($posts, 'slug'))
            ->delete();
    }
}
