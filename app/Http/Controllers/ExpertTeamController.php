<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Faq;
use Illuminate\View\View;

/**
 * Handles the public expert team pages.
 */
class ExpertTeamController extends Controller
{
    /**
     * Display the expert team listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $experts = Expert::query()->activeOrdered()->get();

        return view('experts.index', compact('experts'));
    }

    /**
     * Display a single expert profile page.
     *
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $expert = Expert::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $detailFaqs = $expert->show_faq_section
            ? Faq::query()->forExpertDetail($expert)->get()
            : collect();

        $relatedExperts = Expert::query()
            ->where('status', true)
            ->where('id', '!=', $expert->id)
            ->activeOrdered()
            ->limit(3)
            ->get();

        return view('experts.show', compact('expert', 'detailFaqs', 'relatedExperts'));
    }
}
