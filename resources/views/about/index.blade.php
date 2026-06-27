@extends('layouts.app')

@section('title', 'About Us | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'About Us', 'breadcrumb' => 'About'])

    <!-- About Intro Section Start -->
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
                            <a href="{{ url('/our-expert-team') }}" class="btn-default">Meet Our Experts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Intro Section End -->

    <!-- Stats Section Start -->
    <div class="about-stats-section">
        <div class="container">
            <div class="why-choose-counter-box">
                <div class="why-choose-counter-item wow fadeInUp">
                    <div class="icon-box">
                        <img src="{{ asset('images/icon-why-choose-counter-1.svg') }}" alt="">
                    </div>
                    <div class="why-choose-counter-content">
                        <h3><span class="counter">25</span>+</h3>
                        <p>Years of Experience</p>
                    </div>
                </div>

                <div class="why-choose-counter-item wow fadeInUp" data-wow-delay="0.1s">
                    <div class="icon-box">
                        <img src="{{ asset('images/icon-why-choose-counter-2.svg') }}" alt="">
                    </div>
                    <div class="why-choose-counter-content">
                        <h3><span class="counter">3500</span>+</h3>
                        <p>Patients Treated</p>
                    </div>
                </div>

                <div class="why-choose-counter-item wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <img src="{{ asset('images/icon-why-choose-counter-3.svg') }}" alt="">
                    </div>
                    <div class="why-choose-counter-content">
                        <h3><span class="counter">15</span>+</h3>
                        <p>Expert Specialists</p>
                    </div>
                </div>

                <div class="why-choose-counter-item wow fadeInUp" data-wow-delay="0.3s">
                    <div class="icon-box">
                        <img src="{{ asset('images/icon-why-choose-counter-4.svg') }}" alt="">
                    </div>
                    <div class="why-choose-counter-content">
                        <h3><span class="counter">10</span>+</h3>
                        <p>Therapy Disciplines</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats Section End -->

    <!-- Why Choose Section Start -->
    @php
        $aboutValues = [
            ['icon' => 'fa-shield-halved', 'title' => 'Root-Cause Diagnosis', 'text' => 'We identify what is actually causing the issue — not just suppress symptoms.'],
            ['icon' => 'fa-user-doctor', 'title' => 'Integrated Specialists', 'text' => 'Physiotherapists, Ayurveda doctors, nutritionists and therapists under one roof.'],
            ['icon' => 'fa-hand-holding-heart', 'title' => 'Personalised Protocols', 'text' => 'Every patient receives a treatment plan designed for their unique condition.'],
            ['icon' => 'fa-leaf', 'title' => 'Non-Surgical & Natural', 'text' => 'Avoid risky surgery wherever possible with safe, evidence-based therapies.'],
            ['icon' => 'fa-award', 'title' => '25+ Years Experience', 'text' => 'Decades of clinical work treating complex pain and lifestyle disorders.'],
            ['icon' => 'fa-heart-pulse', 'title' => 'Long-Term Wellness', 'text' => 'Lasting results — we treat the body, mind, metabolism and lifestyle together.'],
        ];
    @endphp
    <div class="home-why-choose about-page-values">
        <div class="container">
            <div class="home-why-choose-header text-center">
                <span class="home-why-choose-eyebrow wow fadeInUp">Why Sahaj Aarogyam</span>
                <h2 class="wow fadeInUp" data-wow-delay="0.1s">Why Patients Trust Us</h2>
                <p class="wow fadeInUp" data-wow-delay="0.2s">A structured integrated healthcare brand — not just another clinic.</p>
            </div>

            <div class="row g-4">
                @foreach ($aboutValues as $index => $item)
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
@endsection
