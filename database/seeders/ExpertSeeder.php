<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Seeder;

/**
 * Seeds default hotel team members for listing and home pages.
 */
class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experts = [
            [
                'name' => 'Rajesh Agarwal',
                'slug' => 'rajesh-agarwal',
                'photo' => asset('assets/img/team/1.jpg'),
                'designation' => 'Founder & Managing Director',
                'specialty' => 'Luxury Hospitality',
                'experience_label' => '20+ Years Experience',
                'qualifications' => 'Luxury Hospitality Leadership | Brand Development',
                'short_description' => 'Leads the hotel vision with a focus on premium guest experiences and operational excellence.',
                'highlight_quote' => 'Every guest should feel the warmth of Indian hospitality with world-class standards.',
                'long_description' => "Rajesh Agarwal founded Tripti Hotel with a vision to blend timeless Indian hospitality with contemporary luxury. Under his leadership, the property has become known for attentive service, refined interiors, and a guest-first culture across every department.\n\nHe works closely with department heads to maintain service consistency, invest in staff development, and elevate the overall guest journey from arrival to departure.",
                'patients_treated' => '10,000+ Guests Hosted',
                'sort_order' => 1,
            ],
            [
                'name' => 'Priya Sharma',
                'slug' => 'priya-sharma',
                'photo' => asset('assets/img/team/2.jpg'),
                'designation' => 'General Manager',
                'specialty' => 'Guest Experience',
                'experience_label' => '15+ Years Experience',
                'qualifications' => 'Hospitality Management | Luxury Hotel Operations | Team Leadership',
                'short_description' => 'Oversees daily operations and ensures every guest enjoys seamless, five-star service.',
                'highlight_quote' => 'Great stays are built on thoughtful details and a team that genuinely cares.',
                'long_description' => "Priya Sharma oversees hotel operations with a sharp focus on service quality, team coordination, and guest satisfaction. She ensures that front office, housekeeping, dining, and events work together seamlessly.\n\nHer experience in luxury hotel operations helps maintain high standards while adapting services to each guest's needs, whether for business travel, family stays, or special celebrations.",
                'patients_treated' => '8,500+ Stays Managed',
                'sort_order' => 2,
            ],
            [
                'name' => 'Amit Patel',
                'slug' => 'amit-patel',
                'photo' => asset('assets/img/team/3.jpg'),
                'designation' => 'Executive Chef',
                'specialty' => 'Fine Dining & Banquets',
                'experience_label' => '18+ Years Experience',
                'qualifications' => 'Culinary Arts | Multi-Cuisine Specialist | Banquet Operations',
                'short_description' => 'Creates memorable dining experiences with curated menus and exceptional presentation.',
                'highlight_quote' => 'Food should tell a story — of flavour, presentation, and the occasion itself.',
                'long_description' => "Amit Patel leads the culinary team at Tripti Hotel, crafting menus that balance regional flavours with international favourites. From all-day dining to bespoke banquet spreads, he ensures every plate reflects quality and care.\n\nHe collaborates with events and guest relations teams to design menus for weddings, corporate gatherings, and private celebrations.",
                'patients_treated' => '5,000+ Events Catered',
                'sort_order' => 3,
            ],
            [
                'name' => 'Neha Mehta',
                'slug' => 'neha-mehta',
                'photo' => asset('assets/img/team/4.jpg'),
                'designation' => 'Front Office Manager',
                'specialty' => 'Guest Relations',
                'experience_label' => '12+ Years Experience',
                'qualifications' => 'Front Office Operations | VIP Guest Handling | Reservation Management',
                'short_description' => 'Ensures smooth check-ins, personalised assistance, and attentive front-desk service.',
                'highlight_quote' => 'A warm welcome sets the tone for an exceptional stay.',
                'long_description' => "Neha Mehta leads the front office team with a guest-first approach, ensuring every arrival feels smooth, personal, and professional. She specialises in VIP handling, group check-ins, and resolving guest requests with speed and care.\n\nFrom room preferences to special occasion arrangements, Neha coordinates closely with housekeeping and concierge teams to deliver a seamless experience from the moment guests step into the lobby.",
                'patients_treated' => '6,000+ Guests Welcomed',
                'sort_order' => 4,
            ],
            [
                'name' => 'Vikram Singh',
                'slug' => 'vikram-singh',
                'photo' => asset('assets/img/team/1.jpg'),
                'designation' => 'Housekeeping Manager',
                'specialty' => 'Room Standards & Comfort',
                'experience_label' => '14+ Years Experience',
                'qualifications' => 'Housekeeping Management | Quality Assurance | Laundry Operations',
                'short_description' => 'Maintains immaculate rooms and suites with consistent attention to detail and comfort.',
                'highlight_quote' => 'Clean, comfortable rooms are the foundation of a memorable hotel stay.',
                'long_description' => "Vikram Singh ensures that every room and suite meets Tripti Hotel's exacting standards for cleanliness, comfort, and presentation. He leads training programmes for housekeeping staff and implements quality checks throughout the property.\n\nHis team works behind the scenes to prepare rooms promptly, maintain public areas, and support guest requests for extra amenities or special setups.",
                'patients_treated' => '12,000+ Rooms Prepared',
                'sort_order' => 5,
            ],
            [
                'name' => 'Kiran Desai',
                'slug' => 'kiran-desai',
                'photo' => asset('assets/img/team/2.jpg'),
                'designation' => 'Guest Relations Manager',
                'specialty' => 'Concierge & Events',
                'experience_label' => '10+ Years Experience',
                'qualifications' => 'Concierge Services | Event Coordination | Local Experiences',
                'short_description' => 'Helps guests with travel plans, local recommendations, and special occasion arrangements.',
                'highlight_quote' => 'The best recommendations come from knowing both the city and the guest.',
                'long_description' => "Kiran Desai helps guests make the most of their stay with personalised recommendations, travel assistance, and event coordination. From restaurant reservations to local sightseeing and celebration planning, Kiran ensures guests feel supported throughout their visit.\n\nShe works closely with the events team to arrange birthdays, anniversaries, and corporate functions with thoughtful touches and smooth execution.",
                'patients_treated' => '3,500+ Requests Fulfilled',
                'sort_order' => 6,
            ],
        ];

        foreach ($experts as $expert) {
            Expert::query()->updateOrCreate(
                ['slug' => $expert['slug']],
                [
                    'name' => $expert['name'],
                    'photo' => $expert['photo'],
                    'designation' => $expert['designation'],
                    'specialty' => $expert['specialty'],
                    'experience_label' => $expert['experience_label'] ?? null,
                    'qualifications' => $expert['qualifications'] ?? null,
                    'short_description' => $expert['short_description'],
                    'highlight_quote' => $expert['highlight_quote'] ?? null,
                    'long_description' => $expert['long_description'] ?? null,
                    'patients_treated' => $expert['patients_treated'] ?? null,
                    'status' => true,
                    'display_on_home' => true,
                    'sort_order' => $expert['sort_order'],
                ]
            );
        }

        Expert::query()
            ->whereNotIn('slug', array_column($experts, 'slug'))
            ->delete();
    }
}
