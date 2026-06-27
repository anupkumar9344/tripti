<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $latestContacts = [
            [
                'name' => 'Priya Sharma',
                'email' => 'priya.sharma@gmail.com',
                'phone' => '+91 98260 12345',
                'subject' => 'Physiotherapy Appointment',
                'message' => 'I have been experiencing lower back pain for the past two weeks. Would like to book a consultation.',
                'date' => '26 Jun 2026, 10:42 AM',
                'status' => 'new',
            ],
            [
                'name' => 'Rahul Mehta',
                'email' => 'rahul.mehta@outlook.com',
                'phone' => '+91 88712 33456',
                'subject' => 'Ayurveda Consultation',
                'message' => 'Looking for Panchakarma detox program details and available slots this month.',
                'date' => '25 Jun 2026, 4:15 PM',
                'status' => 'new',
            ],
            [
                'name' => 'Anita Joshi',
                'email' => 'anita.joshi@yahoo.com',
                'phone' => '+91 93025 77889',
                'subject' => 'Diabetes Management Program',
                'message' => 'Interested in the health camp mentioned on your website. Please share registration details.',
                'date' => '24 Jun 2026, 11:20 AM',
                'status' => 'read',
            ],
            [
                'name' => 'Vikram Singh',
                'email' => 'vikram.singh@gmail.com',
                'phone' => '+91 94250 66771',
                'subject' => 'General Inquiry',
                'message' => 'Do you offer home visit physiotherapy services in Indore?',
                'date' => '23 Jun 2026, 6:05 PM',
                'status' => 'read',
            ],
            [
                'name' => 'Neha Patel',
                'email' => 'neha.patel@gmail.com',
                'phone' => '+91 97550 88990',
                'subject' => 'Acupuncture Treatment',
                'message' => 'Need information about acupuncture sessions for chronic neck pain.',
                'date' => '22 Jun 2026, 9:30 AM',
                'status' => 'read',
            ],
        ];

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

        return view('admin.dashboard.index', compact('stats', 'totalContent', 'latestContacts', 'latestBlogs'));
    }
}
