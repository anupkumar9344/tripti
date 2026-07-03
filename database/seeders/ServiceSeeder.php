<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Seeds default hotel facility records for listing and home pages.
 */
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Fine Dining Restaurant',
                'slug' => 'fine-dining-restaurant',
                'thumbnail' => asset('assets/img/menu/1.jpg'),
                'icon' => 'fa-utensils',
                'tags' => 'Multi-Cuisine, Room Service',
                'short_description' => 'Savour chef-crafted dishes in an elegant dining setting with attentive table service.',
                'long_description' => '<p>Our restaurant offers a curated menu of Indian and international favourites, prepared fresh with premium ingredients.</p><p>Whether you are enjoying a relaxed breakfast, business lunch, or special dinner, our culinary team ensures a memorable dining experience.</p><ul><li>Breakfast, lunch, and dinner service</li><li>Multi-cuisine menu options</li><li>Private dining arrangements</li><li>Dietary preferences accommodated</li><li>Warm, professional service</li><li>Comfortable ambience</li></ul>',
                'sort_order' => 1,
                'display_on_home' => true,
            ],
            [
                'title' => 'Spa & Wellness',
                'slug' => 'spa-wellness',
                'thumbnail' => asset('assets/img/spa/1.jpg'),
                'icon' => 'fa-spa',
                'tags' => 'Massage, Relaxation',
                'short_description' => 'Unwind with rejuvenating spa therapies designed to restore calm and comfort.',
                'long_description' => '<p>Our spa and wellness services help guests relax after travel or a busy day with soothing treatments in a tranquil setting.</p><p>Choose from therapeutic massages and wellness rituals tailored to help you feel refreshed and recharged.</p><ul><li>Relaxing body massages</li><li>Stress relief therapies</li><li>Couples spa sessions</li><li>Wellness consultation</li><li>Calm, private treatment rooms</li><li>Trained wellness staff</li></ul>',
                'sort_order' => 2,
                'display_on_home' => true,
            ],
            [
                'title' => 'Banquet & Events',
                'slug' => 'banquet-events',
                'thumbnail' => asset('assets/img/extra-services/1.jpg'),
                'icon' => 'fa-champagne-glasses',
                'tags' => 'Weddings, Celebrations',
                'short_description' => 'Host weddings, receptions, and social gatherings in beautifully arranged event spaces.',
                'long_description' => '<p>Tripti Hotel offers flexible banquet facilities for weddings, engagements, birthdays, and family celebrations.</p><p>Our events team supports décor planning, catering menus, seating layouts, and smooth coordination on the day.</p><ul><li>Customisable banquet setups</li><li>Wedding and reception packages</li><li>In-house catering support</li><li>Audio-visual assistance</li><li>Event coordination team</li><li>Guest accommodation options</li></ul>',
                'sort_order' => 3,
                'display_on_home' => true,
            ],
            [
                'title' => 'Airport Transfer',
                'slug' => 'airport-transfer',
                'thumbnail' => asset('assets/img/extra-services/2.jpg'),
                'icon' => 'fa-car',
                'tags' => 'Pickup, Drop-off',
                'short_description' => 'Convenient pickup and drop services for a smooth arrival and departure experience.',
                'long_description' => '<p>Start and end your trip comfortably with our reliable airport transfer service.</p><p>Advance booking ensures timely pickup, luggage assistance, and a hassle-free journey to or from the hotel.</p><ul><li>Airport pickup on request</li><li>Drop-off scheduling</li><li>Comfortable vehicles</li><li>Professional drivers</li><li>Advance booking available</li><li>Ideal for business travellers</li></ul>',
                'sort_order' => 4,
                'display_on_home' => true,
            ],
            [
                'title' => '24/7 Room Service',
                'slug' => 'room-service',
                'thumbnail' => asset('assets/img/extra-services/3.jpg'),
                'icon' => 'fa-bell-concierge',
                'tags' => 'In-Room Dining, Convenience',
                'short_description' => 'Enjoy meals, beverages, and essentials delivered directly to your room any time.',
                'long_description' => '<p>Our room service menu brings restaurant-quality food and refreshments to the comfort of your room.</p><p>Available around the clock for late arrivals, quiet dinners, or anytime cravings during your stay.</p><ul><li>All-day room dining</li><li>Quick in-room delivery</li><li>Hot and cold menu options</li><li>Beverages and snacks</li><li>Discreet, timely service</li><li>Ideal for relaxed stays</li></ul>',
                'sort_order' => 5,
                'display_on_home' => true,
            ],
            [
                'title' => 'Conference Facilities',
                'slug' => 'conference-facilities',
                'thumbnail' => asset('assets/img/extra-services/4.jpg'),
                'icon' => 'fa-briefcase',
                'tags' => 'Meetings, Corporate Events',
                'short_description' => 'Well-equipped meeting spaces for conferences, trainings, and corporate gatherings.',
                'long_description' => '<p>Our conference facilities support business meetings, seminars, and corporate events with practical layouts and professional support.</p><p>From small boardroom discussions to larger presentations, we help your event run smoothly.</p><ul><li>Meeting and conference rooms</li><li>Presentation-ready setups</li><li>Tea breaks and catering</li><li>Business-friendly environment</li><li>Flexible seating arrangements</li><li>On-site coordination support</li></ul>',
                'sort_order' => 6,
                'display_on_home' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'title' => $service['title'],
                    'thumbnail' => $service['thumbnail'],
                    'icon' => $service['icon'],
                    'tags' => $service['tags'],
                    'short_description' => $service['short_description'],
                    'long_description' => $service['long_description'],
                    'sort_order' => $service['sort_order'],
                    'status' => true,
                    'display_on_home' => $service['display_on_home'],
                ]
            );
        }

        Service::query()
            ->whereNotIn('slug', array_column($services, 'slug'))
            ->delete();
    }
}
