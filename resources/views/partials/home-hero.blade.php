@php
    use App\Support\IconMap;

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
            'primary_label' => 'Contact Us',
            'primary_url' => route('contact'),
            'secondary_label' => null,
            'secondary_url' => null,
            'secondary_type' => null,
        ],
    ];

    $slides = isset($heroBanners) && $heroBanners->isNotEmpty() ? $heroBanners : collect($fallbackSlides);

    $firstSlide = $slides->first();
    $isFirstModel = is_object($firstSlide) && method_exists($firstSlide, 'imageUrl');
    $heroTitle = $isFirstModel
        ? $firstSlide->title
        : ($firstSlide['title'] ?? (($settings ?? [])['about_home_title'] ?? 'Enjoy a relaxing retreat at Tripti Hotel'));

    $phoneHref = preg_replace('/\s+/', '', $sitePhone ?? '+919876543210');
    $phoneDisplay = $sitePhone ?? '+91 98765 43210';
    $emailDisplay = $siteEmail ?? 'info@triptihotel.com';
    $addressDisplay = ($settings ?? [])['address'] ?? '987-A, Dudhivadar, Rajkot, Gujarat, Bharat - 360410';
    $addressShort = \Illuminate\Support\Str::limit($addressDisplay, 42);

    $featureTags = isset($whyChooseItems) ? $whyChooseItems->take(3) : collect();

    $averageRating = round((float) (($settings ?? [])['patient_feedback_average_rating'] ?? 5.0), 1);
    $totalReviews = ($settings ?? [])['patient_feedback_total_reviews'] ?? '428';
    $filledStars = min(5, max(0, (int) round($averageRating)));

    $lowestFare = isset($homeRooms) && $homeRooms->isNotEmpty()
        ? $homeRooms->min('fare')
        : null;

    $openingHours = collect(preg_split('/\R/', (string) (($settings ?? [])['opening_hours'] ?? '')))
        ->map(fn ($line) => trim($line))
        ->filter();

    $checkInText = $openingHours->first(fn ($line) => stripos($line, 'check-in') !== false) ?? 'Check-in: 2:00 PM';
    $checkOutText = $openingHours->first(fn ($line) => stripos($line, 'check-out') !== false) ?? 'Check-out: 11:00 AM';
    $checkInText = preg_replace('/^check-in:\s*/i', 'Check-in: ', $checkInText);
    $checkOutText = preg_replace('/^check-out:\s*/i', 'Check-out: ', $checkOutText);
@endphp

