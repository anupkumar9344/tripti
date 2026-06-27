<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

/**
 * Handles the public home page.
 */
class HomeController extends Controller
{
    /**
     * Setting keys used on the home page location section.
     *
     * @var list<string>
     */
    private const LOCATION_SETTING_KEYS = [
        'visit_us_eyebrow',
        'visit_us_title',
        'visit_us_description',
        'visit_us_bg_image',
        'email_1',
        'email_2',
        'phone_1',
        'phone_2',
        'address',
        'google_map_embed',
    ];

    /**
     * Setting keys used for the home about section.
     *
     * @var list<string>
     */
    private const HOME_ABOUT_SETTING_KEYS = [
        'about_home_eyebrow',
        'about_home_title',
        'about_home_title_highlight',
        'about_home_description',
        'about_home_image',
        'about_home_badge_number',
        'about_home_badge_suffix',
        'about_home_badge_text',
        'about_home_button_text',
    ];

    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $settings = Setting::getMany(array_merge(
            self::LOCATION_SETTING_KEYS,
            self::HOME_ABOUT_SETTING_KEYS
        ));

        return view('index', compact('settings'));
    }
}
