<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\View\View;

/**
 * Handles the public treatment pages.
 */
class TreatmentController extends Controller
{
    /**
     * Display the treatment listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $treatments = Treatment::query()->activeOrdered()->get();

        return view('rooms.index', compact('treatments'));
    }

    /**
     * Display a single treatment detail page.
     *
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $treatment = Treatment::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $allTreatments = Treatment::query()->activeOrdered()->get();

        return view('rooms.show', compact('treatment', 'allTreatments'));
    }
}
