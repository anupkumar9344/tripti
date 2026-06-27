@extends('layouts.app')

@section('title', $treatment->title . ' | Treatment | Sahaj Aarogyam')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="page-header-bg" style="background-image: url('{{ $treatment->imageUrl() }}');"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $treatment->title }}</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/treatment') }}">Treatment</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $treatment->title }}</li>
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
                            <h3>What We Treat</h3>
                            <ul>
                                @foreach ($allTreatments as $navItem)
                                    <li class="{{ $navItem->slug === $treatment->slug ? 'active' : '' }}">
                                        <a href="{{ route('treatment.show', $navItem->slug) }}">{{ $navItem->title }}</a>
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
                                <img src="{{ $treatment->imageUrl() }}" alt="{{ $treatment->title }}">
                            </figure>
                        </div>

                        @if ($treatment->short_description)
                            <p class="wow fadeInUp">{{ $treatment->short_description }}</p>
                        @endif

                        @if ($treatment->long_description)
                            <div class="service-entry wow fadeInUp" data-wow-delay="0.1s">
                                {!! $treatment->long_description !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Detail Single End -->
@endsection
