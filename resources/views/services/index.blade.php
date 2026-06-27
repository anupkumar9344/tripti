@extends('layouts.app')

@section('title', 'Services | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Services', 'breadcrumb' => 'Services'])

    @include('partials.service-cards', [
        'services' => $services,
        'showViewAll' => false,
    ])
@endsection
