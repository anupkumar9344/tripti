<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PromoCode;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles the public hotel booking flow.
 */
class BookingController extends Controller
{
    /**
     * Display the booking search page and available room types.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $filters = $this->searchFilters($request);
        $roomTypes = collect();

        if ($filters['searched']) {
            $roomTypes = RoomType::query()
                ->activeOrdered()
                ->withCount(['rooms' => fn ($query) => $query->where('status', true)])
                ->get()
                ->map(function (RoomType $roomType) use ($filters) {
                    $booked = Booking::overlappingCount(
                        $roomType->id,
                        $filters['check_in'],
                        $filters['check_out']
                    );
                    $available = max(0, (int) $roomType->rooms_count - $booked);
                    $fitsGuests = $filters['adults'] <= (int) $roomType->max_adults
                        && $filters['children'] <= (int) $roomType->max_children;

                    $roomType->available_units = $available;
                    $roomType->is_bookable = $available > 0 && $fitsGuests;
                    $roomType->stay_total = (float) $roomType->fare * $filters['nights'];
                    $resolvedPromoCode = $this->resolvePromoCode($filters['promo_code'] ?? null, $roomType->stay_total);
                    $roomType->discount_amount = $resolvedPromoCode['discount_amount'] ?? 0.0;
                    $roomType->final_stay_total = max(0, $roomType->stay_total - $roomType->discount_amount);

                    return $roomType;
                })
                ->filter(fn (RoomType $roomType) => $roomType->is_bookable || $request->boolean('show_all'))
                ->values();
        }

        return view('booking.index', [
            'filters' => $filters,
            'roomTypes' => $roomTypes,
        ]);
    }

    /**
     * Display the checkout form for a selected room type and stay.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout(Request $request): RedirectResponse|View
    {
        $filters = $this->searchFilters($request);

        if (! $filters['searched'] || ! $request->filled('room_type')) {
            return redirect()
                ->route('booking')
                ->with('error', 'Please select your stay dates and a room type to continue.');
        }

        $roomType = RoomType::query()->activeOrdered()->findOrFail($request->integer('room_type'));

        if ($filters['adults'] > (int) $roomType->max_adults || $filters['children'] > (int) $roomType->max_children) {
            return redirect()
                ->route('booking', $this->filterQuery($filters))
                ->with('error', 'Guest count exceeds the limit for the selected room type.');
        }

        $available = $roomType->availableRoomsCount() - Booking::overlappingCount(
            $roomType->id,
            $filters['check_in'],
            $filters['check_out']
        );

        if ($available < 1) {
            return redirect()
                ->route('booking', $this->filterQuery($filters))
                ->with('error', 'Sorry, this room type is no longer available for the selected dates.');
        }

        $stayTotal = (float) $roomType->fare * $filters['nights'];
        $discountAmount = 0.0;
        $promoCode = null;
        $resolvedPromoCode = $this->resolvePromoCode($filters['promo_code'] ?? null, $stayTotal);

        if ($resolvedPromoCode) {
            $promoCode = $resolvedPromoCode['code'];
            $discountAmount = $resolvedPromoCode['discount_amount'];
        }

        return view('booking.checkout', [
            'filters' => $filters,
            'roomType' => $roomType,
            'stayTotal' => $stayTotal,
            'discountAmount' => $discountAmount,
            'promoCode' => $promoCode,
            'finalAmount' => max(0, $stayTotal - $discountAmount),
            'paymentMethods' => $this->availablePaymentMethods(),
        ]);
    }

    /**
     * Store a new booking request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'adults' => ['required', 'integer', 'min:1', 'max:10'],
            'children' => ['required', 'integer', 'min:0', 'max:10'],
            'booking_for' => ['required', Rule::in(['myself', 'someone_else'])],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'country' => ['nullable', 'string', 'max:100'],
            'guests' => ['nullable', 'array', 'max:10'],
            'guests.*.first_name' => ['nullable', 'string', 'max:100'],
            'guests.*.last_name' => ['nullable', 'string', 'max:100'],
            'guests.*.country' => ['nullable', 'string', 'max:100'],
            'check_in_time' => ['nullable', 'string', 'max:20'],
            'check_out_time' => ['nullable', 'string', 'max:20'],
            'special_requests' => ['nullable', 'string', 'max:2000'],
            'promo_code' => ['nullable', 'string', 'max:50'],
            'marketing_consent' => ['nullable', 'boolean'],
            'terms_accepted' => ['accepted'],
            'payment_method' => ['required', Rule::in(array_keys($this->availablePaymentMethods()))],
        ]);

        $guests = [];
        if ($validated['booking_for'] === 'someone_else') {
            foreach ($request->input('guests', []) as $guest) {
                $firstName = trim((string) ($guest['first_name'] ?? ''));
                $lastName = trim((string) ($guest['last_name'] ?? ''));
                $guestCountry = trim((string) ($guest['country'] ?? ''));

                if ($firstName === '' && $lastName === '') {
                    continue;
                }

                $guests[] = [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'country' => $guestCountry !== '' ? $guestCountry : null,
                ];
            }
        }

        $roomType = RoomType::query()->activeOrdered()->findOrFail($validated['room_type_id']);

        if ($validated['adults'] > (int) $roomType->max_adults || $validated['children'] > (int) $roomType->max_children) {
            return back()
                ->withInput()
                ->with('error', 'Guest count exceeds the limit for the selected room type.');
        }

        $checkIn = Carbon::parse($validated['check_in'])->toDateString();
        $checkOut = Carbon::parse($validated['check_out'])->toDateString();
        $nights = (int) Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));

        $available = $roomType->availableRoomsCount() - Booking::overlappingCount(
            $roomType->id,
            $checkIn,
            $checkOut
        );

        if ($available < 1) {
            return redirect()
                ->route('booking', [
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'adults' => $validated['adults'],
                    'children' => $validated['children'],
                ])
                ->with('error', 'Sorry, this room type is no longer available for the selected dates.');
        }

        $baseAmount = (float) $roomType->fare * $nights;
        $promoCode = null;
        $discountAmount = 0.0;
        $resolvedPromoCode = $this->resolvePromoCode($validated['promo_code'] ?? null, $baseAmount);

        if ($resolvedPromoCode) {
            $promoCode = $resolvedPromoCode['code'];
            $discountAmount = $resolvedPromoCode['discount_amount'];
        }

        $paymentMethod = $validated['payment_method'];
        $paymentStatus = Booking::PAYMENT_PENDING;
        $paymentGateway = null;

        // Razorpay (and other gateways) can be enabled later without changing the booking schema.
        if ($paymentMethod === Booking::PAYMENT_RAZORPAY) {
            $paymentGateway = 'razorpay';
            // Future: create Razorpay order, redirect to payment, then mark paid via webhook/callback.
        }

        $booking = Booking::query()->create([
            'booking_number' => Booking::generateBookingNumber(),
            'room_type_id' => $roomType->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'adults' => $validated['adults'],
            'children' => $validated['children'],
            'nights' => $nights,
            'room_fare' => $roomType->fare,
            'discount_amount' => $discountAmount,
            'total_amount' => max(0, $baseAmount - $discountAmount),
            'booking_for' => $validated['booking_for'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => $validated['country'] ?? null,
            'guests' => $guests !== [] ? $guests : null,
            'check_in_time' => $validated['check_in_time'] ?? null,
            'check_out_time' => $validated['check_out_time'] ?? null,
            'special_requests' => $validated['special_requests'] ?? null,
            'promo_code' => $promoCode,
            'marketing_consent' => $request->boolean('marketing_consent'),
            'terms_accepted' => true,
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'payment_gateway' => $paymentGateway,
            'status' => Booking::STATUS_PENDING,
        ]);

        if ($resolvedPromoCode && isset($resolvedPromoCode['promo_code'])) {
            $resolvedPromoCode['promo_code']->incrementUsage();
        }

        return redirect()
            ->route('booking.success', $booking->booking_number)
            ->with('success', 'Your booking request has been received.');
    }

    /**
     * Display the booking success confirmation page.
     *
     * @return \Illuminate\View\View
     */
    public function success(string $bookingNumber): View
    {
        $booking = Booking::query()
            ->with('roomType')
            ->where('booking_number', $bookingNumber)
            ->firstOrFail();

        return view('booking.success', compact('booking'));
    }

