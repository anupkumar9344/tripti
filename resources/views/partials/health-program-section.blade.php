@php
    $variant = $variant ?? 'home';
    $reverse = ! empty($reverse);
    $showSectionIntro = $variant === 'home';
    $programDetails = $program->detailItems($showSectionIntro);
    $videoUrl = $program->video_url ?: 'https://www.youtube.com/watch?v=Y-x0efG1seA';
    $buttonUrl = $program->button_url ? (str_starts_with($program->button_url, 'http') ? $program->button_url : url($program->button_url)) : url('/contact-us');
    $buttonText = $program->button_text ?: 'Explore Latest Programs';
@endphp

<div @class([
    'home-programs-camps',
    'home-programs-camps--listing' => $variant === 'listing',
    'home-programs-camps--reverse' => $variant === 'listing' && $reverse,
])>
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div @class([
                'col-lg-5',
                'order-lg-2' => $reverse,
            ])>
                <div class="home-programs-camps-video wow fadeInUp">
                    <figure class="home-programs-camps-video-frame">
                        <img src="{{ $program->imageUrl() }}" alt="{{ $program->title }}">
                    </figure>
                    @if ($program->video_url)
                        <a href="{{ $videoUrl }}" class="home-programs-camps-play popup-video" aria-label="Watch {{ $program->title }} video">
                            <span class="home-programs-camps-play-icon"><i class="fa-solid fa-play"></i></span>
                            <span class="home-programs-camps-play-text">Watch Video</span>
                        </a>
                    @endif
                </div>
            </div>

            <div @class([
                'col-lg-7',
                'order-lg-1' => $reverse,
            ])>
                <div class="home-programs-camps-content">
                    @if ($showSectionIntro && $program->eyebrow)
                        <span class="home-programs-camps-eyebrow wow fadeInUp">{{ $program->eyebrow }}</span>
                    @endif

                    @if ($showSectionIntro && $program->section_title)
                        <h2 class="home-programs-camps-title wow fadeInUp" data-wow-delay="0.1s">{{ $program->section_title }}</h2>
                    @elseif ($variant === 'listing')
                        <h2 class="home-programs-camps-title wow fadeInUp" data-wow-delay="0.1s">{{ $program->title }}</h2>
                    @endif

                    @if ($showSectionIntro && $program->section_lead)
                        <p class="home-programs-camps-lead wow fadeInUp" data-wow-delay="0.15s">{{ $program->section_lead }}</p>
                    @endif

                    <div class="home-programs-camps-details">
                        @foreach ($programDetails as $index => $detail)
                            <div class="home-programs-camps-detail home-programs-camps-detail--{{ $detail['tone'] }} wow fadeInUp" data-wow-delay="{{ number_format(0.2 + ($index * 0.05), 2) }}s">
                                <span class="home-programs-camps-detail-label">{{ $detail['label'] }}</span>
                                <p class="home-programs-camps-detail-value">
                                    @if (!empty($detail['icon']))
                                        <i class="fa-solid {{ $detail['icon'] }}"></i>
                                    @endif
                                    {{ $detail['value'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    @if (!empty($showButton))
                        <div class="home-programs-camps-action wow fadeInUp" data-wow-delay="0.45s">
                            <a href="{{ $buttonUrl }}" class="btn-default">{{ $buttonText }} <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
