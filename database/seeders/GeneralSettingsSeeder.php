<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default general settings for Tripti Hotel.
 */
class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'admin_theme_primary_color' => '#7356a5',
            'theme_primary_color' => '#9d7e54',
            'website_name' => 'Tripti Hotel',
            'website_logo' => 'logo/logo.png',
            'website_favicon' => 'logo/logo.png',
            'admin_login_image' => 'gallery-4.jpg',
            'welcome_modal_enabled' => '1',
            'welcome_modal_title' => 'Welcome to Tripti Hotel',
            'welcome_modal_message' => 'Discover luxury rooms, fine dining, and premium hospitality. Book your unforgettable stay with us today.',
            'welcome_modal_media_type' => 'image',
            'welcome_modal_image' => 'gallery-4.jpg',
            'welcome_modal_video_url' => null,
            'welcome_modal_button_text' => 'Explore Rooms',
            'welcome_modal_button_url' => '/rooms',
            'welcome_modal_revision' => '1',
            'footer_about' => 'Tripti Hotel offers luxury rooms, fine dining, and premium hospitality for an unforgettable stay.',
            'email_1' => 'info@triptihotel.com',
            'email_2' => 'contact@triptihotel.com',
            'phone_1' => '+91 98765 43210',
            'phone_2' => null,
            'whatsapp_number' => '9876543210',
            'address' => '987-A, Dudhivadar, Rajkot, Gujarat, Bharat - 360410',
            'opening_hours' => "Check-in: 2:00 PM\nCheck-out: 11:00 AM\nFront Desk: 24 Hours",
            'facebook_url' => null,
            'instagram_url' => null,
            'youtube_url' => null,
            'google_map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTripti%20Hotel!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
            'visit_us_eyebrow' => 'Visit Us',
            'visit_us_title' => 'Welcome to Tripti Hotel',
            'visit_us_description' => 'Experience luxury hospitality in the heart of the city with elegant rooms and world-class amenities.',
            'visit_us_bg_image' => 'home-about-team.jpg',
            'contact_locations_title' => 'Our Location',
            'contact_locations_description' => 'Reach out to book your stay or ask about our rooms and facilities.',
            'contact_form_title' => 'Send Us a Message',
            'contact_form_description' => 'Fill out the form below and our team will get in touch with you shortly.',
            'career_page_eyebrow' => 'Join Our Team',
            'career_page_title' => 'Build Your Career at Tripti Hotel',
            'career_page_intro' => 'We are always looking for passionate people to deliver warm hospitality and memorable guest experiences.',
            'career_form_title' => 'Apply Now',
            'career_form_description' => 'Share your details and our HR team will contact you if your profile matches an open role.',
            'seo_meta_title' => 'Tripti Hotel | Luxury Stay & Hospitality',
            'seo_meta_description' => 'Tripti Hotel offers luxury rooms, fine dining, spa, and premium hospitality for an unforgettable stay.',
            'seo_meta_keywords' => 'Tripti Hotel, luxury hotel, rooms, booking, restaurant, spa, hospitality',
            'seo_meta_author' => 'Tripti Hotel',
            'seo_robots' => 'index, follow',
            'seo_og_title' => 'Tripti Hotel | Luxury Stay & Hospitality',
            'seo_og_description' => 'Luxury rooms, fine dining, and premium hospitality at Tripti Hotel.',
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
