@extends('layouts.app')

@section('title', 'Treatment | Tripti Hotel')

@section('content')
    @include('partials.page-header', ['title' => 'Treatment', 'breadcrumb' => 'Treatment'])

    @include('partials.treatment-cards', [
        'treatments' => $treatments,
        'sectionClass' => 'page-section-green',
    ])
@endsection
