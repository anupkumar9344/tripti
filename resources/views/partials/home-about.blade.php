@php
    use App\Models\Setting;

    $aboutSettings = $settings ?? Setting::getMany([
        'about_home_title',
        'about_home_title_highlight',
        'about_home_description',
        'about_home_image',
        'about_stat_1_count',
        'about_stat_1_label',
        'about_stat_2_count',
        'about_stat_2_label',
        'about_stat_3_count',
        'about_stat_3_label',
    ]);

    $aboutEyebrow = 'About ' . ($siteName ?? 'Tripti Hotel');
    $aboutTitle = $aboutSettings['about_home_title'] ?? 'Experience luxury';
    $aboutHighlight = $aboutSettings['about_home_title_highlight'] ?? 'hospitality';
    $aboutDescription = $aboutSettings['about_home_description'] ?? '';

    $aboutImagePath = $aboutSettings['about_home_image'] ?? null;
    if (filled($aboutImagePath) && (str_starts_with($aboutImagePath, 'http://') || str_starts_with($aboutImagePath, 'https://'))) {
        $aboutImageUrl = $aboutImagePath;
    } elseif (filled($aboutImagePath) && str_starts_with($aboutImagePath, 'assets/')) {
        $aboutImageUrl = asset($aboutImagePath);
    } elseif (filled($aboutImagePath)) {
        $aboutImageUrl = Setting::imageUrl($aboutImagePath, 'assets/img/rooms/1.jpg');
        if (str_contains($aboutImageUrl, 'home-about-team') || str_contains($aboutImageUrl, 'about-one.png')) {
            $aboutImageUrl = asset('assets/img/rooms/1.jpg');
        }
    } else {
        $aboutImageUrl = asset('assets/img/rooms/1.jpg');
    }

    $aboutStats = [
        ['count' => $aboutSettings['about_stat_1_count'] ?? '15', 'label' => $aboutSettings['about_stat_1_label'] ?? 'Years of Hospitality'],
        ['count' => $aboutSettings['about_stat_2_count'] ?? '12000', 'label' => $aboutSettings['about_stat_2_label'] ?? 'Happy Guests'],
        ['count' => $aboutSettings['about_stat_3_count'] ?? '48', 'label' => $aboutSettings['about_stat_3_label'] ?? 'Luxury Rooms'],
    ];
@endphp

<section class="home-about-professional padding-tb-50">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                <div class="home-about-image">
                    <img src="{{ $aboutImageUrl }}" alt="{{ $aboutTitle }} {{ $aboutHighlight }}">
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <div class="home-about-copy">
                    <span class="home-about-eyebrow">{{ $aboutEyebrow }}</span>
                    <h2 class="home-about-title">{{ $aboutTitle }} <span>{{ $aboutHighlight }}</span></h2>

                    @if ($aboutDescription)
                        <p class="home-about-text">{{ $aboutDescription }}</p>
                    @endif

                    <div class="home-about-metrics">
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

                    <a href="{{ route('about') }}" class="home-about-btn">Discover Our Story</a>
                </div>
            </div>
        </div>
    </div>
</section>
