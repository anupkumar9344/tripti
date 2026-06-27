@extends('layouts.app')

@section('title', 'Treatment | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Treatment', 'breadcrumb' => 'Treatment'])

    @php
        $items = [
            ['icon' => 'fa-award', 'title' => 'Back Pain & Spine disorders', 'text' => 'Advanced non-surgical care for chronic back pain, stiffness, and spinal discomfort.'],
            ['icon' => 'fa-hand-holding-heart', 'title' => 'Slip Disc & Sciatica', 'text' => 'Targeted therapies designed to reduce disc-related pain and improve mobility.'],
            ['icon' => 'fa-clipboard-medical', 'title' => 'Liver & Metabolic Disorders', 'text' => 'Natural management for metabolic imbalance, fatty liver, and lifestyle-related conditions.'],
            ['icon' => 'fa-bone', 'title' => 'Knee Pain & Joints pain', 'text' => 'Personalized therapies to improve knee strength, flexibility, and movement.'],
            ['icon' => 'fa-venus-mars', 'title' => 'Male and Female Wellness', 'text' => 'Specialized care for hormonal balance, fertility support, and gender-specific wellness.'],
            ['icon' => 'fa-user-doctor', 'title' => 'Cervical & Ankylosing Spondylitis', 'text' => 'Effective care for neck pain, posture correction, and cervical discomfort.'],
        ];
    @endphp

    <div class="home-what-we-treat page-section-green">
        <div class="home-what-we-treat-overlay"></div>
        <div class="container position-relative">
            <div class="home-what-we-treat-header text-center">
                <h2 class="wow fadeInUp">What We Treat</h2>
                <p class="text-white mt-3 wow fadeInUp" data-wow-delay="0.1s">Non-surgical, integrated care for pain and chronic conditions.</p>
            </div>

            <div class="row g-4">
                @foreach ($items as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="home-treat-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-treat-card-icon">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <div class="home-treat-card-body">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
