<?php

namespace App\Http\Controllers;

use App\Models\Setting;
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
        'about_page_title',
        'about_page_title_highlight',
        'about_page_description',
        'about_page_image',
        'about_page_badge_number',
        'about_mission_title',
        'about_mission_text',
        'about_vision_title',
        'about_vision_text',
        'about_stat_1_count',
        'about_stat_1_label',
        'about_stat_2_count',
        'about_stat_2_label',
        'about_stat_3_count',
        'about_stat_3_label',
        'about_stat_4_count',
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

        return view('about.index', compact('settings'));
    }
}
