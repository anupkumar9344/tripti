@extends('layouts.app')

@section('title', 'Services | Tripti Hotel')

@section('content')
    @include('partials.page-header', ['title' => 'Services', 'breadcrumb' => 'Services'])

    @include('partials.service-cards', [
        'services' => $services,
        'showViewAll' => false,
        'showPagination' => true,
    ])

    @include('partials.video-feedback-section', ['videoFeedbacks' => $servicesVideoFeedbacks])
@endsection
