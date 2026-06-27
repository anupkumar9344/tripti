@extends('layouts.app')

@section('title', 'Treatment | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Treatment', 'breadcrumb' => 'Treatment'])

    <div class="home-what-we-treat page-section-green">
        <div class="home-what-we-treat-overlay"></div>
        <div class="container position-relative">
            <div class="home-what-we-treat-header text-center">
                <h2 class="wow fadeInUp">What We Treat</h2>
                <p class="text-white mt-3 wow fadeInUp" data-wow-delay="0.1s">Non-surgical, integrated care for pain and chronic conditions.</p>
            </div>

            <div class="row g-4">
                @foreach ($items as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="home-treat-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-treat-card-icon">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <div class="home-treat-card-body">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['excerpt'] }}</p>
                            </div>
                            <a href="{{ route('treatment.show', $item['slug']) }}" class="home-treat-card-link">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
