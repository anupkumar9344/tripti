@extends('layouts.app')

@section('title', 'Facilities | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Facilities'])
    @include('partials.static.home-services')
    @include('partials.home-amenities')
@endsection
