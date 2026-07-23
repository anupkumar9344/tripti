@php
    use App\Models\HotelFacility;

    $homeFacilities = $homeFacilities ?? HotelFacility::query()->forHome()->get();
@endphp

@if ($homeFacilities->isNotEmpty())
    <section class="home-amenities-section padding-tb-50">
        <div class="container">
            <div class="home-amenities-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="home-amenities-eyebrow">Luxury Comforts</span>
                <h2 class="home-amenities-title">Our <span>Amenities</span></h2>
                <p class="home-amenities-intro">Discover world-class comforts designed to elevate every moment of your stay with us.</p>
            </div>

            <div class="home-amenities-showcase" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <div class="home-amenities-visual">
                    @foreach ($homeFacilities as $index => $facility)
                        <div class="home-amenities-slide{{ $index === 0 ? ' is-active' : '' }}" data-amenity-slide="{{ $index }}">
                            <img src="{{ $facility->imageUrl($index) }}" alt="{{ $facility->title }}">
                        </div>
                    @endforeach

                    <div class="home-amenities-dots" role="tablist" aria-label="Amenities">
                        @foreach ($homeFacilities as $index => $facility)
                            <button
                                type="button"
                                class="home-amenities-dot{{ $index === 0 ? ' is-active' : '' }}"
                                role="tab"
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="home-amenity-panel-{{ $index }}"
                                data-amenity-tab="{{ $index }}"
                            >
                                <span class="visually-hidden">{{ $facility->title }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="home-amenities-content">
                    <nav class="home-amenities-tabs" role="tablist" aria-label="Amenity categories">
                        @foreach ($homeFacilities as $index => $facility)
                            <button
                                type="button"
                                class="home-amenities-tab{{ $index === 0 ? ' is-active' : '' }}"
                                role="tab"
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="home-amenity-panel-{{ $index }}"
                                data-amenity-tab="{{ $index }}"
                            >
                                @if ($facility->icon)
                                    <i class="fa-solid {{ $facility->icon }}"></i>
                                @else
                                    <span class="home-amenities-tab-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                @endif
                                <span>{{ $facility->title }}</span>
                            </button>
                        @endforeach
                    </nav>

                    <div class="home-amenities-panels">
                        @foreach ($homeFacilities as $index => $facility)
                            <div
                                id="home-amenity-panel-{{ $index }}"
                                class="home-amenities-panel{{ $index === 0 ? ' is-active' : '' }}"
                                role="tabpanel"
                                data-amenity-panel="{{ $index }}"
                            >
                                <h3 class="home-amenities-panel-title">{{ $facility->title }}</h3>
                                @if ($facility->short_description)
                                    <p class="home-amenities-panel-text">{{ $facility->short_description }}</p>
                                @endif
                                <a href="{{ route('contact') }}" class="btn-pill btn-pill--dark home-amenities-btn">Learn More</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
