@extends('layouts.app')

@section('title', 'Our Expert Team | Tripti Hotel')

@section('content')
    @include('partials.page-header', ['title' => 'Our Expert Team', 'breadcrumb' => 'Experts'])

    @include('partials.expert-cards', [
        'experts' => $experts,
        'sectionClass' => 'page-section-green',
        'showViewAll' => false,
    ])
@endsection
