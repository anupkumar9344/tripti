<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

/**
 * Handles the public privacy policy and terms pages.
 */
class LegalPageController extends Controller
{
    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacy(): View
    {
        return $this->renderPage(
            'privacy_policy_title',
            'privacy_policy_content',
            'Privacy Policy',
            'privacy-policy'
        );
    }

    /**
     * Display the terms and conditions page.
     *
     * @return \Illuminate\View\View
     */
    public function terms(): View
    {
        return $this->renderPage(
            'terms_conditions_title',
            'terms_conditions_content',
            'Terms & Conditions',
            'terms-and-conditions'
        );
    }

    /**
     * Build the legal page view with stored settings.
     *
     * @return \Illuminate\View\View
     */
    private function renderPage(string $titleKey, string $contentKey, string $defaultTitle, string $pageSlug): View
    {
        $settings = Setting::getMany([$titleKey, $contentKey]);

        $title = $settings[$titleKey] ?: $defaultTitle;
        $content = $settings[$contentKey] ?? '';

        return view('legal.show', compact('title', 'content', 'pageSlug'));
    }
}
