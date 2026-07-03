@php
    use App\Models\Setting;

    $aboutSettings = $settings ?? Setting::getMany([
        'about_page_title',
        'about_page_title_highlight',
        'about_page_description',
        'about_page_image',
        'about_page_badge_number',
        'about_mission_title',
        'about_mission_text',
        'about_vision_title',
        'about_vision_text',
        'about_stat_1_count',
        'about_stat_1_label',
        'about_stat_2_count',
        'about_stat_2_label',
        'about_stat_3_count',
        'about_stat_3_label',
        'about_stat_4_count',
        'about_stat_4_label',
    ]);

    $aboutEyebrow = 'About ' . ($siteName ?? 'Tripti Hotel');
    $aboutTitle = $aboutSettings['about_page_title'] ?? 'Experience luxury';
    $aboutHighlight = $aboutSettings['about_page_title_highlight'] ?? 'hospitality';
    $aboutDescription = $aboutSettings['about_page_description'] ?? '';
    $badgeNumber = $aboutSettings['about_page_badge_number'] ?? '15';

    $aboutImagePath = $aboutSettings['about_page_image'] ?? null;
    if (filled($aboutImagePath) && (str_starts_with($aboutImagePath, 'http://') || str_starts_with($aboutImagePath, 'https://'))) {
        $aboutImageUrl = $aboutImagePath;
    } elseif (filled($aboutImagePath) && str_starts_with($aboutImagePath, 'assets/')) {
        $aboutImageUrl = asset($aboutImagePath);
    } elseif (filled($aboutImagePath)) {
        $aboutImageUrl = Setting::imageUrl($aboutImagePath, 'assets/img/rooms/1.jpg');
    } else {
        $aboutImageUrl = asset('assets/img/rooms/1.jpg');
    }

    $aboutStats = [
        ['count' => $aboutSettings['about_stat_1_count'] ?? '15', 'label' => $aboutSettings['about_stat_1_label'] ?? 'Years of Hospitality'],
        ['count' => $aboutSettings['about_stat_2_count'] ?? '12000', 'label' => $aboutSettings['about_stat_2_label'] ?? 'Happy Guests'],
        ['count' => $aboutSettings['about_stat_3_count'] ?? '48', 'label' => $aboutSettings['about_stat_3_label'] ?? 'Luxury Rooms'],
        ['count' => $aboutSettings['about_stat_4_count'] ?? '24', 'label' => $aboutSettings['about_stat_4_label'] ?? 'Hour Concierge'],
    ];

    $missionTitle = $aboutSettings['about_mission_title'] ?? 'Our Mission';
    $missionText = $aboutSettings['about_mission_text'] ?? 'To deliver exceptional hospitality through comfortable stays, attentive service, and memorable guest experiences at every visit.';
    $visionTitle = $aboutSettings['about_vision_title'] ?? 'Our Vision';
    $visionText = $aboutSettings['about_vision_text'] ?? 'To be the most trusted hotel in Rajkot for leisure, business, and celebrations — known for warmth, quality, and genuine care.';

    $contactPhone = $sitePhone ?? '+91 98765 43210';
    $contactEmail = $siteEmail ?? 'info@triptihotel.com';
    $phoneDigits = preg_replace('/\D+/', '', (string) $contactPhone);
@endphp

<section class="about-page-section padding-t-50 padding-b-100">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                <div class="about-page-image-wrap">
                    <div class="about-page-image">
                        <img src="{{ $aboutImageUrl }}" alt="{{ $aboutTitle }} {{ $aboutHighlight }}">
                    </div>
                    @if ($badgeNumber)
                        <div class="about-page-experience-badge">
                            <strong>{{ $badgeNumber }}+</strong>
                            <span>Years of Excellence</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <div class="home-about-copy">
                    <span class="home-about-eyebrow">{{ $aboutEyebrow }}</span>
                    <h1 class="home-about-title">{{ $aboutTitle }} <span>{{ $aboutHighlight }}</span></h1>

                    @if ($aboutDescription)
                        <div class="about-page-description">{!! $aboutDescription !!}</div>
                    @endif

                    <div class="home-about-metrics about-page-metrics">
                        @foreach ($aboutStats as $stat)
                            @php
                                $count = $stat['count'];
                                $displayCount = is_numeric($count) && (int) $count >= 1000
                                    ? rtrim(rtrim(number_format((int) $count / 1000, 1), '0'), '.') . 'K'
                                    : $count;
                            @endphp
                            <div class="home-about-metric">
                                <strong>{{ $displayCount }}+</strong>
                                <span>{{ $stat['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 about-page-mv-row">
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                <div class="about-page-mv-card">
                    <span class="about-page-mv-icon"><i class="ri-compass-3-line"></i></span>
                    <h2>{{ $missionTitle }}</h2>
                    <p>{{ $missionText }}</p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="about-page-mv-card">
                    <span class="about-page-mv-icon"><i class="ri-eye-line"></i></span>
                    <h2>{{ $visionTitle }}</h2>
                    <p>{{ $visionText }}</p>
                </div>
            </div>
        </div>

        <div class="about-page-contact-card" data-aos="fade-up" data-aos-duration="1000">
            <div class="about-page-contact-copy">
                <span class="about-page-contact-badge">We're Here to Help</span>
                <h2>Contact Us</h2>
                <p>Have a question about your stay, events, or reservations? Our front desk team is ready to assist you.</p>
            </div>
            <div class="about-page-contact-actions">
                <a href="tel:{{ $phoneDigits }}" class="about-page-contact-item">
                    <i class="ri-phone-line"></i>
                    <span>{{ $contactPhone }}</span>
                </a>
                <a href="mailto:{{ $contactEmail }}" class="about-page-contact-item">
                    <i class="ri-mail-line"></i>
                    <span>{{ $contactEmail }}</span>
                </a>
                <a href="{{ route('contact') }}" class="about-page-contact-btn">Get In Touch</a>
            </div>
        </div>
    </div>
</section>
