@extends('layouts.app')

@section('title', 'Gallery | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Gallery', 'breadcrumb' => 'Gallery'])

    @include('partials.gallery-grid')
@endsection
