@extends('layouts.app')

@section('title', 'About Us | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'About Us', 'breadcrumb' => 'About'])

    @php
        use App\Models\Setting;

        $aboutTitle = $settings['about_page_title'] ?: 'A holistic path to';
        $aboutTitleHighlight = $settings['about_page_title_highlight'] ?: 'natural healing';
        $aboutDescription = $settings['about_page_description'] ?: '<p>At Sahaj Aarogyam, we combine time-tested therapies with modern clinical care to treat pain and chronic conditions without surgery — helping you recover safely, naturally, and with lasting results.</p>';
        $aboutImage = Setting::imageUrl($settings['about_page_image'] ?? null);
        $aboutBadgeNumber = $settings['about_page_badge_number'] ?: '25';
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
                            <strong>{{ $aboutBadgeNumber }}+</strong>
                            <span>Years of Trusted Care</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-about-intro-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">About us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $aboutTitle }} <span>{{ $aboutTitleHighlight }}</span></h2>
                            <div class="wow fadeInUp about-page-description" data-wow-delay="0.2s">{!! $aboutDescription !!}</div>
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
    @include('partials.why-choose-section', [
        'whyChooseItems' => $whyChooseItems,
        'sectionClass' => 'about-page-values',
        'title' => 'Why Patients Trust Us',
    ])
    <!-- Why Choose Section End -->
@endsection
