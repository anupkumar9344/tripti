@extends('layouts.app')

@section('title', 'About Us | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'About Us', 'breadcrumb' => 'About'])

    @php
        use App\Models\Setting;

        $aboutEyebrow = $settings['about_page_eyebrow'] ?: 'About us';
        $aboutTitle = $settings['about_page_title'] ?: 'A holistic path to';
        $aboutTitleHighlight = $settings['about_page_title_highlight'] ?: 'natural healing';
        $aboutDescription = $settings['about_page_description'] ?: '<p>At Sahaj Aarogyam, we combine time-tested therapies with modern clinical care to treat pain and chronic conditions without surgery — helping you recover safely, naturally, and with lasting results.</p>';
        $aboutImage = Setting::imageUrl($settings['about_page_image'] ?? null);
        $aboutBadgeNumber = $settings['about_page_badge_number'] ?: '25';
        $aboutBadgeSuffix = $settings['about_page_badge_suffix'] ?? '+';
        $aboutBadgeText = $settings['about_page_badge_text'] ?: 'Years of Trusted Care';
        $aboutButtonText = $settings['about_page_button_text'] ?: 'Meet Our Experts';
    @endphp

    <!-- About Intro Section Start -->
    <div class="home-about-intro">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="home-about-intro-media wow fadeInUp">
                        <figure class="home-about-intro-photo">
                            <img src="{{ $aboutImage }}" alt="Sahaj Aarogyam expert team">
                        </figure>
                        <div class="home-about-intro-badge">
                            <strong>{{ $aboutBadgeNumber }}{{ $aboutBadgeSuffix }}</strong>
                            <span>{{ $aboutBadgeText }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-about-intro-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $aboutEyebrow }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $aboutTitle }} <span>{{ $aboutTitleHighlight }}</span></h2>
                            <div class="wow fadeInUp about-page-description" data-wow-delay="0.2s">{!! $aboutDescription !!}</div>
                        </div>

                        <div class="home-about-intro-btn wow fadeInUp" data-wow-delay="0.3s">
                            <a href="{{ url('/our-expert-team') }}" class="btn-default">{{ $aboutButtonText }}</a>
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
                @foreach ($aboutStats as $stat)
                    <div class="why-choose-counter-item wow fadeInUp" @if ($stat['delay'] !== '0') data-wow-delay="{{ $stat['delay'] }}" @endif>
                        <div class="icon-box">
                            <img src="{{ asset('images/' . $stat['icon']) }}" alt="">
                        </div>
                        <div class="why-choose-counter-content">
                            <h3><span class="counter">{{ $stat['count'] }}</span>{{ $stat['suffix'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </div>
                    </div>
                @endforeach
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
