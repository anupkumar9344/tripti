<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Serves static public hotel pages (no CMS data on the frontend for now).
 */
class PageController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function home(): View
    {
        return view('index');
    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about(): View
    {
        return view('about.index');
    }

    /**
     * Display the rooms listing page.
     *
     * @return \Illuminate\View\View
     */
    public function rooms(): View
    {
        return view('rooms.index');
    }

    /**
     * Display a static room details page.
     *
     * @return \Illuminate\View\View
     */
    public function roomDetails(): View
    {
        return view('rooms.show');
    }

    /**
     * Display the gallery page.
     *
     * @return \Illuminate\View\View
     */
    public function gallery(): View
    {
        return view('gallery.index');
    }

    /**
     * Display the blog listing page.
     *
     * @return \Illuminate\View\View
     */
    public function blog(): View
    {
        return view('blog.index');
    }

    /**
     * Display a static blog details page.
     *
     * @return \Illuminate\View\View
     */
    public function blogDetails(): View
    {
        return view('blog.show');
    }

    /**
     * Display the FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function faq(): View
    {
        return view('faq.index');
    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact(): View
    {
        return view('contact.index');
    }

    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacy(): View
    {
        return view('legal.privacy');
    }

    /**
     * Display the terms and conditions page.
     *
     * @return \Illuminate\View\View
     */
    public function terms(): View
    {
        return view('legal.terms');
    }
}
