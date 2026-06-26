@extends('layouts.app')

@section('title', 'Restraint - Yoga & Meditation HTML Template')

@section('content')
<!-- Hero Section Start -->
    <div class="hero parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Hero Content Start -->
                    <div class="hero-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Welcome Restraint</h3>
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Transform Your Life Through Yoga and Meditation</h1>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Discover the path to holistic well-being through yoga meditation  practices are designed to enhance your physical strength, mental clarity.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Hero Content Body Start -->
                        <div class="hero-body wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Hero Button Start -->
                            <div class="hero-btn">
                                <a href="{{ url('/contact-us') }}" class="btn-default">join us today</a>                                
                            </div>
                            <!-- Hero Button End -->

                            <!-- Video Play Button Start -->
                            <div class="video-play-button">
                                <p>Watch Video</p>
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            </div>
                            <!-- Video Play Button End -->
                        </div>
                        <!-- Hero Content Body End -->
                    </div>
                    <!-- Hero Content End -->
                </div>
            </div>
        </div>

        <!-- Down Arrow Circle Start -->
        <div class="down-arrow-circle">
            <a href="{{ url('/') }}#home-trust"><img src="{{ asset('images/down-circle.svg') }}" alt=""><i class="fa-solid fa-arrow-down"></i></a>
        </div>
        <!-- Down Arrow Circle End -->
    </div>
    <!-- Hero Section End -->

<!-- Trust Strip Section Start -->
    <div class="scrolling-ticker" id="home-trust">
        <!-- Trust Strip Box Start -->
        <div class="scrolling-ticker-box">
            <!-- Scrolling Content Start -->
            <div class="scrolling-content">
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Serene Flow</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Mindful Movement</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Yoga Journey</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Flex & Relax</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Calm & Balance</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Serene Flow</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Mindful Movement</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Yoga Journey</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Flex & Relax</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Calm & Balance</span>
            </div>
            <!-- Scrolling Content End -->
            
            <!-- Scrolling Content Start -->
            <div class="scrolling-content">
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Serene Flow</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Mindful Movement</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Yoga Journey</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Flex & Relax</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Calm & Balance</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Serene Flow</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Mindful Movement</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Yoga Journey</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Flex & Relax</span>
                <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">Calm & Balance</span>
            </div>
            <!-- Scrolling Content End -->
            
            <!-- Scrolling Ticker Images Start -->
            <div class="scrolling-ticker-images">
                <!-- Scrolling Ticker Image Start -->
                <div class="scrolling-ticker-image">
                    <figure class="image-anime">
                        <img src="{{ asset('images/scrolling-ticker-image-1.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Scrolling Ticker Image End -->
    
                <!-- Scrolling Ticker Image Start -->
                <div class="scrolling-ticker-image">
                    <figure class="image-anime">
                        <img src="{{ asset('images/scrolling-ticker-image-2.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Scrolling Ticker Image End -->
    
                <!-- Scrolling Ticker Image Start -->
                <div class="scrolling-ticker-image">
                    <figure class="image-anime">
                        <img src="{{ asset('images/scrolling-ticker-image-3.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Scrolling Ticker Image End -->
    
                <!-- Scrolling Ticker Image Start -->
                <div class="scrolling-ticker-image">
                    <figure class="image-anime">
                        <img src="{{ asset('images/scrolling-ticker-image-4.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Scrolling Ticker Image End -->
    
                <!-- Scrolling Ticker Image Start -->
                <div class="scrolling-ticker-image">
                    <figure class="image-anime">
                        <img src="{{ asset('images/scrolling-ticker-image-5.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Scrolling Ticker Image End -->
            </div>
            <!-- Scrolling Ticker Images End -->      
        </div>
        <!-- Trust Strip Box End -->     
    </div>
	<!-- Trust Strip Section End -->

