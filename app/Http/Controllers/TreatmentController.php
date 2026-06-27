<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Handles the public treatment page.
 */
class TreatmentController extends Controller
{
    /**
     * Display the treatment page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('treatment.index');
    }
}
