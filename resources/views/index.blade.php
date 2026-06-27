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
    <div class="home-about-intro">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="home-about-intro-media wow fadeInUp">
                        <figure class="home-about-intro-photo">
                            <img src="{{ asset('images/home-about-team.jpg') }}" alt="Sahaj Aarogyam expert team">
                        </figure>
                        <div class="home-about-intro-badge">
                            <strong>25+</strong>
                            <span>Years of Trusted Care</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-about-intro-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">About us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">A holistic path to <span>natural healing</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">At Sahaj Aarogyam, we combine time-tested therapies with modern clinical care to treat pain and chronic conditions without surgery — helping you recover safely, naturally, and with lasting results.</p>
                        </div>

                        <div class="home-about-intro-btn wow fadeInUp" data-wow-delay="0.3s">
                            <a href="{{ url('/about-us') }}" class="btn-default">Learn More About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Home About Intro Section End -->

<!-- Why Choose Section Start -->
    @php
        $whyChooseItems = [
            ['icon' => 'fa-shield-halved', 'title' => 'Root-Cause Diagnosis', 'text' => 'We identify what\'s actually causing the issue — not just suppress symptoms.'],
            ['icon' => 'fa-user-doctor', 'title' => 'Integrated Specialists', 'text' => 'Physiotherapists, Ayurveda doctors, nutritionists & therapists under one roof.'],
            ['icon' => 'fa-hand-holding-heart', 'title' => 'Personalised Protocols', 'text' => 'Every patient receives a treatment plan designed for their unique condition.'],
            ['icon' => 'fa-leaf', 'title' => 'Non-Surgical & Natural', 'text' => 'Avoid risky surgery wherever possible with safe, evidence-based therapies.'],
            ['icon' => 'fa-award', 'title' => '25+ Years Experience', 'text' => 'Decades of clinical work treating complex pain and lifestyle disorders.'],
            ['icon' => 'fa-heart-pulse', 'title' => 'Long-Term Wellness', 'text' => 'Lasting results — we treat the body, mind, metabolism and aesthetics together.'],
        ];
    @endphp
    <div class="home-why-choose">
        <div class="container">
            <div class="home-why-choose-header text-center">
                <span class="home-why-choose-eyebrow wow fadeInUp">Why Sahaj Aarogyam</span>
                <h2 class="wow fadeInUp" data-wow-delay="0.1s">Why Choose Sahaj Aarogyam</h2>
                <p class="wow fadeInUp" data-wow-delay="0.2s">A structured integrated healthcare brand — not just another clinic.</p>
            </div>

            <div class="row g-4">
                @foreach ($whyChooseItems as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="home-why-choose-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                            <span class="home-why-choose-card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="home-why-choose-card-icon">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Why Choose Section End -->

<!-- What We Treat Section Start -->
    @php
        $whatWeTreatItems = [
            ['slug' => 'back-pain-spine-disorders', 'icon' => 'fa-award', 'title' => 'Back Pain & Spine disorders', 'text' => 'Advanced non-surgical care for chronic back pain, stiffness, and spinal discomfort.'],
            ['slug' => 'slip-disc-sciatica', 'icon' => 'fa-hand-holding-heart', 'title' => 'Slip Disc & Sciatica', 'text' => 'Targeted therapies designed to reduce disc-related pain and improve mobility.'],
            ['slug' => 'liver-metabolic-disorders', 'icon' => 'fa-clipboard-medical', 'title' => 'Liver & Metabolic Disorders', 'text' => 'Natural pain management solutions for sciatica, nerve pain and numbness.'],
            ['slug' => 'knee-pain-joints', 'icon' => 'fa-bone', 'title' => 'Knee Pain & Joints pain', 'text' => 'Personalized therapies to improve knee strength, flexibility, and movement.'],
            ['slug' => 'male-female-wellness', 'icon' => 'fa-venus-mars', 'title' => 'Male and Female Wellness', 'text' => 'Specialized rehabilitation care for shoulder pain, stiffness, and restricted motion.'],
            ['slug' => 'cervical-ankylosing-spondylitis', 'icon' => 'fa-user-doctor', 'title' => 'Cervical & Ankylosing Spondylitis', 'text' => 'Effective care for neck pain, posture correction, and cervical discomfort.'],
        ];
    @endphp
    <div class="home-what-we-treat">
        <div class="home-what-we-treat-overlay"></div>
        <div class="container position-relative">
            <div class="home-what-we-treat-header text-center">
                <h2 class="wow fadeInUp">What We Treat</h2>
            </div>

            <div class="row g-4">
                @foreach ($whatWeTreatItems as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="home-treat-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-treat-card-icon">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <div class="home-treat-card-body">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                            <a href="{{ route('treatment.show', $item['slug']) }}" class="home-treat-card-link">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="home-what-we-treat-action text-center wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ url('/treatment') }}" class="btn-default btn-highlighted">View All</a>
            </div>
        </div>
    </div>
    <!-- What We Treat Section End -->

<!-- Our Core Services Section Start -->
    @php
        $coreServices = [
            [
                'slug' => 'pain-rehabilitation',
                'image' => 'service-featured-image.jpg',
                'title' => 'Pain & Rehabilitation',
                'text' => 'Personalized rehabilitation therapies focused on pain relief, mobility, recovery, and physical strength.',
                'tags' => ['Physiotherapy', 'Neuro Rehab'],
            ],
            [
                'slug' => 'ayurveda-detox',
                'image' => 'gallery-2.jpg',
                'title' => 'Ayurveda & Detox',
                'text' => 'Traditional Ayurvedic detox therapies designed to restore balance, cleanse the body, and wellness.',
                'tags' => ['Panchakarma', 'Naturopathy'],
            ],
            [
                'slug' => 'metabolic-care',
                'image' => 'gallery-3.jpg',
                'title' => 'Metabolic Care',
                'text' => 'Customized wellness programs for weight management, metabolism support, and nutritional balance.',
                'tags' => ['Weight Loss', 'Nutrition'],
            ],
            [
                'slug' => 'hijama-cupping',
                'image' => 'service-benefits-img.jpg',
                'title' => 'Hijama & Cupping',
                'text' => 'Therapeutic cupping treatments to improve circulation, relieve pain, and support natural healing.',
                'tags' => ['Hijama Therapy', 'Pain Relief'],
            ],
            [
                'slug' => 'acupuncture-acupressure',
                'image' => 'gallery-5.jpg',
                'title' => 'Acupuncture & Acupressure',
                'text' => 'Evidence-based needle and pressure-point therapies to restore energy flow and reduce chronic discomfort.',
                'tags' => ['Acupuncture', 'Acupressure'],
            ],
            [
                'slug' => 'holistic-wellness-programs',
                'image' => 'what-we-benefit-image.jpg',
                'title' => 'Holistic Wellness Programs',
                'text' => 'Integrated care plans combining multiple therapies for long-term health, vitality, and lifestyle balance.',
                'tags' => ['Integrated Care', 'Lifestyle Support'],
            ],
        ];
    @endphp
    <div class="home-core-services">
        <div class="container">
            <div class="home-core-services-header text-center">
                <h2 class="wow fadeInUp">Our Core Services</h2>
            </div>

            <div class="row g-4">
                @foreach ($coreServices as $index => $service)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-core-service-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <a href="{{ route('services.show', $service['slug']) }}" class="home-core-service-media">
                                <img src="{{ asset('images/' . $service['image']) }}" alt="{{ $service['title'] }}">
                                <span class="home-core-service-badge" aria-hidden="true">
                                    <i class="fa-solid fa-mortar-pestle"></i>
                                </span>
                            </a>
                            <div class="home-core-service-content">
                                <h3><a href="{{ route('services.show', $service['slug']) }}">{{ $service['title'] }}</a></h3>
                                <p>{{ $service['text'] }}</p>
                                <ul class="home-core-service-tags">
                                    @foreach ($service['tags'] as $tag)
                                        <li><i class="fa-solid fa-circle-check"></i> {{ $tag }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('services.show', $service['slug']) }}" class="home-core-service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="home-core-services-action text-center wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ url('/services') }}" class="btn-default">View All</a>
            </div>
        </div>
    </div>
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
    @php
        $homeExperts = [
            [
                'image' => 'team-1.jpg',
                'name' => 'Dr. Ravindra Verma',
                'role' => 'Founder & Chairman',
                'specialty' => 'Alternative Therapy Specialist',
                'stats' => '25+ Years Experience',
                'bio' => 'Leads the overall integrated treatment system and treatment philosophy.',
            ],
            [
                'image' => 'team-2.jpg',
                'name' => 'Dr. Rachana Gangrade',
                'role' => 'Co-Founder & Managing Director',
                'specialty' => 'Dietitian & Nutritionist',
                'stats' => '25+ Years Experience | Ph.D. in Food & Nutrition | Weight Management Specialist',
                'bio' => 'Expert in Integrated Nutrition for Metabolic Health, Weight Loss & Lifestyle Disorders.',
            ],
            [
                'image' => 'team-3.jpg',
                'name' => 'Dr. Pankaj Jain',
                'role' => 'Director & Chief Medical Officer',
                'specialty' => 'Ayurveda & Panchakarma Specialist',
                'stats' => '25+ Years Experience | Kerala Panchakarma Specialist | Senior Ayurveda Consultant',
                'bio' => 'Expert in Integrated Ayurveda & Panchakarma for Chronic Diseases, Pain Management & Metabolic Disorders.',
            ],
            [
                'image' => 'team-4.jpg',
                'name' => 'Dr. Shaziya Gandhi',
                'role' => 'Co-Founder & Director',
                'specialty' => 'Unani Medicine & Hijama Specialist',
                'stats' => '16+ Years Experience | BUMS | Specialist in Unani Medicine & Hijama Therapy',
                'bio' => 'Expert in Integrated Unani Healing for Detoxification, Pain Management & Lifestyle Disorders.',
            ],
            [
                'image' => 'team-5.jpg',
                'name' => 'Dr. Sanjay Patel',
                'role' => 'Head of Physiotherapy',
                'specialty' => 'Pain & Rehabilitation Specialist',
                'stats' => '18+ Years Experience | MPT Orthopedics | Neuro Rehab Expert',
                'bio' => 'Specialist in non-surgical pain relief, spine disorders, and advanced physiotherapy rehabilitation.',
            ],
            [
                'image' => 'team-6.jpg',
                'name' => 'Dr. Neha Singh',
                'role' => 'Senior Wellness Consultant',
                'specialty' => 'Acupuncture & Acupressure Specialist',
                'stats' => '12+ Years Experience | Certified Acupuncturist | Holistic Pain Management',
                'bio' => 'Expert in acupuncture, acupressure, and integrative therapies for chronic pain and wellness recovery.',
            ],
        ];
    @endphp
    <div class="home-meet-experts">
        <div class="home-meet-experts-overlay"></div>
        <div class="container position-relative">
            <div class="home-meet-experts-header text-center">
                <span class="home-meet-experts-eyebrow wow fadeInUp">Meet Our Experts</span>
                <h2 class="wow fadeInUp" data-wow-delay="0.1s">A Multidisciplinary Team</h2>
            </div>

            <div class="row g-4">
                @foreach ($homeExperts as $index => $expert)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-expert-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-expert-card-media">
                                <img src="{{ asset('images/' . $expert['image']) }}" alt="{{ $expert['name'] }}">
                            </div>
                            <div class="home-expert-card-body">
                                <h3 class="home-expert-card-name">{{ $expert['name'] }}</h3>
                                <p class="home-expert-card-role">{{ $expert['role'] }}</p>
                                <p class="home-expert-card-specialty">{{ $expert['specialty'] }}</p>
                                <hr class="home-expert-card-divider">
                                <p class="home-expert-card-stats">{{ $expert['stats'] }}</p>
                                <p class="home-expert-card-bio">{{ $expert['bio'] }}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="home-meet-experts-action text-center wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ url('/our-expert-team') }}" class="btn-default">Know More <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </div>
    </div>
    <!-- Meet Our Experts Section End -->

<!-- Patient Feedback Section Start -->
    @php
        $patientReviews = [
            [
                'name' => 'Kiran Mehta',
                'initial' => 'K',
                'avatar_tone' => 'accent',
                'time' => '6 months ago',
                'text' => 'I came to Sahaj Aarogyam with chronic back pain and limited mobility. Within weeks of integrated physiotherapy and Ayurveda support, my pain reduced significantly. The team is compassionate, professional, and truly focused on root-cause healing.',
            ],
            [
                'name' => 'Amit Sharma',
                'initial' => 'A',
                'avatar_tone' => 'primary',
                'time' => '3 months ago',
                'text' => 'Excellent experience for my father\'s knee pain treatment. Non-surgical care, clear guidance, and regular follow-ups made a huge difference. Staff explained every step patiently. Highly recommended for anyone seeking natural recovery.',
            ],
            [
                'name' => 'Priya Verma',
                'initial' => 'P',
                'avatar_tone' => 'warm',
                'time' => '1 year ago',
                'text' => 'The weight management and nutrition program changed my lifestyle completely. Dr Rachana\'s diet plan was practical and easy to follow. I lost weight sustainably without crash dieting. Very grateful to the entire team.',
            ],
            [
                'name' => 'Rajesh Gupta',
                'initial' => 'R',
                'avatar_tone' => 'accent',
                'time' => '2 months ago',
                'text' => 'Panchakarma detox at Sahaj Aarogyam was a transformative experience. Clean facility, expert Ayurveda doctors, and personalized therapy plan. I feel lighter, more energetic, and mentally refreshed after the program.',
            ],
            [
                'name' => 'Sunita Jain',
                'initial' => 'S',
                'avatar_tone' => 'primary',
                'time' => '4 weeks ago',
                'text' => 'Hijama therapy and Unani consultation helped with my long-standing fatigue and joint stiffness. Dr Shaziya was thorough and caring. The holistic approach here treats the person, not just symptoms.',
            ],
            [
                'name' => 'Mohan Das',
                'initial' => 'M',
                'avatar_tone' => 'warm',
                'time' => '8 months ago',
                'text' => 'Slip disc pain had made daily life difficult. After structured rehab and acupuncture sessions, I am back to normal activities without surgery. Transparent pricing, skilled therapists, and genuine care throughout.',
            ],
        ];
    @endphp
    <div class="home-patient-feedback">
        <div class="container">
            <div class="home-patient-feedback-header text-center wow fadeInUp">
                <h2>Our Patient Feedback</h2>
                <div class="home-patient-feedback-rating">
                    <span class="home-patient-feedback-rating-label">Excellent</span>
                    <div class="home-patient-feedback-stars" aria-label="5 out of 5 stars">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                    <p class="home-patient-feedback-count">Based on <strong>346 reviews</strong></p>
                    <div class="home-patient-feedback-google" aria-hidden="true">
                        <i class="fa-brands fa-google"></i>
                        <span>Google Reviews</span>
                    </div>
                </div>
            </div>

            <div class="home-patient-feedback-slider-wrap wow fadeInUp" data-wow-delay="0.15s">
                <button type="button" class="home-patient-feedback-nav home-patient-feedback-prev" aria-label="Previous review">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="swiper home-patient-feedback-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($patientReviews as $review)
                            <div class="swiper-slide">
                                <article class="home-feedback-card">
                                    <div class="home-feedback-card-top">
                                        <div class="home-feedback-author">
                                            <span class="home-feedback-avatar home-feedback-avatar--{{ $review['avatar_tone'] }}">{{ $review['initial'] }}</span>
                                            <div>
                                                <h3>{{ $review['name'] }}</h3>
                                                <time>{{ $review['time'] }}</time>
                                            </div>
                                        </div>
                                        <span class="home-feedback-google-badge" aria-label="Google review">
                                            <i class="fa-brands fa-google"></i>
                                        </span>
                                    </div>
                                    <div class="home-feedback-card-rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        <span class="home-feedback-verified"><i class="fa-solid fa-circle-check"></i> Verified</span>
                                    </div>
                                    <div class="home-feedback-card-text">
                                        <p class="home-feedback-review-text">{{ $review['text'] }}</p>
                                        <button type="button" class="home-feedback-read-more" aria-expanded="false">Read more</button>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="home-patient-feedback-nav home-patient-feedback-next" aria-label="Next review">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div class="home-patient-feedback-action text-center wow fadeInUp" data-wow-delay="0.25s">
                <a href="#" class="btn-default" target="_blank" rel="noopener noreferrer">Read More Reviews <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </div>
    </div>
    <!-- Patient Feedback Section End -->

<!-- Gallery Section Start -->
    @php
        $galleryPanels = [
            [
                'image' => 'gallery-2.jpg',
                'title' => 'Ayurveda & Panchakarma',
                'text' => 'Traditional detox and rejuvenation therapies for deep healing and balance.',
            ],
            [
                'image' => 'gallery-3.jpg',
                'title' => 'Metabolic Wellness',
                'text' => 'Personalized nutrition and lifestyle guidance for sustainable health outcomes.',
            ],
            [
                'image' => 'gallery-4.jpg',
                'title' => 'Mindfulness & Meditation',
                'text' => 'Reduce stress, improve focus, and cultivate inner peace through guided meditation practices.',
                'featured' => true,
                'icons' => ['fa-leaf', 'fa-spa', 'fa-person-praying', 'fa-heart-pulse', 'fa-seedling', 'fa-hand-holding-heart'],
            ],
            [
                'image' => 'gallery-5.jpg',
                'title' => 'Hijama & Cupping',
                'text' => 'Natural detox and pain-relief therapies rooted in time-tested healing traditions.',
            ],
            [
                'image' => 'gallery-6.jpg',
                'title' => 'Therapeutic Massage',
                'text' => 'Expert manual therapy to relieve tension, restore mobility, and accelerate recovery.',
            ],
        ];
    @endphp
    <div class="home-gallery-showcase">
        <div class="container">
            <div class="home-gallery-showcase-header text-center wow fadeInUp">
                <h2>Gallery</h2>
            </div>
        </div>

        <div class="home-gallery-accordion-wrap gallery-items wow fadeInUp" data-wow-delay="0.1s">
            <div class="home-gallery-accordion" role="list">
                @foreach ($galleryPanels as $index => $panel)
                    <article
                        class="home-gallery-panel{{ !empty($panel['featured']) ? ' is-featured' : '' }}"
                        role="listitem"
                        data-panel-index="{{ $index }}"
                    >
                        <a href="{{ asset('images/' . $panel['image']) }}" class="home-gallery-panel-link" data-cursor-text="View">
                            <img src="{{ asset('images/' . $panel['image']) }}" alt="{{ $panel['title'] }}">
                            <span class="home-gallery-panel-shade" aria-hidden="true"></span>
                            <div class="home-gallery-panel-content">
                                @if (!empty($panel['icons']))
                                    <div class="home-gallery-panel-icons" aria-hidden="true">
                                        @foreach ($panel['icons'] as $icon)
                                            <span><i class="fa-solid {{ $icon }}"></i></span>
                                        @endforeach
                                    </div>
                                @endif
                                <h3>{{ $panel['title'] }}</h3>
                                <p>{{ $panel['text'] }}</p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="home-gallery-accordion-mobile swiper home-gallery-mobile-swiper">
                <div class="swiper-wrapper">
                    @foreach ($galleryPanels as $panel)
                        <div class="swiper-slide">
                            <article class="home-gallery-mobile-card">
                                <a href="{{ asset('images/' . $panel['image']) }}" class="home-gallery-mobile-link" data-cursor-text="View">
                                    <img src="{{ asset('images/' . $panel['image']) }}" alt="{{ $panel['title'] }}">
                                    <span class="home-gallery-panel-shade" aria-hidden="true"></span>
                                    <div class="home-gallery-panel-content">
                                        <h3>{{ $panel['title'] }}</h3>
                                        <p>{{ $panel['text'] }}</p>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="home-gallery-mobile-pagination swiper-pagination"></div>
            </div>
        </div>

        <div class="container">
            <div class="home-gallery-showcase-action text-center wow fadeInUp" data-wow-delay="0.2s">
                <a href="{{ url('/gallery') }}" class="btn-default">See More <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </div>
    </div>
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
    @php
        $homeFaqs = [
            [
                'question' => 'What treatments does Sahaj Aarogyam offer?',
                'answer' => 'We offer integrated non-surgical care including physiotherapy, Ayurveda, Panchakarma, Hijama, acupuncture, nutrition counselling, pain rehabilitation, and lifestyle disorder management — all under one roof.',
            ],
            [
                'question' => 'Do I need a doctor\'s referral to visit?',
                'answer' => 'No referral is required. You can book a consultation directly. Our specialists will assess your condition and recommend a personalised treatment plan during your first visit.',
            ],
            [
                'question' => 'Are your treatments non-surgical?',
                'answer' => 'Yes. Our focus is on natural, evidence-based therapies that help you recover without surgery wherever possible. Treatment plans are tailored to your condition, age, and health goals.',
            ],
            [
                'question' => 'How long does a typical treatment plan take?',
                'answer' => 'It depends on your condition and severity. Some patients notice relief within a few sessions, while chronic or long-standing issues may need a structured plan over several weeks.',
            ],
            [
                'question' => 'Do you offer personalised diet and lifestyle plans?',
                'answer' => 'Absolutely. Our nutritionists and wellness consultants create practical diet, exercise, and lifestyle protocols to support recovery, weight management, and long-term health.',
            ],
            [
                'question' => 'How do I book an appointment?',
                'answer' => 'You can book online through our website, call our clinic directly, or visit us in person. Our team will help you schedule a consultation at your convenience.',
            ],
        ];
    @endphp
    <div class="home-faq">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="home-faq-content">
                        <div class="home-faq-header wow fadeInUp">
                            <span class="home-faq-eyebrow">FAQs</span>
                            <h2>Frequently Asked Questions</h2>
                            <p>Quick answers about our treatments, appointments, and holistic care approach.</p>
                        </div>

                        <div class="home-faq-accordion accordion wow fadeInUp" data-wow-delay="0.1s" id="homeFaqAccordion">
                            @foreach ($homeFaqs as $index => $faq)
                                <div class="accordion-item home-faq-item">
                                    <h3 class="accordion-header" id="homeFaqHeading{{ $index }}">
                                        <button
                                            class="accordion-button{{ $index === 0 ? '' : ' collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#homeFaqCollapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="homeFaqCollapse{{ $index }}"
                                        >
                                            {{ $faq['question'] }}
                                        </button>
                                    </h3>
                                    <div
                                        id="homeFaqCollapse{{ $index }}"
                                        class="accordion-collapse collapse{{ $index === 0 ? ' show' : '' }}"
                                        aria-labelledby="homeFaqHeading{{ $index }}"
                                        data-bs-parent="#homeFaqAccordion"
                                    >
                                        <div class="accordion-body">
                                            <p>{{ $faq['answer'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-faq-media wow fadeInUp" data-wow-delay="0.15s">
                        <figure class="home-faq-image">
                            <img src="{{ asset('images/faqs-image.jpg') }}" alt="Sahaj Aarogyam consultation">
                        </figure>
                        <a href="{{ url('/contact-us') }}" class="home-faq-contact-box">
                            <span class="home-faq-contact-icon"><i class="fa-solid fa-phone-volume"></i></span>
                            <span class="home-faq-contact-text">
                                <strong>Still Have Questions?</strong>
                                <span>Call us at +91 94259 63336</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ Section End -->

<!-- Location Map Section Start -->
    @php
        $defaultMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSahaj%20Aarogyam!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin';
        $mapEmbed = ($settings['google_map_embed'] ?? '') ?: $defaultMap;
        $visitEyebrow = ($settings['visit_us_eyebrow'] ?? '') ?: 'Visit Us';
        $visitTitle = ($settings['visit_us_title'] ?? '') ?: 'Serving Indore & Nearby';
        $visitDescription = ($settings['visit_us_description'] ?? '') ?: 'Conveniently located in the heart of Indore, we proudly serve patients from across the city and nearby areas.';
        $visitBgImage = ($settings['visit_us_bg_image'] ?? '') ?: 'home-about-team.jpg';
        $locationAddress = ($settings['address'] ?? '') ?: '560 Sector B Greater Brajeshwari, Near Agrawal Public School, Indore, India, 452001';
        $locationPhone = ($settings['phone_1'] ?? '') ?: '+91 94259 63336';
        $locationEmailPrimary = ($settings['email_1'] ?? '') ?: 'info@sahajaarogyam.com';
        $locationEmailSecondary = ($settings['email_2'] ?? '') ?: 'sahajaarogyam@gmail.com';
    @endphp
    <div class="home-location-map" id="location" style="background-image: url('{{ asset('images/' . $visitBgImage) }}');">
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
