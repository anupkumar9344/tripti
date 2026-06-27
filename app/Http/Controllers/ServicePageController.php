<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public services pages.
 */
class ServicePageController extends Controller
{
    /**
     * Build shared process steps for a service detail page.
     *
     * @param  string  $topic
     * @return list<array{title: string, text: string}>
     */
    private function processSteps(string $topic): array
    {
        return [
            [
                'title' => 'Consultation & Assessment',
                'text' => "Our team reviews your {$topic} concerns, medical history, and daily routine to identify the root cause.",
            ],
            [
                'title' => 'Personalised Treatment Plan',
                'text' => 'A structured plan is created combining the therapies best suited to your condition and recovery goals.',
            ],
            [
                'title' => 'Guided Sessions & Follow-Up',
                'text' => 'Regular sessions, progress monitoring, and lifestyle guidance help you achieve lasting improvement.',
            ],
        ];
    }

    /**
     * Static service records for listing and detail pages.
     *
     * @return array<string, array<string, mixed>>
     */
    private function services(): array
    {
        return [
            'pain-rehabilitation' => [
                'slug' => 'pain-rehabilitation',
                'title' => 'Pain & Rehabilitation',
                'heading' => 'Pain & <span>Rehabilitation</span>',
                'image' => 'service-featured-image.jpg',
                'benefits_image' => 'service-benefits-img.jpg',
                'excerpt' => 'Personalized rehabilitation therapies focused on pain relief, mobility, recovery, and physical strength.',
                'tags' => ['Physiotherapy', 'Neuro Rehab'],
                'intro' => [
                    'Pain and restricted movement can affect every part of daily life. Our Pain & Rehabilitation service combines physiotherapy, manual therapy, and structured exercise to help you recover naturally — without unnecessary surgery.',
                    'Whether you are dealing with back pain, joint stiffness, post-injury weakness, or long-standing musculoskeletal issues, we build a plan around your body, your goals, and your pace of recovery.',
                ],
                'highlight_heading' => 'Restore strength <span>and mobility</span>',
                'highlight_text' => 'Targeted rehabilitation helps reduce pain, improve movement, and rebuild confidence in everyday activities.',
                'highlights' => [
                    ['icon' => 'fa-hand-holding-medical', 'title' => 'Clinical Assessment', 'text' => 'Detailed evaluation of pain source, posture, and movement patterns.'],
                    ['icon' => 'fa-person-walking', 'title' => 'Functional Recovery', 'text' => 'Therapies designed to help you move, work, and live with less discomfort.'],
                ],
                'info_text' => 'Integrated physiotherapy and rehabilitation support under one roof — with specialists who focus on long-term recovery, not quick fixes.',
                'benefits_heading' => 'Key benefits of <span>rehabilitation care</span>',
                'benefits_text' => 'Structured rehabilitation supports faster recovery, better mobility, and reduced risk of pain returning.',
                'benefits_list' => ['Reduced chronic pain', 'Improved joint mobility', 'Better posture and balance', 'Stronger muscles and core', 'Faster post-injury recovery', 'Non-surgical pain management'],
                'process_heading' => 'Our rehabilitation <span>process</span>',
                'process_text' => 'Every patient follows a clear, step-by-step path from assessment to recovery.',
                'steps' => $this->processSteps('pain and mobility'),
                'faqs' => [
                    ['question' => 'Do I need a referral for physiotherapy?', 'answer' => 'No referral is required. You can book a consultation directly and our team will assess your condition during the first visit.'],
                    ['question' => 'How many sessions will I need?', 'answer' => 'It depends on your condition and severity. After assessment, we share a realistic plan with expected session frequency and duration.'],
                    ['question' => 'Is this suitable after surgery?', 'answer' => 'Yes. Post-surgical rehabilitation is one of our core offerings, tailored to your surgeon\'s guidelines and recovery stage.'],
                ],
            ],
            'ayurveda-detox' => [
                'slug' => 'ayurveda-detox',
                'title' => 'Ayurveda & Detox',
                'heading' => 'Ayurveda & <span>Detox</span>',
                'image' => 'gallery-2.jpg',
                'benefits_image' => 'gallery-2.jpg',
                'excerpt' => 'Traditional Ayurvedic detox therapies designed to restore balance, cleanse the body, and wellness.',
                'tags' => ['Panchakarma', 'Naturopathy'],
                'intro' => [
                    'Ayurveda & Detox at Sahaj Aarogyam focuses on restoring the body\'s natural balance through time-tested therapies, herbal support, and lifestyle correction — not quick-fix cleanses.',
                    'From Panchakarma to guided naturopathic support, our programs are designed to improve digestion, energy, immunity, and overall vitality under expert supervision.',
                ],
                'highlight_heading' => 'Cleanse and <span>rebalance naturally</span>',
                'highlight_text' => 'Authentic Ayurvedic detox supports deep healing by addressing accumulated toxins and metabolic imbalance.',
                'highlights' => [
                    ['icon' => 'fa-leaf', 'title' => 'Authentic Panchakarma', 'text' => 'Structured detox protocols customised to your constitution and health status.'],
                    ['icon' => 'fa-spa', 'title' => 'Holistic Rejuvenation', 'text' => 'Therapies that support digestion, sleep, skin, and long-term wellness.'],
                ],
                'info_text' => 'Detox at Sahaj Aarogyam is always supervised — safe, personalised, and aligned with classical Ayurvedic principles.',
                'benefits_heading' => 'Benefits of <span>Ayurvedic detox</span>',
                'benefits_text' => 'When done correctly, detox therapies can reset digestion, improve energy, and support chronic condition management.',
                'benefits_list' => ['Improved digestion', 'Better sleep quality', 'Enhanced immunity', 'Reduced fatigue', 'Metabolic balance support', 'Mind-body rejuvenation'],
                'process_heading' => 'Our detox <span>process</span>',
                'process_text' => 'Each detox journey follows preparation, main therapy, and post-care phases for safe results.',
                'steps' => $this->processSteps('Ayurvedic detox'),
                'faqs' => [
                    ['question' => 'Is Panchakarma safe for everyone?', 'answer' => 'Panchakarma is customised after a detailed consultation. It is not recommended without proper assessment and supervision.'],
                    ['question' => 'How long does a detox program take?', 'answer' => 'Programs vary from a few days to several weeks depending on your condition, season, and body strength.'],
                    ['question' => 'Can detox help with lifestyle disorders?', 'answer' => 'Yes. When combined with diet and lifestyle correction, detox therapies can support metabolic and digestive disorders.'],
                ],
            ],
            'metabolic-care' => [
                'slug' => 'metabolic-care',
                'title' => 'Metabolic Care',
                'heading' => 'Metabolic <span>Care</span>',
                'image' => 'gallery-3.jpg',
                'benefits_image' => 'gallery-3.jpg',
                'excerpt' => 'Customized wellness programs for weight management, metabolism support, and nutritional balance.',
                'tags' => ['Weight Loss', 'Nutrition'],
                'intro' => [
                    'Metabolic Care addresses weight gain, sluggish metabolism, thyroid imbalance, PCOS, diabetes risk, and other lifestyle-related conditions through integrated nutrition and therapy support.',
                    'We do not promote crash diets. Instead, we focus on sustainable metabolic correction — personalised food plans, activity guidance, and Ayurvedic support where needed.',
                ],
                'highlight_heading' => 'Support your metabolism <span>the right way</span>',
                'highlight_text' => 'Long-term weight and metabolic health come from correcting habits, hormones, and digestion together.',
                'highlights' => [
                    ['icon' => 'fa-weight-scale', 'title' => 'Personalised Nutrition', 'text' => 'Diet plans based on your body type, routine, and health reports.'],
                    ['icon' => 'fa-heart-pulse', 'title' => 'Metabolic Monitoring', 'text' => 'Regular follow-ups to track progress and adjust your plan safely.'],
                ],
                'info_text' => 'Our metabolic programs combine nutrition counselling with Ayurveda and physiotherapy when movement support is needed.',
                'benefits_heading' => 'Benefits of <span>metabolic care</span>',
                'benefits_text' => 'Structured metabolic support helps you lose weight safely and maintain results over time.',
                'benefits_list' => ['Sustainable weight management', 'Better energy levels', 'Improved digestion', 'Hormonal balance support', 'Reduced cravings', 'Healthier daily routine'],
                'process_heading' => 'Our metabolic care <span>process</span>',
                'process_text' => 'We assess, plan, and monitor — so your progress is measurable and realistic.',
                'steps' => $this->processSteps('metabolic health'),
                'faqs' => [
                    ['question' => 'Will I have to follow a strict diet?', 'answer' => 'Plans are practical and personalised — not extreme. We focus on changes you can maintain long term.'],
                    ['question' => 'Can this help with PCOS or thyroid issues?', 'answer' => 'Yes. Metabolic care is often part of integrated treatment for hormonal and lifestyle disorders.'],
                    ['question' => 'How soon will I see results?', 'answer' => 'Many patients notice improved energy and digestion within weeks. Weight changes vary based on individual factors.'],
                ],
            ],
            'hijama-cupping' => [
                'slug' => 'hijama-cupping',
                'title' => 'Hijama & Cupping',
                'heading' => 'Hijama & <span>Cupping</span>',
                'image' => 'service-benefits-img.jpg',
                'benefits_image' => 'service-benefits-img.jpg',
                'excerpt' => 'Therapeutic cupping treatments to improve circulation, relieve pain, and support natural healing.',
                'tags' => ['Hijama Therapy', 'Pain Relief'],
                'intro' => [
                    'Hijama and cupping therapy are traditional treatments used to improve blood circulation, relieve muscular tension, and support the body\'s natural healing response.',
                    'At Sahaj Aarogyam, Hijama is performed by trained practitioners using hygienic, clinical standards — often as part of a broader pain or wellness plan.',
                ],
                'highlight_heading' => 'Natural therapy for <span>pain and vitality</span>',
                'highlight_text' => 'Cupping helps release tension, improve circulation, and support recovery from chronic stiffness and fatigue.',
                'highlights' => [
                    ['icon' => 'fa-droplet', 'title' => 'Improved Circulation', 'text' => 'Helps stimulate blood flow and reduce localized muscle tension.'],
                    ['icon' => 'fa-shield-heart', 'title' => 'Safe Clinical Practice', 'text' => 'Performed with sterile equipment and professional supervision.'],
                ],
                'info_text' => 'Hijama may be recommended alongside physiotherapy or Ayurveda for comprehensive pain and wellness support.',
                'benefits_heading' => 'Benefits of <span>Hijama therapy</span>',
                'benefits_text' => 'Patients often choose Hijama for pain relief, detox support, and general wellness maintenance.',
                'benefits_list' => ['Muscle pain relief', 'Reduced stiffness', 'Better circulation', 'Stress reduction support', 'Detox assistance', 'General wellness boost'],
                'process_heading' => 'Our Hijama <span>process</span>',
                'process_text' => 'Each session follows assessment, preparation, treatment, and after-care guidance.',
                'steps' => $this->processSteps('Hijama and cupping'),
                'faqs' => [
                    ['question' => 'Is Hijama painful?', 'answer' => 'Most patients describe mild suction pressure. Any discomfort is brief and managed by our trained therapists.'],
                    ['question' => 'How often should Hijama be done?', 'answer' => 'Frequency depends on your condition and practitioner recommendation — typically spaced across weeks, not daily.'],
                    ['question' => 'Are there any restrictions after treatment?', 'answer' => 'We provide clear after-care instructions including rest, hydration, and activity guidance after each session.'],
                ],
            ],
            'acupuncture-acupressure' => [
                'slug' => 'acupuncture-acupressure',
                'title' => 'Acupuncture & Acupressure',
                'heading' => 'Acupuncture & <span>Acupressure</span>',
                'image' => 'gallery-5.jpg',
                'benefits_image' => 'gallery-5.jpg',
                'excerpt' => 'Evidence-based needle and pressure-point therapies to restore energy flow and reduce chronic discomfort.',
                'tags' => ['Acupuncture', 'Acupressure'],
                'intro' => [
                    'Acupuncture and acupressure work by stimulating specific points on the body to restore energy flow, reduce pain, and support natural healing.',
                    'These therapies are commonly used for chronic pain, stress-related conditions, headaches, joint issues, and supportive care alongside physiotherapy or Ayurveda.',
                ],
                'highlight_heading' => 'Restore balance through <span>targeted points</span>',
                'highlight_text' => 'Precise point stimulation helps relieve pain, reduce tension, and improve overall body function.',
                'highlights' => [
                    ['icon' => 'fa-location-dot', 'title' => 'Targeted Point Therapy', 'text' => 'Treatment focused on the meridian points relevant to your condition.'],
                    ['icon' => 'fa-brain', 'title' => 'Stress & Pain Relief', 'text' => 'Supports both physical discomfort and stress-related symptoms.'],
                ],
                'info_text' => 'Sessions are tailored to your tolerance and condition — gentle for beginners, progressive for chronic cases.',
                'benefits_heading' => 'Benefits of <span>acupuncture care</span>',
                'benefits_text' => 'Many patients experience relief from pain, better sleep, and improved energy with regular sessions.',
                'benefits_list' => ['Chronic pain relief', 'Headache and migraine support', 'Reduced muscle tension', 'Stress and anxiety relief', 'Better sleep quality', 'Complementary rehab support'],
                'process_heading' => 'Our acupuncture <span>process</span>',
                'process_text' => 'From first consultation to follow-up sessions, every step is structured and safe.',
                'steps' => $this->processSteps('acupuncture'),
                'faqs' => [
                    ['question' => 'Does acupuncture hurt?', 'answer' => 'Needles are very fine. Most patients feel minimal sensation — often a mild tingling or warmth at the point.'],
                    ['question' => 'How many sessions are needed?', 'answer' => 'Acute issues may improve in fewer sessions. Chronic conditions typically need a structured course over several weeks.'],
                    ['question' => 'Can it be combined with other treatments?', 'answer' => 'Yes. Acupuncture is frequently used alongside physiotherapy and Ayurveda in our integrated care plans.'],
                ],
            ],
            'holistic-wellness-programs' => [
                'slug' => 'holistic-wellness-programs',
                'title' => 'Holistic Wellness Programs',
                'heading' => 'Holistic Wellness <span>Programs</span>',
                'image' => 'what-we-benefit-image.jpg',
                'benefits_image' => 'what-we-benefit-image.jpg',
                'excerpt' => 'Integrated care plans combining multiple therapies for long-term health, vitality, and lifestyle balance.',
                'tags' => ['Integrated Care', 'Lifestyle Support'],
                'intro' => [
                    'Holistic Wellness Programs bring together the best of Sahaj Aarogyam — physiotherapy, Ayurveda, nutrition, detox, and lifestyle counselling — in one coordinated plan.',
                    'These programs are ideal for patients who need more than a single therapy: chronic pain, lifestyle disorders, post-treatment recovery, or long-term wellness maintenance.',
                ],
                'highlight_heading' => 'Complete care under <span>one roof</span>',
                'highlight_text' => 'Integrated programs save time, improve consistency, and deliver better outcomes than isolated treatments.',
                'highlights' => [
                    ['icon' => 'fa-people-group', 'title' => 'Multi-Specialist Team', 'text' => 'Physiotherapists, Ayurveda doctors, and nutritionists work together on your plan.'],
                    ['icon' => 'fa-calendar-check', 'title' => 'Structured Follow-Up', 'text' => 'Regular reviews keep your treatment aligned with your progress.'],
                ],
                'info_text' => 'Ideal for patients seeking a long-term partner in health — not just a one-time consultation.',
                'benefits_heading' => 'Benefits of <span>integrated programs</span>',
                'benefits_text' => 'Coordinated care addresses root causes from multiple angles for deeper, lasting improvement.',
                'benefits_list' => ['Root-cause focused care', 'Multiple therapies in one plan', 'Consistent specialist follow-up', 'Lifestyle and diet support', 'Reduced treatment gaps', 'Long-term wellness focus'],
                'process_heading' => 'Our wellness program <span>process</span>',
                'process_text' => 'Programs begin with a comprehensive assessment and evolve as you progress.',
                'steps' => $this->processSteps('holistic wellness'),
                'faqs' => [
                    ['question' => 'Who should join a wellness program?', 'answer' => 'Anyone with chronic conditions, lifestyle disorders, or a desire for structured long-term health support can benefit.'],
                    ['question' => 'Can I choose which therapies to include?', 'answer' => 'Yes. After assessment, we recommend a combination — you discuss and finalise the plan with our team.'],
                    ['question' => 'Are programs available for families?', 'answer' => 'We offer individual and family-oriented wellness guidance. Ask our team about group program options.'],
                ],
            ],
        ];
    }

    /**
     * Display the services listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $services = array_values($this->services());

        return view('services.index', compact('services'));
    }

    /**
     * Display a single service detail page.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $services = $this->services();

        if (! isset($services[$slug])) {
            abort(404);
        }

        $item = $services[$slug];
        $allItems = array_map(
            fn (array $service): array => ['slug' => $service['slug'], 'title' => $service['title']],
            array_values($services)
        );

        return view('services.show', compact('item', 'allItems'));
    }
}
