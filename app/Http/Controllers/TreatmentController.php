<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public treatment pages.
 */
class TreatmentController extends Controller
{
    /**
     * Build shared process steps for a treatment detail page.
     *
     * @param  string  $topic
     * @return list<array{title: string, text: string}>
     */
    private function processSteps(string $topic): array
    {
        return [
            [
                'title' => 'Detailed Diagnosis',
                'text' => "We assess your {$topic} symptoms, history, and lifestyle to identify the underlying cause — not just the pain.",
            ],
            [
                'title' => 'Integrated Treatment Plan',
                'text' => 'A non-surgical plan is created using physiotherapy, Ayurveda, and supportive therapies as needed.',
            ],
            [
                'title' => 'Recovery & Prevention',
                'text' => 'Ongoing sessions, home exercises, and lifestyle guidance help prevent recurrence and maintain results.',
            ],
        ];
    }

    /**
     * Static treatment records for listing and detail pages.
     *
     * @return array<string, array<string, mixed>>
     */
    private function treatments(): array
    {
        return [
            'back-pain-spine-disorders' => [
                'slug' => 'back-pain-spine-disorders',
                'title' => 'Back Pain & Spine disorders',
                'heading' => 'Back Pain & <span>Spine Disorders</span>',
                'icon' => 'fa-award',
                'image' => 'service-featured-image.jpg',
                'benefits_image' => 'service-benefits-img.jpg',
                'excerpt' => 'Advanced non-surgical care for chronic back pain, stiffness, and spinal discomfort.',
                'intro' => [
                    'Back pain and spine disorders are among the most common reasons patients visit Sahaj Aarogyam. Whether your pain is muscular, disc-related, postural, or chronic, our focus is on non-surgical recovery.',
                    'We combine physiotherapy, spinal rehabilitation, Ayurvedic support, and lifestyle correction to reduce pain, restore mobility, and prevent recurrence.',
                ],
                'highlight_heading' => 'Non-surgical spine <span>care</span>',
                'highlight_text' => 'Most back and spine conditions improve significantly with structured, conservative treatment.',
                'highlights' => [
                    ['icon' => 'fa-bone', 'title' => 'Spinal Assessment', 'text' => 'Detailed evaluation of posture, movement, and pain patterns.'],
                    ['icon' => 'fa-person-walking', 'title' => 'Mobility Restoration', 'text' => 'Therapies to reduce stiffness and rebuild functional movement.'],
                ],
                'info_text' => 'Surgery is considered only when conservative care is exhausted — our first priority is safe, natural recovery.',
                'benefits_heading' => 'Benefits of <span>spine treatment</span>',
                'benefits_text' => 'Structured spine care reduces pain, improves posture, and helps you return to daily activities confidently.',
                'benefits_list' => ['Reduced back pain', 'Better spinal flexibility', 'Improved posture', 'Less dependency on medication', 'Stronger core support', 'Lower recurrence risk'],
                'process_heading' => 'Our spine care <span>process</span>',
                'process_text' => 'From first consultation to long-term maintenance, every stage is planned and monitored.',
                'steps' => $this->processSteps('back and spine'),
                'faqs' => [
                    ['question' => 'Can slip disc be treated without surgery?', 'answer' => 'Many disc-related conditions respond well to physiotherapy and integrated care. Surgery is recommended only when absolutely necessary.'],
                    ['question' => 'How long does recovery take?', 'answer' => 'It varies by condition. Some patients feel relief within weeks; chronic cases may need a longer structured plan.'],
                    ['question' => 'Will I need bed rest?', 'answer' => 'Prolonged bed rest is usually avoided. Guided movement and rehabilitation are central to our approach.'],
                ],
            ],
            'slip-disc-sciatica' => [
                'slug' => 'slip-disc-sciatica',
                'title' => 'Slip Disc & Sciatica',
                'heading' => 'Slip Disc & <span>Sciatica</span>',
                'icon' => 'fa-hand-holding-heart',
                'image' => 'gallery-4.jpg',
                'benefits_image' => 'gallery-4.jpg',
                'excerpt' => 'Targeted therapies designed to reduce disc-related pain and improve mobility.',
                'intro' => [
                    'Slip disc and sciatica can cause sharp pain, numbness, and limited movement that affects work and daily life. Our integrated approach targets nerve irritation and disc-related pressure through non-surgical therapies.',
                    'Treatment plans may include physiotherapy, traction support, Ayurvedic therapies, and posture correction — customised to your scan findings and symptoms.',
                ],
                'highlight_heading' => 'Relief from nerve <span>and disc pain</span>',
                'highlight_text' => 'Targeted therapy reduces inflammation, eases nerve pressure, and restores comfortable movement.',
                'highlights' => [
                    ['icon' => 'fa-wave-square', 'title' => 'Nerve Pain Management', 'text' => 'Therapies focused on sciatica, radiating pain, and numbness.'],
                    ['icon' => 'fa-user-doctor', 'title' => 'Specialist-Led Care', 'text' => 'Plans guided by experienced physiotherapists and Ayurveda doctors.'],
                ],
                'info_text' => 'Early intervention for slip disc and sciatica often prevents worsening and avoids surgical routes.',
                'benefits_heading' => 'Benefits of <span>disc & sciatica care</span>',
                'benefits_text' => 'Patients typically experience reduced leg pain, better walking ability, and improved sleep and comfort.',
                'benefits_list' => ['Reduced sciatic pain', 'Less numbness and tingling', 'Improved walking ability', 'Better spinal stability', 'Reduced inflammation', 'Non-surgical recovery path'],
                'process_heading' => 'Our disc recovery <span>process</span>',
                'process_text' => 'Each plan is built around your scan results, pain level, and daily activity needs.',
                'steps' => $this->processSteps('slip disc and sciatica'),
                'faqs' => [
                    ['question' => 'Do I need an MRI before treatment?', 'answer' => 'An MRI helps but is not always required to begin care. Our team will advise based on your symptoms and examination.'],
                    ['question' => 'Can I continue working during treatment?', 'answer' => 'In most cases, yes — with activity modifications. We guide you on safe movement during recovery.'],
                    ['question' => 'Is traction always used?', 'answer' => 'Traction is recommended only when appropriate for your condition. Not every patient requires it.'],
                ],
            ],
            'liver-metabolic-disorders' => [
                'slug' => 'liver-metabolic-disorders',
                'title' => 'Liver & Metabolic Disorders',
                'heading' => 'Liver & <span>Metabolic Disorders</span>',
                'icon' => 'fa-clipboard-medical',
                'image' => 'gallery-3.jpg',
                'benefits_image' => 'gallery-3.jpg',
                'excerpt' => 'Natural management for metabolic imbalance, fatty liver, and lifestyle-related conditions.',
                'intro' => [
                    'Liver and metabolic disorders — including fatty liver, elevated enzymes, obesity, and insulin resistance — are increasingly common and deeply linked to lifestyle.',
                    'At Sahaj Aarogyam, we address these conditions through Ayurveda, nutrition counselling, detox support, and activity planning — treating the root metabolic imbalance.',
                ],
                'highlight_heading' => 'Restore metabolic <span>balance naturally</span>',
                'highlight_text' => 'Integrated metabolic care improves liver health, energy, and long-term disease prevention.',
                'highlights' => [
                    ['icon' => 'fa-leaf', 'title' => 'Ayurvedic Metabolic Support', 'text' => 'Therapies and herbs selected for your body type and liver status.'],
                    ['icon' => 'fa-apple-whole', 'title' => 'Nutrition Guidance', 'text' => 'Practical diet plans that support liver function and weight balance.'],
                ],
                'info_text' => 'Metabolic recovery requires consistency — we support you with regular follow-ups and realistic lifestyle changes.',
                'benefits_heading' => 'Benefits of <span>metabolic treatment</span>',
                'benefits_text' => 'Patients often see improved reports, better energy, and sustainable weight management over time.',
                'benefits_list' => ['Liver health support', 'Better blood sugar balance', 'Weight management', 'Improved digestion', 'Higher daily energy', 'Reduced medication dependency'],
                'process_heading' => 'Our metabolic care <span>process</span>',
                'process_text' => 'Assessment, personalised planning, and regular monitoring form the foundation of metabolic recovery.',
                'steps' => $this->processSteps('liver and metabolic health'),
                'faqs' => [
                    ['question' => 'Can fatty liver be reversed?', 'answer' => 'Early and moderate fatty liver often improves significantly with diet, activity, and Ayurvedic metabolic support.'],
                    ['question' => 'Will I need blood tests during treatment?', 'answer' => 'Periodic tests help track progress. We recommend follow-up labs at appropriate intervals.'],
                    ['question' => 'Is detox necessary for liver conditions?', 'answer' => 'Detox may be recommended in some cases after assessment — it is never a one-size-fits-all approach.'],
                ],
            ],
            'knee-pain-joints' => [
                'slug' => 'knee-pain-joints',
                'title' => 'Knee Pain & Joints pain',
                'heading' => 'Knee Pain & <span>Joint Pain</span>',
                'icon' => 'fa-bone',
                'image' => 'gallery-5.jpg',
                'benefits_image' => 'gallery-5.jpg',
                'excerpt' => 'Personalized therapies to improve knee strength, flexibility, and movement.',
                'intro' => [
                    'Knee and joint pain can limit walking, climbing stairs, and everyday independence. Our joint care program focuses on strengthening, pain reduction, and mobility — without rushing to surgery.',
                    'Treatment includes physiotherapy, manual therapy, weight management support, and Ayurvedic anti-inflammatory care where appropriate.',
                ],
                'highlight_heading' => 'Move freely with <span>stronger joints</span>',
                'highlight_text' => 'Joint rehabilitation restores strength, reduces pain, and delays or avoids surgical intervention.',
                'highlights' => [
                    ['icon' => 'fa-dumbbell', 'title' => 'Strength Building', 'text' => 'Exercises to support knee and joint stability safely.'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Pain Management', 'text' => 'Therapies to reduce inflammation and improve daily comfort.'],
                ],
                'info_text' => 'Whether arthritis, injury, or overuse — we build a joint plan suited to your age and activity level.',
                'benefits_heading' => 'Benefits of <span>joint treatment</span>',
                'benefits_text' => 'Structured joint care helps you walk, exercise, and live with less pain and more confidence.',
                'benefits_list' => ['Reduced knee and joint pain', 'Better flexibility', 'Improved walking comfort', 'Stronger supporting muscles', 'Delay of surgical need', 'Enhanced daily mobility'],
                'process_heading' => 'Our joint care <span>process</span>',
                'process_text' => 'Assessment, targeted therapy, and home exercise guidance work together for joint recovery.',
                'steps' => $this->processSteps('knee and joint'),
                'faqs' => [
                    ['question' => 'Is knee replacement always necessary?', 'answer' => 'No. Many patients improve significantly with rehabilitation and integrated care before surgery is considered.'],
                    ['question' => 'Can overweight patients benefit?', 'answer' => 'Yes. Weight management is often part of joint care to reduce load on knees and hips.'],
                    ['question' => 'Are home exercises provided?', 'answer' => 'Yes. We teach safe home exercises tailored to your condition and progress level.'],
                ],
            ],
            'male-female-wellness' => [
                'slug' => 'male-female-wellness',
                'title' => 'Male and Female Wellness',
                'heading' => 'Male & <span>Female Wellness</span>',
                'icon' => 'fa-venus-mars',
                'image' => 'home-about-team.jpg',
                'benefits_image' => 'home-about-team.jpg',
                'excerpt' => 'Specialized care for hormonal balance, fertility support, and gender-specific wellness.',
                'intro' => [
                    'Male and Female Wellness at Sahaj Aarogyam addresses hormonal imbalance, fertility concerns, PCOS, men\'s health issues, and stress-related wellness — with privacy, sensitivity, and clinical expertise.',
                    'Treatment combines Ayurveda, nutrition, lifestyle counselling, and supportive therapies tailored to gender-specific health needs.',
                ],
                'highlight_heading' => 'Personalised wellness for <span>men and women</span>',
                'highlight_text' => 'Gender-specific care requires understanding, discretion, and a holistic treatment approach.',
                'highlights' => [
                    ['icon' => 'fa-venus', 'title' => 'Women\'s Health Support', 'text' => 'Care for PCOS, hormonal balance, fertility, and menstrual wellness.'],
                    ['icon' => 'fa-mars', 'title' => 'Men\'s Health Support', 'text' => 'Support for vitality, stress, metabolic health, and reproductive wellness.'],
                ],
                'info_text' => 'All consultations are handled with complete confidentiality and a patient-first approach.',
                'benefits_heading' => 'Benefits of <span>wellness care</span>',
                'benefits_text' => 'Integrated wellness care improves hormonal balance, energy, and overall quality of life.',
                'benefits_list' => ['Hormonal balance support', 'Fertility guidance', 'PCOS and thyroid care', 'Stress and mood support', 'Nutrition and lifestyle plans', 'Confidential specialist care'],
                'process_heading' => 'Our wellness <span>process</span>',
                'process_text' => 'Private consultation, personalised planning, and discreet follow-up at every stage.',
                'steps' => $this->processSteps('wellness'),
                'faqs' => [
                    ['question' => 'Are consultations private?', 'answer' => 'Absolutely. All wellness consultations are strictly confidential and handled with sensitivity.'],
                    ['question' => 'Can Ayurveda help with PCOS?', 'answer' => 'Yes. Ayurveda, along with diet and lifestyle changes, is commonly used to support PCOS management.'],
                    ['question' => 'Do you treat couples for fertility?', 'answer' => 'We offer guidance for individual and couple wellness. Discuss your needs during the first consultation.'],
                ],
            ],
            'cervical-ankylosing-spondylitis' => [
                'slug' => 'cervical-ankylosing-spondylitis',
                'title' => 'Cervical & Ankylosing Spondylitis',
                'heading' => 'Cervical & <span>Ankylosing Spondylitis</span>',
                'icon' => 'fa-user-doctor',
                'image' => 'faqs-image.jpg',
                'benefits_image' => 'faqs-image.jpg',
                'excerpt' => 'Effective care for neck pain, posture correction, and cervical discomfort.',
                'intro' => [
                    'Cervical pain, spondylitis, and ankylosing spondylitis can cause chronic neck stiffness, reduced mobility, and long-term postural changes. Early, consistent care makes a significant difference.',
                    'Our treatment combines physiotherapy for spinal mobility, Ayurvedic anti-inflammatory support, posture training, and ergonomic guidance for desk workers and professionals.',
                ],
                'highlight_heading' => 'Ease neck pain and <span>spinal stiffness</span>',
                'highlight_text' => 'Regular therapy and posture correction help manage cervical and spondylitis symptoms naturally.',
                'highlights' => [
                    ['icon' => 'fa-head-side-virus', 'title' => 'Cervical Pain Relief', 'text' => 'Therapies for neck pain, stiffness, and restricted head movement.'],
                    ['icon' => 'fa-chair', 'title' => 'Posture & Ergonomics', 'text' => 'Guidance for desk posture, sleeping position, and daily habits.'],
                ],
                'info_text' => 'Consistent care is key for spondylitis — we help you build a sustainable routine for long-term comfort.',
                'benefits_heading' => 'Benefits of <span>cervical care</span>',
                'benefits_text' => 'Patients experience less stiffness, better neck movement, and improved comfort during daily activities.',
                'benefits_list' => ['Reduced neck pain', 'Better head and neck mobility', 'Improved posture', 'Less morning stiffness', 'Ergonomic lifestyle support', 'Long-term symptom management'],
                'process_heading' => 'Our cervical care <span>process</span>',
                'process_text' => 'Structured assessment, therapy sessions, and home exercises for ongoing spinal health.',
                'steps' => $this->processSteps('cervical and spondylitis'),
                'faqs' => [
                    ['question' => 'Is ankylosing spondylitis curable?', 'answer' => 'It is a chronic condition, but symptoms can be managed effectively with regular therapy, lifestyle changes, and medical support.'],
                    ['question' => 'Can desk workers benefit from this care?', 'answer' => 'Yes. Cervical pain from prolonged sitting is very common — ergonomic correction is a core part of treatment.'],
                    ['question' => 'How often should I attend sessions?', 'answer' => 'Frequency depends on severity. We recommend a plan after your initial assessment — typically 2–3 sessions per week initially.'],
                ],
            ],
        ];
    }

    /**
     * Display the treatment listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $items = array_values($this->treatments());

        return view('treatment.index', compact('items'));
    }

    /**
     * Display a single treatment detail page.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $treatments = $this->treatments();

        if (! isset($treatments[$slug])) {
            abort(404);
        }

        $item = $treatments[$slug];
        $allItems = array_map(
            fn (array $treatment): array => ['slug' => $treatment['slug'], 'title' => $treatment['title']],
            array_values($treatments)
        );

        return view('treatment.show', compact('item', 'allItems'));
    }
}
