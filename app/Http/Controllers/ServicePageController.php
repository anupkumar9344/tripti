<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
use App\Models\VideoFeedback;
use Illuminate\View\View;

/**
 * Handles the public services pages.
 */
class ServicePageController extends Controller
{
    /**
     * Display the services listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $services = Service::query()->activeOrdered()->paginate(9);
        $servicesVideoFeedbacks = VideoFeedback::query()->forServices()->get();

        return view('services.index', compact('services', 'servicesVideoFeedbacks'));
    }

    /**
     * Display a single service detail page.
     *
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $service = Service::query()
            ->with(['images', 'subServices', 'benefits'])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $allServices = Service::query()->activeOrdered()->get();
        $detailFaqs = $service->show_faq_section
            ? Faq::query()->forServiceDetail($service)->get()
            : collect();

        return view('services.show', compact('service', 'allServices', 'detailFaqs'));
    }
}
