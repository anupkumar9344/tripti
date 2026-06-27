@extends('layouts.app')

@section('title', 'Treatment | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Treatment', 'breadcrumb' => 'Treatment'])

    @include('partials.treatment-cards', [
        'treatments' => $treatments,
        'sectionClass' => 'page-section-green',
    ])
@endsection
