@extends('layouts.app')

@section('title', 'Rooms & Suites | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Rooms & Suites'])

    <section class="rooms-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="home-rooms-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="home-rooms-eyebrow">Accommodation</span>
                <h1 class="home-rooms-title">Our <span>Rooms &amp; Suites</span></h1>
                <p class="home-rooms-intro">Choose from thoughtfully designed rooms and suites with premium comfort, modern amenities, and warm hospitality for every stay.</p>
            </div>

            @if ($roomTypes->isNotEmpty())
                <div class="row g-4">
                    @foreach ($roomTypes as $index => $roomType)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($index % 3) * 100 }}">
                            @include('partials.room-type-card', ['room' => $roomType])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rooms-page-empty text-center" data-aos="fade-up" data-aos-duration="1000">
                    <p>Room listings are being updated. Please contact us for availability.</p>
                    <a href="{{ route('contact') }}" class="btn-pill btn-pill--dark-outline home-rooms-view-all">Contact Us</a>
                </div>
            @endif
        </div>
    </section>
@endsection
