<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\WhyChooseItem;
use Illuminate\View\View;

/**
 * Handles the public about page.
 */
class AboutController extends Controller
{
    /**
     * Setting keys used on the about page.
     *
     * @var list<string>
     */
    private const ABOUT_SETTING_KEYS = [
        'about_page_eyebrow',
        'about_page_title',
        'about_page_title_highlight',
        'about_page_description',
        'about_page_image',
        'about_page_badge_number',
        'about_page_badge_suffix',
        'about_page_badge_text',
        'about_page_button_text',
        'about_stat_1_count',
        'about_stat_1_suffix',
        'about_stat_1_label',
        'about_stat_2_count',
        'about_stat_2_suffix',
        'about_stat_2_label',
        'about_stat_3_count',
        'about_stat_3_suffix',
        'about_stat_3_label',
        'about_stat_4_count',
        'about_stat_4_suffix',
        'about_stat_4_label',
    ];

    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $settings = Setting::getMany(self::ABOUT_SETTING_KEYS);

        $aboutStats = [
            [
                'count' => $settings['about_stat_1_count'] ?: '25',
                'suffix' => $settings['about_stat_1_suffix'] ?? '+',
                'label' => $settings['about_stat_1_label'] ?: 'Years of Experience',
                'icon' => 'icon-why-choose-counter-1.svg',
                'delay' => '0',
            ],
            [
                'count' => $settings['about_stat_2_count'] ?: '3500',
                'suffix' => $settings['about_stat_2_suffix'] ?? '+',
                'label' => $settings['about_stat_2_label'] ?: 'Patients Treated',
                'icon' => 'icon-why-choose-counter-2.svg',
                'delay' => '0.1s',
            ],
            [
                'count' => $settings['about_stat_3_count'] ?: '15',
                'suffix' => $settings['about_stat_3_suffix'] ?? '+',
                'label' => $settings['about_stat_3_label'] ?: 'Expert Specialists',
                'icon' => 'icon-why-choose-counter-3.svg',
                'delay' => '0.2s',
            ],
            [
                'count' => $settings['about_stat_4_count'] ?: '10',
                'suffix' => $settings['about_stat_4_suffix'] ?? '+',
                'label' => $settings['about_stat_4_label'] ?: 'Therapy Disciplines',
                'icon' => 'icon-why-choose-counter-4.svg',
                'delay' => '0.3s',
            ],
        ];

        $whyChooseItems = WhyChooseItem::query()->activeOrdered()->get();

        return view('about.index', compact('settings', 'aboutStats', 'whyChooseItems'));
    }
}
