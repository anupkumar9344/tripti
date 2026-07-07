<?php

namespace App\Http\Controllers;

use App\Models\CareerApplication;
use App\Models\CareerOpening;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles the public careers page and job applications.
 */
class CareerController extends Controller
{
    /**
     * Setting keys used on the careers page.
     *
     * @var list<string>
     */
    private const CAREER_SETTING_KEYS = [
        'website_name',
        'career_page_eyebrow',
        'career_page_title',
        'career_page_intro',
        'career_form_title',
        'career_form_description',
        'email_1',
        'phone_1',
    ];

    /**
     * Display the careers page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $settings = Setting::getMany(self::CAREER_SETTING_KEYS);
        $openings = CareerOpening::query()->activeOrdered()->get();

        return view('careers.index', compact('settings', 'openings'));
    }

    /**
     * Store a career application from the public form.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'career_opening_id' => ['required', 'integer', 'exists:career_openings,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $opening = CareerOpening::query()
            ->where('id', $validated['career_opening_id'])
            ->where('status', true)
            ->firstOrFail();

        CareerApplication::create([
            'career_opening_id' => $opening->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'position' => $opening->title,
            'message' => $validated['message'] ?? null,
            'status' => CareerApplication::STATUS_NEW,
        ]);

        return response()->json([
            'message' => 'Thank you for applying. Our HR team will review your application and contact you soon.',
        ]);
    }
}
