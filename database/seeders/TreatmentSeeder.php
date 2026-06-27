<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Seeds default treatment records for listing and home pages.
 */
class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treatments = [
            [
                'title' => 'Back Pain & Spine disorders',
                'slug' => 'back-pain-spine-disorders',
                'icon' => 'fa-award',
                'source_image' => 'service-featured-image.jpg',
                'short_description' => 'Advanced non-surgical care for chronic back pain, stiffness, and spinal discomfort.',
                'long_description' => '<p>Back pain and spine disorders are among the most common reasons patients visit Sahaj Aarogyam. Whether your pain is muscular, disc-related, postural, or chronic, our focus is on non-surgical recovery.</p><p>We combine physiotherapy, spinal rehabilitation, Ayurvedic support, and lifestyle correction to reduce pain, restore mobility, and prevent recurrence.</p>',
                'sort_order' => 1,
                'display_on_home' => true,
            ],
            [
                'title' => 'Slip Disc & Sciatica',
                'slug' => 'slip-disc-sciatica',
                'icon' => 'fa-hand-holding-heart',
                'source_image' => 'gallery-4.jpg',
                'short_description' => 'Targeted therapies designed to reduce disc-related pain and improve mobility.',
                'long_description' => '<p>Slip disc and sciatica can cause sharp pain, numbness, and limited movement that affects work and daily life. Our integrated approach targets nerve irritation and disc-related pressure through non-surgical therapies.</p><p>Treatment plans may include physiotherapy, traction support, Ayurvedic therapies, and posture correction — customised to your scan findings and symptoms.</p>',
                'sort_order' => 2,
                'display_on_home' => true,
            ],
            [
                'title' => 'Liver & Metabolic Disorders',
                'slug' => 'liver-metabolic-disorders',
                'icon' => 'fa-clipboard-medical',
                'source_image' => 'gallery-3.jpg',
                'short_description' => 'Natural management for metabolic imbalance, fatty liver, and lifestyle-related conditions.',
                'long_description' => '<p>Liver and metabolic disorders — including fatty liver, elevated enzymes, obesity, and insulin resistance — are increasingly common and deeply linked to lifestyle.</p><p>At Sahaj Aarogyam, we address these conditions through Ayurveda, nutrition counselling, detox support, and activity planning — treating the root metabolic imbalance.</p>',
                'sort_order' => 3,
                'display_on_home' => true,
            ],
            [
                'title' => 'Knee Pain & Joints pain',
                'slug' => 'knee-pain-joints',
                'icon' => 'fa-bone',
                'source_image' => 'gallery-5.jpg',
                'short_description' => 'Personalized therapies to improve knee strength, flexibility, and movement.',
                'long_description' => '<p>Knee and joint pain can limit walking, climbing stairs, and everyday independence. Our joint care program focuses on strengthening, pain reduction, and mobility — without rushing to surgery.</p><p>Treatment includes physiotherapy, manual therapy, weight management support, and Ayurvedic anti-inflammatory care where appropriate.</p>',
                'sort_order' => 4,
                'display_on_home' => true,
            ],
            [
                'title' => 'Male and Female Wellness',
                'slug' => 'male-female-wellness',
                'icon' => 'fa-venus-mars',
                'source_image' => 'home-about-team.jpg',
                'short_description' => 'Specialized care for hormonal balance, fertility support, and gender-specific wellness.',
                'long_description' => '<p>Male and Female Wellness at Sahaj Aarogyam addresses hormonal imbalance, fertility concerns, PCOS, men\'s health issues, and stress-related wellness — with privacy, sensitivity, and clinical expertise.</p><p>Treatment combines Ayurveda, nutrition, lifestyle counselling, and supportive therapies tailored to gender-specific health needs.</p>',
                'sort_order' => 5,
                'display_on_home' => true,
            ],
            [
                'title' => 'Cervical & Ankylosing Spondylitis',
                'slug' => 'cervical-ankylosing-spondylitis',
                'icon' => 'fa-user-doctor',
                'source_image' => 'faqs-image.jpg',
                'short_description' => 'Effective care for neck pain, posture correction, and cervical discomfort.',
                'long_description' => '<p>Cervical pain, spondylitis, and ankylosing spondylitis can cause chronic neck stiffness, reduced mobility, and long-term postural changes. Early, consistent care makes a significant difference.</p><p>Our treatment combines physiotherapy for spinal mobility, Ayurvedic anti-inflammatory support, posture training, and ergonomic guidance for desk workers and professionals.</p>',
                'sort_order' => 6,
                'display_on_home' => true,
            ],
        ];

        foreach ($treatments as $treatment) {
            $storagePath = $this->storeSeedImage($treatment['slug'], $treatment['source_image']);

            Treatment::query()->updateOrCreate(
                ['slug' => $treatment['slug']],
                [
                    'title' => $treatment['title'],
                    'image' => $storagePath,
                    'icon' => $treatment['icon'] ?? null,
                    'short_description' => $treatment['short_description'],
                    'long_description' => $treatment['long_description'],
                    'sort_order' => $treatment['sort_order'],
                    'status' => true,
                    'display_on_home' => $treatment['display_on_home'],
                ]
            );
        }
    }

    /**
     * Copy a public image into storage for a seeded treatment.
     */
    private function storeSeedImage(string $slug, string $filename): string
    {
        $sourcePath = public_path('images/'.$filename);
        $extension = pathinfo($filename, PATHINFO_EXTENSION) ?: 'jpg';
        $destination = 'treatments/images/'.$slug.'.'.$extension;

        if (is_file($sourcePath)) {
            Storage::disk('public')->put($destination, file_get_contents($sourcePath));
        }

        return $destination;
    }
}