<!-- Why Choose Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Why Choose</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Experience excellence in <span>yoga and meditation</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>Join us to experience expert-guided yoga and meditation practices designed to enhance your physical health, mental clarity, and overall well-being.</p>
                    </div>
                    <!-- Section Title Content End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Why Choose Content Start -->
                    <div class="why-choose-content">
                        <!-- Why Choose Image Start -->
                        <div class="why-choose-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('images/why-choose-image.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Why Choose Image End -->

                        <!-- Why Choose Item Start -->
                        <div class="why-choose-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-why-choose-item-1.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>Yoga for Balance</h3>
                                <p>Achieve harmony of body and spirit through gent practices designed to enhance physical stability, mental clarity.</p>
                            </div>
                        </div>
                        <!-- Why Choose Item End -->

                        <!-- Why Choose Item Start -->
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-why-choose-item-2.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>Inner Peace Workshops</h3>
                                <p>Achieve harmony of body and spirit through gent practices designed to enhance physical stability, mental clarity.</p>
                            </div>
                        </div>
                        <!-- Why Choose Item End -->
                    </div>
                    <!-- Why Choose Content End -->

                    <!-- Why Choose Counter Box Start -->
                    <div class="why-choose-counter-box">
                        <!-- Why Choose Counter Item Start -->
                        <div class="why-choose-counter-item">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-why-choose-counter-1.svg') }}" alt="">
                            </div>
                            <div class="why-choose-counter-content">
                                <h3><span class="counter">25</span>+</h3>
                                <p>Years Of Experience</p>
                            </div>
                        </div>
                        <!-- Why Choose Counter Item End -->

                        <!-- Why Choose Counter Item Start -->
                        <div class="why-choose-counter-item">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-why-choose-counter-2.svg') }}" alt="">
                            </div>
                            <div class="why-choose-counter-content">
                                <h3><span class="counter">150</span>K+</h3>
                                <p>Satisfied clients</p>
                            </div>
                        </div>
                        <!-- Why Choose Counter Item End -->

                        <!-- Why Choose Counter Item Start -->
                        <div class="why-choose-counter-item">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-why-choose-counter-3.svg') }}" alt="">
                            </div>
                            <div class="why-choose-counter-content">
                                <h3><span class="counter">30</span>+</h3>
                                <p>Countries Reached</p>
                            </div>
                        </div>
                        <!-- Why Choose Counter Item End -->

                        <!-- Why Choose Counter Item Start -->
                        <div class="why-choose-counter-item">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-why-choose-counter-4.svg') }}" alt="">
                            </div>
                            <div class="why-choose-counter-content">
                                <h3><span class="counter">2</span>K+</h3>
                                <p>Classes Conducted</p>
                            </div>
                        </div>
                        <!-- Why Choose Counter Item End -->
                    </div>
                    <!-- Why Choose Counter Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Section End -->

<!-- What We Treat Section Start -->
    <div class="our-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">What We Treat</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Conditions we help you <span>heal naturally</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/services') }}" class="btn-default">view all services</a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp">
                        <!-- Service Header Start -->
                        <div class="service-header">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-service-item-1.svg') }}" alt="">
                            </div>
                            <div class="service-btn">
                                <a href="service-single.html"><img src="{{ asset('images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <!-- Service Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="service-single.html">Beginner Yoga Classes</a></h3>
                            <p>Learn foundational poses and techniques yoga journey.</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Service Header Start -->
                        <div class="service-header">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-service-item-2.svg') }}" alt="">
                            </div>
                            <div class="service-btn">
                                <a href="service-single.html"><img src="{{ asset('images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <!-- Service Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="service-single.html">Stress Relief Sessions</a></h3>
                            <p>Learn foundational poses and techniques yoga journey.</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Service Header Start -->
                        <div class="service-header">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-service-item-3.svg') }}" alt="">
                            </div>
                            <div class="service-btn">
                                <a href="service-single.html"><img src="{{ asset('images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <!-- Service Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="service-single.html">Mindful Meditation</a></h3>
                            <p>Learn foundational poses and techniques yoga journey.</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                        <!-- Service Header Start -->
                        <div class="service-header">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-service-item-4.svg') }}" alt="">
                            </div>
                            <div class="service-btn">
                                <a href="service-single.html"><img src="{{ asset('images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <!-- Service Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="service-single.html">Mental Clarity Meditation</a></h3>
                            <p>Learn foundational poses and techniques yoga journey.</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.2s">
                        <p><span>Free</span>Let's make something great work together. <a href="contact.html">Get Free Quote</a></p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>
        </div>
    </div>
    <!-- What We Treat Section End -->

