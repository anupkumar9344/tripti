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
                'slug' => '5-natural-ways-to-improve-your-gut-health',
                'title' => '5 Natural Ways to Improve Your Gut Health',
                'featured_image' => 'post-1.jpg',
                'excerpt' => 'Good gut health is the foundation of overall well-being. A healthy gut improves digestion, boosts immunity, enhances mood, and helps maintain a healthy weight.',
                'tags' => 'gut health, nutrition, wellness',
                'published_at' => '2026-05-29',
                'display_on_home' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'ayurveda-vs-modern-lifestyle-disorders',
                'title' => 'Ayurveda vs Modern Lifestyle Disorders',
                'featured_image' => 'post-2.jpg',
                'excerpt' => 'Modern lifestyle has led to an increase in disorders like obesity, diabetes, hypertension, PCOS, thyroid issues, and stress-related conditions.',
                'tags' => 'ayurveda, lifestyle, chronic care',
                'published_at' => '2026-05-29',
                'display_on_home' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'how-physiotherapy-helps-in-chronic-pain-recovery',
                'title' => 'How Physiotherapy Helps in Chronic Pain Recovery',
                'featured_image' => 'post-3.jpg',
                'excerpt' => 'Chronic pain can affect your daily life and limit your ability to move, work, and enjoy the things you love.',
                'tags' => 'physiotherapy, pain relief, rehabilitation',
                'published_at' => '2026-05-29',
                'display_on_home' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'understanding-panchakarma-detox-benefits',
                'title' => 'Understanding Panchakarma Detox Benefits',
                'featured_image' => 'post-4.jpg',
                'excerpt' => 'Panchakarma is a cornerstone of Ayurvedic healing — a structured detox process that cleanses the body and restores balance.',
                'tags' => 'panchakarma, detox, ayurveda',
                'published_at' => '2026-05-15',
                'display_on_home' => false,
                'sort_order' => 4,
            ],
            [
                'slug' => 'weight-loss-without-crash-diets',
                'title' => 'Weight Loss Without Crash Diets',
                'featured_image' => 'post-5.jpg',
                'excerpt' => 'Sustainable weight management comes from balanced nutrition, metabolism support, and lifestyle changes.',
                'tags' => 'weight loss, nutrition, metabolism',
                'published_at' => '2026-05-10',
                'display_on_home' => false,
                'sort_order' => 5,
            ],
            [
                'slug' => 'non-surgical-options-for-back-pain',
                'title' => 'Non-Surgical Options for Back Pain',
                'featured_image' => 'post-6.jpg',
                'excerpt' => 'Most back pain can be treated effectively without surgery through physiotherapy, Ayurveda, and structured rehabilitation.',
                'tags' => 'back pain, spine care, non-surgical',
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
    }
}
