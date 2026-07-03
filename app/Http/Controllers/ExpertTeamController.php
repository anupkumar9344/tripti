<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Faq;
use App\Models\Setting;
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

        $settings = Setting::getMany([
            'team_page_eyebrow',
            'team_page_title',
            'team_page_intro',
        ]);

        $pageEyebrow = $settings['team_page_eyebrow'] ?? 'Our Leadership';
        $pageTitle = $settings['team_page_title'] ?? 'Meet Our Expert Team';
        $pageIntro = $settings['team_page_intro']
            ?? 'Dedicated professionals across hospitality, dining, and guest services — committed to making every stay at Tripti Hotel exceptional.';

        $specialties = $experts
            ->pluck('specialty')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('experts.index', compact(
            'experts',
            'pageEyebrow',
            'pageTitle',
            'pageIntro',
            'specialties'
        ));
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
            ->when(
                filled($expert->specialty),
                fn ($query) => $query->orderByRaw('CASE WHEN specialty = ? THEN 0 ELSE 1 END', [$expert->specialty])
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(3)
            ->get();

        $contactSettings = Setting::getMany([
            'phone_1',
            'whatsapp_number',
        ]);

        $qualificationItems = collect(preg_split('/\s*\|\s*/', (string) $expert->qualifications))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values();

        return view('experts.show', compact(
            'expert',
            'detailFaqs',
            'relatedExperts',
            'contactSettings',
            'qualificationItems'
        ));
    }
}
