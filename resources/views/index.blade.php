@extends('layouts.app')

@section('title', 'Sahaj Aarogyam')

@section('content')
    <!-- Hero Section Start -->
    @include('partials.home-hero-section')
    <!-- Hero Section End -->

<!-- Trust Strip Section Start -->
    @include('partials.home-trust-strip-section')
    <!-- Trust Strip Section End -->

<!-- Home About Intro Section Start -->
    @php
        use App\Models\Setting;

        $homeAboutEyebrow = $settings['about_home_eyebrow'] ?: 'About us';
        $homeAboutTitle = $settings['about_home_title'] ?: 'A holistic path to';
        $homeAboutTitleHighlight = $settings['about_home_title_highlight'] ?: 'natural healing';
        $homeAboutDescription = $settings['about_home_description'] ?: 'At Sahaj Aarogyam, we combine time-tested therapies with modern clinical care to treat pain and chronic conditions without surgery — helping you recover safely, naturally, and with lasting results.';
        $homeAboutImage = Setting::imageUrl($settings['about_home_image'] ?? null);
        $homeAboutBadgeNumber = $settings['about_home_badge_number'] ?: '25';
        $homeAboutBadgeSuffix = $settings['about_home_badge_suffix'] ?? '+';
        $homeAboutBadgeText = $settings['about_home_badge_text'] ?: 'Years of Trusted Care';
        $homeAboutButtonText = $settings['about_home_button_text'] ?: 'Learn More About Us';
    @endphp
    <div class="home-about-intro">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="home-about-intro-media wow fadeInUp">
                        <figure class="home-about-intro-photo">
                            <img src="{{ $homeAboutImage }}" alt="Sahaj Aarogyam expert team">
                        </figure>
                        <div class="home-about-intro-badge">
                            <strong>{{ $homeAboutBadgeNumber }}{{ $homeAboutBadgeSuffix }}</strong>
                            <span>{{ $homeAboutBadgeText }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-about-intro-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $homeAboutEyebrow }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $homeAboutTitle }} <span>{{ $homeAboutTitleHighlight }}</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $homeAboutDescription }}</p>
                        </div>

                        <div class="home-about-intro-btn wow fadeInUp" data-wow-delay="0.3s">
                            <a href="{{ url('/about-us') }}" class="btn-default">{{ $homeAboutButtonText }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Home About Intro Section End -->

<!-- Why Choose Section Start -->
    @include('partials.why-choose-section', [
        'whyChooseItems' => $whyChooseItems,
    ])
    <!-- Why Choose Section End -->

<!-- What We Treat Section Start -->
    @include('partials.treatment-cards', [
        'treatments' => $homeTreatments,
        'showViewAll' => true,
    ])
    <!-- What We Treat Section End -->

<!-- Our Core Services Section Start -->
    @include('partials.service-cards', [
        'services' => $homeServices,
        'showViewAll' => true,
    ])
    <!-- Our Core Services Section End -->

<!-- Health Programs & Camps Section Start -->
    @if ($homeHealthProgram)
        @include('partials.health-program-section', ['program' => $homeHealthProgram, 'showButton' => true, 'variant' => 'home'])
    @endif
    <!-- Health Programs & Camps Section End -->

<!-- Meet Our Experts Section Start -->
    @include('partials.expert-cards', [
        'experts' => $homeExperts,
        'showViewAll' => true,
    ])
    <!-- Meet Our Experts Section End -->

<!-- Patient Feedback Section Start -->
    @include('partials.patient-feedback-section')
    <!-- Patient Feedback Section End -->

<!-- Video Feedback Reels Section Start -->
    @include('partials.video-feedback-section', ['videoFeedbacks' => $homeVideoFeedbacks])
    <!-- Video Feedback Reels Section End -->

<!-- Gallery Section Start -->
    @include('partials.home-gallery-section')
    <!-- Gallery Section End -->

<!-- Blog Post Section Start -->
    @include('partials.home-blog-section')
    <!-- Blog Post Section End -->

<!-- FAQ Section Start -->
    @include('partials.home-faq-section')
    <!-- FAQ Section End -->

<!-- Location Map Section Start -->
    @php
        $defaultMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSahaj%20Aarogyam!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin';
        $mapEmbed = ($settings['google_map_embed'] ?? '') ?: $defaultMap;
        $visitEyebrow = ($settings['visit_us_eyebrow'] ?? '') ?: 'Visit Us';
        $visitTitle = ($settings['visit_us_title'] ?? '') ?: 'Serving Indore & Nearby';
        $visitDescription = ($settings['visit_us_description'] ?? '') ?: 'Conveniently located in the heart of Indore, we proudly serve patients from across the city and nearby areas.';
        $visitBgImage = \App\Models\Setting::imageUrl($settings['visit_us_bg_image'] ?? null, 'home-about-team.jpg');
        $locationAddress = ($settings['address'] ?? '') ?: '560 Sector B Greater Brajeshwari, Near Agrawal Public School, Indore, India, 452001';
        $locationPhone = ($settings['phone_1'] ?? '') ?: '+91 94259 63336';
        $locationEmailPrimary = ($settings['email_1'] ?? '') ?: 'info@sahajaarogyam.com';
        $locationEmailSecondary = ($settings['email_2'] ?? '') ?: 'sahajaarogyam@gmail.com';
    @endphp
    <div class="home-location-map" id="location" style="background-image: url('{{ $visitBgImage }}');">
        <div class="home-location-map-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center g-4 g-xl-5">
                <div class="col-lg-6">
                    <div class="home-location-content wow fadeInUp">
                        <span class="home-location-eyebrow">{{ $visitEyebrow }}</span>
                        <h2>{{ $visitTitle }}</h2>
                        <p>{{ $visitDescription }}</p>

                        <ul class="home-location-details">
                            <li>
                                <span class="home-location-icon"><i class="fa-solid fa-location-dot"></i></span>
                                <div class="home-location-item-body">
                                    <strong>Clinic Address</strong>
                                    <span>{{ $locationAddress }}</span>
                                </div>
                            </li>
                            <li>
                                <span class="home-location-icon"><i class="fa-solid fa-phone"></i></span>
                                <div class="home-location-item-body">
                                    <strong>Phone</strong>
                                    <span><a href="tel:{{ preg_replace('/\s+/', '', $locationPhone) }}">{{ $locationPhone }}</a></span>
                                </div>
                            </li>
                            <li>
                                <span class="home-location-icon"><i class="fa-solid fa-envelope"></i></span>
                                <div class="home-location-item-body">
                                    <strong>Email</strong>
                                    <span>
                                        <a href="mailto:{{ $locationEmailPrimary }}">{{ $locationEmailPrimary }}</a><br>
                                        <a href="mailto:{{ $locationEmailSecondary }}">{{ $locationEmailSecondary }}</a>
                                    </span>
                                </div>
                            </li>
                        </ul>

                        <div class="home-location-action">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Contact Us</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-location-map-frame wow fadeInUp" data-wow-delay="0.15s">
                        <iframe
                            src="{{ $mapEmbed }}"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Sahaj Aarogyam clinic location on Google Maps"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Map Section End -->

@endsection
