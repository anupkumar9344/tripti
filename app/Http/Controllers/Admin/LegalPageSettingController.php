<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles admin settings for privacy policy and terms pages.
 */
class LegalPageSettingController extends Controller
{
    /**
     * Setting keys managed on the legal pages settings screen.
     *
     * @var list<string>
     */
    private const SETTING_KEYS = [
        'privacy_policy_title',
        'privacy_policy_content',
        'terms_conditions_title',
        'terms_conditions_content',
    ];

    /**
     * Show the privacy policy and terms settings form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $settings = Setting::getMany(self::SETTING_KEYS);

        return view('admin.legal-pages.edit', compact('settings'));
    }

    /**
     * Save privacy policy and terms settings to the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'privacy_policy_title' => ['nullable', 'string', 'max:255'],
            'privacy_policy_content' => ['nullable', 'string'],
            'terms_conditions_title' => ['nullable', 'string', 'max:255'],
            'terms_conditions_content' => ['nullable', 'string'],
        ]);

        foreach (self::SETTING_KEYS as $key) {
            Setting::setValue($key, $validated[$key] ?? null);
        }

        return redirect()
            ->route('admin.legal-pages.edit')
            ->with('success', 'Privacy & Terms content updated successfully.');
    }
}
