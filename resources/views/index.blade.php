@extends('layouts.app')

@section('title', 'Sahaj Aarogyam')

@section('content')
    @php
        $heroSlides = [
            [
                'image' => 'home-about-team.jpg',
                'eyebrow' => 'Welcome to Sahaj Aarogyam',
                'title' => 'Non-Surgical Healing for Pain & Chronic Conditions',
                'text' => 'Integrated physiotherapy, Ayurveda, and holistic therapies to help you recover safely, naturally, and with lasting results.',
                'primary_label' => 'Book Appointment',
                'primary_url' => url('/contact-us'),
                'secondary_label' => 'Watch Video',
                'secondary_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                'secondary_type' => 'video',
            ],
            [
                'image' => 'gallery-4.jpg',
                'eyebrow' => 'Multidisciplinary Care',
                'title' => 'Ayurveda, Physiotherapy & Wellness Under One Roof',
                'text' => 'Expert-led treatments for back pain, metabolic disorders, detox, rehabilitation, and complete lifestyle wellness.',
                'primary_label' => 'Explore Services',
                'primary_url' => url('/services'),
                'secondary_label' => 'Meet Our Experts',
                'secondary_url' => url('/our-expert-team'),
                'secondary_type' => 'link',
            ],
            [
                'image' => 'faqs-image.jpg',
                'eyebrow' => 'Health Programs & Camps',
                'title' => 'Structured Programs for Long-Term Wellness',
                'text' => 'Join weight management, spine care, detox, and community wellness camps designed for sustainable healing.',
                'primary_label' => 'View Programs',
                'primary_url' => url('/health-programs'),
                'secondary_label' => 'Contact Us',
                'secondary_url' => url('/contact-us'),
                'secondary_type' => 'link',
            ],
        ];
    @endphp

    <!-- Hero Section Start -->
    <div class="hero hero-slider-layout">
        <div class="swiper hero-main-swiper">
            <div class="swiper-wrapper">
                @foreach ($heroSlides as $slide)
                    <div class="swiper-slide">
                        <div class="hero-slide">
                            <div class="hero-slider-image">
                                <img src="{{ asset('images/' . $slide['image']) }}" alt="{{ $slide['title'] }}">
                            </div>

                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-10">
                                        <div class="hero-content">
                                            <div class="section-title">
                                                <span class="hero-eyebrow">{{ $slide['eyebrow'] }}</span>
                                                <h1>{{ $slide['title'] }}</h1>
                                                <p>{{ $slide['text'] }}</p>
                                            </div>

                                            <div class="hero-body">
                                                <div class="hero-btn">
                                                    <a href="{{ $slide['primary_url'] }}" class="btn-default">{{ $slide['primary_label'] }}</a>
                                                </div>

                                                @if ($slide['secondary_type'] === 'video')
                                                    <div class="video-play-button">
                                                        <p>{{ $slide['secondary_label'] }}</p>
                                                        <a href="{{ $slide['secondary_url'] }}" class="popup-video" data-cursor-text="Play">
                                                            <i class="fa-solid fa-play"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="hero-btn hero-btn-secondary">
                                                        <a href="{{ $slide['secondary_url'] }}" class="btn-default btn-highlighted">{{ $slide['secondary_label'] }}</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="hero-pagination"></div>
        </div>

        <button type="button" class="hero-slider-nav hero-slider-prev" aria-label="Previous slide">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <button type="button" class="hero-slider-nav hero-slider-next" aria-label="Next slide">
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
    <!-- Hero Section End -->

