<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Setting;
use Illuminate\View\View;

/**
 * Handles the public FAQ page.
 */
class FaqPageController extends Controller
{
    /**
     * Setting keys used on the FAQ page.
     *
     * @var list<string>
     */
    private const PAGE_SETTING_KEYS = [
        'faq_page_eyebrow',
        'faq_page_title',
        'faq_page_description',
        'faq_page_image',
        'faq_page_contact_label',
        'phone_1',
    ];

    /**
     * Display the FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $faqPageItems = Faq::query()->forFaqPage()->get();
        $faqPageSettings = Setting::getMany(self::PAGE_SETTING_KEYS);

        return view('faq.index', compact('faqPageItems', 'faqPageSettings'));
    }
}
