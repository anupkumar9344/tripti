<?php

namespace Database\Seeders;

use App\Models\HealthProgram;
use Illuminate\Database\Seeder;

/**
 * Seeds default hotel packages and special offers.
 */
class HealthProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthProgram::query()->updateOrCreate(
            ['title' => 'Weekend Getaway Package'],
            [
                'image' => asset('assets/img/rooms/2.jpg'),
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'eyebrow' => 'Special Offers',
                'section_title' => 'Relax. Refresh. Recharge.',
                'section_lead' => 'Enjoy a curated weekend stay with comfortable accommodation, breakfast, and exclusive in-hotel benefits.',
                'date_time' => 'Every Friday – Sunday',
                'location' => 'Tripti Hotel, Rajkot',
                'chief_consultant' => 'Reservations Team',
                'key_benefits' => 'Complimentary Breakfast, Late Check-Out, Room Upgrade Subject to Availability, Dining Discount',
                'button_text' => 'View Latest Offers',
                'button_url' => url('/contact-us'),
                'sort_order' => 1,
                'status' => true,
                'active_on_home' => true,
            ]
        );

        HealthProgram::query()->updateOrCreate(
            ['title' => 'Corporate Stay Package'],
            [
                'image' => asset('assets/img/rooms/3.jpg'),
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'eyebrow' => 'Business Travel',
                'section_title' => 'Smart Stays for Business Guests.',
                'section_lead' => 'Tailored packages for corporate travellers with meeting support, dining, and priority services.',
                'date_time' => 'Available Year Round',
                'location' => 'Tripti Hotel, Rajkot',
                'chief_consultant' => 'Front Office Manager',
                'key_benefits' => 'Meeting Room Access, Express Check-In, Wi-Fi, Airport Transfer on Request',
                'button_text' => 'Enquire Now',
                'button_url' => url('/contact-us'),
                'sort_order' => 2,
                'status' => true,
                'active_on_home' => false,
            ]
        );

        HealthProgram::query()
            ->whereNotIn('title', ['Weekend Getaway Package', 'Corporate Stay Package'])
            ->delete();
    }
}
