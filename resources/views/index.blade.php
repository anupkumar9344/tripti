@extends('layouts.app')

@section('title', 'Tripti Hotel | Luxury Stay & Hospitality')

@section('content')
    @include('partials.static.home-hero')
    @include('partials.static.home-about')
    @include('partials.static.home-services')
    @include('partials.static.home-rooms')
    @include('partials.static.home-amenities')
    @include('partials.static.home-testimonials')
    @include('partials.static.home-blog')
@endsection
