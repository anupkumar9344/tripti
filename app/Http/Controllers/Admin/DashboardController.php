<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BedType;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\CareerApplication;
use App\Models\CareerOpening;
use App\Models\Faq;
use App\Models\GalleryItem;
use App\Models\HotelAmenity;
use App\Models\HotelFacility;
use App\Models\PatientReview;
use App\Models\PremiumService;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\HeroBanner;
use Illuminate\View\View;

/**
 * Handles the admin dashboard pages.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard home page with hotel and website content stats.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $hotelStats = [
            [
                'label' => 'Room Types',
                'count' => RoomType::query()->where('status', true)->count(),
                'subtitle' => 'Active categories on website',
                'icon' => 'ti-bed',
                'tone' => 'primary',
                'url' => route('admin.room-types.index'),
            ],
            [
                'label' => 'Rooms',
                'count' => Room::query()->where('status', true)->count(),
                'subtitle' => 'Available room inventory',
                'icon' => 'ti-home-2',
                'tone' => 'accent',
                'url' => route('admin.room-types.index'),
            ],
            [
                'label' => 'Amenities',
                'count' => HotelAmenity::query()->where('status', true)->count(),
                'subtitle' => 'In-room amenities listed',
                'icon' => 'ti-list-check',
                'tone' => 'teal',
                'url' => route('admin.hotel-amenities.index'),
            ],
            [
                'label' => 'Facilities',
                'count' => HotelFacility::query()->where('status', true)->count(),
                'subtitle' => 'Hotel facilities listed',
                'icon' => 'ti-building-community',
                'tone' => 'info',
                'url' => route('admin.hotel-facilities.index'),
            ],
            [
                'label' => 'Premium Services',
                'count' => PremiumService::query()->where('status', true)->count(),
                'subtitle' => 'Add-on services offered',
                'icon' => 'ti-diamond',
                'tone' => 'gold',
                'url' => route('admin.premium-services.index'),
            ],
            [
                'label' => 'Bed Types',
                'count' => BedType::query()->count(),
                'subtitle' => 'Bed configurations',
                'icon' => 'ti-layout-grid',
                'tone' => 'warm',
                'url' => route('admin.bed-types.index'),
            ],
        ];

        $contentStats = [
            [
                'label' => 'Job Openings',
                'count' => CareerOpening::query()->where('status', true)->count(),
                'subtitle' => 'Active roles on website',
                'icon' => 'ti-briefcase',
                'tone' => 'warm',
                'url' => route('admin.career-openings.index'),
            ],
            [
                'label' => 'Career Applications',
                'count' => CareerApplication::query()->where('status', CareerApplication::STATUS_NEW)->count(),
                'subtitle' => 'New job applications',
                'icon' => 'ti-user-check',
                'tone' => 'teal',
                'url' => route('admin.career-applications.index'),
            ],
            [
                'label' => 'Blog Posts',
                'count' => BlogPost::query()->where('status', true)->count(),
                'subtitle' => 'Published articles',
                'icon' => 'ti-news',
                'tone' => 'info',
                'url' => route('admin.blog-posts.index'),
            ],
            [
                'label' => 'Gallery Items',
                'count' => GalleryItem::query()->where('status', true)->count(),
                'subtitle' => 'Photos and videos',
                'icon' => 'ti-camera',
                'tone' => 'purple',
                'url' => route('admin.gallery-items.index'),
            ],
            [
                'label' => 'FAQs',
                'count' => Faq::query()->where('status', true)->count(),
                'subtitle' => 'Active questions',
                'icon' => 'ti-help',
                'tone' => 'teal',
                'url' => route('admin.faqs.index'),
            ],
            [
                'label' => 'Feedback',
                'count' => PatientReview::query()->where('status', true)->count(),
                'subtitle' => 'Published testimonials',
                'icon' => 'ti-star',
                'tone' => 'gold',
                'url' => route('admin.patient-reviews.index'),
            ],
            [
                'label' => 'Hero Banners',
                'count' => HeroBanner::query()->where('status', true)->count(),
                'subtitle' => 'Homepage banners',
                'icon' => 'ti-photo',
                'tone' => 'primary',
                'url' => route('admin.hero-banners.index'),
            ],
        ];

        $latestContacts = Contact::query()
            ->latest()
            ->take(5)
            ->get();

        $newContactCount = Contact::query()->where('status', 'new')->count();

        $latestBlogs = BlogPost::query()
            ->where('status', true)
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        $latestRoomTypes = RoomType::query()
            ->withCount(['rooms' => fn ($query) => $query->where('status', true)])
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(5)
            ->get();

        $totalHotel = collect($hotelStats)->sum('count');
        $totalWebsite = collect($contentStats)->sum('count');
        $totalContent = $totalHotel + $totalWebsite;

        return view('admin.dashboard.index', compact(
            'hotelStats',
            'contentStats',
            'totalContent',
            'totalHotel',
            'totalWebsite',
            'latestContacts',
            'latestBlogs',
            'latestRoomTypes',
            'newContactCount'
        ));
    }
}
