<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default FAQ items and home section settings.
 */
class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionSettings = [
            'faq_home_eyebrow' => 'FAQs',
            'faq_home_title' => 'Frequently Asked Questions',
            'faq_home_description' => 'Quick answers about bookings, check-in, rooms, and hotel amenities.',
            'faq_home_image' => 'home-about-team.jpg',
            'faq_home_contact_label' => 'Still Have Questions?',
            'faq_page_eyebrow' => 'FAQs',
            'faq_page_title' => 'Frequently Asked Questions',
            'faq_page_description' => 'Find answers to common questions about reservations, stays, facilities, and guest services at Tripti Hotel.',
            'faq_page_image' => 'home-about-team.jpg',
            'faq_page_contact_label' => 'Still Have Questions?',
        ];

        foreach ($sectionSettings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $faqs = [
            [
                'question' => 'What are the check-in and check-out times?',
                'answer' => 'Check-in is from 2:00 PM and check-out is by 11:00 AM. Early check-in or late check-out may be available on request, subject to room availability.',
                'sort_order' => 1,
                'display_on_home' => true,
            ],
            [
                'question' => 'How can I book a room at Tripti Hotel?',
                'answer' => 'You can book directly through our website contact form, call our front desk, or email us with your preferred dates and room type. Our team will confirm availability and assist with your reservation.',
                'sort_order' => 2,
                'display_on_home' => true,
            ],
            [
                'question' => 'Do you offer airport pickup and drop-off?',
                'answer' => 'Yes. Airport transfer can be arranged on request at the time of booking or by contacting the front desk before your arrival.',
                'sort_order' => 3,
                'display_on_home' => true,
            ],
            [
                'question' => 'Is Wi-Fi available in the rooms?',
                'answer' => 'Complimentary high-speed Wi-Fi is available for guests throughout the hotel, including all rooms and common areas.',
                'sort_order' => 4,
                'display_on_home' => true,
            ],
            [
                'question' => 'Do you have banquet and event facilities?',
                'answer' => 'Yes. We offer banquet and meeting spaces for weddings, receptions, corporate events, and private celebrations with catering and coordination support.',
                'sort_order' => 5,
                'display_on_home' => true,
            ],
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'Cancellation terms may vary by booking type and season. Please contact our reservations team for the applicable policy at the time of booking.',
                'sort_order' => 6,
                'display_on_home' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'sort_order' => $faq['sort_order'],
                    'status' => true,
                    'display_on_home' => $faq['display_on_home'],
                    'display_on_faq_page' => true,
                ]
            );
        }

        Faq::query()
            ->whereNotIn('question', array_column($faqs, 'question'))
            ->delete();
    }
}
