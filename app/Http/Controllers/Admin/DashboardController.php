<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\View\View;

/**
 * Handles the admin dashboard pages.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard home page with website content stats.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $stats = [
            [
                'label' => 'Services',
                'count' => 6,
                'subtitle' => 'Published on website',
                'icon' => 'ti-briefcase',
                'tone' => 'primary',
            ],
            [
                'label' => 'Treatments',
                'count' => 6,
                'subtitle' => 'Published on website',
                'icon' => 'ti-stethoscope',
                'tone' => 'accent',
            ],
            [
                'label' => 'Blog Posts',
                'count' => 6,
                'subtitle' => 'Articles on blog page',
                'icon' => 'ti-news',
                'tone' => 'info',
            ],
            [
                'label' => 'Expert Team',
                'count' => 6,
                'subtitle' => 'Team members listed',
                'icon' => 'ti-users',
                'tone' => 'warm',
            ],
            [
                'label' => 'Gallery Images',
                'count' => 9,
                'subtitle' => 'Photos in gallery',
                'icon' => 'ti-photo',
                'tone' => 'purple',
            ],
            [
                'label' => 'Health Programs',
                'count' => 1,
                'subtitle' => 'Featured program',
                'icon' => 'ti-calendar-event',
                'tone' => 'rose',
            ],
        ];

        $latestContacts = Contact::query()
            ->latest()
            ->take(5)
            ->get();

        $newContactCount = Contact::query()->where('status', 'new')->count();

        $latestBlogs = [
            [
                'title' => '5 Natural Ways to Improve Your Gut Health',
                'slug' => '5-natural-ways-to-improve-your-gut-health',
                'image' => 'post-1.jpg',
                'date' => 'May 29, 2026',
                'author' => 'Sahaj Aarogyam',
            ],
            [
                'title' => 'Ayurveda vs Modern Lifestyle Disorders',
                'slug' => 'ayurveda-vs-modern-lifestyle-disorders',
                'image' => 'post-2.jpg',
                'date' => 'May 29, 2026',
                'author' => 'Sahaj Aarogyam',
            ],
            [
                'title' => 'How Physiotherapy Helps in Chronic Pain Recovery',
                'slug' => 'how-physiotherapy-helps-in-chronic-pain-recovery',
                'image' => 'post-3.jpg',
                'date' => 'May 29, 2026',
                'author' => 'Sahaj Aarogyam',
            ],
            [
                'title' => 'Understanding Panchakarma Detox Benefits',
                'slug' => 'understanding-panchakarma-detox-benefits',
                'image' => 'post-4.jpg',
                'date' => 'May 15, 2026',
                'author' => 'Sahaj Aarogyam',
            ],
            [
                'title' => 'Weight Loss Without Crash Diets',
                'slug' => 'weight-loss-without-crash-diets',
                'image' => 'post-5.jpg',
                'date' => 'May 10, 2026',
                'author' => 'Sahaj Aarogyam',
            ],
        ];

        $totalContent = collect($stats)->sum('count');

        return view('admin.dashboard.index', compact('stats', 'totalContent', 'latestContacts', 'latestBlogs', 'newContactCount'));
    }
}
