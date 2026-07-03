@php
    use App\Models\HotelFacility;

    $homeFacilities = ($homeFacilities ?? HotelFacility::query()->forHome()->limit(6)->get());

    if ($homeFacilities->isEmpty()) {
        $homeFacilities = collect([
            ['title' => 'Restro & Cafe', 'image' => asset('assets/img/amenities/1.jpg'), 'short_description' => 'Welcome to The Gourmet Haven, where culinary excellence meets a serene and inviting ambiance.'],
            ['title' => 'Spa & Beauty', 'image' => asset('assets/img/amenities/2.jpg'), 'short_description' => 'Rejuvenate your body and mind with our premium spa treatments and wellness services.'],
            ['title' => 'Gym & Fitness', 'image' => asset('assets/img/amenities/3.jpg'), 'short_description' => 'Stay active during your stay with our fully equipped fitness center and personal trainers.'],
            ['title' => 'Swimming Pool', 'image' => asset('assets/img/amenities/4.jpg'), 'short_description' => 'Relax by our outdoor pool with stunning views and poolside service.'],
        ]);
    }
@endphp

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
                    @php
                        $isModel = is_object($facility) && method_exists($facility, 'imageUrl');
                        $title = $isModel ? $facility->title : $facility['title'];
                        $imageUrl = $isModel ? $facility->imageUrl() : $facility['image'];
                    @endphp
                    <div class="home-amenities-slide{{ $index === 0 ? ' is-active' : '' }}" data-amenity-slide="{{ $index }}">
                        <img src="{{ $imageUrl }}" alt="{{ $title }}">
                    </div>
                @endforeach

                <div class="home-amenities-dots" role="tablist" aria-label="Amenities">
                    @foreach ($homeFacilities as $index => $facility)
                        @php
                            $isModel = is_object($facility) && method_exists($facility, 'imageUrl');
                            $title = $isModel ? $facility->title : $facility['title'];
                        @endphp
                        <button
                            type="button"
                            class="home-amenities-dot{{ $index === 0 ? ' is-active' : '' }}"
                            role="tab"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-controls="home-amenity-panel-{{ $index }}"
                            data-amenity-tab="{{ $index }}"
                        >
                            <span class="visually-hidden">{{ $title }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="home-amenities-content">
                <nav class="home-amenities-tabs" role="tablist" aria-label="Amenity categories">
                    @foreach ($homeFacilities as $index => $facility)
                        @php
                            $isModel = is_object($facility) && method_exists($facility, 'imageUrl');
                            $title = $isModel ? $facility->title : $facility['title'];
                            $icon = $isModel ? $facility->icon : null;
                        @endphp
                        <button
                            type="button"
                            class="home-amenities-tab{{ $index === 0 ? ' is-active' : '' }}"
                            role="tab"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-controls="home-amenity-panel-{{ $index }}"
                            data-amenity-tab="{{ $index }}"
                        >
                            @if ($icon)
                                <i class="fa-solid {{ $icon }}"></i>
                            @else
                                <span class="home-amenities-tab-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            @endif
                            <span>{{ $title }}</span>
                        </button>
                    @endforeach
                </nav>

                <div class="home-amenities-panels">
                    @foreach ($homeFacilities as $index => $facility)
                        @php
                            $isModel = is_object($facility) && method_exists($facility, 'imageUrl');
                            $title = $isModel ? $facility->title : $facility['title'];
                            $description = $isModel ? $facility->short_description : $facility['short_description'];
                        @endphp
                        <div
                            id="home-amenity-panel-{{ $index }}"
                            class="home-amenities-panel{{ $index === 0 ? ' is-active' : '' }}"
                            role="tabpanel"
                            data-amenity-panel="{{ $index }}"
                        >
                            <h3 class="home-amenities-panel-title">{{ $title }}</h3>
                            @if ($description)
                                <p class="home-amenities-panel-text">{{ $description }}</p>
                            @endif
                            <a href="{{ route('facilities') }}" class="home-amenities-btn">Learn More</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
