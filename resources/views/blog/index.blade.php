@extends('layouts.app')

@section('title', 'Blog | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Blog'])
    @include('partials.static.home-blog')
@endsection
