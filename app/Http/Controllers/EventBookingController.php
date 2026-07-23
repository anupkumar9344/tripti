<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles public banquet and meeting booking requests.
 */
class EventBookingController extends Controller
{
    /**
     * Display the banquet / meeting booking form.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('event-booking.index');
    }

    /**
     * Store a banquet or meeting booking request from the website.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'booking_type' => ['required', Rule::in(EventBooking::types())],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:5000'],
            'program_name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'event_time' => ['nullable', 'string', 'max:20'],
            'purpose' => ['required', 'string', 'max:2000'],
            'additional_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        EventBooking::query()->create([
            'reference_number' => EventBooking::generateReferenceNumber(),
            'booking_type' => $validated['booking_type'],
            'contact_name' => $validated['contact_name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'company_name' => $validated['company_name'] ?? null,
            'number_of_people' => $validated['number_of_people'],
            'program_name' => $validated['program_name'],
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'] ?? null,
            'purpose' => $validated['purpose'],
            'additional_notes' => $validated['additional_notes'] ?? null,
            'source' => EventBooking::SOURCE_WEBSITE,
            'status' => EventBooking::STATUS_NEW,
        ]);

        return response()->json([
            'message' => 'Thank you! Your booking request has been received. Our events team will contact you shortly.',
        ]);
    }
}
