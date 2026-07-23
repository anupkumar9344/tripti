<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles admin CRUD and status tracking for banquet / meeting bookings.
 */
class EventBookingController extends Controller
{
    /**
     * Display event bookings with optional status filter.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        if ($status !== '' && ! in_array($status, EventBooking::statuses(), true)) {
            $status = '';
        }

        $bookings = EventBooking::query()
            ->when($status !== '', fn ($query) => $query->status($status))
            ->latest()
            ->get();

        $counts = [
            'all' => EventBooking::query()->count(),
            EventBooking::STATUS_NEW => EventBooking::query()->status(EventBooking::STATUS_NEW)->count(),
            EventBooking::STATUS_CONFIRMED => EventBooking::query()->status(EventBooking::STATUS_CONFIRMED)->count(),
            EventBooking::STATUS_COMPLETED => EventBooking::query()->status(EventBooking::STATUS_COMPLETED)->count(),
            EventBooking::STATUS_CANCELLED => EventBooking::query()->status(EventBooking::STATUS_CANCELLED)->count(),
        ];

        return view('admin.event-bookings.index', compact('bookings', 'status', 'counts'));
    }

    /**
     * Show the form to create a new event booking.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.event-bookings.create');
    }

    /**
     * Store a newly created event booking.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $booking = EventBooking::query()->create($this->validatedData($request, true));

        return redirect()
            ->route('admin.event-bookings.show', $booking)
            ->with('success', 'Event booking created successfully.');
    }

    /**
     * Display a single event booking.
     *
     * @return \Illuminate\View\View
     */
    public function show(EventBooking $eventBooking): View
    {
        return view('admin.event-bookings.show', ['booking' => $eventBooking]);
    }

    /**
     * Show the form to edit an event booking.
     *
     * @return \Illuminate\View\View
     */
    public function edit(EventBooking $eventBooking): View
    {
        return view('admin.event-bookings.edit', compact('eventBooking'));
    }

    /**
     * Update the given event booking.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, EventBooking $eventBooking): RedirectResponse
    {
        $eventBooking->update($this->validatedData($request, false));

        return redirect()
            ->route('admin.event-bookings.show', $eventBooking)
            ->with('success', 'Event booking updated successfully.');
    }

    /**
     * Update only the booking status and admin notes.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, EventBooking $eventBooking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(EventBooking::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $eventBooking->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $eventBooking->admin_notes,
        ]);

        return redirect()
            ->route('admin.event-bookings.show', $eventBooking)
            ->with('success', 'Booking status updated successfully.');
    }

    /**
     * Delete an event booking.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EventBooking $eventBooking): RedirectResponse
    {
        $eventBooking->delete();

        return redirect()
            ->route('admin.event-bookings.index')
            ->with('success', 'Event booking deleted successfully.');
    }

    /**
     * Validate and normalize event booking form input.
     *
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, bool $isCreate): array
    {
        $validated = $request->validate([
            'booking_type' => ['required', Rule::in(EventBooking::types())],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:5000'],
            'program_name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable', 'string', 'max:20'],
            'purpose' => ['required', 'string', 'max:2000'],
            'additional_notes' => ['nullable', 'string', 'max:5000'],
            'booking_amount' => ['nullable', 'numeric', 'min:0'],
            'advance_amount' => ['nullable', 'numeric', 'min:0'],
            'advance_paid_at' => ['nullable', 'date'],
            'source' => ['required', Rule::in(EventBooking::sources())],
            'status' => ['required', Rule::in(EventBooking::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        if ($isCreate) {
            $validated['reference_number'] = EventBooking::generateReferenceNumber();
        }

        if (isset($validated['booking_amount']) && $validated['booking_amount'] !== null && $validated['booking_amount'] !== '') {
            $validated['booking_amount'] = round((float) $validated['booking_amount'], 2);
        } else {
            $validated['booking_amount'] = null;
        }

        if (isset($validated['advance_amount']) && $validated['advance_amount'] !== null && $validated['advance_amount'] !== '') {
            $validated['advance_amount'] = round((float) $validated['advance_amount'], 2);
        } else {
            $validated['advance_amount'] = null;
        }

        if ($validated['booking_amount'] !== null
            && $validated['advance_amount'] !== null
            && $validated['advance_amount'] > $validated['booking_amount']) {
            $validated['advance_amount'] = $validated['booking_amount'];
        }

        return $validated;
    }
}
