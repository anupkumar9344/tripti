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
            'about_home_eyebrow' => 'About us',
            'about_home_title' => 'A holistic path to',
            'about_home_title_highlight' => 'natural healing',
            'about_home_description' => 'At Sahaj Aarogyam, we combine time-tested therapies with modern clinical care to treat pain and chronic conditions without surgery — helping you recover safely, naturally, and with lasting results.',
            'about_home_image' => 'home-about-team.jpg',
            'about_home_badge_number' => '25',
            'about_home_badge_suffix' => '+',
            'about_home_badge_text' => 'Years of Trusted Care',
            'about_home_button_text' => 'Learn More About Us',

            'about_page_eyebrow' => 'About us',
            'about_page_title' => 'A holistic path to',
            'about_page_title_highlight' => 'natural healing',
            'about_page_description' => '<p>At Sahaj Aarogyam, we combine time-tested therapies with modern clinical care to treat pain and chronic conditions without surgery — helping you recover safely, naturally, and with lasting results.</p>',
            'about_page_image' => 'home-about-team.jpg',
            'about_page_badge_number' => '25',
            'about_page_badge_suffix' => '+',
            'about_page_badge_text' => 'Years of Trusted Care',
            'about_page_button_text' => 'Meet Our Experts',

            'about_stat_1_count' => '25',
            'about_stat_1_suffix' => '+',
            'about_stat_1_label' => 'Years of Experience',
            'about_stat_2_count' => '3500',
            'about_stat_2_suffix' => '+',
            'about_stat_2_label' => 'Patients Treated',
            'about_stat_3_count' => '15',
            'about_stat_3_suffix' => '+',
            'about_stat_3_label' => 'Expert Specialists',
            'about_stat_4_count' => '10',
            'about_stat_4_suffix' => '+',
            'about_stat_4_label' => 'Therapy Disciplines',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