<!-- Trust Strip Section Start -->
    @php
        $trustItems = [
            ['image' => 'experience.webp', 'text' => '25+ Years Clinical Experience'],
            ['image' => 'successfull.webp', 'text' => '3500+ Patients Successfully Treated'],
            ['image' => 'expert.webp', 'text' => 'Multidisciplinary Expert Team'],
            ['image' => 'natural.webp', 'text' => 'Natural, Safe & Evidence-Based Treatments'],
            ['image' => 'extracted_icon.webp', 'text' => 'Multidimensional Treatment Approach'],
            ['image' => 'social-media-banner-3-1.webp', 'text' => 'Personalized Treatment protocols & Plans'],
        ];
    @endphp
    <div class="home-trust-strip" id="home-trust">
        <div class="trust-strip-inner">
            <div class="container-fluid">
                <div class="swiper trust-strip-swiper">
                    <div class="swiper-wrapper">
                        @foreach (array_merge($trustItems, $trustItems) as $item)
                            <div class="swiper-slide">
                                <div class="trust-strip-item">
                                    <div class="trust-strip-icon">
                                        <img src="{{ asset('images/trusts/' . $item['image']) }}" alt="">
                                    </div>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <span class="trust-strip-edge trust-strip-edge-left" aria-hidden="true"></span>
            <span class="trust-strip-edge trust-strip-edge-right" aria-hidden="true"></span>
        </div>
    </div>
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
    @php
        $programDetails = [
            ['label' => 'Program Name', 'value' => 'Diabetes Reversal & Lifestyle Management Camp', 'tone' => 'primary'],
            ['label' => 'Date & Time', 'value' => '15 April 2026 · 10:00 AM – 2:00 PM', 'tone' => 'accent', 'icon' => 'fa-calendar-days'],
            ['label' => 'Location', 'value' => 'Agarwal Public School, Indore', 'tone' => 'warm', 'icon' => 'fa-location-dot'],
            ['label' => 'Chief Consultant', 'value' => 'Dr Ravindra Verma', 'tone' => 'primary', 'icon' => 'fa-user-doctor'],
            ['label' => 'Key Benefits', 'value' => 'Diabetes Management, Personalized Diet Plan, Stress Reduction Techniques, Lifestyle Counseling, Health Screening', 'tone' => 'accent'],
        ];
    @endphp
    <div class="home-programs-camps">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="home-programs-camps-video wow fadeInUp">
                        <figure class="home-programs-camps-video-frame">
                            <img src="{{ asset('images/gallery-4.jpg') }}" alt="Health programs and wellness camps at Sahaj Aarogyam">
                        </figure>
                        <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="home-programs-camps-play popup-video" aria-label="Watch health programs video">
                            <span class="home-programs-camps-play-icon"><i class="fa-solid fa-play"></i></span>
                            <span class="home-programs-camps-play-text">Watch Our Camps</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="home-programs-camps-content">
                        <span class="home-programs-camps-eyebrow wow fadeInUp">Health Programs & Camps</span>
                        <h2 class="home-programs-camps-title wow fadeInUp" data-wow-delay="0.1s">Group Healing. Lasting Wellness.</h2>
                        <p class="home-programs-camps-lead wow fadeInUp" data-wow-delay="0.15s">Join our weekend wellness camps, weight-management programs, detox retreats and community healing sessions led by our multidisciplinary team.</p>

                        <div class="home-programs-camps-details">
                            @foreach ($programDetails as $index => $detail)
                                <div class="home-programs-camps-detail home-programs-camps-detail--{{ $detail['tone'] }} wow fadeInUp" data-wow-delay="{{ number_format(0.2 + ($index * 0.05), 2) }}s">
                                    <span class="home-programs-camps-detail-label">{{ $detail['label'] }}</span>
                                    <p class="home-programs-camps-detail-value">
                                        @if (!empty($detail['icon']))
                                            <i class="fa-solid {{ $detail['icon'] }}"></i>
                                        @endif
                                        {{ $detail['value'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <div class="home-programs-camps-action wow fadeInUp" data-wow-delay="0.45s">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Explore Latest Programs <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<!-- Gallery Section Start -->
    @include('partials.home-gallery-section')
    <!-- Gallery Section End -->

<!-- Blog Post Section Start -->
    @php
        $homeBlogPosts = [
            [
                'slug' => '5-natural-ways-to-improve-your-gut-health',
                'image' => 'post-1.jpg',
                'title' => '5 Natural Ways to Improve Your Gut Health',
                'excerpt' => 'Good gut health is the foundation of overall well-being. A healthy gut improves digestion, boosts immunity, enhances mood, and helps maintain a healthy weight.',
                'date' => 'May 29, 2026',
            ],
            [
                'slug' => 'ayurveda-vs-modern-lifestyle-disorders',
                'image' => 'post-2.jpg',
                'title' => 'Ayurveda vs Modern Lifestyle Disorders',
                'excerpt' => 'Modern lifestyle has led to an increase in disorders like obesity, diabetes, hypertension, PCOS, thyroid issues, and stress-related conditions. While modern medicine manages symptoms, Ayurveda treats the root cause.',
                'date' => 'May 29, 2026',
            ],
            [
                'slug' => 'how-physiotherapy-helps-in-chronic-pain-recovery',
                'image' => 'post-3.jpg',
                'title' => 'How Physiotherapy Helps in Chronic Pain Recovery',
                'excerpt' => 'Chronic pain can affect your daily life and limit your ability to move, work, and enjoy the things you love. Physiotherapy focuses on reducing pain, improving mobility, and restoring function naturally.',
                'date' => 'May 29, 2026',
            ],
        ];
    @endphp
    <div class="home-blog-posts">
        <div class="container">
            <div class="home-blog-posts-header text-center wow fadeInUp">
                <h2>Blog Post</h2>
            </div>

            <div class="row g-4">
                @foreach ($homeBlogPosts as $index => $post)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-blog-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                            <a href="{{ route('blog.show', $post['slug']) }}" class="home-blog-card-image" data-cursor-text="View">
                                <img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}">
                            </a>
                            <div class="home-blog-card-body">
                                <ul class="home-blog-card-meta">
                                    <li><i class="fa-solid fa-user"></i> sahajaarogyam</li>
                                    <li><i class="fa-solid fa-calendar-days"></i> {{ $post['date'] }}</li>
                                    <li><i class="fa-solid fa-folder"></i> Blog</li>
                                </ul>
                                <h3><a href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a></h3>
                                <p>{{ $post['excerpt'] }}</p>
                                <a href="{{ route('blog.show', $post['slug']) }}" class="home-blog-readmore">Read more</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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
