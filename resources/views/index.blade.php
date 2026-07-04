@extends('layouts.app')

@section('title', 'Tripti Hotel | Luxury Stay & Hospitality')

@section('content')
    @include('partials.home-hero')
    @include('partials.home-booking-strip')
    @include('partials.home-about')
    @include('partials.home-rooms')
    @include('partials.home-amenities')
    @include('partials.home-testimonials')
    @include('partials.home-blog')
@endsection
