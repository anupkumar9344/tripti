<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

/**
 * Handles the public contact page.
 */
class ContactController extends Controller
{
    /**
     * Setting keys used on the contact page.
     *
     * @var list<string>
     */
    private const CONTACT_SETTING_KEYS = [
        'website_name',
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
        'contact_locations_title',
        'contact_locations_description',
        'contact_form_title',
        'contact_form_description',
    ];

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $settings = Setting::getMany(self::CONTACT_SETTING_KEYS);

        return view('contact.index', compact('settings'));
    }
}
