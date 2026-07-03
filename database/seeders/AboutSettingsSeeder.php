<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default About Us page and home section settings.
 */
class AboutSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'about_home_title' => 'Experience luxury',
            'about_home_title_highlight' => 'hospitality',
            'about_home_description' => 'At Tripti Hotel, we welcome every guest with warm service, elegant rooms, and thoughtful amenities — creating stays that feel comfortable, refined, and truly memorable.',
            'about_home_image' => 'home-about-team.jpg',
            'about_home_badge_number' => '15',

            'about_page_title' => 'Experience luxury',
            'about_page_title_highlight' => 'hospitality',
            'about_page_description' => '<p>At Tripti Hotel, we welcome every guest with warm service, elegant rooms, and thoughtful amenities — creating stays that feel comfortable, refined, and truly memorable.</p><p>From business travellers to families and weekend getaways, our team is dedicated to making every visit smooth, relaxing, and special.</p>',
            'about_page_image' => 'home-about-team.jpg',
            'about_page_badge_number' => '15',

            'about_stat_1_count' => '15',
            'about_stat_1_label' => 'Years of Hospitality',
            'about_stat_2_count' => '12000',
            'about_stat_2_label' => 'Happy Guests',
            'about_stat_3_count' => '48',
            'about_stat_3_label' => 'Luxury Rooms',
            'about_stat_4_count' => '24',
            'about_stat_4_label' => 'Hour Concierge',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
