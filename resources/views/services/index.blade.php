@extends('layouts.app')

@section('title', 'Services | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Services', 'breadcrumb' => 'Services'])

    @php
        $services = [
            ['image' => 'service-featured-image.jpg', 'title' => 'Pain & Rehabilitation', 'text' => 'Personalized rehabilitation therapies focused on pain relief, mobility, recovery, and physical strength.', 'tags' => ['Physiotherapy', 'Neuro Rehab']],
            ['image' => 'gallery-2.jpg', 'title' => 'Ayurveda & Detox', 'text' => 'Traditional Ayurvedic detox therapies designed to restore balance, cleanse the body, and wellness.', 'tags' => ['Panchakarma', 'Naturopathy']],
            ['image' => 'gallery-3.jpg', 'title' => 'Metabolic Care', 'text' => 'Customized wellness programs for weight management, metabolism support, and nutritional balance.', 'tags' => ['Weight Loss', 'Nutrition']],
            ['image' => 'service-benefits-img.jpg', 'title' => 'Hijama & Cupping', 'text' => 'Therapeutic cupping treatments to improve circulation, relieve pain, and support natural healing.', 'tags' => ['Hijama Therapy', 'Pain Relief']],
            ['image' => 'gallery-5.jpg', 'title' => 'Acupuncture & Acupressure', 'text' => 'Evidence-based needle and pressure-point therapies to restore energy flow and reduce chronic discomfort.', 'tags' => ['Acupuncture', 'Acupressure']],
            ['image' => 'what-we-benefit-image.jpg', 'title' => 'Holistic Wellness Programs', 'text' => 'Integrated care plans combining multiple therapies for long-term health, vitality, and lifestyle balance.', 'tags' => ['Integrated Care', 'Lifestyle Support']],
        ];
    @endphp

    <div class="home-core-services">
        <div class="container">
            <div class="home-core-services-header text-center">
                <h2 class="wow fadeInUp">Our Core Services</h2>
            </div>

            <div class="row g-4">
                @foreach ($services as $index => $service)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-core-service-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-core-service-media">
                                <img src="{{ asset('images/' . $service['image']) }}" alt="{{ $service['title'] }}">
                                <span class="home-core-service-badge" aria-hidden="true">
                                    <i class="fa-solid fa-mortar-pestle"></i>
                                </span>
                            </div>
                            <div class="home-core-service-content">
                                <h3>{{ $service['title'] }}</h3>
                                <p>{{ $service['text'] }}</p>
                                <ul class="home-core-service-tags">
                                    @foreach ($service['tags'] as $tag)
                                        <li><i class="fa-solid fa-circle-check"></i> {{ $tag }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