<!-- Core Specialty Section Start -->
    <div class="our-features">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Core Specialty</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Unlock wellness through <span>unique yoga features</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>Join us to experience expert-guided yoga and meditation practices designed to enhance your physical health, mental clarity, and overall well-being.</p>
                    </div>
                    <!-- Section Title Content End -->
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Features Item Start -->
                    <div class="features-item wow fadeInUp">
                        <div class="features-item-content">
                            <p>Ashtanga Yoga</p>
                            <h3>Healing Retreats and Workshops</h3>
                        </div>
                        <div class="features-item-image">
                            <figure>
                                <img src="{{ asset('images/features-image-1.png') }}" alt="">
                            </figure>
                        </div>
                    </div>
                    <!-- Features Item End -->
                </div>

                <div class="col-lg-6">
                    <!-- Our Features Boxes Start -->
                    <div class="our-features-boxes">
                        <!-- Features Box Start -->
                        <div class="features-box box-1 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="features-box-content">
                                <p>Ashtanga Yoga</p>
                                <h3>Community Support and Yoga Encouragement</h3>
                            </div>
                            <div class="features-box-image">
                                <figure>
                                    <img src="{{ asset('images/features-image-2.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Features Box End -->

                        <!-- Features Box Start -->
                        <div class="features-box box-2 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="features-box-content">
                                <p>Ashtanga</p>
                                <h3>Guided Meditation Sessions</h3>
                            </div>
                            <div class="features-box-image">
                                <figure>
                                    <img src="{{ asset('images/features-image-3.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Features Box End -->

                        <!-- Features Item Start -->
                        <div class="features-item features-box box-3 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="features-box-content">
                                <p>Ashtanga</p>
                                <h3>Stress-Relief Programs</h3>
                            </div>
                            <div class="features-item-image">
                                <figure>
                                    <img src="{{ asset('images/features-image-4.png') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Features Item End -->
                    </div>
                    <!-- Our Features Boxes End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Core Specialty Section End -->

