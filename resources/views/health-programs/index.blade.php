@extends('layouts.app')

@section('title', 'Health Programs | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Health Programs', 'breadcrumb' => 'Programs'])

    @php
        $programDetails = [
            ['label' => 'Program Name', 'value' => 'Diabetes Reversal & Lifestyle Management Camp', 'tone' => 'primary'],
            ['label' => 'Date & Time', 'value' => '15 April 2026 · 10:00 AM – 2:00 PM', 'tone' => 'accent', 'icon' => 'fa-calendar-days'],
            ['label' => 'Location', 'value' => 'Agarwal Public School, Indore', 'tone' => 'warm', 'icon' => 'fa-location-dot'],
            ['label' => 'Chief Consultant', 'value' => 'Dr Ravindra Verma', 'tone' => 'primary', 'icon' => 'fa-user-doctor'],
            ['label' => 'Key Benefits', 'value' => 'Diabetes Management, Personalized Diet Plan, Stress Reduction, Lifestyle Counseling, Health Screening', 'tone' => 'accent'],
        ];
    @endphp

    <div class="home-programs-camps">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="home-programs-camps-video wow fadeInUp">
                        <figure class="home-programs-camps-video-frame">
                            <img src="{{ asset('images/gallery-4.jpg') }}" alt="Health programs at Sahaj Aarogyam">
                        </figure>
                        <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="home-programs-camps-play popup-video" aria-label="Watch video">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
