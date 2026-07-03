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
                <div class="row g-4">
                    @foreach ($galleryItems as $index => $item)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($index % 3) * 100 }}">
                            @include('partials.hotel-gallery-card', ['item' => $item])
                        </div>
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
        });
    </script>
@endpush
