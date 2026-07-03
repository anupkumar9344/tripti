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
                'slug' => 'best-way-to-enjoy-luxury-dining-at-our-hotel',
                'title' => 'Best way to enjoy luxury dining at our hotel.',
                'featured_image' => 'assets/img/blog/1.jpg',
                'tags' => 'Restaurant, dining, hotel food',
                'published_at' => '2024-06-28',
                'display_on_home' => true,
                'sort_order' => 1,
                'excerpt' => 'Discover exceptional cuisine crafted by our award-winning chefs in an elegant atmosphere perfect for every occasion.',
                'content' => '<p>Discover exceptional cuisine crafted by our award-winning chefs. From intimate dinners to grand celebrations, Tripti Hotel offers dining experiences that delight every palate.</p><p>Our restaurant blends local flavors with international techniques, served in an elegant atmosphere perfect for business lunches or romantic evenings. Seasonal menus, attentive service, and a thoughtfully curated wine list make every meal memorable.</p><p>Whether you are joining us for breakfast before a busy day or an unhurried dinner with family, our culinary team focuses on quality ingredients, beautiful presentation, and warm hospitality.</p>',
            ],
            [
                'slug' => 'wellness-guide-5-steps-to-a-perfect-stay',
                'title' => 'Wellness guide: 5 steps to a perfect stay.',
                'featured_image' => 'assets/img/blog/2.jpg',
                'tags' => 'Gym, wellness, fitness',
                'published_at' => '2024-06-30',
                'display_on_home' => true,
                'sort_order' => 2,
                'excerpt' => 'Stay active and balanced during your visit with our fitness center, spa services, and simple wellness routines.',
                'content' => '<p>A great hotel stay is about more than a comfortable room. At Tripti Hotel, wellness is woven into the experience — from morning workouts to evening relaxation.</p><p><strong>1. Start with movement.</strong> Visit our fully equipped fitness center to energize your day.</p><p><strong>2. Hydrate and nourish.</strong> Choose balanced meals from our restaurant and room service menu.</p><p><strong>3. Unwind at the spa.</strong> Book a treatment to release tension and restore calm.</p><p><strong>4. Sleep well.</strong> Premium bedding and quiet rooms help you recharge fully.</p><p><strong>5. Take mindful breaks.</strong> Enjoy the pool, lounge spaces, and scenic corners of the property.</p>',
            ],
            [
                'slug' => 'relax-and-recharge-at-our-spa-retreat',
                'title' => 'Relax and recharge at our spa retreat.',
                'featured_image' => 'assets/img/blog/3.jpg',
                'tags' => 'Spa, wellness, relaxation',
                'published_at' => '2024-06-16',
                'display_on_home' => true,
                'sort_order' => 3,
                'excerpt' => 'Rejuvenate your body and mind with premium spa treatments designed for rest, renewal, and total relaxation.',
                'content' => '<p>Step away from the pace of travel and into a sanctuary of calm. Our spa retreat offers therapies that soothe tired muscles, refresh the skin, and quiet the mind.</p><p>Choose from aromatherapy massages, rejuvenating facials, and holistic wellness rituals led by trained therapists. Soft lighting, tranquil interiors, and personalized care create an experience that feels indulgent yet deeply restorative.</p><p>Pair your treatment with time by the pool or a light meal afterward — the perfect way to complete a day of self-care at Tripti Hotel.</p>',
            ],
            [
                'slug' => 'host-unforgettable-events-at-tripti-hotel',
                'title' => 'Host unforgettable events at Tripti Hotel.',
                'featured_image' => 'assets/img/blog/4.jpg',
                'tags' => 'Events, banquet, celebrations',
                'published_at' => '2024-06-10',
                'display_on_home' => true,
                'sort_order' => 4,
                'excerpt' => 'From weddings to corporate gatherings, our event spaces and planning team help you create memorable celebrations.',
                'content' => '<p>Whether you are planning a wedding reception, corporate conference, or private celebration, Tripti Hotel offers versatile venues and dedicated event support.</p><p>Our team assists with layout, catering, audiovisual needs, and guest accommodation so you can focus on the occasion itself. Elegant interiors, flexible seating, and attentive service ensure every event feels polished and personal.</p><p>Contact our events desk to tour the spaces, discuss menus, and build a package tailored to your guest list and vision.</p>',
            ],
            [
                'slug' => 'business-travel-made-comfortable',
                'title' => 'Business Travel Made Comfortable',
                'featured_image' => 'assets/img/blog/1.jpg',
                'tags' => 'Business travel, corporate stay, hotel tips',
                'published_at' => '2026-05-15',
                'display_on_home' => false,
                'sort_order' => 5,
                'excerpt' => 'What business guests should look for in a hotel — connectivity, service, dining, and meeting support.',
                'content' => '<p>Business travellers need reliability, speed, and comfort. Tripti Hotel delivers with high-speed Wi-Fi, efficient check-in, quiet work-friendly rooms, and responsive room service.</p><p>Executive suites offer extra space for longer stays, while our front desk can arrange airport transfers, laundry, and meeting room support. Start your day with a hearty breakfast and return to a hotel that understands the pace of professional travel.</p>',
            ],
            [
                'slug' => 'make-your-anniversary-stay-extra-special',
                'title' => 'Make Your Anniversary Stay Extra Special',
                'featured_image' => 'assets/img/blog/2.jpg',
                'tags' => 'Anniversary, celebration, luxury stay',
                'published_at' => '2026-04-28',
                'display_on_home' => false,
                'sort_order' => 6,
                'excerpt' => 'Simple ways to elevate a romantic stay with room upgrades, dining, and personalised hotel services.',
                'content' => '<p>Celebrate your anniversary with thoughtful touches that turn a hotel stay into a cherished memory. Request room decoration, reserve a private dinner, or upgrade to a suite with panoramic views.</p><p>Our team can help coordinate flowers, cakes, spa appointments, and special amenities so you can arrive and simply enjoy the moment together.</p>',
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
                    'content' => $post['content'],
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
