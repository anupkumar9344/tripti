<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public gallery page.
 */
class GalleryController extends Controller
{
    /**
     * Display the gallery page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('gallery.index');
    }
}
