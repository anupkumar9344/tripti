@extends('layouts.app')

@section('title', 'Careers | ' . ($settings['website_name'] ?? 'Tripti Hotel'))

@section('content')
    @php
        $pageEyebrow = $settings['career_page_eyebrow'] ?? 'Join Our Team';
        $pageTitle = $settings['career_page_title'] ?? 'Build Your Career at Tripti Hotel';
        $pageIntro = $settings['career_page_intro'] ?? 'We are always looking for passionate people to deliver warm hospitality and memorable guest experiences.';
        $formTitle = $settings['career_form_title'] ?? 'Apply Now';
        $formIntro = $settings['career_form_description'] ?? 'Select an opening below and submit your application. Our HR team will contact you if your profile matches the role.';
        $selectedOpeningId = (string) old('career_opening_id', request('opening', ''));
    @endphp

    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Careers'])

    <section class="contact-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="contact-page-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="contact-page-eyebrow">{{ $pageEyebrow }}</span>
                <h1 class="contact-page-title">{{ $pageTitle }}</h1>
                <p class="contact-page-intro">{{ $pageIntro }}</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="career-page-info">
                        <h2>Why work with us?</h2>
                        <p>Tripti Hotel offers a supportive workplace where teamwork, discipline, and guest care matter.</p>
                        <ul class="career-page-list">
                            <li><i class="ri-check-line"></i> Professional hotel environment</li>
                            <li><i class="ri-check-line"></i> Training and on-the-job learning</li>
                            <li><i class="ri-check-line"></i> Friendly and respectful culture</li>
                            <li><i class="ri-check-line"></i> Growth across departments</li>
                        </ul>
                        @if (filled($settings['email_1'] ?? null) || filled($settings['phone_1'] ?? null))
                            <div class="career-page-contact">
                                <p class="mb-2">For HR queries:</p>
                                @if (filled($settings['email_1'] ?? null))
                                    <p class="mb-1"><a href="mailto:{{ $settings['email_1'] }}">{{ $settings['email_1'] }}</a></p>
                                @endif
                                @if (filled($settings['phone_1'] ?? null))
                                    <p class="mb-0"><a href="tel:{{ preg_replace('/\D+/', '', $settings['phone_1']) }}">{{ $settings['phone_1'] }}</a></p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <div class="career-openings-wrap">
                        <div class="career-openings-header">
                            <h2>Current Openings</h2>
                            <p>Select a role and click Apply to continue.</p>
                        </div>

                        @if ($openings->isNotEmpty())
                            <div class="career-openings-list">
                                @foreach ($openings as $opening)
                                    <article class="career-opening-card{{ $selectedOpeningId === (string) $opening->id ? ' is-selected' : '' }}" data-opening-id="{{ $opening->id }}" data-opening-title="{{ $opening->title }}">
                                        <div class="career-opening-card-top">
                                            <div>
                                                <h3>{{ $opening->title }}</h3>
                                                <div class="career-opening-meta">
                                                    @if ($opening->department)
                                                        <span><i class="ri-building-line"></i> {{ $opening->department }}</span>
                                                    @endif
                                                    <span><i class="ri-time-line"></i> {{ $opening->job_type }}</span>
                                                    @if ($opening->location)
                                                        <span><i class="ri-map-pin-line"></i> {{ $opening->location }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="button" class="career-opening-apply-btn js-select-opening" data-opening-id="{{ $opening->id }}" data-opening-title="{{ $opening->title }}">
                                                Apply
                                            </button>
                                        </div>
                                        @if ($opening->description)
                                            <p class="career-opening-description">{{ $opening->description }}</p>
                                        @endif
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div class="career-openings-empty">
                                <p>There are no active openings right now. Please check back soon or contact our HR team.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if ($openings->isNotEmpty())
                <div class="row mt-4" id="careerApplySection" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="col-lg-10 mx-auto">
                        <div class="contact-page-form-card">
                            <div class="contact-page-form-header">
                                <h2>{{ $formTitle }}</h2>
                                <p>{{ $formIntro }}</p>
                            </div>

                            <div class="career-selected-opening d-none" id="careerSelectedOpening">
                                <span class="career-selected-opening-label">Applying for</span>
                                <strong id="careerSelectedOpeningTitle"></strong>
                            </div>

                            <form id="careerPageForm" class="contact-page-form needs-validation" action="{{ route('careers.store') }}" method="POST" novalidate>
                                @csrf
                                <input type="hidden" name="career_opening_id" id="career_opening_id" value="{{ $selectedOpeningId }}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="contact-page-label" for="career_name">Full Name <span>*</span></label>
                                        <input type="text" class="contact-page-input" id="career_name" name="name" value="{{ old('name') }}" placeholder="Your name" required>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="contact-page-label" for="career_phone">Phone Number <span>*</span></label>
                                        <input type="text" class="contact-page-input" id="career_phone" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210" required>
                                        <div class="invalid-feedback">Please enter your phone number.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="contact-page-label" for="career_email">Email Address <span>*</span></label>
                                        <input type="email" class="contact-page-input" id="career_email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="contact-page-label" for="career_message">Short Message</label>
                                        <textarea class="contact-page-input" id="career_message" name="message" rows="4" placeholder="Briefly tell us about your experience or interest">{{ old('message') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="career-message-error d-none" role="alert"></div>
                                        <button type="submit" class="contact-page-submit career-message-submit" id="careerSubmitBtn" disabled>
                                            <span class="career-message-submit-text">Submit Application</span>
                                            <span class="career-message-submit-loader d-none">Submitting...</span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="career-message-success d-none" role="status">
                                <div class="contact-message-success-icon"><i class="ri-checkbox-circle-line"></i></div>
                                <h3>Application Submitted</h3>
                                <p class="career-message-success-text">Thank you for applying. Our HR team will review your application and contact you soon.</p>
                                <button type="button" class="contact-page-submit career-message-reset">Apply for Another Role</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function () {
            var $form = $('#careerPageForm');
            if (!$form.length) {
                return;
            }

            var $openingInput = $('#career_opening_id');
            var $selectedWrap = $('#careerSelectedOpening');
            var $selectedTitle = $('#careerSelectedOpeningTitle');
            var $submitBtn = $('#careerSubmitBtn');

            function selectOpening(id, title) {
                $openingInput.val(id);
                $selectedTitle.text(title);
                $selectedWrap.removeClass('d-none');
                $submitBtn.prop('disabled', false);

                $('.career-opening-card').removeClass('is-selected');
                $('.career-opening-card[data-opening-id="' + id + '"]').addClass('is-selected');

                var section = document.getElementById('careerApplySection');
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            $('.js-select-opening').on('click', function () {
                selectOpening($(this).data('opening-id'), $(this).data('opening-title'));
            });

            if ($openingInput.val()) {
                var initialCard = $('.career-opening-card[data-opening-id="' + $openingInput.val() + '"]');
                if (initialCard.length) {
                    selectOpening($openingInput.val(), initialCard.data('opening-title'));
                }
            }

            $form.on('submit', function (event) {
                event.preventDefault();
                var form = this;

                if (!$openingInput.val()) {
                    $('.career-message-error').removeClass('d-none').text('Please select a job opening first.');
                    return;
                }

                if (!form.checkValidity()) {
                    event.stopPropagation();
                    $form.addClass('was-validated');
                    return;
                }

                var $submitText = $form.find('.career-message-submit-text');
                var $submitLoader = $form.find('.career-message-submit-loader');
                var $error = $('.career-message-error');

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
                            $('.career-message-success-text').text(response.message);
                        }

                        $form.addClass('d-none');
                        $selectedWrap.addClass('d-none');
                        $('.career-message-success').removeClass('d-none');
                    },
                    error: function (xhr) {
                        var message = 'Something went wrong. Please try again.';

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).map(function (items) {
                                return items[0];
                            }).join(' ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        $error.removeClass('d-none').text(message);
                        $submitBtn.prop('disabled', !!$openingInput.val());
                    },
                    complete: function () {
                        $submitText.removeClass('d-none');
                        $submitLoader.addClass('d-none');
                    },
                });
            });

            $('.career-message-reset').on('click', function () {
                var form = document.getElementById('careerPageForm');

                if (form) {
                    form.reset();
                    $form.removeClass('was-validated d-none');
                }

                $openingInput.val('');
                $selectedWrap.addClass('d-none');
                $selectedTitle.text('');
                $submitBtn.prop('disabled', true);
                $('.career-opening-card').removeClass('is-selected');
                $('.career-message-success').addClass('d-none');
                $('.career-message-error').addClass('d-none').text('');
            });
        })();
    </script>
@endpush
