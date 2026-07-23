@extends('layouts.app')

@section('title', 'Tripti Hotel | Luxury Stay & Hospitality')

@section('content')
    @include('partials.home-hero')
    @include('partials.home-booking-strip')
    @include('partials.home-about')
    @include('partials.home-rooms')
    @include('partials.home-amenities')
    @include('partials.home-testimonials')
    @include('partials.home-gallery-section')
    @include('partials.home-faq-section')
    @include('partials.video-feedback-section', [
        'videoFeedbacks' => $homeVideoFeedbacks,
        'eyebrow' => 'Shorts Video',
        'title' => 'See in practice',
        'lead' => 'Real stories from our community',
    ])
    @include('partials.home-blog')
@endsection

