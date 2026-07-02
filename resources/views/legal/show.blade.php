@extends('layouts.app')

@section('title', $title.' | Tripti Hotel')

@section('content')
    @include('partials.page-header', [
        'title' => $title,
        'breadcrumb' => $title,
    ])

    <div class="page-single-post legal-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post-content">
                        <div class="post-entry wow fadeInUp" data-wow-delay="0.1s">
                            @if (filled($content))
                                {!! $content !!}
                            @else
                                <p>Content for this page will be available soon.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