<!-- Programs & Camps Section Start -->
    <div class="our-pricing">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Programs & Camps</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Wellness programs and <span>healing camps</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>Choose from our flexible pricing plans designed to suit your needs. Whether you're a beginner or advanced practitioner, we offer affordable.</p>
                    </div>
                    <!-- Section Title Content End -->
                </div>
            </div>            

            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6">
                    <!-- Pricing Item Start -->
                    <div class="pricing-item wow fadeInUp">
                        <!-- Pricing Image Start -->
                        <div class="pricing-image">
                            <figure class="image-anime">
                                <img src="{{ asset('images/pricing-image-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Pricing Image End -->

                        <!-- Pricing Content Start -->
                        <div class="pricing-content">
                            <div class="pricing-title">
                                <h3>Basic Plan</h3>
                            </div>
                            <h2>$29</h2>
                            <p>per month</p>
                        </div>
                        <!-- Pricing Content End -->

                        <!-- Pricing Body Start -->
                        <div class="pricing-body">
                            <!-- Pricing List Start -->
                            <div class="pricing-list">
                                <ul>
                                    <li>Weekly Group Yoga Practice</li>
                                    <li>Stress Relief Yoga Programs</li>
                                    <li>Flexible Class Schedules</li>
                                    <li>In-Person and Online Options</li>
                                </ul>
                            </div>
                            <!-- Pricing List End -->

                            <!-- Pricing Button Start -->
                            <div class="pricing-btn">
                                <a href="contact.html" class="btn-default">get started now</a>
                            </div>
                            <!-- Pricing Button End -->
                        </div>
                        <!-- Pricing Body End -->                   
                    </div>
                    <!-- Pricing Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Pricing Item Start -->
                    <div class="pricing-item highlighted-box wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Pricing Image Start -->
                        <div class="pricing-image">
                            <figure class="image-anime">
                                <img src="{{ asset('images/pricing-image-2.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Pricing Image End -->

                        <!-- Pricing Content Start -->
                        <div class="pricing-content">
                            <div class="pricing-title">
                                <h3>Standard plan</h3>
                            </div>
                            <h2>$39</h2>
                            <p>per month</p>
                        </div>
                        <!-- Pricing Content End -->

                        <!-- Pricing Body Start -->
                        <div class="pricing-body">
                            <!-- Pricing List Start -->
                            <div class="pricing-list">
                                <ul>
                                    <li>Weekly Group Yoga Practice</li>
                                    <li>Stress Relief Yoga Programs</li>
                                    <li>Flexible Class Schedules</li>
                                    <li>In-Person and Online Options</li>
                                </ul>
                            </div>
                            <!-- Pricing List End -->

                            <!-- Pricing Button Start -->
                            <div class="pricing-btn">
                                <a href="contact.html" class="btn-default btn-highlighted">get started now</a>
                            </div>
                            <!-- Pricing Button End -->
                        </div>
                        <!-- Pricing Body End -->
                    </div>
                    <!-- Pricing Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Pricing Item Start -->
                    <div class="pricing-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Pricing Image Start -->
                        <div class="pricing-image">
                            <figure class="image-anime">
                                <img src="{{ asset('images/pricing-image-3.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Pricing Image End -->

                        <!-- Pricing Content Start -->
                        <div class="pricing-content">
                            <div class="pricing-title">
                                <h3>Premium plan</h3>
                            </div>
                            <h2>$49</h2>
                            <p>per month</p>
                        </div>
                        <!-- Pricing Content End -->

                        <!-- Pricing Body Start -->
                        <div class="pricing-body">
                            <!-- Pricing List Start -->
                            <div class="pricing-list">
                                <ul>
                                    <li>Weekly Group Yoga Practice</li>
                                    <li>Stress Relief Yoga Programs</li>
                                    <li>Flexible Class Schedules</li>
                                    <li>In-Person and Online Options</li>
                                </ul>
                            </div>
                            <!-- Pricing List End -->

                            <!-- Pricing Button Start -->
                            <div class="pricing-btn">
                                <a href="contact.html" class="btn-default">get started now</a>
                            </div>
                            <!-- Pricing Button End -->
                        </div>
                        <!-- Pricing Body End -->
                    </div>
                    <!-- Pricing Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Programs & Camps Section End -->

