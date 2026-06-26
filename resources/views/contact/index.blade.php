@extends('layouts.app')

@section('title', 'Contact Us | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Contact Us', 'breadcrumb' => 'Contact'])

    @php
        $clinicName = $settings['website_name'] ?: 'Sahaj Aarogyam - Main Clinic';
        $defaultMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSahaj%20Aarogyam!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin';
        $mapEmbed = $settings['google_map_embed'] ?: $defaultMap;
        $openingHours = $settings['opening_hours'] ?: "Mon - Sat: 9:00 AM - 8:00 PM\nSunday: Closed";
    @endphp

    <!-- Our Locations Section Start -->
    <div class="contact-locations-section">
        <div class="container">
            <div class="contact-locations-header text-center">
                <h2 class="wow fadeInUp">Our Locations</h2>
                <p class="wow fadeInUp" data-wow-delay="0.1s">Visit us at our clinic in Indore for personalized care and holistic healing.</p>
            </div>

            <div class="row align-items-start g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="contact-locations-info wow fadeInUp" data-wow-delay="0.15s">
                        <div class="contact-locations-item">
                            <div class="contact-locations-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="contact-locations-content">
                                <h3>{{ $clinicName }}</h3>
                                <p>{{ $settings['address'] ?: '560 Sector B Greater Brajeshwari, Near Agrawal Public School, Indore, India, 452001' }}</p>
                            </div>
                        </div>

                        <div class="contact-locations-item">
                            <div class="contact-locations-icon">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="contact-locations-content">
                                <h3>Opening Hours</h3>
                                @foreach (preg_split('/\r\n|\r|\n/', $openingHours) as $line)
                                    @if (trim($line) !== '')
                                        <p>{{ trim($line) }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        @php
                            $phonePrimary = $settings['phone_1'] ?: '+91 94259 63336';
                            $emailPrimary = $settings['email_1'] ?: 'info@sahajaarogyam.com';
                            $emailSecondary = $settings['email_2'] ?: 'sahajaarogyam@gmail.com';
                        @endphp

                        <div class="contact-locations-item">
                            <div class="contact-locations-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="contact-locations-content">
                                <h3>Phone</h3>
                                <p><a href="tel:{{ preg_replace('/\s+/', '', $phonePrimary) }}">{{ $phonePrimary }}</a></p>
                                @if ($settings['phone_2'])
                                    <p><a href="tel:{{ preg_replace('/\s+/', '', $settings['phone_2']) }}">{{ $settings['phone_2'] }}</a></p>
                                @endif
                            </div>
                        </div>

                        <div class="contact-locations-item">
                            <div class="contact-locations-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="contact-locations-content">
                                <h3>Email</h3>
                                <p><a href="mailto:{{ $emailPrimary }}">{{ $emailPrimary }}</a></p>
                                @if ($emailSecondary)
                                    <p><a href="mailto:{{ $emailSecondary }}">{{ $emailSecondary }}</a></p>
                                @endif
                            </div>
                        </div>

                        @if ($settings['facebook_url'] || $settings['instagram_url'] || $settings['youtube_url'] || $settings['whatsapp_number'])
                            <div class="contact-locations-social">
                                @if ($settings['facebook_url'])
                                    <a href="{{ $settings['facebook_url'] }}" class="contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                                @endif
                                @if ($settings['instagram_url'])
                                    <a href="{{ $settings['instagram_url'] }}" class="contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                                @endif
                                @if ($settings['youtube_url'])
                                    <a href="{{ $settings['youtube_url'] }}" class="contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                                @endif
                                @if ($settings['whatsapp_number'])
                                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp_number']) }}" class="contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-locations-map wow fadeInUp" data-wow-delay="0.2s">
                        <iframe src="{{ $mapEmbed }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Clinic location map"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Locations Section End -->

    <!-- Contact Message Section Start -->
    <div class="contact-message-section">
        <div class="container">
            <div class="contact-message-box wow fadeInUp">
                <div class="contact-message-header">
                    <h2>Send Us a Message</h2>
                    <p>Fill out the form below and our team will get in touch with you.</p>
                </div>

                <div class="contact-message-form-wrap">
                    <form id="contactPageForm" action="#" method="POST" novalidate>
                        <div class="row g-3 g-md-4">
                            <div class="col-md-6">
                                <label class="form-label" for="contact_name">Your Name <span>*</span></label>
                                <input type="text" class="form-control" id="contact_name" name="name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="contact_email">Email Address <span>*</span></label>
                                <input type="email" class="form-control" id="contact_email" name="email" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="contact_phone">Phone Number <span>*</span></label>
                                <input type="tel" class="form-control" id="contact_phone" name="phone" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="contact_subject">Subject</label>
                                <input type="text" class="form-control" id="contact_subject" name="subject">
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="contact_message">Your Message <span>*</span></label>
                                <textarea class="form-control" id="contact_message" name="message" rows="5" required></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn-default btn-highlighted contact-message-submit">Send Message</button>
                            </div>
                        </div>
                    </form>

                    <div class="contact-message-success d-none" role="status">
                        <i class="fa-solid fa-circle-check"></i>
                        <h3>Message Sent</h3>
                        <p>Thank you for reaching out. This is a demo form — we will connect the live workflow later.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Message Section End -->
@endsection
