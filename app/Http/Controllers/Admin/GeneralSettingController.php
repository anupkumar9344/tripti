<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\MediaPath;
use App\Support\WelcomeModal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles general website settings stored as key-value pairs.
 */
class GeneralSettingController extends Controller
{
    /**
     * Setting keys managed on the general settings page.
     *
     * @var list<string>
     */
    private const SETTING_KEYS = [
        'admin_theme_primary_color',
        'theme_primary_color',
        'website_name',
        'website_logo',
        'website_favicon',
        'admin_login_image',
        'welcome_modal_enabled',
        'welcome_modal_title',
        'welcome_modal_message',
        'welcome_modal_media_type',
        'welcome_modal_image',
        'welcome_modal_video_url',
        'welcome_modal_button_text',
        'welcome_modal_button_url',
        'welcome_modal_revision',
        'footer_about',
        'email_1',
        'email_2',
        'phone_1',
        'phone_2',
        'whatsapp_number',
        'address',
        'opening_hours',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'google_map_embed',
        'visit_us_eyebrow',
        'visit_us_title',
        'visit_us_description',
        'visit_us_bg_image',
        'contact_locations_title',
        'contact_locations_description',
        'contact_form_title',
        'contact_form_description',
        'career_page_eyebrow',
        'career_page_title',
        'career_page_intro',
        'career_form_title',
        'career_form_description',
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_meta_author',
        'seo_robots',
        'seo_og_title',
        'seo_og_description',
        'seo_og_image',
        'seo_twitter_card',
        'seo_twitter_site',
        'seo_google_site_verification',
    ];

    /**
     * Media setting keys that store pasted library URLs.
     *
     * @var list<string>
     */
    private const MEDIA_SETTING_KEYS = [
        'website_logo',
        'website_favicon',
        'admin_login_image',
        'welcome_modal_image',
        'visit_us_bg_image',
        'seo_og_image',
    ];

    /**
     * Show the general settings form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $settings = Setting::getMany(self::SETTING_KEYS);

        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Save general settings to the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'admin_theme_primary_color' => ['nullable', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'theme_primary_color' => ['nullable', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'website_name' => ['required', 'string', 'max:255'],
            'website_logo' => ['nullable', 'string', 'max:500'],
            'website_favicon' => ['nullable', 'string', 'max:500'],
            'admin_login_image' => ['nullable', 'string', 'max:500'],
            'welcome_modal_enabled' => ['required', 'boolean'],
            'welcome_modal_title' => ['nullable', 'string', 'max:255'],
            'welcome_modal_message' => ['nullable', 'string', 'max:2000'],
            'welcome_modal_media_type' => ['required', 'in:none,image,video'],
            'welcome_modal_image' => ['nullable', 'string', 'max:500'],
            'welcome_modal_video_url' => ['nullable', 'string', 'max:500'],
            'welcome_modal_button_text' => ['nullable', 'string', 'max:100'],
            'welcome_modal_button_url' => ['nullable', 'string', 'max:500'],
            'footer_about' => ['nullable', 'string', 'max:1000'],
            'email_1' => ['nullable', 'email', 'max:255'],
            'email_2' => ['nullable', 'email', 'max:255'],
            'phone_1' => ['nullable', 'string', 'max:50'],
            'phone_2' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:1000'],
            'opening_hours' => ['nullable', 'string', 'max:1000'],
            'facebook_url' => ['nullable', 'url', 'max:500'],
            'instagram_url' => ['nullable', 'url', 'max:500'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'google_map_embed' => ['nullable', 'string', 'max:2000'],
            'visit_us_eyebrow' => ['nullable', 'string', 'max:255'],
            'visit_us_title' => ['nullable', 'string', 'max:255'],
            'visit_us_description' => ['nullable', 'string', 'max:1000'],
            'visit_us_bg_image' => ['nullable', 'string', 'max:500'],
            'contact_locations_title' => ['nullable', 'string', 'max:255'],
            'contact_locations_description' => ['nullable', 'string', 'max:1000'],
            'contact_form_title' => ['nullable', 'string', 'max:255'],
            'contact_form_description' => ['nullable', 'string', 'max:1000'],
            'career_page_eyebrow' => ['nullable', 'string', 'max:255'],
            'career_page_title' => ['nullable', 'string', 'max:255'],
            'career_page_intro' => ['nullable', 'string', 'max:1000'],
            'career_form_title' => ['nullable', 'string', 'max:255'],
            'career_form_description' => ['nullable', 'string', 'max:1000'],
            'seo_meta_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_description' => ['nullable', 'string', 'max:500'],
            'seo_meta_keywords' => ['nullable', 'string', 'max:500'],
            'seo_meta_author' => ['nullable', 'string', 'max:255'],
            'seo_robots' => ['nullable', 'string', 'max:100'],
            'seo_og_title' => ['nullable', 'string', 'max:255'],
            'seo_og_description' => ['nullable', 'string', 'max:500'],
            'seo_og_image' => ['nullable', 'string', 'max:500'],
            'seo_twitter_card' => ['nullable', 'string', 'max:50'],
            'seo_twitter_site' => ['nullable', 'string', 'max:100'],
            'seo_google_site_verification' => ['nullable', 'string', 'max:255'],
        ]);

        $previousWelcome = Setting::getMany(WelcomeModal::SETTING_KEYS);

        foreach (self::SETTING_KEYS as $key) {
            if ($key === 'welcome_modal_revision') {
                continue;
            }

            if (in_array($key, ['theme_primary_color', 'admin_theme_primary_color'], true)) {
                Setting::setValue($key, \App\Support\ThemeColors::normalizeHex($validated[$key] ?? null));

                continue;
            }

            if (in_array($key, self::MEDIA_SETTING_KEYS, true)) {
                Setting::setValue($key, MediaPath::normalize($validated[$key] ?? null));

                continue;
            }

            Setting::setValue($key, $validated[$key] ?? null);
        }

        $currentWelcome = Setting::getMany(WelcomeModal::SETTING_KEYS);
        unset($previousWelcome['welcome_modal_revision'], $currentWelcome['welcome_modal_revision']);

        if ($previousWelcome !== $currentWelcome) {
            Setting::setValue('welcome_modal_revision', (string) time());
        }

        return redirect()
            ->route('admin.settings.general')
            ->with('success', 'General settings updated successfully.');
    }
}