    /**
     * Normalize search filters from the request.
     *
     * @return array{
     *     check_in: string|null,
     *     check_out: string|null,
     *     adults: int,
     *     children: int,
     *     nights: int,
     *     searched: bool,
     *     guests_label: string
     * }
     */
    private function searchFilters(Request $request): array
    {
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $adults = max(1, min(10, (int) $request->input('adults', 2)));
        $children = max(0, min(10, (int) $request->input('children', 0)));

        $searched = filled($checkIn) && filled($checkOut);
        $nights = 0;

        if ($searched) {
            try {
                $in = Carbon::parse($checkIn)->startOfDay();
                $out = Carbon::parse($checkOut)->startOfDay();

                if ($in->lt(Carbon::today())) {
                    $in = Carbon::today();
                    $checkIn = $in->toDateString();
                }

                if ($out->lte($in)) {
                    $out = $in->copy()->addDay();
                    $checkOut = $out->toDateString();
                }

                $checkIn = $in->toDateString();
                $checkOut = $out->toDateString();
                $nights = (int) $in->diffInDays($out);
                $searched = $nights >= 1;
            } catch (\Throwable) {
                $searched = false;
                $checkIn = null;
                $checkOut = null;
            }
        }

        $promoCode = $request->has('promo_code')
            ? trim((string) $request->input('promo_code'))
            : trim((string) (PromoCode::defaultApplicable()?->code ?? ''));

        return [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'adults' => $adults,
            'children' => $children,
            'nights' => $nights,
            'searched' => $searched,
            'promo_code' => $promoCode !== '' ? strtoupper($promoCode) : null,
            'guests_label' => $adults.' adult'.($adults === 1 ? '' : 's').', '.$children.' child'.($children === 1 ? '' : 'ren'),
        ];
    }

