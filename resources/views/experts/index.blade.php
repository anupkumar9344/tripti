@extends('layouts.app')

@section('title', 'Our Expert Team | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Our Expert Team', 'breadcrumb' => 'Experts'])

    <div class="home-meet-experts page-section-green">
        <div class="home-meet-experts-overlay"></div>
        <div class="container position-relative">
            <div class="home-meet-experts-header text-center">
                <span class="home-meet-experts-eyebrow wow fadeInUp">Meet Our Experts</span>
                <h2 class="wow fadeInUp" data-wow-delay="0.1s">A Multidisciplinary Team</h2>
            </div>

            <div class="row g-4">
                @forelse ($experts as $index => $expert)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('experts.show', $expert->slug) }}" class="home-expert-card-link">
                            <article class="home-expert-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                                <div class="home-expert-card-media">
                                    <img src="{{ $expert->photoUrl() }}" alt="{{ $expert->name }}">
                                </div>
                                <div class="home-expert-card-body">
                                    <h3 class="home-expert-card-name">{{ $expert->name }}</h3>
                                    @if ($expert->designation)
                                        <p class="home-expert-card-role">{{ $expert->designation }}</p>
                                    @endif
                                    @if ($expert->specialty)
                                        <p class="home-expert-card-specialty">{{ $expert->specialty }}</p>
                                    @endif
                                    <hr class="home-expert-card-divider">
                                    @if ($expert->qualifications || $expert->experience_label)
                                        <p class="home-expert-card-stats">{{ $expert->experience_label }}@if ($expert->experience_label && $expert->qualifications) | @endif{{ $expert->qualifications }}</p>
                                    @endif
                                    @if ($expert->short_description)
                                        <p class="home-expert-card-bio">{{ $expert->short_description }}</p>
                                    @endif
                                </div>
                            </article>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-white mb-0">Expert profiles will appear here once added from the admin panel.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
