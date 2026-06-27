<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Handles the public blog pages.
 */
class BlogController extends Controller
{
    /**
     * Static blog posts used on listing and detail pages.
     *
     * @return array<string, array<string, mixed>>
     */
    private function posts(): array
    {
        return [
            '5-natural-ways-to-improve-your-gut-health' => [
                'slug' => '5-natural-ways-to-improve-your-gut-health',
                'image' => 'post-1.jpg',
                'title' => '5 Natural Ways to Improve Your Gut Health',
                'excerpt' => 'Good gut health is the foundation of overall well-being. A healthy gut improves digestion, boosts immunity, enhances mood, and helps maintain a healthy weight.',
                'date' => 'May 29, 2026',
                'author' => 'Sahaj Aarogyam',
                'tags' => ['gut health', 'nutrition', 'wellness'],
                'content' => '
                    <p>Good gut health is the foundation of overall well-being. A healthy digestive system improves nutrient absorption, strengthens immunity, supports mental clarity, and helps maintain a healthy weight. At Sahaj Aarogyam, we often see patients whose chronic issues — fatigue, bloating, skin problems, or joint pain — improve significantly once gut health is addressed.</p>
                    <p>The gut is not just responsible for digestion. It plays a central role in immunity, hormone balance, and even mood regulation through the gut-brain axis. When digestion is weak or the microbiome is imbalanced, the entire body feels the impact.</p>
                    <blockquote><p>"When the gut is balanced, the body heals faster, energy improves, and long-term wellness becomes achievable through simple, natural habits."</p></blockquote>
                    <p>Improving gut health does not require extreme diets or expensive supplements. With the right daily practices — aligned with Ayurveda and modern nutrition science — you can restore digestive balance naturally.</p>
                    <h2>5 natural ways to support your gut</h2>
                    <ul>
                        <li>Eat warm, freshly prepared meals and reduce heavy, processed, or late-night eating</li>
                        <li>Include fibre-rich foods, seasonal vegetables, and adequate hydration every day</li>
                        <li>Manage stress through breathing, yoga, and regular sleep — stress directly affects digestion</li>
                        <li>Use Ayurvedic herbs and therapies only under professional guidance for your body type</li>
                        <li>Walk after meals and maintain consistent meal timings to strengthen digestive fire (Agni)</li>
                    </ul>
                    <p>If you experience persistent bloating, acidity, constipation, or unexplained fatigue, a personalised consultation can help identify the root cause rather than treating symptoms alone. Our integrated team combines Ayurveda, nutrition, and lifestyle counselling for lasting results.</p>
                ',
            ],
            'ayurveda-vs-modern-lifestyle-disorders' => [
                'slug' => 'ayurveda-vs-modern-lifestyle-disorders',
                'image' => 'post-2.jpg',
                'title' => 'Ayurveda vs Modern Lifestyle Disorders',
                'excerpt' => 'Modern lifestyle has led to an increase in disorders like obesity, diabetes, hypertension, PCOS, thyroid issues, and stress-related conditions.',
                'date' => 'May 29, 2026',
                'author' => 'Sahaj Aarogyam',
                'tags' => ['ayurveda', 'lifestyle', 'chronic care'],
                'content' => '
                    <p>Modern lifestyle disorders are rising rapidly — obesity, diabetes, hypertension, PCOS, thyroid imbalance, and stress-related conditions are now common across all age groups. While modern medicine plays a vital role in diagnosis and acute care, many of these conditions need long-term lifestyle correction to truly improve.</p>
                    <p>Ayurveda approaches these disorders differently. Instead of only managing symptoms, it focuses on identifying the root imbalance — in digestion, metabolism, sleep, stress, or daily routine — and correcting it through personalised diet, therapies, and habits.</p>
                    <blockquote><p>"Ayurveda does not replace modern medicine — it complements it by treating the person behind the diagnosis, not just the report."</p></blockquote>
                    <h2>Where Ayurveda adds value</h2>
                    <ul>
                        <li>Personalised diet and daily routine based on your constitution and current imbalance</li>
                        <li>Detox and metabolic support through Panchakarma and guided therapies</li>
                        <li>Stress and sleep correction — key drivers of lifestyle disorders</li>
                        <li>Sustainable weight and hormone balance without crash approaches</li>
                        <li>Integrated care alongside physiotherapy and clinical monitoring when needed</li>
                    </ul>
                    <p>At Sahaj Aarogyam, we combine Ayurvedic wisdom with modern clinical assessment so patients receive safe, structured, and practical treatment plans — not generic advice copied from the internet.</p>
                ',
            ],
            'how-physiotherapy-helps-in-chronic-pain-recovery' => [
                'slug' => 'how-physiotherapy-helps-in-chronic-pain-recovery',
                'image' => 'post-3.jpg',
                'title' => 'How Physiotherapy Helps in Chronic Pain Recovery',
                'excerpt' => 'Chronic pain can affect your daily life and limit your ability to move, work, and enjoy the things you love.',
                'date' => 'May 29, 2026',
                'author' => 'Sahaj Aarogyam',
                'tags' => ['physiotherapy', 'pain relief', 'rehabilitation'],
                'content' => '
                    <p>Chronic pain affects more than the body — it limits movement, reduces confidence, disrupts sleep, and impacts work and family life. Many patients live with pain for months or years before finding a structured recovery plan.</p>
                    <p>Physiotherapy focuses on restoring movement, reducing pain, and rebuilding strength through evidence-based techniques — manual therapy, targeted exercises, posture correction, and progressive rehabilitation.</p>
                    <blockquote><p>"Pain relief is not the end goal — restoring function, confidence, and long-term mobility is what lasting recovery looks like."</p></blockquote>
                    <h2>How physiotherapy supports recovery</h2>
                    <ul>
                        <li>Identifies the source of pain — muscle, joint, nerve, or movement pattern</li>
                        <li>Reduces stiffness and inflammation through guided therapy and exercise</li>
                        <li>Corrects posture and ergonomic habits that keep pain recurring</li>
                        <li>Builds core and joint stability to prevent future injury</li>
                        <li>Works alongside Ayurveda and pain management when integrated care is needed</li>
                    </ul>
                    <p>Whether you are recovering from back pain, knee issues, sports injury, or post-surgery stiffness, a personalised physiotherapy plan can help you move better — naturally and without unnecessary surgery.</p>
                ',
            ],
            'understanding-panchakarma-detox-benefits' => [
                'slug' => 'understanding-panchakarma-detox-benefits',
                'image' => 'post-4.jpg',
                'title' => 'Understanding Panchakarma Detox Benefits',
                'excerpt' => 'Panchakarma is a cornerstone of Ayurvedic healing — a structured detox process that cleanses the body and restores balance.',
                'date' => 'May 15, 2026',
                'author' => 'Sahaj Aarogyam',
                'tags' => ['panchakarma', 'detox', 'ayurveda'],
                'content' => '
                    <p>Panchakarma is one of the most comprehensive detox and rejuvenation systems in Ayurveda. Done correctly under expert supervision, it helps remove accumulated toxins, improve digestion, and restore energy and mental clarity.</p>
                    <p>It is not a one-size-fits-all cleanse. Panchakarma is customised based on your health condition, season, age, and body strength — with preparatory, main, and post-therapy phases designed for safe results.</p>
                    <blockquote><p>"True detox in Ayurveda is not about starvation — it is about removing imbalance and rebuilding strength in a structured, supervised way."</p></blockquote>
                    <h2>Key benefits patients often experience</h2>
                    <ul>
                        <li>Improved digestion, appetite, and bowel regularity</li>
                        <li>Better sleep quality and reduced mental fatigue</li>
                        <li>Support for chronic skin, joint, and metabolic conditions</li>
                        <li>Enhanced immunity and overall vitality after completion</li>
                        <li>A reset for healthier daily habits post-therapy</li>
                    </ul>
                    <p>At Sahaj Aarogyam, Panchakarma is offered as part of an integrated treatment plan — never as an isolated trend. A proper consultation ensures the therapy is appropriate and safe for you.</p>
                ',
            ],
            'weight-loss-without-crash-diets' => [
                'slug' => 'weight-loss-without-crash-diets',
                'image' => 'post-5.jpg',
                'title' => 'Weight Loss Without Crash Diets',
                'excerpt' => 'Sustainable weight management comes from balanced nutrition, metabolism support, and lifestyle changes.',
                'date' => 'May 10, 2026',
                'author' => 'Sahaj Aarogyam',
                'tags' => ['weight loss', 'nutrition', 'metabolism'],
                'content' => '
                    <p>Crash diets promise quick results but often damage metabolism, cause muscle loss, and lead to rebound weight gain. Sustainable weight management requires a different approach — one that supports your body rather than fighting it.</p>
                    <p>At Sahaj Aarogyam, weight management is treated as a metabolic and lifestyle condition. We assess digestion, hormone patterns, activity levels, sleep, and stress before recommending any plan.</p>
                    <blockquote><p>"Lasting weight loss is a by-product of a healthier metabolism — not the result of extreme restriction."</p></blockquote>
                    <h2>A healthier approach to weight management</h2>
                    <ul>
                        <li>Personalised nutrition based on your body type and daily routine</li>
                        <li>Gradual, achievable changes instead of sudden food elimination</li>
                        <li>Support for thyroid, PCOS, and insulin resistance where relevant</li>
                        <li>Movement and physiotherapy guidance for safe, consistent activity</li>
                        <li>Regular monitoring and adjustment — not a fixed 7-day miracle plan</li>
                    </ul>
                    <p>If you have tried multiple diets without long-term success, a root-cause consultation can help you build a plan that actually fits your life and health goals.</p>
                ',
            ],
            'non-surgical-options-for-back-pain' => [
                'slug' => 'non-surgical-options-for-back-pain',
                'image' => 'post-6.jpg',
                'title' => 'Non-Surgical Options for Back Pain',
                'excerpt' => 'Most back pain can be treated effectively without surgery through physiotherapy, Ayurveda, and structured rehabilitation.',
                'date' => 'April 28, 2026',
                'author' => 'Sahaj Aarogyam',
                'tags' => ['back pain', 'spine care', 'non-surgical'],
                'content' => '
                    <p>Back pain is one of the most common reasons people visit a clinic — and one of the most misunderstood. Not every back or spine issue requires surgery. In many cases, structured non-surgical care can reduce pain, improve mobility, and prevent recurrence.</p>
                    <p>Effective treatment begins with accurate assessment — understanding whether the pain is muscular, disc-related, postural, or nerve-related — and then building a plan around movement, therapy, and lifestyle correction.</p>
                    <blockquote><p>"Surgery should be the last considered option — not the first suggestion — for most chronic back pain cases."</p></blockquote>
                    <h2>Non-surgical treatments we commonly use</h2>
                    <ul>
                        <li>Physiotherapy for spinal mobility, core strength, and pain reduction</li>
                        <li>Ayurvedic therapies and herbal support for inflammation and recovery</li>
                        <li>Posture and ergonomics correction for desk workers and drivers</li>
                        <li>Gradual rehabilitation plans for slip disc and sciatica management</li>
                        <li>Integrated pain protocols combining multiple specialties under one roof</li>
                    </ul>
                    <p>If you are living with persistent back pain, do not wait until it becomes debilitating. Early, structured care often leads to faster recovery and better long-term outcomes.</p>
                ',
            ],
        ];
    }

    /**
     * Display the blog listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $posts = array_values($this->posts());

        return view('blog.index', compact('posts'));
    }

    /**
     * Display a single blog post.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(string $slug): View|Response
    {
        $posts = $this->posts();

        if (! isset($posts[$slug])) {
            abort(404);
        }

        $post = $posts[$slug];
        $relatedPosts = collect($posts)
            ->reject(fn (array $item): bool => $item['slug'] === $slug)
            ->take(3)
            ->values()
            ->all();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
