@extends('layouts.app')

@section('title', $roomType->name . ' | Rooms | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', [
        'breadcrumbTitle' => $roomType->name,
        'breadcrumbParent' => 'Rooms',
        'breadcrumbParentUrl' => route('rooms'),
    ])

    <section class="room-detail-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="room-detail-gallery" data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ $roomType->imageUrl() }}" alt="{{ $roomType->name }}">
                    </div>

                    <div class="room-detail-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="room-detail-meta">
                            <span class="room-detail-category">{{ $roomType->categoryLabel() }}</span>
                            @if ($roomType->is_featured)
                                <span class="room-detail-featured">Featured</span>
                            @endif
                        </div>

                        <h1 class="room-detail-title">{{ $roomType->name }}</h1>

                        @if ($roomType->short_description)
                            <p class="room-detail-lead">{{ $roomType->short_description }}</p>
                        @endif

                        <div class="room-detail-stats">
                            <div class="room-detail-stat">
                                <i class="ri-user-line"></i>
                                <div>
                                    <strong>{{ $roomType->max_adults }}</strong>
                                    <span>Max Adults</span>
                                </div>
                            </div>
                            <div class="room-detail-stat">
                                <i class="ri-group-line"></i>
                                <div>
                                    <strong>{{ $roomType->max_children }}</strong>
                                    <span>Max Children</span>
                                </div>
                            </div>
                            <div class="room-detail-stat">
                                <i class="ri-hotel-bed-line"></i>
                                <div>
                                    <strong>{{ $roomType->rooms()->where('status', true)->count() }}</strong>
                                    <span>Rooms Available</span>
                                </div>
                            </div>
                        </div>

                        @if ($amenities->isNotEmpty())
                            <div class="room-detail-amenities">
                                <h2>In-Room Amenities</h2>
                                <ul class="room-detail-amenities-list">
                                    @foreach ($amenities as $amenity)
                                        <li>
                                            @if ($amenity->icon)
                                                <i class="fa-solid {{ $amenity->icon }}"></i>
                                            @else
                                                <i class="ri-check-line"></i>
                                            @endif
                                            {{ $amenity->title }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <aside class="room-detail-sidebar" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                        <div class="room-detail-booking-card">
                            <span class="room-detail-booking-label">Starting from</span>
                            <p class="room-detail-booking-price">₹{{ number_format((float) $roomType->fare, 0) }} <span>/ night</span></p>
                            <p class="room-detail-booking-note">Rates may vary by season and availability.</p>
                            <div class="room-detail-booking-actions">
                                <a href="javascript:void(0)" class="home-room-btn" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a>
                                <a href="{{ route('contact') }}" class="room-detail-contact-link">Need help? Contact us</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            @if ($relatedRooms->isNotEmpty())
                <div class="room-detail-related" data-aos="fade-up" data-aos-duration="1000">
                    <div class="home-rooms-header text-center">
                        <span class="home-rooms-eyebrow">More Options</span>
                        <h2 class="home-rooms-title">You May Also <span>Like</span></h2>
                    </div>
                    <div class="row g-4">
                        @foreach ($relatedRooms as $relatedRoom)
                            <div class="col-lg-4 col-md-6">
                                @include('partials.room-type-card', ['room' => $relatedRoom])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