<!-- About Us Section Start -->
    <div class="about-us" id="home-about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Images Start -->
                    <div class="about-images">
                        <!-- About Image Start -->
                        <div class="about-image">
                            <figure>
                                <img src="{{ asset('images/about-us-img.png') }}" alt="">
                            </figure>
                        </div>
                        <!-- About Image End -->

                        <!-- About Image Title Start -->
                        <div class="about-image-title">
                            <h2>about us</h2>
                        </div>
                        <!-- About Image Title End -->
                    </div>
                    <!-- About Images End -->
                </div>

                <div class="col-lg-6">
                    <!-- About Us Content Start -->
                    <div class="about-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">About us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Our Integrated Non–Surgical <span>Holistic Approach</span></h2>
                            <P class="wow fadeInUp" data-wow-delay="0.2s">Discover inner peace and well-being through yoga Our practice combines physical movement, mindfulness, and breathing techniques to help you achieve balance, reduce stress, and foster personal growth.</P>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Content Body Start -->
                        <div class="about-content-body">
                            <!-- About Benefit Item Start -->
                            <div class="about-benefit-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-benefit-1.svg') }}" alt="">
                                </div>
                                <div class="about-benefit-item-content">
                                    <h3>Community Support and Encouragement</h3>
                                    <p>Foster a sense of belonging with our supportive community. Share your journey, exchange experiences.</p>
                                </div>
                            </div>
                            <!-- About Benefit Item End -->

                            <!-- About Benefit Item Start -->
                            <div class="about-benefit-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-benefit-2.svg') }}" alt="">
                                </div>
                                <div class="about-benefit-item-content">
                                    <h3>Enhanced Physical Flexibility and Strength</h3>
                                    <p>Foster a sense of belonging with our supportive community. Share your journey, exchange experiences.</p>
                                </div>
                            </div>
                            <!-- About Benefit Item End -->                           
                        </div>
                        <!-- About Content Body End -->

                        <!-- About Content Button Start -->
                        <div class="about-content-btn wow fadeInUp" data-wow-delay="0.8s">
                            <a href="{{ url('/about-us') }}" class="btn-default">more about us</a>
                        </div>
                        <!-- About Content Button End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Meet our Experts Section Start -->
    <div class="page-team home-experts">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Meet our Experts</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Trusted specialists in <span>holistic healing</span></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/our-expert-team') }}" class="btn-default">View all experts</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp">
                        <div class="team-image">
                            <a href="{{ url('/our-expert-team') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/team-1.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h2><a href="{{ url('/our-expert-team') }}">Dr. Sarah Miller</a></h2>
                            <p>Holistic Physician</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-image">
                            <a href="{{ url('/our-expert-team') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/team-2.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h2><a href="{{ url('/our-expert-team') }}">Dr. Brooklyn Simmons</a></h2>
                            <p>Naturopathy Specialist</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="team-image">
                            <a href="{{ url('/our-expert-team') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/team-3.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h2><a href="{{ url('/our-expert-team') }}">Dr. Leslie Alexander</a></h2>
                            <p>Physiotherapy Expert</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="team-image">
                            <a href="{{ url('/our-expert-team') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/team-4.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h2><a href="{{ url('/our-expert-team') }}">Dr. Maya Thompson</a></h2>
                            <p>Meditation Coach</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Meet our Experts Section End -->

