<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default general settings for Sahaj Aarogyam.
 */
class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'website_name' => 'Sahaj Aarogyam',
            'website_logo' => null,
            'footer_about' => 'Integrated wellness clinic providing physiotherapy, Ayurveda, pain management, and holistic healing solutions in Indore.',
            'email_1' => 'info@sahajaarogyam.com',
            'email_2' => 'sahajaarogyam@gmail.com',
            'phone_1' => '+91 94259 63336',
            'phone_2' => null,
            'whatsapp_number' => '9425963336',
            'address' => '560 Sector B Greater Brajeshwari, Near Agrawal Public School, Indore, India, 452001',
            'opening_hours' => "Mon - Sat: 9:00 AM - 8:00 PM\nSunday: Closed",
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'google_map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSahaj%20Aarogyam!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
            'visit_us_eyebrow' => 'Visit Us',
            'visit_us_title' => 'Serving Indore & Nearby',
            'visit_us_description' => 'Conveniently located in the heart of Indore, we proudly serve patients from across the city and nearby areas.',
            'visit_us_bg_image' => 'home-about-team.jpg',
            'contact_locations_title' => 'Our Locations',
            'contact_locations_description' => 'Visit us at our clinic in Indore for personalized care and holistic healing.',
            'contact_form_title' => 'Send Us a Message',
            'contact_form_description' => 'Fill out the form below and our team will get in touch with you.',
            'seo_meta_title' => 'Sahaj Aarogyam | Integrated Wellness Clinic in Indore',
            'seo_meta_description' => 'Sahaj Aarogyam offers physiotherapy, Ayurveda, pain management, and holistic wellness treatments in Indore. Book your appointment today.',
            'seo_meta_keywords' => 'Sahaj Aarogyam, wellness clinic Indore, physiotherapy, Ayurveda, pain management, holistic healing',
            'seo_meta_author' => 'Sahaj Aarogyam',
            'seo_robots' => 'index, follow',
            'seo_og_title' => 'Sahaj Aarogyam | Integrated Wellness Clinic in Indore',
            'seo_og_description' => 'Physiotherapy, Ayurveda, pain management, and holistic healing solutions in Indore.',
            'seo_og_image' => 'home-about-team.jpg',
            'seo_twitter_card' => 'summary_large_image',
            'seo_twitter_site' => null,
            'seo_google_site_verification' => null,
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
