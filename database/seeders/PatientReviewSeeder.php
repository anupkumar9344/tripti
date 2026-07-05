<?php

namespace Database\Seeders;

use App\Models\PatientReview;
use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default guest reviews and section settings for the home page.
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
            'patient_feedback_average_rating' => '5.0',
            'patient_feedback_total_reviews' => '428',
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
                'photo' => 'assets/img/testimonials/1.jpg',
                'review_time' => '2 weeks ago',
                'review_text' => 'Wonderful stay at Tripti Hotel. The room was spotless, the bed was very comfortable, and the staff were polite and helpful throughout our visit. Would definitely book again.',
                'sort_order' => 1,
            ],
            [
                'reviewer_name' => 'Amit Sharma',
                'initial' => 'A',
                'avatar_tone' => 'primary',
                'photo' => 'assets/img/testimonials/2.jpg',
                'review_time' => '1 month ago',
                'review_text' => 'Booked an executive suite for a business trip and was impressed by the service. Quick check-in, reliable Wi-Fi, and excellent room service made the stay very convenient.',
                'sort_order' => 2,
            ],
            [
                'reviewer_name' => 'Priya Verma',
                'initial' => 'P',
                'avatar_tone' => 'warm',
                'photo' => 'assets/img/testimonials/3.jpg',
                'review_time' => '3 months ago',
                'review_text' => 'We celebrated our anniversary here and the team went the extra mile with room decoration and dinner arrangements. Beautiful hotel and memorable hospitality.',
                'sort_order' => 3,
            ],
            [
                'reviewer_name' => 'Rajesh Gupta',
                'initial' => 'R',
                'avatar_tone' => 'accent',
                'review_time' => '6 weeks ago',
                'review_text' => 'Family room was spacious and well maintained. Kids loved the food, and the front desk helped us with local sightseeing recommendations. Great value for families.',
                'sort_order' => 4,
            ],
            [
                'reviewer_name' => 'Sunita Jain',
                'initial' => 'S',
                'avatar_tone' => 'primary',
                'review_time' => '2 months ago',
                'review_text' => 'Hosted a small corporate meeting at the hotel. The conference setup was smooth, catering was on time, and the team handled everything professionally.',
                'sort_order' => 5,
            ],
            [
                'reviewer_name' => 'Mohan Das',
                'initial' => 'M',
                'avatar_tone' => 'warm',
                'review_time' => '4 months ago',
                'review_text' => 'Clean rooms, tasty breakfast, and friendly staff. Check-out was quick and the concierge arranged airport transfer without any hassle. Highly recommended.',
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
                    'photo' => $review['photo'] ?? null,
                    'review_text' => $review['review_text'],
                    'rating' => 5,
                    'is_verified' => true,
                    'sort_order' => $review['sort_order'],
                    'status' => true,
                ]
            );
        }

        $reviewKeys = collect($reviews)
            ->map(fn (array $review) => $review['reviewer_name'].'|'.$review['review_time'])
            ->all();

        PatientReview::query()
            ->get()
            ->filter(fn (PatientReview $review) => ! in_array($review->reviewer_name.'|'.$review->review_time, $reviewKeys, true))
            ->each
            ->delete();
    }
}
