@extends('layouts.app')

@section('title', $roomType->name . ' | Rooms | Tripti Hotel')

@section('content')
    @php
        $phone = $contactSettings['phone_1'] ?? $sitePhone ?? null;
        $phoneHref = $phone ? preg_replace('/\s+/', '', $phone) : null;
        $whatsapp = preg_replace('/\D+/', '', (string) ($contactSettings['whatsapp_number'] ?? ''));
        $openingHours = collect(preg_split('/\R/', (string) ($contactSettings['opening_hours'] ?? '')))
            ->map(fn ($line) => trim($line))
            ->filter();
    @endphp

    @include('partials.breadcrumb', [
        'breadcrumbTitle' => $roomType->name,
        'breadcrumbParent' => 'Rooms',
        'breadcrumbParentUrl' => route('rooms'),
    ])

    <section class="room-detail-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="room-detail-gallery-wrap" data-aos="fade-up" data-aos-duration="1000">
                        <div class="room-detail-gallery-main">
                            <img src="{{ $galleryImages[0] }}" alt="{{ $roomType->name }}" id="roomDetailMainImage">
                        </div>
                        @if (count($galleryImages) > 1)
                            <div class="room-detail-gallery-thumbs" role="tablist" aria-label="Room gallery">
                                @foreach ($galleryImages as $index => $imageUrl)
                                    <button type="button"
                                        class="room-detail-gallery-thumb{{ $index === 0 ? ' is-active' : '' }}"
                                        data-room-image="{{ $imageUrl }}"
                                        aria-label="Show image {{ $index + 1 }}">
                                        <img src="{{ $imageUrl }}" alt="{{ $roomType->name }} thumbnail {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif
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
                                    <strong>{{ $roomType->availableRoomsCount() }}</strong>
                                    <span>Rooms Available</span>
                                </div>
                            </div>
                            <div class="room-detail-stat">
                                <i class="ri-team-line"></i>
                                <div>
                                    <strong>{{ $roomType->maxGuests() }}</strong>
                                    <span>Total Guests</span>
                                </div>
                            </div>
                        </div>

                        @if ($roomType->description)
                            <div class="room-detail-description">
                                <h2>About This {{ $roomType->categoryLabel() }}</h2>
                                <div class="room-detail-description-body">{!! nl2br(e($roomType->description)) !!}</div>
                            </div>
                        @endif

                        @if ($roomType->rooms->isNotEmpty())
                            <div class="room-detail-inventory">
                                <h2>Room Inventory</h2>
                                <div class="table-responsive">
                                    <table class="room-detail-inventory-table">
                                        <thead>
                                            <tr>
                                                <th>Room No.</th>
                                                <th>Floor</th>
                                                <th>Bed Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomType->rooms as $room)
                                                <tr>
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->floor ?: '—' }}</td>
                                                    <td>{{ $room->bedType?->name ?? '—' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if ($amenities->isNotEmpty())
                            <div class="room-detail-amenities">
                                <h2>In-Room Amenities</h2>
                                <div class="room-detail-amenities-grid">
                                    @foreach ($amenities as $amenity)
                                        <div class="room-detail-amenity-card">
                                            <span class="room-detail-amenity-icon">
                                                <i class="{{ \App\Support\IconMap::remix($amenity->icon) }}"></i>
                                            </span>
                                            <span class="room-detail-amenity-title">{{ $amenity->title }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($premiumServices->isNotEmpty())
                            <div class="room-detail-premium">
                                <h2>Premium Add-Ons</h2>
                                <p class="room-detail-premium-intro">Enhance your stay with optional services available on request.</p>
                                <div class="room-detail-premium-grid">
                                    @foreach ($premiumServices as $service)
                                        <div class="room-detail-premium-card">
                                            <div class="room-detail-premium-icon">
                                                <i class="{{ \App\Support\IconMap::remix($service->icon) }}"></i>
                                            </div>
                                            <div class="room-detail-premium-body">
                                                <h3>{{ $service->title }}</h3>
                                                @if ($service->description)
                                                    <p>{{ $service->description }}</p>
                                                @endif
                                                @if ($service->price)
                                                    <span class="room-detail-premium-price">From ₹{{ number_format((float) $service->price, 0) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($openingHours->isNotEmpty())
                            <div class="room-detail-policies">
                                <h2>Stay Information</h2>
                                <ul class="room-detail-policies-list">
                                    @foreach ($openingHours as $line)
                                        <li><i class="ri-time-line"></i>{{ $line }}</li>
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

                            <ul class="room-detail-booking-meta">
                                <li><i class="ri-user-line"></i> Up to {{ $roomType->max_adults }} adults</li>
                                @if ($roomType->max_children > 0)
                                    <li><i class="ri-group-line"></i> {{ $roomType->max_children }} children</li>
                                @endif
                                <li><i class="ri-hotel-bed-line"></i> {{ $roomType->availableRoomsCount() }} rooms available</li>
                            </ul>

                            <div class="room-detail-booking-actions">
                                <a href="javascript:void(0)" class="home-room-btn" data-bs-toggle="modal" data-bs-target="#rx_booking_from">
                                    <i class="ri-calendar-check-line"></i> Book Now
                                </a>
                                @if ($phoneHref)
                                    <a href="tel:{{ $phoneHref }}" class="room-detail-sidebar-link">
                                        <i class="ri-phone-line"></i> {{ $phone }}
                                    </a>
                                @endif
                                @if ($whatsapp !== '')
                                    <a href="https://wa.me/{{ $whatsapp }}" class="room-detail-sidebar-link room-detail-sidebar-link--whatsapp" target="_blank" rel="noopener">
                                        <i class="ri-whatsapp-line"></i> WhatsApp Us
                                    </a>
                                @endif
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('roomDetailMainImage');
            const thumbs = document.querySelectorAll('.room-detail-gallery-thumb');

            if (!mainImage || !thumbs.length) {
                return;
            }

            thumbs.forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    const imageUrl = thumb.getAttribute('data-room-image');

                    if (!imageUrl) {
                        return;
                    }

                    mainImage.src = imageUrl;
                    thumbs.forEach(function (item) {
                        item.classList.toggle('is-active', item === thumb);
                    });
                });
            });
        });
    </script>
@endpush
