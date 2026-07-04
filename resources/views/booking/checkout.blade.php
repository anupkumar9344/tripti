@extends('layouts.app')

@section('title', 'Checkout | Tripti Hotel')

@section('content')
    <section class="booking-page booking-checkout-page booking-page-no-breadcrumb">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger booking-alert">{{ session('error') }}</div>
            @endif

            <div class="booking-steps">
                <span class="is-done">1. Dates</span>
                <span class="is-done">2. Room</span>
                <span class="is-active">3. Guest &amp; Payment</span>
            </div>

            <div class="booking-checkout-layout">
                <div class="booking-checkout-main">
                    <form action="{{ route('booking.store') }}" method="POST" class="booking-checkout-form" novalidate>
                        @csrf
                        <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                        <input type="hidden" name="check_in" value="{{ $filters['check_in'] }}">
                        <input type="hidden" name="check_out" value="{{ $filters['check_out'] }}">
                        <input type="hidden" name="adults" value="{{ $filters['adults'] }}">
                        <input type="hidden" name="children" value="{{ $filters['children'] }}">

                        <div class="booking-card">
                            <h2 class="booking-card-title">Customer</h2>

                            <div class="booking-for-group">
                                <span class="booking-label">I'm booking for</span>
                                <div class="booking-toggle">
                                    <label class="booking-toggle-option">
                                        <input type="radio" name="booking_for" value="myself" @checked(old('booking_for', 'myself') === 'myself')>
                                        <span>Myself</span>
                                    </label>
                                    <label class="booking-toggle-option">
                                        <input type="radio" name="booking_for" value="someone_else" @checked(old('booking_for') === 'someone_else')>
                                        <span>Someone else</span>
                                    </label>
                                </div>
                                <p class="booking-help">Enter the details of the primary guest. Other guests’ details can be provided at check-in.</p>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="booking-label" for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="booking-input @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="booking-label" for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="booking-input @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="booking-label" for="phone">Phone Number</label>
                                    <div class="booking-input-icon">
                                        <i class="ri-phone-line"></i>
                                        <input type="text" id="phone" name="phone" class="booking-input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+91 98765 43210" required>
                                    </div>
                                    @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="booking-label" for="email">Email Address</label>
                                    <div class="booking-input-icon">
                                        <i class="ri-mail-line"></i>
                                        <input type="email" id="email" name="email" class="booking-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="booking-label" for="country">Country</label>
                                    <input type="text" id="country" name="country" class="booking-input @error('country') is-invalid @enderror" value="{{ old('country', 'India') }}">
                                    @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="booking-checks mt-3">
                                <label class="booking-check">
                                    <input type="checkbox" name="marketing_consent" value="1" @checked(old('marketing_consent'))>
                                    <span>I give my consent to receive news and information about special offers.</span>
                                </label>
                                <label class="booking-check">
                                    <input type="checkbox" name="terms_accepted" value="1" @checked(old('terms_accepted')) required>
                                    <span>
                                        I give my consent to personal data processing and confirm that I have read the
                                        <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms and policies</a>
                                        and the
                                        <a href="{{ route('privacy-policy') }}" target="_blank">Privacy policy</a>.
                                    </span>
                                </label>
                                @error('terms_accepted')<div class="text-danger font-13 mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        @php
                            $oldGuests = old('guests', [['first_name' => '', 'last_name' => '', 'country' => 'India']]);
                            if (! is_array($oldGuests) || $oldGuests === []) {
                                $oldGuests = [['first_name' => '', 'last_name' => '', 'country' => 'India']];
                            }
                        @endphp

                        <div
                            class="booking-card booking-guests-card{{ old('booking_for', 'myself') === 'someone_else' ? ' is-visible' : '' }}"
                            id="bookingGuestsCard"
                            @if (old('booking_for', 'myself') !== 'someone_else') hidden @endif
                        >
                            <h2 class="booking-card-title">Guests</h2>
                            <p class="booking-help mb-3">Add the people who will stay. You can add more guests if needed.</p>

                            <div id="bookingGuestsList" class="booking-guests-list">
                                @foreach ($oldGuests as $index => $guest)
                                    <div class="booking-guest-row" data-guest-row>
                                        <div class="booking-guest-row-head">
                                            <strong>Guest <span data-guest-number>{{ $index + 1 }}</span>:</strong>
                                            <button type="button" class="booking-guest-remove" data-remove-guest @if ($index === 0) hidden @endif>
                                                Remove
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="guests[{{ $index }}][first_name]"
                                                    class="booking-input"
                                                    placeholder="First name"
                                                    value="{{ $guest['first_name'] ?? '' }}"
                                                >
                                            </div>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="guests[{{ $index }}][last_name]"
                                                    class="booking-input"
                                                    placeholder="Last name"
                                                    value="{{ $guest['last_name'] ?? '' }}"
                                                >
                                            </div>
                                            <div class="col-md-6">
                                                <label class="booking-label">Country</label>
                                                <input
                                                    type="text"
                                                    name="guests[{{ $index }}][country]"
                                                    class="booking-input"
                                                    placeholder="Country"
                                                    value="{{ $guest['country'] ?? 'India' }}"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="booking-guests-actions">
                                <button type="button" class="booking-add-guest-btn" id="bookingAddGuestBtn">
                                    + Add a guest
                                </button>
                                <span>Optional</span>
                            </div>
                        </div>

                        <div class="booking-card">
                            <h2 class="booking-card-title">Additional information</h2>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="booking-label" for="check_in_time">Check-in time</label>
                                    <select id="check_in_time" name="check_in_time" class="booking-input">
                                        @foreach (['12:00', '12:30', '13:00', '14:00', '15:00', '16:00'] as $time)
                                            <option value="{{ $time }}" @selected(old('check_in_time', '14:00') === $time)>{{ $time }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="booking-label" for="check_out_time">Check-out time</label>
                                    <select id="check_out_time" name="check_out_time" class="booking-input">
                                        @foreach (['10:00', '11:00', '12:00'] as $time)
                                            <option value="{{ $time }}" @selected(old('check_out_time', '11:00') === $time)>{{ $time }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="booking-label" for="special_requests">Personal request</label>
                                    <textarea id="special_requests" name="special_requests" class="booking-input booking-textarea" rows="4" placeholder="If you have any special needs, please feel free to share them with us. We’ll do our best to help you.">{{ old('special_requests') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="booking-label" for="promo_code">Promo code (optional)</label>
                                    <input type="text" id="promo_code" name="promo_code" class="booking-input" value="{{ old('promo_code', $filters['promo_code'] ?? '') }}" placeholder="I have a promo code">
                                </div>
                            </div>
                        </div>

                        <div class="booking-card">
                            <h2 class="booking-card-title">Payment method</h2>
                            <div class="booking-payment-list">
                                @foreach ($paymentMethods as $key => $method)
                                    <label class="booking-payment-option {{ ! $method['enabled'] ? 'is-disabled' : '' }}">
                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="{{ $key }}"
                                            @checked(old('payment_method', 'cod') === $key)
                                            @disabled(! $method['enabled'])
                                        >
                                        <span class="booking-payment-body">
                                            <strong>
                                                @if ($key === 'cod')
                                                    <i class="ri-cash-line"></i>
                                                @else
                                                    <i class="ri-bank-card-line"></i>
                                                @endif
                                                {{ $method['label'] }}
                                            </strong>
                                            <span>{{ $method['description'] }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('payment_method')<div class="text-danger font-13 mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="booking-checkout-actions">
                            <a href="{{ route('booking', array_filter([
                                'check_in' => $filters['check_in'],
                                'check_out' => $filters['check_out'],
                                'adults' => $filters['adults'],
                                'children' => $filters['children'],
                                'promo_code' => $filters['promo_code'] ?? null,
                            ])) }}" class="booking-back-link">
                                <i class="ri-arrow-left-line"></i> Back to rooms
                            </a>
                            <button type="submit" class="booking-search-btn">Confirm Booking</button>
                        </div>
                    </form>
                </div>

                <aside class="booking-checkout-aside">
                    <div class="booking-summary">
                        <h3>Stay summary</h3>
                        <div class="booking-summary-room">
                            <img src="{{ $roomType->imageUrl() }}" alt="{{ $roomType->name }}">
                            <div>
                                <strong>{{ $roomType->name }}</strong>
                                <span>{{ $roomType->categoryLabel() }}</span>
                            </div>
                        </div>
                        <ul class="booking-summary-list">
                            <li>
                                <span>Check-in</span>
                                <strong>{{ \Carbon\Carbon::parse($filters['check_in'])->format('d M Y') }}</strong>
                            </li>
                            <li>
                                <span>Check-out</span>
                                <strong>{{ \Carbon\Carbon::parse($filters['check_out'])->format('d M Y') }}</strong>
                            </li>
                            <li>
                                <span>Guests</span>
                                <strong>{{ $filters['guests_label'] }}</strong>
                            </li>
                            <li>
                                <span>Nights</span>
                                <strong>{{ $filters['nights'] }}</strong>
                            </li>
                            <li>
                                <span>Room fare</span>
                                <strong>₹{{ number_format((float) $roomType->fare, 0) }} / night</strong>
                            </li>
                        </ul>
                        <div class="booking-summary-total">
                            <span>Total</span>
                            <strong>₹{{ number_format((float) $stayTotal, 0) }}</strong>
                        </div>
                        <p class="booking-summary-note">Your booking will be pending until our team confirms availability.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const guestsCard = document.getElementById('bookingGuestsCard');
            const guestsList = document.getElementById('bookingGuestsList');
            const addGuestBtn = document.getElementById('bookingAddGuestBtn');
            const bookingForInputs = document.querySelectorAll('input[name="booking_for"]');
            const maxGuests = 8;

            if (!guestsCard || !guestsList || !addGuestBtn) return;

            function toggleGuestsCard() {
                const selected = document.querySelector('input[name="booking_for"]:checked');
                const show = selected && selected.value === 'someone_else';
                guestsCard.hidden = !show;
                guestsCard.classList.toggle('is-visible', show);
            }

            function renumberGuests() {
                guestsList.querySelectorAll('[data-guest-row]').forEach(function (row, index) {
                    const number = row.querySelector('[data-guest-number]');
                    if (number) number.textContent = String(index + 1);

                    row.querySelectorAll('input').forEach(function (input) {
                        const field = input.name.match(/\[(first_name|last_name|country)\]$/);
                        if (field) {
                            input.name = 'guests[' + index + '][' + field[1] + ']';
                        }
                    });

                    const removeBtn = row.querySelector('[data-remove-guest]');
                    if (removeBtn) {
                        removeBtn.hidden = index === 0 && guestsList.querySelectorAll('[data-guest-row]').length === 1;
                    }
                });
            }

            function createGuestRow(index) {
                const row = document.createElement('div');
                row.className = 'booking-guest-row';
                row.setAttribute('data-guest-row', '');
                row.innerHTML =
                    '<div class="booking-guest-row-head">' +
                        '<strong>Guest <span data-guest-number>' + (index + 1) + '</span>:</strong>' +
                        '<button type="button" class="booking-guest-remove" data-remove-guest>Remove</button>' +
                    '</div>' +
                    '<div class="row g-3">' +
                        '<div class="col-md-6">' +
                            '<input type="text" name="guests[' + index + '][first_name]" class="booking-input" placeholder="First name">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                            '<input type="text" name="guests[' + index + '][last_name]" class="booking-input" placeholder="Last name">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                            '<label class="booking-label">Country</label>' +
                            '<input type="text" name="guests[' + index + '][country]" class="booking-input" placeholder="Country" value="India">' +
                        '</div>' +
                    '</div>';
                return row;
            }

            bookingForInputs.forEach(function (input) {
                input.addEventListener('change', toggleGuestsCard);
            });

            addGuestBtn.addEventListener('click', function () {
                const count = guestsList.querySelectorAll('[data-guest-row]').length;
                if (count >= maxGuests) return;
                guestsList.appendChild(createGuestRow(count));
                renumberGuests();
            });

            guestsList.addEventListener('click', function (event) {
                const removeBtn = event.target.closest('[data-remove-guest]');
                if (!removeBtn) return;

                const row = removeBtn.closest('[data-guest-row]');
                if (!row) return;

                if (guestsList.querySelectorAll('[data-guest-row]').length === 1) {
                    row.querySelectorAll('input').forEach(function (input) {
                        if (input.name.includes('[country]')) {
                            input.value = 'India';
                        } else {
                            input.value = '';
                        }
                    });
                    return;
                }

                row.remove();
                renumberGuests();
            });

            toggleGuestsCard();
            renumberGuests();
        });
    </script>
@endpush
