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
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
