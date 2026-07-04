<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles admin booking management.
 */
class BookingController extends Controller
{
    /**
     * Display bookings with status and date filters.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $filters = $this->resolvedFilters($request);

        $bookings = Booking::query()
            ->with('roomType')
            ->when($filters['status'] !== '', fn ($query) => $query->status($filters['status']))
            ->when($filters['date_from'], fn ($query) => $query->whereDate('created_at', '>=', $filters['date_from']))
            ->when($filters['date_to'], fn ($query) => $query->whereDate('created_at', '<=', $filters['date_to']))
            ->latest()
            ->get();

        $counts = [
            'all' => Booking::query()->count(),
            Booking::STATUS_PENDING => Booking::query()->status(Booking::STATUS_PENDING)->count(),
            Booking::STATUS_CONFIRMED => Booking::query()->status(Booking::STATUS_CONFIRMED)->count(),
            Booking::STATUS_COMPLETED => Booking::query()->status(Booking::STATUS_COMPLETED)->count(),
            Booking::STATUS_CANCELLED => Booking::query()->status(Booking::STATUS_CANCELLED)->count(),
        ];

        $status = $filters['status'];

        return view('admin.bookings.index', compact('bookings', 'counts', 'status', 'filters'));
    }

    /**
     * Display a single booking record.
     *
     * @return \Illuminate\View\View
     */
    public function show(Booking $booking): View
    {
        $booking->load(['roomType', 'room']);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Update booking status and optional admin notes.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(Booking::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
            'payment_status' => ['nullable', Rule::in([
                Booking::PAYMENT_PENDING,
                Booking::PAYMENT_PAID,
                Booking::PAYMENT_FAILED,
                Booking::PAYMENT_REFUNDED,
            ])],
        ]);

        $data = [
            'admin_notes' => $validated['admin_notes'] ?? $booking->admin_notes,
            'status' => $validated['status'],
        ];

        if (! empty($validated['payment_status'])) {
            $data['payment_status'] = $validated['payment_status'];
        }

        if ($validated['status'] === Booking::STATUS_CONFIRMED) {
            $data['confirmed_at'] = $booking->confirmed_at ?? now();
            $data['cancelled_at'] = null;
        } elseif ($validated['status'] === Booking::STATUS_COMPLETED) {
            $data['confirmed_at'] = $booking->confirmed_at ?? now();
            $data['cancelled_at'] = null;
        } elseif ($validated['status'] === Booking::STATUS_CANCELLED) {
            $data['cancelled_at'] = now();
        } else {
            $data['confirmed_at'] = null;
            $data['cancelled_at'] = null;
        }

        $booking->update($data);

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Delete a booking record.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
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
        if ($status !== '' && ! in_array($status, Booking::statuses(), true)) {
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
