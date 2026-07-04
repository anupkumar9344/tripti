<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\GalleryItem;
use App\Models\HealthProgram;
use App\Models\HeroBanner;
use App\Models\HotelFacility;
use App\Models\PatientReview;
use App\Models\RoomType;
use App\Models\Setting;
use App\Models\TrustStripItem;
use App\Models\VideoFeedback;
use App\Models\WhyChooseItem;
use Illuminate\View\View;

/**
 * Handles the public home page.
 */
class HomeController extends Controller
{
    /**
     * Setting keys used on the home page.
     *
     * @var list<string>
     */
    private const HOME_SETTING_KEYS = [
        'about_home_title',
        'about_home_title_highlight',
        'about_home_description',
        'about_home_image',
        'about_home_badge_number',
        'phone_1',
        'about_stat_1_count',
        'about_stat_1_label',
        'about_stat_2_count',
        'about_stat_2_label',
        'about_stat_3_count',
        'about_stat_3_label',
        'patient_feedback_rating_label',
        'patient_feedback_total_reviews',
    ];

    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $settings = Setting::getMany(self::HOME_SETTING_KEYS);
        $whyChooseItems = WhyChooseItem::query()->activeOrdered()->get();
        $homeRooms = RoomType::query()->forHome()->limit(6)->get();
        $homeFacilities = HotelFacility::query()->forHome()->limit(6)->get();
        $homeTestimonials = PatientReview::query()->activeOrdered()->limit(6)->get();
        $homeBlogPosts = BlogPost::query()->forHome()->limit(4)->get();
        $healthPrograms = HealthProgram::query()->activeOrdered()->get();
        $heroBanners = HeroBanner::query()->activeOrdered()->get();
        $trustStripItems = TrustStripItem::query()->activeOrdered()->get();
        $homeGalleryItems = GalleryItem::query()->forHome()->get();
        $homeVideoFeedbacks = VideoFeedback::query()->forHome()->limit(10)->get();

        return view('index', compact(
            'settings',
            'whyChooseItems',
            'homeRooms',
            'homeFacilities',
            'homeTestimonials',
            'homeBlogPosts',
            'healthPrograms',
            'heroBanners',
            'trustStripItems',
            'homeGalleryItems',
            'homeVideoFeedbacks',
        ));
    }
}
