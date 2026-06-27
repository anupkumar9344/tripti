@if ($homeGalleryItems->isNotEmpty())
    @php
        $galleryTitle = $galleryHomeSettings['gallery_home_title'] ?? 'Gallery';
    @endphp

    <div class="home-gallery-showcase">
        <div class="container">
            <div class="home-gallery-showcase-header text-center wow fadeInUp">
                <h2>{{ $galleryTitle }}</h2>
            </div>
        </div>

        <div class="home-gallery-accordion-wrap gallery-items wow fadeInUp" data-wow-delay="0.1s">
            <div class="home-gallery-accordion" role="list">
                @foreach ($homeGalleryItems as $index => $item)
                    <article
                        class="home-gallery-panel{{ $item->is_featured ? ' is-featured' : '' }}"
                        role="listitem"
                        data-panel-index="{{ $index }}"
                    >
                        <a
                            href="{{ $item->popupHref() }}"
                            class="home-gallery-panel-link {{ $item->isVideo() ? 'popup-video' : 'gallery-popup-image' }}"
                            data-cursor-text="{{ $item->isVideo() ? 'Play' : 'View' }}"
                        >
                            <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}">
                            <span class="home-gallery-panel-shade" aria-hidden="true"></span>
                            <div class="home-gallery-panel-content">
                                @if ($item->iconList())
                                    <div class="home-gallery-panel-icons" aria-hidden="true">
                                        @foreach ($item->iconList() as $icon)
                                            <span><i class="fa-solid {{ $icon }}"></i></span>
                                        @endforeach
                                    </div>
                                @endif
                                <h3>{{ $item->title }}</h3>
                                @if ($item->description)
                                    <p>{{ $item->description }}</p>
                                @endif
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="home-gallery-accordion-mobile swiper home-gallery-mobile-swiper">
                <div class="swiper-wrapper">
                    @foreach ($homeGalleryItems as $item)
                        <div class="swiper-slide">
                            <article class="home-gallery-mobile-card">
                                <a
                                    href="{{ $item->popupHref() }}"
                                    class="home-gallery-mobile-link {{ $item->isVideo() ? 'popup-video' : 'gallery-popup-image' }}"
                                    data-cursor-text="{{ $item->isVideo() ? 'Play' : 'View' }}"
                                >
                                    <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}">
                                    <span class="home-gallery-panel-shade" aria-hidden="true"></span>
                                    <div class="home-gallery-panel-content">
                                        <h3>{{ $item->title }}</h3>
                                        @if ($item->description)
                                            <p>{{ $item->description }}</p>
                                        @endif
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="home-gallery-mobile-pagination swiper-pagination"></div>
            </div>
        </div>

        <div class="container">
            <div class="home-gallery-showcase-action text-center wow fadeInUp" data-wow-delay="0.2s">
                <a href="{{ url('/gallery') }}" class="btn-default">See More</a>
            </div>
        </div>
    </div>
@endif
