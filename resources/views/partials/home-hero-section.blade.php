@if ($heroBanners->isNotEmpty())
    <div class="hero hero-slider-layout">
        <div class="swiper hero-main-swiper">
            <div class="swiper-wrapper">
                @foreach ($heroBanners as $banner)
                    <div class="swiper-slide">
                        <div class="hero-slide">
                            <div class="hero-slider-image">
                                <img src="{{ $banner->imageUrl() }}" alt="{{ $banner->title }}">
                            </div>

                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-10">
                                        <div class="hero-content">
                                            <div class="section-title">
                                                @if ($banner->eyebrow)
                                                    <span class="hero-eyebrow">{{ $banner->eyebrow }}</span>
                                                @endif
                                                <h1>{{ $banner->title }}</h1>
                                                @if ($banner->text)
                                                    <p>{{ $banner->text }}</p>
                                                @endif
                                            </div>

                                            @if ($banner->primary_label || $banner->hasSecondaryAction())
                                                <div class="hero-body">
                                                    @if ($banner->primary_label)
                                                        <div class="hero-btn">
                                                            <a href="{{ $banner->primaryActionUrl() }}" class="btn-default">{{ $banner->primary_label }}</a>
                                                        </div>
                                                    @endif

                                                    @if ($banner->isSecondaryVideo())
                                                        <div class="video-play-button">
                                                            <p>{{ $banner->secondary_label }}</p>
                                                            <a href="{{ $banner->secondaryActionUrl() }}" class="popup-video" data-cursor-text="Play">
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    @elseif ($banner->hasSecondaryAction())
                                                        <div class="hero-btn hero-btn-secondary">
                                                            <a href="{{ $banner->secondaryActionUrl() }}" class="btn-default btn-highlighted">{{ $banner->secondary_label }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="hero-pagination"></div>
        </div>

        <button type="button" class="hero-slider-nav hero-slider-prev" aria-label="Previous slide">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <button type="button" class="hero-slider-nav hero-slider-next" aria-label="Next slide">
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
@endif
