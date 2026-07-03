@php
    $fallbackSlides = [
        [
            'image' => asset('assets/img/hero/hero-1.png'),
            'eyebrow' => 'Welcome to Tripti Hotel',
            'title' => 'Luxury Stays & Premium Hospitality',
            'text' => 'Experience elegant rooms, fine dining, and attentive service designed to make every visit comfortable and memorable.',
            'primary_label' => 'Book Your Stay',
            'primary_url' => route('contact'),
            'secondary_label' => null,
            'secondary_url' => null,
            'secondary_type' => null,
        ],
        [
            'image' => asset('assets/img/hero/hero-2.png'),
            'eyebrow' => 'Rooms & Suites',
            'title' => 'Comfortable Rooms for Every Traveller',
            'text' => 'From deluxe rooms to premium suites, find the perfect space for business trips, family holidays, and weekend escapes.',
            'primary_label' => 'Explore Rooms',
            'primary_url' => route('rooms'),
            'secondary_label' => null,
            'secondary_url' => null,
            'secondary_type' => null,
        ],
        [
            'image' => asset('assets/img/hero/hero-3.png'),
            'eyebrow' => 'Events & Dining',
            'title' => 'Celebrate, Dine, and Host with Ease',
            'text' => 'Discover banquet facilities, curated menus, and event support for weddings, meetings, and special occasions.',
            'primary_label' => 'View Facilities',
            'primary_url' => route('facilities'),
            'secondary_label' => null,
            'secondary_url' => null,
            'secondary_type' => null,
        ],
    ];

    $slides = isset($heroBanners) && $heroBanners->isNotEmpty() ? $heroBanners : collect($fallbackSlides);
    $phoneHref = preg_replace('/\s+/', '', $sitePhone ?? '+919876543210');
    $phoneDisplay = $sitePhone ?? '+91 98765 43210';
@endphp

<section class="section-hero margin-b-50">
    <div class="container-fulid">
        <div class="row">
            <div class="col-12">
                <div class="rx-slider">
                    @foreach ($slides as $index => $slide)
                        @php
                            $isModel = is_object($slide) && method_exists($slide, 'imageUrl');
                            $imageUrl = $isModel ? $slide->imageUrl() : $slide['image'];
                            $eyebrow = $isModel ? $slide->eyebrow : ($slide['eyebrow'] ?? null);
                            $title = $isModel ? $slide->title : $slide['title'];
                            $text = $isModel ? $slide->text : $slide['text'];
                            $primaryLabel = $isModel ? $slide->primary_label : $slide['primary_label'];
                            $primaryUrl = $isModel ? $slide->primaryActionUrl() : $slide['primary_url'];
                            $secondaryLabel = $isModel ? $slide->secondary_label : ($slide['secondary_label'] ?? null);
                            $secondaryUrl = $isModel ? $slide->secondaryActionUrl() : ($slide['secondary_url'] ?? null);
                            $isVideo = $isModel ? $slide->isSecondaryVideo() : false;
                            $hasSecondary = $isModel ? $slide->hasSecondaryAction() : filled($secondaryLabel) && filled($secondaryUrl);
                        @endphp
                        <div class="rx-slide rx-slide-dynamic slide-{{ $index + 1 }}" style="background-image: url('{{ $imageUrl }}');">
                            <img src="{{ $imageUrl }}" alt="" class="banner-arrow-img" aria-hidden="true">
                            <div class="rx-slide-overlay"></div>
                            <div class="rx-hero-contact">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-10">
                                            <div class="inner-contact slider-animation">
                                                @if ($eyebrow)
                                                    <p class="hero-eyebrow">{{ $eyebrow }}</p>
                                                @endif
                                                <h2>{{ $title }}</h2>
                                                @if ($text)
                                                    <p class="hero-lead">{{ $text }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="hero-footer slider-animation">
                                                <div class="hero-actions">
                                                    @if ($primaryLabel)
                                                        <a href="{{ $primaryUrl }}" class="rx-btn-one hero-cta-btn">{{ $primaryLabel }}</a>
                                                    @endif

                                                    @if ($hasSecondary)
                                                        <a href="{{ $secondaryUrl }}" class="rx-btn-one hero-cta-btn" @if ($isVideo) data-fancybox @endif>
                                                            @if ($isVideo)
                                                                <i class="ri-play-fill"></i>
                                                            @endif
                                                            {{ $secondaryLabel }}
                                                        </a>
                                                    @endif
                                                </div>

                                                <a href="tel:{{ $phoneHref }}" class="hero-reservation-card booking-now">
                                                    <span class="hero-reservation-icon">
                                                        <i class="ri-phone-line"></i>
                                                    </span>
                                                    <span class="hero-reservation-text">
                                                        <span class="hero-reservation-label">Reservations</span>
                                                        <span class="hero-reservation-phone">{{ $phoneDisplay }}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof $.fancybox !== 'undefined') {
                $('[data-fancybox]').fancybox({
                    youtube: { controls: 1, showinfo: 0 },
                });
            }
        });
    </script>
@endpush