<section class="section-hero section-hero-split margin-b-50">
    <div class="hero-split-layout">
        <div class="hero-split-banner">
                <div class="rx-slider">
                    @foreach ($slides as $index => $slide)
                        @php
                            $isModel = is_object($slide) && method_exists($slide, 'imageUrl');
                            $isVideoBanner = $isModel && $slide->isVideoBanner();
                            $imageUrl = $isModel ? $slide->posterUrl() : $slide['image'];
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
                        <div class="rx-slide rx-slide-dynamic{{ $isVideoBanner ? ' rx-slide-video' : '' }} slide-{{ $index + 1 }}" @unless($isVideoBanner) style="background-image: url('{{ $imageUrl }}');" @endunless>
                            @if ($isVideoBanner)
                                <div class="hero-slide-video-wrap" aria-hidden="true">
                                    @if ($slide->isDirectVideo())
                                        <video class="hero-slide-video-media" muted loop playsinline preload="metadata" poster="{{ $imageUrl }}">
                                            <source src="{{ $slide->videoSourceUrl() }}" type="video/mp4">
                                        </video>
                                    @else
                                        <iframe
                                            class="hero-slide-video-iframe"
                                            src="{{ $slide->videoEmbedUrl() }}"
                                            title="{{ $title }}"
                                            allow="autoplay; encrypted-media; picture-in-picture"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            loading="lazy"
                                        ></iframe>
                                    @endif
                                </div>
                            @endif
                            <img src="{{ $imageUrl }}" alt="" class="banner-arrow-img" aria-hidden="true">
                            <div class="rx-slide-overlay"></div>
                            <div class="rx-hero-contact">
                                <div class="hero-slide-inner">
                                    <div class="inner-contact slider-animation">
                                        @if ($eyebrow)
                                            <span class="hero-eyebrow">{{ $eyebrow }}</span>
                                        @endif
                                        <h2>{{ $title }}</h2>
                                        @if ($text)
                                            <p class="hero-lead">{{ $text }}</p>
                                        @endif
                                    </div>

                                    <div class="hero-footer slider-animation">
                                        <div class="hero-actions">
                                            @if ($primaryLabel)
                                                <a href="{{ $primaryUrl }}" class="btn-pill btn-pill--primary hero-cta-btn">{{ $primaryLabel }}</a>
                                            @endif

                                            @if ($hasSecondary)
                                                <a href="{{ $secondaryUrl }}" class="btn-pill btn-pill--outline hero-cta-btn" @if ($isVideo) data-fancybox @endif>
                                                    @if ($isVideo)
                                                        <i class="ri-play-fill"></i>
                                                    @endif
                                                    {{ $secondaryLabel }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="hero-split-info d-none d-lg-flex">
                <div class="hero-info-card">
                    <h1 class="hero-info-title">{{ $heroTitle }}</h1>

                    <div class="hero-info-contacts">
                        <a href="mailto:{{ $emailDisplay }}" class="hero-info-contact hero-info-contact--tooltip" data-tooltip="{{ $emailDisplay }}" aria-label="Email {{ $emailDisplay }}">
                            <i class="ri-mail-line" aria-hidden="true"></i>
                        </a>
                        <a href="tel:{{ $phoneHref }}" class="hero-info-contact hero-info-contact--tooltip" data-tooltip="{{ $phoneDisplay }}" aria-label="Call {{ $phoneDisplay }}">
                            <i class="ri-phone-line" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('contact') }}" class="hero-info-contact hero-info-contact--address" title="{{ $addressDisplay }}">
                            <i class="ri-map-pin-line" aria-hidden="true"></i>
                            <span>{{ $addressShort }}</span>
                        </a>
                    </div>

                    @if ($featureTags->isNotEmpty())
                        <ul class="hero-info-tags">
                            @foreach ($featureTags as $tag)
                                <li>
                                    <span class="hero-info-tag-icon" aria-hidden="true">
                                        <i class="{{ IconMap::remix($tag->icon) }}"></i>
                                    </span>
                                    <span>{{ $tag->title }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="hero-info-rating">
                        <span class="hero-info-rating-badge">{{ number_format($averageRating, 1) }}</span>
                        <span class="hero-info-rating-stars" aria-label="{{ number_format($averageRating, 1) }} out of 5 stars">
                            @for ($i = 0; $i < $filledStars; $i++)
                                <i class="ri-star-fill" aria-hidden="true"></i>
                            @endfor
                            @for ($i = $filledStars; $i < 5; $i++)
                                <i class="ri-star-line" aria-hidden="true"></i>
                            @endfor
                        </span>
                        <span class="hero-info-rating-count">({{ $totalReviews }} reviews)</span>
                    </div>

                    <p class="hero-info-times">{{ $checkInText }} | {{ $checkOutText }}</p>

                    <a href="{{ route('booking') }}" class="hero-info-booking">
                        <span class="hero-info-booking-icon">
                            <i class="ri-calendar-check-line" aria-hidden="true"></i>
                        </span>
                        <span class="hero-info-booking-copy">
                            @if ($lowestFare)
                                <strong>From ₹{{ number_format((float) $lowestFare, 2) }} /night</strong>
                            @else
                                <strong>Book your stay</strong>
                            @endif
                            <small>*lowest rate for the next 60 days</small>
                        </span>
                        <span class="hero-info-booking-arrow" aria-hidden="true">
                            <i class="ri-arrow-right-line"></i>
                        </span>
                    </a>
                </div>
            </aside>
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

            const heroSlider = document.querySelector('.section-hero-split .rx-slider');

            if (!heroSlider || typeof jQuery === 'undefined') {
                return;
            }

            const syncHeroVideos = function () {
                heroSlider.querySelectorAll('.hero-slide-video-media').forEach(function (video) {
                    const slide = video.closest('.rx-slide');
                    const isActive = slide && slide.classList.contains('slick-active');

                    if (isActive) {
                        const playPromise = video.play();
                        if (playPromise !== undefined) {
                            playPromise.catch(function () {});
                        }
                    } else {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            };

            jQuery(heroSlider).on('init afterChange', syncHeroVideos);
            syncHeroVideos();
        });
    </script>
@endpush
