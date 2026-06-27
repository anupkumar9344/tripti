<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public expert team page.
 */
class ExpertTeamController extends Controller
{
    /**
     * Display the expert team page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('experts.index');
    }
}
