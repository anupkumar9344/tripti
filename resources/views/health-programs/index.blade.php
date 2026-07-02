@extends('layouts.app')

@section('title', 'Health Programs | Tripti Hotel')

@section('content')
    @include('partials.page-header', ['title' => 'Health Programs', 'breadcrumb' => 'Programs'])

    @forelse ($healthPrograms as $program)
        @include('partials.health-program-section', [
            'program' => $program,
            'variant' => 'listing',
            'reverse' => $loop->even,
        ])
    @empty
        <div class="container py-5">
            <p class="text-center mb-0">Health programs will be published here soon.</p>
        </div>
    @endforelse
@endsection
