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
            'faq_home_description' => 'Quick answers about our treatments, appointments, and holistic care approach.',
            'faq_home_image' => 'faqs-image.jpg',
            'faq_home_contact_label' => 'Still Have Questions?',
            'faq_page_eyebrow' => 'FAQs',
            'faq_page_title' => 'Frequently Asked Questions',
            'faq_page_description' => 'Find answers to common questions about our treatments, appointments, and holistic wellness approach.',
            'faq_page_image' => 'faqs-image.jpg',
            'faq_page_contact_label' => 'Still Have Questions?',
        ];

        foreach ($sectionSettings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $faqs = [
            [
                'question' => 'What treatments does Sahaj Aarogyam offer?',
                'answer' => 'We offer integrated non-surgical care including physiotherapy, Ayurveda, Panchakarma, Hijama, acupuncture, nutrition counselling, pain rehabilitation, and lifestyle disorder management — all under one roof.',
                'sort_order' => 1,
                'display_on_home' => true,
            ],
            [
                'question' => 'Do I need a doctor\'s referral to visit?',
                'answer' => 'No referral is required. You can book a consultation directly. Our specialists will assess your condition and recommend a personalised treatment plan during your first visit.',
                'sort_order' => 2,
                'display_on_home' => true,
            ],
            [
                'question' => 'Are your treatments non-surgical?',
                'answer' => 'Yes. Our focus is on natural, evidence-based therapies that help you recover without surgery wherever possible. Treatment plans are tailored to your condition, age, and health goals.',
                'sort_order' => 3,
                'display_on_home' => true,
            ],
            [
                'question' => 'How long does a typical treatment plan take?',
                'answer' => 'It depends on your condition and severity. Some patients notice relief within a few sessions, while chronic or long-standing issues may need a structured plan over several weeks.',
                'sort_order' => 4,
                'display_on_home' => true,
            ],
            [
                'question' => 'Do you offer personalised diet and lifestyle plans?',
                'answer' => 'Absolutely. Our nutritionists and wellness consultants create practical diet, exercise, and lifestyle protocols to support recovery, weight management, and long-term health.',
                'sort_order' => 5,
                'display_on_home' => true,
            ],
            [
                'question' => 'How do I book an appointment?',
                'answer' => 'You can book online through our website, call our clinic directly, or visit us in person. Our team will help you schedule a consultation at your convenience.',
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
                    'display_on_service_detail' => false,
                    'display_on_expert_detail' => false,
                    'service_id' => null,
                    'expert_id' => null,
                ]
            );
        }
    }
}
