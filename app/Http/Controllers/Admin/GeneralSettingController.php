<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        'website_name',
        'website_logo',
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
            'website_name' => ['required', 'string', 'max:255'],
            'website_logo' => ['nullable', 'image', 'max:2048'],
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
        ]);

        foreach ([
            'website_name',
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
        ] as $key) {
            Setting::setValue($key, $validated[$key] ?? null);
        }

        if ($request->hasFile('website_logo')) {
            $oldLogo = Setting::getValue('website_logo');

            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('website_logo')->store('settings', 'public');
            Setting::setValue('website_logo', $path);
        }

        return redirect()
            ->route('admin.settings.general')
            ->with('success', 'General settings updated successfully.');
    }
}
