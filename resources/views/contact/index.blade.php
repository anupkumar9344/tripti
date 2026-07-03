@extends('layouts.app')

@section('title', 'Contact Us | ' . ($settings['website_name'] ?? 'Tripti Hotel'))

@section('content')
    @php
        $pageTitle = $settings['contact_locations_title'] ?? 'Get In Touch';
        $pageIntro = $settings['contact_locations_description'] ?? 'We are here to help with reservations, events, and any questions about your stay at Tripti Hotel.';
        $formTitle = $settings['contact_form_title'] ?? 'Send Us a Message';
        $formIntro = $settings['contact_form_description'] ?? 'Fill out the form below and our team will respond as soon as possible.';

        $address = $settings['address'] ?? '987-A, Dudhivadar, Rajkot, Gujarat, Bharat - 360410';
        $phone = $settings['phone_1'] ?? '+91 98765 43210';
        $phone2 = $settings['phone_2'] ?? null;
        $email = $settings['email_1'] ?? 'info@triptihotel.com';
        $email2 = $settings['email_2'] ?? null;
        $hours = $settings['opening_hours'] ?? null;
        $whatsapp = preg_replace('/\D+/', '', (string) ($settings['whatsapp_number'] ?? ''));
        $phoneDigits = preg_replace('/\D+/', '', (string) $phone);

        $mapEmbed = trim((string) ($settings['google_map_embed'] ?? ''));
        if (str_contains($mapEmbed, '<iframe') && preg_match('/src=["\']([^"\']+)["\']/', $mapEmbed, $mapMatch)) {
            $mapEmbed = $mapMatch[1];
        }
        if ($mapEmbed === '') {
            $mapEmbed = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTripti%20Hotel!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin';
        }

        $socialLinks = array_filter([
            ['url' => $settings['facebook_url'] ?? null, 'icon' => 'ri-facebook-fill', 'label' => 'Facebook'],
            ['url' => $settings['instagram_url'] ?? null, 'icon' => 'ri-instagram-line', 'label' => 'Instagram'],
            ['url' => $settings['youtube_url'] ?? null, 'icon' => 'ri-youtube-fill', 'label' => 'YouTube'],
        ], fn (array $item) => filled($item['url']));
    @endphp

    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Contact Us'])

    <section class="contact-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="contact-page-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="contact-page-eyebrow">Contact Us</span>
                <h1 class="contact-page-title">{{ $pageTitle }}</h1>
                <p class="contact-page-intro">{{ $pageIntro }}</p>
            </div>

            <div class="row g-4 contact-page-cards" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <span class="contact-info-card-icon"><i class="ri-map-pin-line"></i></span>
                        <h3>Address</h3>
                        <p>{{ $address }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <span class="contact-info-card-icon"><i class="ri-phone-line"></i></span>
                        <h3>Phone</h3>
                        <p><a href="tel:{{ $phoneDigits }}">{{ $phone }}</a></p>
                        @if ($phone2)
                            <p><a href="tel:{{ preg_replace('/\D+/', '', $phone2) }}">{{ $phone2 }}</a></p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <span class="contact-info-card-icon"><i class="ri-mail-line"></i></span>
                        <h3>Email</h3>
                        <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                        @if ($email2)
                            <p><a href="mailto:{{ $email2 }}">{{ $email2 }}</a></p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <span class="contact-info-card-icon"><i class="ri-time-line"></i></span>
                        <h3>Hours</h3>
                        @if ($hours)
                            <p>{!! nl2br(e($hours)) !!}</p>
                        @else
                            <p>Front Desk: 24 Hours</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <div class="contact-page-map">
                        <iframe
                            src="{{ $mapEmbed }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Tripti Hotel location map"
                        ></iframe>
                    </div>

                    
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="contact-page-form-card">
                        <div class="contact-page-form-header">
                            <h2>{{ $formTitle }}</h2>
                            <p>{{ $formIntro }}</p>
                        </div>

                        <form id="contactPageForm" class="contact-page-form needs-validation" action="{{ route('contact.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="contact_name">Your Name <span>*</span></label>
                                    <input type="text" class="contact-page-input" id="contact_name" name="name" value="{{ old('name') }}" placeholder="Full name" required>
                                    <div class="invalid-feedback">Please enter your name.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="contact-page-label" for="contact_phone">Phone Number <span>*</span></label>
                                    <input type="text" class="contact-page-input" id="contact_phone" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210" required>
                                    <div class="invalid-feedback">Please enter your phone number.</div>
                                </div>
                                <div class="col-12">
                                    <label class="contact-page-label" for="contact_email">Email Address <span>*</span></label>
                                    <input type="email" class="contact-page-input" id="contact_email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                                <div class="col-12">
                                    <label class="contact-page-label" for="contact_subject">Subject</label>
                                    <input type="text" class="contact-page-input" id="contact_subject" name="subject" value="{{ old('subject') }}" placeholder="Room booking, event inquiry, etc.">
                                </div>
                                <div class="col-12">
                                    <label class="contact-page-label" for="contact_message">Message <span>*</span></label>
                                    <textarea class="contact-page-input" id="contact_message" name="message" rows="5" placeholder="Tell us how we can help you..." required>{{ old('message') }}</textarea>
                                    <div class="invalid-feedback">Please enter your message.</div>
                                </div>
                                <div class="col-12">
                                    <div class="contact-message-error d-none" role="alert"></div>
                                    <button type="submit" class="contact-page-submit contact-message-submit">
                                        <span class="contact-message-submit-text">Send Message</span>
                                        <span class="contact-message-submit-loader d-none">Sending...</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="contact-message-success d-none" role="status">
                            <div class="contact-message-success-icon"><i class="ri-checkbox-circle-line"></i></div>
                            <h3>Message Sent</h3>
                            <p class="contact-message-success-text">Thank you for reaching out. Our team will get in touch with you shortly.</p>
                            <button type="button" class="contact-page-submit contact-message-reset">Send Another Message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
