@extends('layouts.app')

@section('title', 'Tripti Hotel | Luxury Stay & Hospitality')

@section('content')
    @include('partials.home-hero')
    @include('partials.home-about')
    @include('partials.home-rooms')
    @include('partials.static.home-amenities')
    @include('partials.static.home-testimonials')
    @include('partials.static.home-blog')
@endsection
