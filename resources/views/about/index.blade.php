@extends('layouts.app')

@section('title', 'About Us | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'About Us'])
    @include('partials.static.home-about')
    @include('partials.static.home-services')
@endsection
