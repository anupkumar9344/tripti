<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Seeds default service records for listing and home pages.
 */
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Pain & Rehabilitation',
                'slug' => 'pain-rehabilitation',
                'thumbnail' => 'service-featured-image.jpg',
                'icon' => 'fa-hand-holding-medical',
                'tags' => 'Physiotherapy, Neuro Rehab',
                'short_description' => 'Personalized rehabilitation therapies focused on pain relief, mobility, recovery, and physical strength.',
                'long_description' => '<p>Pain and restricted movement can affect every part of daily life. Our Pain & Rehabilitation service combines physiotherapy, manual therapy, and structured exercise to help you recover naturally — without unnecessary surgery.</p><p>Whether you are dealing with back pain, joint stiffness, post-injury weakness, or long-standing musculoskeletal issues, we build a plan around your body, your goals, and your pace of recovery.</p><ul><li>Reduced chronic pain</li><li>Improved joint mobility</li><li>Better posture and balance</li><li>Stronger muscles and core</li><li>Faster post-injury recovery</li><li>Non-surgical pain management</li></ul>',
                'sort_order' => 1,
                'display_on_home' => true,
            ],
            [
                'title' => 'Ayurveda & Detox',
                'slug' => 'ayurveda-detox',
                'thumbnail' => 'gallery-2.jpg',
                'icon' => 'fa-leaf',
                'tags' => 'Panchakarma, Naturopathy',
                'short_description' => 'Traditional Ayurvedic detox therapies designed to restore balance, cleanse the body, and wellness.',
                'long_description' => '<p>Ayurveda & Detox at Tripti Hotel focuses on restoring the body\'s natural balance through time-tested therapies, herbal support, and lifestyle correction — not quick-fix cleanses.</p><p>From Panchakarma to guided naturopathic support, our programs are designed to improve digestion, energy, immunity, and overall vitality under expert supervision.</p><ul><li>Improved digestion</li><li>Better sleep quality</li><li>Enhanced immunity</li><li>Reduced fatigue</li><li>Metabolic balance support</li><li>Mind-body rejuvenation</li></ul>',
                'sort_order' => 2,
                'display_on_home' => true,
            ],
            [
                'title' => 'Metabolic Care',
                'slug' => 'metabolic-care',
                'thumbnail' => 'gallery-3.jpg',
                'icon' => 'fa-weight-scale',
                'tags' => 'Weight Loss, Nutrition',
                'short_description' => 'Customized wellness programs for weight management, metabolism support, and nutritional balance.',
                'long_description' => '<p>Metabolic Care addresses weight gain, sluggish metabolism, thyroid imbalance, PCOS, diabetes risk, and other lifestyle-related conditions through integrated nutrition and therapy support.</p><p>We do not promote crash diets. Instead, we focus on sustainable metabolic correction — personalised food plans, activity guidance, and Ayurvedic support where needed.</p><ul><li>Sustainable weight management</li><li>Better energy levels</li><li>Improved digestion</li><li>Hormonal balance support</li><li>Reduced cravings</li><li>Healthier daily routine</li></ul>',
                'sort_order' => 3,
                'display_on_home' => true,
            ],
            [
                'title' => 'Hijama & Cupping',
                'slug' => 'hijama-cupping',
                'thumbnail' => 'service-benefits-img.jpg',
                'icon' => 'fa-droplet',
                'tags' => 'Hijama Therapy, Pain Relief',
                'short_description' => 'Therapeutic cupping treatments to improve circulation, relieve pain, and support natural healing.',
                'long_description' => '<p>Hijama and cupping therapy are traditional treatments used to improve blood circulation, relieve muscular tension, and support the body\'s natural healing response.</p><p>At Tripti Hotel, Hijama is performed by trained practitioners using hygienic, clinical standards — often as part of a broader pain or wellness plan.</p><ul><li>Muscle pain relief</li><li>Reduced stiffness</li><li>Better circulation</li><li>Stress reduction support</li><li>Detox assistance</li><li>General wellness boost</li></ul>',
                'sort_order' => 4,
                'display_on_home' => true,
            ],
            [
                'title' => 'Acupuncture & Acupressure',
                'slug' => 'acupuncture-acupressure',
                'thumbnail' => 'gallery-5.jpg',
                'icon' => 'fa-location-dot',
                'tags' => 'Acupuncture, Acupressure',
                'short_description' => 'Evidence-based needle and pressure-point therapies to restore energy flow and reduce chronic discomfort.',
                'long_description' => '<p>Acupuncture and acupressure work by stimulating specific points on the body to restore energy flow, reduce pain, and support natural healing.</p><p>These therapies are commonly used for chronic pain, stress-related conditions, headaches, joint issues, and supportive care alongside physiotherapy or Ayurveda.</p><ul><li>Chronic pain relief</li><li>Headache and migraine support</li><li>Reduced muscle tension</li><li>Stress and anxiety relief</li><li>Better sleep quality</li><li>Complementary rehab support</li></ul>',
                'sort_order' => 5,
                'display_on_home' => true,
            ],
            [
                'title' => 'Holistic Wellness Programs',
                'slug' => 'holistic-wellness-programs',
                'thumbnail' => 'what-we-benefit-image.jpg',
                'icon' => 'fa-people-group',
                'tags' => 'Integrated Care, Lifestyle Support',
                'short_description' => 'Integrated care plans combining multiple therapies for long-term health, vitality, and lifestyle balance.',
                'long_description' => '<p>Holistic Wellness Programs bring together the best of Tripti Hotel — physiotherapy, Ayurveda, nutrition, detox, and lifestyle counselling — in one coordinated plan.</p><p>These programs are ideal for patients who need more than a single therapy: chronic pain, lifestyle disorders, post-treatment recovery, or long-term wellness maintenance.</p><ul><li>Root-cause focused care</li><li>Multiple therapies in one plan</li><li>Consistent specialist follow-up</li><li>Lifestyle and diet support</li><li>Reduced treatment gaps</li><li>Long-term wellness focus</li></ul>',
                'sort_order' => 6,
                'display_on_home' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'title' => $service['title'],
                    'thumbnail' => $service['thumbnail'],
                    'icon' => $service['icon'],
                    'tags' => $service['tags'],
                    'short_description' => $service['short_description'],
                    'long_description' => $service['long_description'],
                    'sort_order' => $service['sort_order'],
                    'status' => true,
                    'display_on_home' => $service['display_on_home'],
                ]
            );
        }
    }
}
