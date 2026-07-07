@extends('layouts.app')

@section('title', 'Gallery | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Gallery'])

    <section class="gallery-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="gallery-page-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="gallery-page-eyebrow">Visual Tour</span>
                <h1 class="gallery-page-title">Our <span>Gallery</span></h1>
                <p class="gallery-page-intro">Explore our rooms, dining spaces, wellness areas, and event venues through a glimpse of life at Tripti Hotel.</p>
            </div>

            @if ($galleryItems->isNotEmpty())
                @php
                    $hasImages = $galleryItems->contains(fn ($item) => ! $item->isVideo());
                    $hasVideos = $galleryItems->contains(fn ($item) => $item->isVideo());
                @endphp

                @if ($hasImages && $hasVideos)
                    <div class="gallery-filter" role="tablist" data-aos="fade-up" data-aos-duration="1000">
                        <button type="button" class="gallery-filter-btn is-active" data-filter="all">All</button>
                        <button type="button" class="gallery-filter-btn" data-filter="image">Photos</button>
                        <button type="button" class="gallery-filter-btn" data-filter="video">Videos</button>
                    </div>
                @endif

                <div class="gallery-bento" data-aos="fade-up" data-aos-duration="1000">
                    @foreach ($galleryItems as $item)
                        <article class="gallery-bento-item{{ $item->isVideo() ? ' is-video' : '' }}{{ $item->is_featured ? ' is-featured' : '' }}" data-type="{{ $item->isVideo() ? 'video' : 'image' }}">
                            <a
                                href="{{ $item->popupHref() }}"
                                class="gallery-bento-link"
                                data-fancybox="hotel-gallery"
                                @if ($item->isVideo()) data-type="iframe" @endif
                                data-caption="{{ $item->title }}"
                            >
                                <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}" loading="lazy">
                                <span class="gallery-bento-shade" aria-hidden="true"></span>

                                @if ($item->isVideo())
                                    <span class="gallery-bento-action is-play" aria-hidden="true">
                                        <i class="ri-play-fill"></i>
                                    </span>
                                @elseif ($item->is_featured)
                                    <span class="gallery-bento-action is-heart" aria-hidden="true">
                                        <i class="ri-heart-fill"></i>
                                    </span>
                                @endif

                                <span class="gallery-bento-meta">
                                    <strong>{{ $item->title }}</strong>
                                </span>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="gallery-page-empty text-center" data-aos="fade-up" data-aos-duration="1000">
                    <p>Gallery images are being updated. Please check back soon or contact us for a property tour.</p>
                    <a href="{{ route('contact') }}" class="gallery-page-cta">Contact Us</a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof $.fancybox !== 'undefined') {
                $('[data-fancybox="hotel-gallery"]').fancybox({
                    buttons: ['zoom', 'slideShow', 'fullScreen', 'close'],
                    loop: true,
                    protect: true,
                    youtube: { controls: 1, showinfo: 0 },
                });
            }

            var filterButtons = document.querySelectorAll('.gallery-filter-btn');
            var galleryItems = document.querySelectorAll('.gallery-bento-item');

            filterButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var filter = button.getAttribute('data-filter');

                    filterButtons.forEach(function (btn) {
                        btn.classList.toggle('is-active', btn === button);
                    });

                    galleryItems.forEach(function (item) {
                        var matches = filter === 'all' || item.getAttribute('data-type') === filter;
                        item.style.display = matches ? '' : 'none';
                    });
                });
            });
        });
    </script>
@endpush
