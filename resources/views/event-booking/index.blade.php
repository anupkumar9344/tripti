@extends('layouts.app')

@section('title', 'Banquet & Meeting Booking | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Banquet & Meeting Booking'])

    <section class="contact-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="contact-page-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="contact-page-eyebrow">Events</span>
                <h1 class="contact-page-title">Banquet & Meeting Booking</h1>
                <p class="contact-page-intro">Plan your banquet, conference, or meeting at Tripti Hotel. Share your event details and our team will get back to you with availability and pricing.</p>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="col-lg-8">
                    <div class="contact-page-form-card">
                        <div class="contact-page-form-header">
                            <h2>Request a Booking</h2>
                            <p>Fill in the details below. Fields marked with * are required.</p>
                        </div>

                        <form id="eventBookingForm" class="contact-page-form needs-validation" action="{{ route('event-booking.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="booking_type">Booking Type <span>*</span></label>
                                    <select class="contact-page-input" id="booking_type" name="booking_type" required>
                                        <option value="banquet" @selected(old('booking_type') === 'banquet')>Banquet</option>
                                        <option value="meeting" @selected(old('booking_type') === 'meeting')>Meeting</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a booking type.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="contact_name">Your Name <span>*</span></label>
                                    <input type="text" class="contact-page-input" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" placeholder="Full name" required>
                                    <div class="invalid-feedback">Please enter your name.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="phone">Phone Number <span>*</span></label>
                                    <input type="text" class="contact-page-input" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210" required>
                                    <div class="invalid-feedback">Please enter your phone number.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="email">Email Address</label>
                                    <input type="email" class="contact-page-input" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="company_name">Company / Organization</label>
                                    <input type="text" class="contact-page-input" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Optional">
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="number_of_people">Number of People <span>*</span></label>
                                    <input type="number" min="1" class="contact-page-input" id="number_of_people" name="number_of_people" value="{{ old('number_of_people') }}" placeholder="e.g. 50" required>
                                    <div class="invalid-feedback">Please enter the number of guests.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="program_name">Program / Event Name <span>*</span></label>
                                    <input type="text" class="contact-page-input" id="program_name" name="program_name" value="{{ old('program_name') }}" placeholder="e.g. Annual Meet, Wedding Reception" required>
                                    <div class="invalid-feedback">Please enter the program name.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="contact-page-label" for="event_date">Event Date <span>*</span></label>
                                    <input type="date" class="contact-page-input" id="event_date" name="event_date" value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
                                    <div class="invalid-feedback">Please select the event date.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="contact-page-label" for="event_time">Event Time</label>
                                    <input type="time" class="contact-page-input" id="event_time" name="event_time" value="{{ old('event_time') }}">
                                </div>
                                <div class="col-12">
                                    <label class="contact-page-label" for="purpose">Purpose <span>*</span></label>
                                    <textarea class="contact-page-input" id="purpose" name="purpose" rows="3" placeholder="Briefly describe the purpose of your event..." required>{{ old('purpose') }}</textarea>
                                    <div class="invalid-feedback">Please describe the purpose of your event.</div>
                                </div>
                                <div class="col-12">
                                    <label class="contact-page-label" for="additional_notes">Additional Notes</label>
                                    <textarea class="contact-page-input" id="additional_notes" name="additional_notes" rows="4" placeholder="Catering preferences, seating layout, AV requirements, etc.">{{ old('additional_notes') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <div class="contact-message-error event-booking-error d-none" role="alert"></div>
                                    <button type="submit" class="contact-page-submit event-booking-submit">
                                        <span class="event-booking-submit-text">Submit Booking Request</span>
                                        <span class="event-booking-submit-loader d-none">Submitting...</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="contact-message-success event-booking-success d-none" role="status">
                            <div class="contact-message-success-icon"><i class="ri-checkbox-circle-line"></i></div>
                            <h3>Request Received</h3>
                            <p class="event-booking-success-text">Thank you! Our events team will contact you shortly.</p>
                            <button type="button" class="contact-page-submit event-booking-reset">Submit Another Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function () {
            const $form = $('#eventBookingForm');
            if (!$form.length) return;

            $form.on('submit', function (event) {
                event.preventDefault();

                if (!this.checkValidity()) {
                    event.stopPropagation();
                    $form.addClass('was-validated');
                    return;
                }

                const $submitBtn = $form.find('.event-booking-submit');
                const $submitText = $form.find('.event-booking-submit-text');
                const $submitLoader = $form.find('.event-booking-submit-loader');
                const $error = $('.event-booking-error');

                $error.addClass('d-none').text('');
                $submitBtn.prop('disabled', true);
                $submitText.addClass('d-none');
                $submitLoader.removeClass('d-none');

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        Accept: 'application/json',
                    },
                    success: function (response) {
                        if (response.message) {
                            $('.event-booking-success-text').text(response.message);
                        }

                        $form.addClass('d-none');
                        $('.event-booking-success').removeClass('d-none');
                    },
                    error: function (xhr) {
                        let message = 'Something went wrong. Please try again.';

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).map(function (items) {
                                return items[0];
                            }).join(' ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        $error.removeClass('d-none').text(message);
                    },
                    complete: function () {
                        $submitBtn.prop('disabled', false);
                        $submitText.removeClass('d-none');
                        $submitLoader.addClass('d-none');
                    },
                });
            });

            $('.event-booking-reset').on('click', function () {
                const form = document.getElementById('eventBookingForm');
                if (form) {
                    form.reset();
                    $form.removeClass('was-validated d-none');
                }

                $('.event-booking-success').addClass('d-none');
                $('.event-booking-error').addClass('d-none').text('');
            });
        })();
    </script>
@endpush
