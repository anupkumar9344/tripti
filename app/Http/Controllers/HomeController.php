<?php

namespace App\Http\Controllers;

/**
 * Handles the public home page.
 */
class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }
}
