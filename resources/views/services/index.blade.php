@extends('layouts.app')

@section('title', 'Services | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Services', 'breadcrumb' => 'Services'])

    <div class="home-core-services">
        <div class="container">
            <div class="home-core-services-header text-center">
                <h2 class="wow fadeInUp">Our Core Services</h2>
            </div>

            <div class="row g-4">
                @foreach ($services as $index => $service)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-core-service-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <a href="{{ route('services.show', $service['slug']) }}" class="home-core-service-media">
                                <img src="{{ asset('images/' . $service['image']) }}" alt="{{ $service['title'] }}">
                                <span class="home-core-service-badge" aria-hidden="true">
                                    <i class="fa-solid fa-mortar-pestle"></i>
                                </span>
                            </a>
                            <div class="home-core-service-content">
                                <h3><a href="{{ route('services.show', $service['slug']) }}">{{ $service['title'] }}</a></h3>
                                <p>{{ $service['excerpt'] }}</p>
                                <ul class="home-core-service-tags">
                                    @foreach ($service['tags'] as $tag)
                                        <li><i class="fa-solid fa-circle-check"></i> {{ $tag }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('services.show', $service['slug']) }}" class="home-core-service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