<!-- Our Testimonials Section Start -->
    <div class="our-testimonials">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Testimonial Image Content Start -->
                    <div class="testimonial-image-content">
                        <!-- Testimonial Image Start -->
                        <div class="testimonial-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('images/testimonial-image.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Testimonial Image End -->

                        <!-- Testimonial Review Box Start -->
                        <div class="testimonial-review-box wow fadeInUp">
                            <div class="testimonial-review-header">
                                <div class="testimonial-review-title">
                                    <h3>Try a free Class Today!</h3>
                                </div>
                                <div class="testimonial-review-counter">
                                    <span>30K+</span>
                                    <p>Worldwide Client</p>
                                </div>
                            </div>
                            <div class="testimonial-review-body">
                                <div class="testimonial-review-content">
                                    <p>Experience the benefits of yoga with a free trial class! Discover how mindful movement, techniques, and guided relaxation can enhance your well-being No matter your skill level, this is the perfect.</p>
                                </div>
                                <div class="testimonial-review-btn">
                                    <a href="contact.html"><img src="{{ asset('images/arrow-white.svg') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Review Box End -->
                    </div>
                    <!-- Testimonial Image Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Our Testimonial Content Start -->
                    <div class="our-testimonial-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Our testimonials</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Real stories transformation <span>and growth</span></h2>                            
                        </div>
                        <!-- Section Title End -->
                        
                        <div class="our-testimonial-box">
                            <!-- Testimonial Item Start -->
                            <div class="testimonial-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="testimonial-author">
                                    <div class="author-image">
                                        <figure class="image-anime">
                                            <img src="{{ asset('images/scrolling-ticker-image-1.jpg') }}" alt="">
                                        </figure>
                                    </div>            
                                    <div class="author-content">
                                        <h3>Sarah Miller</h3>
                                        <p>Founder & Lead Yoga Instructor</p>
                                    </div>
                                </div>
                                <div class="testimonial-item-content">
                                    <p>"Joining this yoga and meditation program was life-changing. I feel more balanced, focused, and at peace than ever before The instructors are knowledgeable, patient, and truly inspiring."</p>
                                </div>
                                <div class="testimonial-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>   
                            </div>
                            <!-- Testimonial Item End -->

                            <!-- Testimonial Item Start -->
                            <div class="testimonial-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="testimonial-author">
                                    <div class="author-image">
                                        <figure class="image-anime">
                                            <img src="{{ asset('images/scrolling-ticker-image-2.jpg') }}" alt="">
                                        </figure>
                                    </div>            
                                    <div class="author-content">
                                        <h3>Sarah Miller</h3>
                                        <p>Founder & Lead Yoga Instructor</p>
                                    </div>
                                </div>
                                <div class="testimonial-item-content">
                                    <p>"Joining this yoga and meditation program was life-changing. I feel more balanced, focused, and at peace than ever before The instructors are knowledgeable, patient, and truly inspiring."</p>
                                </div>
                                <div class="testimonial-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>   
                            </div>
                            <!-- Testimonial Item End -->
                        </div>
                    </div>
                    <!-- Our Testimonial Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testimonial Section End -->

    <!-- Gallery Section Start -->
    <div class="page-gallery home-gallery">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Gallery</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A glimpse of our <span>healing centre</span></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/gallery') }}" class="btn-default">View full gallery</a>
                    </div>
                </div>
            </div>
            <div class="row gallery-items page-gallery-box">
                <div class="col-lg-4 col-6">
                    <div class="photo-gallery wow fadeInUp">
                        <a href="{{ asset('images/gallery-1.jpg') }}" data-cursor-text="View">
                            <figure class="image-anime"><img src="{{ asset('images/gallery-1.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ asset('images/gallery-2.jpg') }}" data-cursor-text="View">
                            <figure class="image-anime"><img src="{{ asset('images/gallery-2.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ asset('images/gallery-3.jpg') }}" data-cursor-text="View">
                            <figure class="image-anime"><img src="{{ asset('images/gallery-3.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.6s">
                        <a href="{{ asset('images/gallery-4.jpg') }}" data-cursor-text="View">
                            <figure class="image-anime"><img src="{{ asset('images/gallery-4.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="0.8s">
                        <a href="{{ asset('images/gallery-5.jpg') }}" data-cursor-text="View">
                            <figure class="image-anime"><img src="{{ asset('images/gallery-5.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="photo-gallery wow fadeInUp" data-wow-delay="1s">
                        <a href="{{ asset('images/gallery-6.jpg') }}" data-cursor-text="View">
                            <figure class="image-anime"><img src="{{ asset('images/gallery-6.jpg') }}" alt=""></figure>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Section End -->

