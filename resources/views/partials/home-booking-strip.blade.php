@php
    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
@endphp

<section class="home-booking-strip-wrap pt-4">
    <div class="container">
        <form action="{{ route('booking') }}" method="GET" class="home-booking-strip" id="homeBookingStrip">
            <div class="home-booking-strip-brand">
                <strong>Book Online</strong>
                <span>Guaranteed accommodation</span>
            </div>

            <div class="home-booking-strip-fields">
                <label class="home-booking-field">
                    <span class="home-booking-field-label">Check-in</span>
                    <span class="home-booking-field-control">
                        <input type="date" name="check_in" value="{{ $today }}" min="{{ $today }}" required>
                        <i class="ri-calendar-line" aria-hidden="true"></i>
                    </span>
                </label>

                <label class="home-booking-field">
                    <span class="home-booking-field-label">Check-out</span>
                    <span class="home-booking-field-control">
                        <input type="date" name="check_out" value="{{ $tomorrow }}" min="{{ $tomorrow }}" required>
                        <i class="ri-calendar-line" aria-hidden="true"></i>
                    </span>
                </label>

                <div class="home-booking-field home-booking-field-guests">
                    <span class="home-booking-field-label">Guests</span>
                    <div class="home-booking-guests">
                        <label>
                            <span class="visually-hidden">Adults</span>
                            <select name="adults" aria-label="Adults">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($i === 2)>{{ $i }} adult{{ $i === 1 ? '' : 's' }}</option>
                                @endfor
                            </select>
                        </label>
                        <label>
                            <span class="visually-hidden">Children</span>
                            <select name="children" aria-label="Children">
                                @for ($i = 0; $i <= 4; $i++)
                                    <option value="{{ $i }}">{{ $i }} child{{ $i === 1 ? '' : 'ren' }}</option>
                                @endfor
                            </select>
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-pill btn-pill--dark home-booking-strip-btn">Find Room</button>
        </form>
    </div>
</section>
