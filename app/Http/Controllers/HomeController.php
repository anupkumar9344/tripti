<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Faq;
use App\Models\GalleryItem;
use App\Models\PatientReview;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Treatment;
use App\Models\WhyChooseItem;
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
     * Setting keys used for the home patient feedback section header.
     *
     * @var list<string>
     */
    private const PATIENT_FEEDBACK_SETTING_KEYS = [
        'patient_feedback_rating_label',
        'patient_feedback_total_reviews',
        'patient_feedback_read_more_url',
    ];

    /**
     * Setting keys used for the home FAQ section.
     *
     * @var list<string>
     */
    private const FAQ_HOME_SETTING_KEYS = [
        'faq_home_eyebrow',
        'faq_home_title',
        'faq_home_description',
        'faq_home_image',
        'faq_home_contact_label',
    ];

    /**
     * Setting keys used for the home gallery section.
     *
     * @var list<string>
     */
    private const GALLERY_HOME_SETTING_KEYS = [
        'gallery_home_title',
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

        $whyChooseItems = WhyChooseItem::query()->activeOrdered()->get();
        $homeTreatments = Treatment::query()->forHome()->get();
        $homeServices = Service::query()->forHome()->get();
        $homeExperts = Expert::query()->forHome()->get();
        $patientReviews = PatientReview::query()->activeOrdered()->get();
        $patientFeedbackSettings = Setting::getMany(self::PATIENT_FEEDBACK_SETTING_KEYS);
        $homeFaqs = Faq::query()->forHome()->get();
        $faqHomeSettings = Setting::getMany(self::FAQ_HOME_SETTING_KEYS);
        $homeGalleryItems = GalleryItem::query()->forHome()->get();
        $galleryHomeSettings = Setting::getMany(self::GALLERY_HOME_SETTING_KEYS);

        return view('index', compact(
            'settings',
            'whyChooseItems',
            'homeTreatments',
            'homeServices',
            'homeExperts',
            'patientReviews',
            'patientFeedbackSettings',
            'homeFaqs',
            'faqHomeSettings',
            'homeGalleryItems',
            'galleryHomeSettings'
        ));
    }
}
