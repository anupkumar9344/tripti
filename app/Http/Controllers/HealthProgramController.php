<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public health programs page.
 */
class HealthProgramController extends Controller
{
    /**
     * Display the health programs page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('health-programs.index');
    }
}
