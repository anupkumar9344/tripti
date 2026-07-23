@extends('layouts.app')

@section('title', 'Gallery | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Gallery'])

    <section class="gallery-page-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="gallery-page-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="gallery-page-eyebrow">Visual Tour</span>
                <h1 class="gallery-page-title">Our <span>Gallery</span></h1>
                <p class="gallery-page-intro">Explore our rooms, dining spaces, wellness areas, and event venues through photos and videos from Tripti Hotel.</p>
            </div>

            @if ($galleryVideos->isNotEmpty() || $galleryPhotos->isNotEmpty())
                @if ($galleryVideos->isNotEmpty())
                    <div class="gallery-page-block">
                        <div class="gallery-page-block-header" data-aos="fade-up" data-aos-duration="1000">
                            <h2 class="gallery-page-block-title">Videos</h2>
                            <p class="gallery-page-block-intro">Watch highlights from our hotel, rooms, dining, and events.</p>
                        </div>

                        @include('partials.gallery-bento-grid', [
                            'items' => $galleryVideos,
                            'fancyboxGroup' => 'hotel-gallery-videos',
                        ])
                    </div>
                @endif

                @if ($galleryPhotos->isNotEmpty())
                    <div class="gallery-page-block{{ $galleryVideos->isNotEmpty() ? ' gallery-page-block--photos' : '' }}">
                        <div class="gallery-page-block-header" data-aos="fade-up" data-aos-duration="1000">
                            <h2 class="gallery-page-block-title">Photos</h2>
                            <p class="gallery-page-block-intro">Browse our spaces, amenities, and memorable moments at the property.</p>
                        </div>

                        @include('partials.gallery-bento-grid', [
                            'items' => $galleryPhotos,
                            'fancyboxGroup' => 'hotel-gallery-photos',
                        ])
                    </div>
                @endif
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
                $('[data-fancybox="hotel-gallery-videos"], [data-fancybox="hotel-gallery-photos"]').fancybox({
                    buttons: ['zoom', 'slideShow', 'fullScreen', 'close'],
                    loop: true,
                    protect: true,
                    youtube: { controls: 1, showinfo: 0 },
                });
            }
        });
    </script>
@endpush
