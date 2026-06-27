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
            ->with(['profileSections.category'])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $profileTabs = $expert->profileSections
            ->filter(function ($section) {
                return $section->category
                    && $section->category->status
                    && filled(trim(strip_tags((string) $section->content)));
            })
            ->sortBy(fn ($section) => $section->category->sort_order)
            ->values()
            ->map(function ($section) {
                return [
                    'id' => $section->category->id,
                    'label' => $section->category->title,
                    'icon' => $section->category->icon ?: 'fa-circle',
                    'content' => $section->content,
                ];
            });

        $detailFaqs = $expert->show_faq_section
            ? Faq::query()->forExpertDetail($expert)->get()
            : collect();

        return view('experts.show', compact('expert', 'profileTabs', 'detailFaqs'));
    }
}
