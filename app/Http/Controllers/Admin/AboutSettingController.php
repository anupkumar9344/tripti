<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin settings for About Us home and page content.
 */
class AboutSettingController extends Controller
{
    /**
     * Setting keys managed on the About Us settings page.
     *
     * @var list<string>
     */
    private const SETTING_KEYS = [
        'about_home_title',
        'about_home_title_highlight',
        'about_home_description',
        'about_home_image',
        'about_home_badge_number',
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
     * Show the About Us settings form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $settings = Setting::getMany(self::SETTING_KEYS);

        return view('admin.about.edit', compact('settings'));
    }

    /**
     * Save About Us settings to the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'about_home_title' => ['nullable', 'string', 'max:255'],
            'about_home_title_highlight' => ['nullable', 'string', 'max:255'],
            'about_home_description' => ['nullable', 'string', 'max:2000'],
            'about_home_image' => ['nullable', 'string', 'max:500'],
            'about_home_badge_number' => ['nullable', 'string', 'max:20'],
            'about_page_title' => ['nullable', 'string', 'max:255'],
            'about_page_title_highlight' => ['nullable', 'string', 'max:255'],
            'about_page_description' => ['nullable', 'string'],
            'about_page_image' => ['nullable', 'string', 'max:500'],
            'about_page_badge_number' => ['nullable', 'string', 'max:20'],
            'about_mission_title' => ['nullable', 'string', 'max:255'],
            'about_mission_text' => ['nullable', 'string', 'max:2000'],
            'about_vision_title' => ['nullable', 'string', 'max:255'],
            'about_vision_text' => ['nullable', 'string', 'max:2000'],
            'about_stat_1_count' => ['nullable', 'string', 'max:20'],
            'about_stat_1_label' => ['nullable', 'string', 'max:255'],
            'about_stat_2_count' => ['nullable', 'string', 'max:20'],
            'about_stat_2_label' => ['nullable', 'string', 'max:255'],
            'about_stat_3_count' => ['nullable', 'string', 'max:20'],
            'about_stat_3_label' => ['nullable', 'string', 'max:255'],
            'about_stat_4_count' => ['nullable', 'string', 'max:20'],
            'about_stat_4_label' => ['nullable', 'string', 'max:255'],
        ]);

        foreach (self::SETTING_KEYS as $key) {
            if (in_array($key, ['about_home_image', 'about_page_image'], true)) {
                Setting::setValue($key, MediaPath::normalize($validated[$key] ?? null));

                continue;
            }

            Setting::setValue($key, $validated[$key] ?? null);
        }

        return redirect()
            ->route('admin.about.edit')
            ->with('success', 'About Us settings updated successfully.');
    }
}
