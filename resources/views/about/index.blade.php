@extends('layouts.app')

@section('title', 'About Us | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'About Us'])
    @include('partials.about-page-content', ['settings' => $settings])
@endsection
