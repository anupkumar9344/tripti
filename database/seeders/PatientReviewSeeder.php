<?php

namespace Database\Seeders;

use App\Models\PatientReview;
use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default patient feedback reviews and section settings for the home page.
 */
class PatientReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionSettings = [
            'patient_feedback_rating_label' => 'Excellent',
            'patient_feedback_total_reviews' => '346',
            'patient_feedback_read_more_url' => '#',
        ];

        foreach ($sectionSettings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $reviews = [
            [
                'reviewer_name' => 'Kiran Mehta',
                'initial' => 'K',
                'avatar_tone' => 'accent',
                'review_time' => '6 months ago',
                'review_text' => 'I came to Sahaj Aarogyam with chronic back pain and limited mobility. Within weeks of integrated physiotherapy and Ayurveda support, my pain reduced significantly. The team is compassionate, professional, and truly focused on root-cause healing.',
                'sort_order' => 1,
            ],
            [
                'reviewer_name' => 'Amit Sharma',
                'initial' => 'A',
                'avatar_tone' => 'primary',
                'review_time' => '3 months ago',
                'review_text' => 'Excellent experience for my father\'s knee pain treatment. Non-surgical care, clear guidance, and regular follow-ups made a huge difference. Staff explained every step patiently. Highly recommended for anyone seeking natural recovery.',
                'sort_order' => 2,
            ],
            [
                'reviewer_name' => 'Priya Verma',
                'initial' => 'P',
                'avatar_tone' => 'warm',
                'review_time' => '1 year ago',
                'review_text' => 'The weight management and nutrition program changed my lifestyle completely. Dr Rachana\'s diet plan was practical and easy to follow. I lost weight sustainably without crash dieting. Very grateful to the entire team.',
                'sort_order' => 3,
            ],
            [
                'reviewer_name' => 'Rajesh Gupta',
                'initial' => 'R',
                'avatar_tone' => 'accent',
                'review_time' => '2 months ago',
                'review_text' => 'Panchakarma detox at Sahaj Aarogyam was a transformative experience. Clean facility, expert Ayurveda doctors, and personalized therapy plan. I feel lighter, more energetic, and mentally refreshed after the program.',
                'sort_order' => 4,
            ],
            [
                'reviewer_name' => 'Sunita Jain',
                'initial' => 'S',
                'avatar_tone' => 'primary',
                'review_time' => '4 weeks ago',
                'review_text' => 'Hijama therapy and Unani consultation helped with my long-standing fatigue and joint stiffness. Dr Shaziya was thorough and caring. The holistic approach here treats the person, not just symptoms.',
                'sort_order' => 5,
            ],
            [
                'reviewer_name' => 'Mohan Das',
                'initial' => 'M',
                'avatar_tone' => 'warm',
                'review_time' => '8 months ago',
                'review_text' => 'Slip disc pain had made daily life difficult. After structured rehab and acupuncture sessions, I am back to normal activities without surgery. Transparent pricing, skilled therapists, and genuine care throughout.',
                'sort_order' => 6,
            ],
        ];

        foreach ($reviews as $review) {
            PatientReview::query()->updateOrCreate(
                [
                    'reviewer_name' => $review['reviewer_name'],
                    'review_time' => $review['review_time'],
                ],
                [
                    'initial' => $review['initial'],
                    'avatar_tone' => $review['avatar_tone'],
                    'review_text' => $review['review_text'],
                    'rating' => 5,
                    'is_verified' => true,
                    'sort_order' => $review['sort_order'],
                    'status' => true,
                ]
            );
        }
    }
}
