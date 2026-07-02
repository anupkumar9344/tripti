<?php

namespace App\Http\Controllers;

use App\Models\HealthProgram;
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
        $healthPrograms = HealthProgram::query()->activeOrdered()->get();

        return view('facilities.index', compact('healthPrograms'));
    }
}
