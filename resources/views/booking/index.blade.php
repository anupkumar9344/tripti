@extends('layouts.app')

@section('title', 'Book Online | Tripti Hotel')

@section('content')
    <section class="booking-page booking-page-no-breadcrumb">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger booking-alert">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success booking-alert">{{ session('success') }}</div>
            @endif

            <form action="{{ route('booking') }}" method="GET" class="booking-search-bar" id="bookingSearchForm">
                <div class="booking-search-brand">
                    <strong>Book Online</strong>
                    <span>Guaranteed accommodation</span>
                </div>

                <div class="booking-search-fields">
                    <label class="booking-field">
                        <span class="booking-field-label">Check-in</span>
                        <span class="booking-field-control">
                            <input type="date" name="check_in" value="{{ $filters['check_in'] }}" min="{{ date('Y-m-d') }}" required>
                            <i class="ri-calendar-line" aria-hidden="true"></i>
                        </span>
                    </label>

                    <label class="booking-field">
                        <span class="booking-field-label">Check-out</span>
                        <span class="booking-field-control">
                            <input type="date" name="check_out" value="{{ $filters['check_out'] }}" min="{{ $filters['check_in'] ?: date('Y-m-d') }}" required>
                            <i class="ri-calendar-line" aria-hidden="true"></i>
                        </span>
                    </label>

                    <div class="booking-field booking-field-guests">
                        <span class="booking-field-label">Guests</span>
                        <div class="booking-guests-row">
                            <label>
                                <span class="visually-hidden">Adults</span>
                                <select name="adults" aria-label="Adults">
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" @selected((int) $filters['adults'] === $i)>{{ $i }} adult{{ $i === 1 ? '' : 's' }}</option>
                                    @endfor
                                </select>
                            </label>
                            <label>
                                <span class="visually-hidden">Children</span>
                                <select name="children" aria-label="Children">
                                    @for ($i = 0; $i <= 4; $i++)
                                        <option value="{{ $i }}" @selected((int) $filters['children'] === $i)>{{ $i }} child{{ $i === 1 ? '' : 'ren' }}</option>
                                    @endfor
                                </select>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="booking-search-btn">Find Room</button>
            </form>

            @if ($filters['searched'])
                <div class="booking-results-head">
                    <div>
                        <h2>Available Rooms</h2>
                        <p>
                            {{ \Carbon\Carbon::parse($filters['check_in'])->format('d M Y') }}
                            –
                            {{ \Carbon\Carbon::parse($filters['check_out'])->format('d M Y') }}
                            <span>·</span>
                            {{ $filters['nights'] }} night{{ $filters['nights'] === 1 ? '' : 's' }}
                            <span>·</span>
                            {{ $filters['guests_label'] }}
                        </p>
                    </div>
                </div>

                <div class="row g-4 booking-results-grid">
                    @forelse ($roomTypes as $roomType)
                        <div class="col-lg-6">
                            <article class="booking-room-card">
                                <div class="booking-room-media">
                                    <img src="{{ $roomType->imageUrl() }}" alt="{{ $roomType->name }}">
                                    <span class="booking-room-badge">{{ $roomType->categoryLabel() }}</span>
                                </div>
                                <div class="booking-room-body">
                                    <div class="booking-room-copy">
                                        <h3>{{ $roomType->name }}</h3>
                                        @if ($roomType->short_description)
                                            <p>{{ $roomType->short_description }}</p>
                                        @endif
                                        <ul class="booking-room-meta">
                                            <li><i class="ri-user-line"></i> Up to {{ $roomType->max_adults }} adults</li>
                                            <li><i class="ri-user-smile-line"></i> Up to {{ $roomType->max_children }} children</li>
                                            <li><i class="ri-hotel-bed-line"></i> {{ $roomType->available_units }} available</li>
                                        </ul>
                                    </div>
                                    <div class="booking-room-price">
                                        <div class="booking-room-fare">
                                            <span>From</span>
                                            <strong>₹{{ number_format((float) $roomType->fare, 0) }}</strong>
                                            <span>/ night</span>
                                        </div>
                                        <div class="booking-room-total">
                                            Stay total: <strong>₹{{ number_format((float) $roomType->stay_total, 0) }}</strong>
                                        </div>
                                        <a
                                            href="{{ route('booking.checkout', array_filter([
                                                'room_type' => $roomType->id,
                                                'check_in' => $filters['check_in'],
                                                'check_out' => $filters['check_out'],
                                                'adults' => $filters['adults'],
                                                'children' => $filters['children'],
                                                'promo_code' => $filters['promo_code'] ?? null,
                                            ])) }}"
                                            class="booking-room-btn"
                                        >
                                            Select Room
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="booking-empty">
                                <i class="ri-hotel-bed-line"></i>
                                <h3>No rooms available</h3>
                                <p>Try different dates or guest counts. You can also contact us for special arrangements.</p>
                                <a href="{{ route('contact') }}" class="booking-room-btn">Contact Us</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="booking-empty booking-empty-start">
                    <i class="ri-calendar-check-line"></i>
                    <h3>Start your reservation</h3>
                    <p>Choose check-in, check-out, and guests above to see available room types and rates.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

