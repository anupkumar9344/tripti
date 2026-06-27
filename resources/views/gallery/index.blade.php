@extends('layouts.app')

@section('title', 'Gallery | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Gallery', 'breadcrumb' => 'Gallery'])

    @php
        $images = [];
        for ($i = 1; $i <= 9; $i++) {
            $images[] = 'gallery-' . $i . '.jpg';
        }
    @endphp

    <div class="home-gallery-showcase">
        <div class="container">
            <div class="home-gallery-showcase-header text-center wow fadeInUp">
                <h2>Gallery</h2>
            </div>

            <div class="row g-4 gallery-items">
                @foreach ($images as $index => $image)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ asset('images/' . $image) }}" class="d-block wow fadeInUp" data-wow-delay="{{ number_format($index * 0.06, 2) }}s" data-cursor-text="View">
                            <img src="{{ asset('images/' . $image) }}" alt="Gallery image {{ $index + 1 }}" class="w-100 rounded-3" style="aspect-ratio: 4/3; object-fit: cover;">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