    /**
     * Build query parameters for booking search redirects.
     *
     * @param  array<string, mixed>  $filters
     * @return array<string, mixed>
     */
    private function filterQuery(array $filters): array
    {
        return array_filter([
            'check_in' => $filters['check_in'],
            'check_out' => $filters['check_out'],
            'adults' => $filters['adults'],
            'children' => $filters['children'],
            'promo_code' => $filters['promo_code'] ?? null,
        ], fn ($value) => $value !== null && $value !== '');
    }

    /**
     * Payment methods available on the checkout page.
     * Enable Razorpay here when gateway credentials are configured.
     *
     * @return array<string, array{label: string, description: string, enabled: bool}>
     */
    private function resolvePromoCode(?string $promoCodeValue, float $baseAmount): ?array
    {
        $code = trim((string) $promoCodeValue);

        if ($code === '') {
            return null;
        }

        $promoCode = PromoCode::query()->where('code', strtoupper($code))->first();

        if (! $promoCode || ! $promoCode->isApplicable()) {
            return null;
        }

        $discountAmount = $promoCode->calculateDiscount($baseAmount);

        return [
            'code' => $promoCode->code,
            'discount_amount' => $discountAmount,
            'promo_code' => $promoCode,
        ];
    }

    private function availablePaymentMethods(): array
    {
        return [
            Booking::PAYMENT_COD => [
                'label' => 'Pay at Hotel (COD)',
                'description' => 'Reserve now and pay at the front desk during check-in.',
                'enabled' => true,
            ],
            Booking::PAYMENT_RAZORPAY => [
                'label' => 'Pay Online (Razorpay)',
                'description' => 'Secure online payment will be available soon.',
                'enabled' => false,
            ],
        ];
    }
}
