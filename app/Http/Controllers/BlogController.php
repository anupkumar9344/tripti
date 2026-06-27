<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public blog page.
 */
class BlogController extends Controller
{
    /**
     * Display the blog listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('blog.index');
    }
}
