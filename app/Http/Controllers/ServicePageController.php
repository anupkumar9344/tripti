<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public services page.
 */
class ServicePageController extends Controller
{
    /**
     * Display the services page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('services.index');
    }
}
