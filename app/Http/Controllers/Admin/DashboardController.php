<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Handles the admin dashboard pages.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
