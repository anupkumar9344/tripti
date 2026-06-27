<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\GalleryItem;
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
                'count' => BlogPost::query()->where('status', true)->count(),
                'subtitle' => 'Published articles',
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
                'label' => 'Gallery Items',
                'count' => GalleryItem::query()->where('status', true)->count(),
                'subtitle' => 'Photos and videos in gallery',
                'icon' => 'ti-camera',
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

        $latestBlogs = BlogPost::query()
            ->where('status', true)
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        $totalContent = collect($stats)->sum('count');

        return view('admin.dashboard.index', compact('stats', 'totalContent', 'latestContacts', 'latestBlogs', 'newContactCount'));
    }
}
