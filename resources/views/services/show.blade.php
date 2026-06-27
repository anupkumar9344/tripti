@extends('layouts.app')

@section('title', $service->title . ' | Services | Sahaj Aarogyam')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="page-header-bg" style="background-image: url('{{ $service->thumbnailUrl() }}');"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $service->title }}</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/services') }}">Services</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Detail Single Start -->
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        <div class="page-catagery-list wow fadeInUp">
                            <h3>Our Services</h3>
                            <ul>
                                @foreach ($allServices as $navItem)
                                    <li class="{{ $navItem->slug === $service->slug ? 'active' : '' }}">
                                        <a href="{{ route('services.show', $navItem->slug) }}">{{ $navItem->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                            <div class="sidebar-cta-image">
                                <figure>
                                    <img src="{{ asset('images/gallery-4.jpg') }}" alt="Book a consultation at Sahaj Aarogyam">
                                </figure>
                            </div>
                            <div class="sidebar-cta-content">
                                <h3>Book a consultation for personalised care</h3>
                                <a href="{{ url('/contact-us') }}" class="btn-default">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="service-single-content">
                        <div class="service-featured-image wow fadeInUp">
                            <figure>
                                <img src="{{ $service->thumbnailUrl() }}" alt="{{ $service->title }}">
                            </figure>
                        </div>

                        @if ($service->short_description)
                            <p class="wow fadeInUp">{{ $service->short_description }}</p>
                        @endif

                        @if ($service->long_description)
                            <div class="service-entry wow fadeInUp" data-wow-delay="0.1s">
                                {!! $service->long_description !!}
                            </div>
                        @endif

                        @if ($service->images->isNotEmpty())
                            <div class="service-benefits-box mt-4">
                                <h2 class="text-anime-style-2">Service <span>Gallery</span></h2>
                                <div class="row g-3 mt-2">
                                    @foreach ($service->images as $image)
                                        <div class="col-md-6">
                                            <figure class="mb-0">
                                                <img src="{{ $image->imageUrl() }}" alt="{{ $service->title }} gallery image" class="img-fluid rounded">
                                            </figure>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @include('partials.detail-faq-section', [
                            'accordionId' => 'serviceFaqAccordion',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Detail Single End -->
@endsection
