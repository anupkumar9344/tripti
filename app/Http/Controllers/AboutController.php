<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public about page.
 */
class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('about.index');
    }
}
