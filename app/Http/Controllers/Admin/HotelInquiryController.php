<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelInquiry;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles admin CRUD and status tracking for hotel inquiries.
 */
class HotelInquiryController extends Controller
{
    /**
     * Display inquiries with optional status filter.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $filters = $this->resolvedFilters($request);

        $inquiries = HotelInquiry::query()
            ->with('roomType')
            ->when($filters['status'] !== '', fn ($query) => $query->status($filters['status']))
            ->when($filters['date_from'], fn ($query) => $query->whereDate('created_at', '>=', $filters['date_from']))
            ->when($filters['date_to'], fn ($query) => $query->whereDate('created_at', '<=', $filters['date_to']))
            ->latest()
            ->get();

        $counts = [
            'all' => HotelInquiry::query()->count(),
            HotelInquiry::STATUS_NEW => HotelInquiry::query()->status(HotelInquiry::STATUS_NEW)->count(),
            HotelInquiry::STATUS_IN_PROGRESS => HotelInquiry::query()->status(HotelInquiry::STATUS_IN_PROGRESS)->count(),
            HotelInquiry::STATUS_QUOTED => HotelInquiry::query()->status(HotelInquiry::STATUS_QUOTED)->count(),
            HotelInquiry::STATUS_CLOSED => HotelInquiry::query()->status(HotelInquiry::STATUS_CLOSED)->count(),
            HotelInquiry::STATUS_CANCELLED => HotelInquiry::query()->status(HotelInquiry::STATUS_CANCELLED)->count(),
        ];

        $status = $filters['status'];

        return view('admin.hotel-inquiries.index', compact('inquiries', 'status', 'counts', 'filters'));
    }

    /**
     * Show the form to create a new inquiry.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $roomTypes = RoomType::query()->where('status', true)->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.hotel-inquiries.create', compact('roomTypes'));
    }

    /**
     * Store a newly created inquiry.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $inquiry = HotelInquiry::query()->create($this->validatedData($request));

        return redirect()
            ->route('admin.hotel-inquiries.show', $inquiry)
            ->with('success', 'Inquiry created successfully.');
    }

    /**
     * Display a single inquiry.
     *
     * @return \Illuminate\View\View
     */
    public function show(HotelInquiry $hotelInquiry): View
    {
        $hotelInquiry->load('roomType');

        return view('admin.hotel-inquiries.show', ['inquiry' => $hotelInquiry]);
    }

    /**
     * Show the form to edit an inquiry.
     *
     * @return \Illuminate\View\View
     */
    public function edit(HotelInquiry $hotelInquiry): View
    {
        $roomTypes = RoomType::query()->where('status', true)->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.hotel-inquiries.edit', compact('hotelInquiry', 'roomTypes'));
    }

    /**
     * Update the given inquiry.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HotelInquiry $hotelInquiry): RedirectResponse
    {
        $hotelInquiry->update($this->validatedData($request));

        return redirect()
            ->route('admin.hotel-inquiries.show', $hotelInquiry)
            ->with('success', 'Inquiry updated successfully.');
    }

    /**
     * Update only the inquiry status and admin notes.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, HotelInquiry $hotelInquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(HotelInquiry::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $hotelInquiry->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $hotelInquiry->admin_notes,
        ]);

        return redirect()
            ->route('admin.hotel-inquiries.show', $hotelInquiry)
            ->with('success', 'Inquiry status updated successfully.');
    }

    /**
     * Delete an inquiry.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HotelInquiry $hotelInquiry): RedirectResponse
    {
        $hotelInquiry->delete();

        return redirect()
            ->route('admin.hotel-inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }

    /**
     * Validate and normalize inquiry form input.
     *
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'inquiry_type' => ['required', Rule::in(HotelInquiry::types())],
            'room_type_id' => ['nullable', 'integer', 'exists:room_types,id'],
            'guest_name' => ['required', 'string', 'max:255'],
            'guest_email' => ['nullable', 'email', 'max:255'],
            'guest_phone' => ['required', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'check_in_date' => ['nullable', 'date'],
            'check_out_date' => ['nullable', 'date', 'after_or_equal:check_in_date'],
            'adults' => ['nullable', 'integer', 'min:1', 'max:20'],
            'children' => ['nullable', 'integer', 'min:0', 'max:20'],
            'source' => ['required', Rule::in(HotelInquiry::sources())],
            'status' => ['required', Rule::in(HotelInquiry::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        if ($validated['inquiry_type'] !== HotelInquiry::TYPE_ROOM) {
            $validated['room_type_id'] = null;
            $validated['check_in_date'] = null;
            $validated['check_out_date'] = null;
            $validated['adults'] = null;
            $validated['children'] = 0;
        } else {
            $validated['children'] = $validated['children'] ?? 0;
        }

        return $validated;
    }

    /**
     * Resolve list filters from the request.
     *
     * @return array{
     *     status: string,
     *     period: string,
     *     date_from: string|null,
     *     date_to: string|null
     * }
     */
    private function resolvedFilters(Request $request): array
    {
        $status = $request->string('status')->toString();
        if ($status !== '' && ! in_array($status, HotelInquiry::statuses(), true)) {
            $status = '';
        }

        $period = $request->string('period')->toString();
        $allowedPeriods = [
            'today',
            'last_7_days',
            'current_month',
            'last_month',
            'this_year',
            'last_year',
            'custom',
        ];

        if ($period !== '' && ! in_array($period, $allowedPeriods, true)) {
            $period = '';
        }

        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if ($period !== '' && $period !== 'custom') {
            [$dateFrom, $dateTo] = $this->periodRange($period);
        } else {
            $dateFrom = $this->validDate($dateFrom);
            $dateTo = $this->validDate($dateTo);

            if ($dateFrom && $dateTo && $dateFrom > $dateTo) {
                [$dateFrom, $dateTo] = [$dateTo, $dateFrom];
            }

            if ($dateFrom || $dateTo) {
                $period = 'custom';
            }
        }

        return [
            'status' => $status,
            'period' => $period,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
    }

    /**
     * Get date range for a named period.
     *
     * @return array{0: string, 1: string}
     */
    private function periodRange(string $period): array
    {
        $today = Carbon::today();

        return match ($period) {
            'today' => [$today->toDateString(), $today->toDateString()],
            'last_7_days' => [$today->copy()->subDays(6)->toDateString(), $today->toDateString()],
            'current_month' => [$today->copy()->startOfMonth()->toDateString(), $today->copy()->endOfMonth()->toDateString()],
            'last_month' => [
                $today->copy()->subMonthNoOverflow()->startOfMonth()->toDateString(),
                $today->copy()->subMonthNoOverflow()->endOfMonth()->toDateString(),
            ],
            'this_year' => [$today->copy()->startOfYear()->toDateString(), $today->copy()->endOfYear()->toDateString()],
            'last_year' => [
                $today->copy()->subYear()->startOfYear()->toDateString(),
                $today->copy()->subYear()->endOfYear()->toDateString(),
            ],
            default => [null, null],
        };
    }

    /**
     * Validate a date string.
     */
    private function validDate(mixed $value): ?string
    {
        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        try {
            return Carbon::parse($value)->toDateString();
        } catch (\Throwable) {
            return null;
        }
    }
}