<!-- Blogs Section Start -->
    <div class="our-blog">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Blogs</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Explore our latest <span>yoga insights</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
    
                <div class="col-lg-6">
                    <!-- Section Title Content Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/blog') }}" class="btn-default">View all post</a>
                    </div>
                    <!-- Section Title Content End -->
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp">
                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/post-1.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single.html">Chakra Balancing Through Yoga and Meditation</a></h2>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Item Readmore Button Start-->
                            <div class="post-item-btn">
                                <a href="blog-single.html" class="readmore-btn">read more</a>
                            </div>
                            <!-- Post Item Readmore Button End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                       <!-- Post Featured Image Start-->
                       <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/post-2.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single.html">The Science Behind Mindfulness Practices</a></h2>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Item Readmore Button Start-->
                            <div class="post-item-btn">
                                <a href="blog-single.html" class="readmore-btn">read more</a>
                            </div>
                            <!-- Post Item Readmore Button End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="blog-single.html" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('images/post-3.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single.html">Creating a Peaceful Meditation Space at Home</a></h2>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Item Readmore Button Start-->
                            <div class="post-item-btn">
                                <a href="blog-single.html" class="readmore-btn">read more</a>
                            </div>
                            <!-- Post Item Readmore Button End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Blogs Section End -->

<!-- FAQ Section Start -->
    <div class="our-faqs">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">FAQs</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Answers to common yoga <span>meditation questions</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/contact-us') }}#faq" class="btn-default">view all faqs</a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Our FAQs Content Start -->
                    <div class="our-faqs-content">
                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="accordion">
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        What is yoga, and how can it benefit me?
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>No prior experience is required. Our classes cater to all levels, from beginners to advanced practitioners. Instructors will guide you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Do I need prior experience to join a class?
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>No prior experience is required. Our classes cater to all levels, from beginners to advanced practitioners. Instructors will guide you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        What's the difference between yoga and meditation?
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>No prior experience is required. Our classes cater to all levels, from beginners to advanced practitioners. Instructors will guide you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="accordion-header" id="heading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        What types of yoga classes do you offer?
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>No prior experience is required. Our classes cater to all levels, from beginners to advanced practitioners. Instructors will guide you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                                <h2 class="accordion-header" id="heading5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        How do I know which class is right for me?
                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>No prior experience is required. Our classes cater to all levels, from beginners to advanced practitioners. Instructors will guide you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    <!-- Our FAQs Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Faqs Image Start -->
                    <div class="faqs-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('images/faqs-image.jpg') }}" alt="">
                        </figure>

                        <!-- Faqs Contact Box Start -->
                        <div class="faqs-contact-box">
                            <div class="icon-box">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="faqs-contact-box-content">
                                <h3>Still have Question?</h3>
                                <p><a href="https://html.awaikenthemes.com/restraint/0761852398"></a>(0) - 0761-852-398</p>
                            </div>
                        </div>
                        <!-- Faqs Contact Box End -->
                    </div>
                    <!-- Faqs Image End -->
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ Section End -->

    <!-- Location SEO Section Start -->
    <div class="page-contact-us home-location" id="location">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Location</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Visit our <span>wellness centre</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Find us easily and plan your visit. We welcome patients seeking non-surgical holistic care for pain relief, rehabilitation, and long-term wellness.</p>
                        </div>
                        <div class="contact-info-list">
                            <div class="contact-info-item wow fadeInUp">
                                <div class="icon-box"><img src="{{ asset('images/icon-location.svg') }}" alt=""></div>
                                <div class="contact-item-content">
                                    <h3>Address</h3>
                                    <p>123 High Street LN1 1AB, United Kingdom</p>
                                </div>
                            </div>
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box"><img src="{{ asset('images/icon-phone.svg') }}" alt=""></div>
                                <div class="contact-item-content">
                                    <h3>Phone</h3>
                                    <p><a href="tel:761853398">+(1) 761-853-398</a></p>
                                </div>
                            </div>
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box"><img src="{{ asset('images/icon-clock.svg') }}" alt=""></div>
                                <div class="contact-item-content">
                                    <h3>Opening Hours</h3>
                                    <p>Mon - Sat: 9:00 AM - 7:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="google-map-iframe wow fadeInUp" data-wow-delay="0.2s">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96737.10562045308!2d-74.08535042841811!3d40.739265258395164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1703158537552!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location SEO Section End -->

<!-- Final CTA Section Start -->
    <div class="cta-box">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Journey to Explore Yoga Amidst Stunning Natural Landscapes</h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-3">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp">
                        <a href="{{ url('/contact-us') }}" class="btn-default btn-highlighted">Book Appointment</a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Final CTA Section End -->
@endsection
