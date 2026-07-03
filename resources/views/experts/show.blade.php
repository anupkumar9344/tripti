@extends('layouts.app')

@section('title', $expert->name.' | Tripti Hotel')

@push('styles')
    <link href="{{ asset('css/expert-profile.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    @php
        $displayName = $expert->name;

        if ($expert->specialty_location) {
            $displayName .= ' – '.$expert->specialty_location;
        }
    @endphp

    @include('partials.page-header', [
        'title' => $expert->name,
        'breadcrumb' => 'Expert Profile',
    ])

    <section class="expert-profile-hero">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="expert-profile-media wow fadeInUp">
                        <figure class="expert-profile-photo">
                            <img src="{{ $expert->photoUrl() }}" alt="{{ $expert->name }}">
                        </figure>

                        @if ($expert->experience_label || $expert->qualifications)
                            <div class="expert-profile-badge">
                                <div class="expert-profile-badge-icon">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <div class="expert-profile-badge-text">
                                    @if ($expert->experience_label)
                                        <strong>{{ $expert->experience_label }}</strong>
                                    @endif
                                    @if ($expert->qualifications)
                                        <span>{{ $expert->qualifications }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="expert-profile-intro wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="expert-profile-name">{{ $displayName }}</h1>

                        @if ($expert->designation)
                            <p class="expert-profile-designation">{{ $expert->designation }}</p>
                        @endif

                        @if ($expert->patients_treated)
                            <p class="expert-profile-patients wow fadeInUp" data-wow-delay="0.12s">
                                <i class="fa-solid fa-users me-2"></i>{{ $expert->patients_treated }}
                            </p>
                        @endif

                        @if ($expert->highlight_quote || $expert->long_description)
                            <div class="expert-profile-quote-box">
                                <i class="fa-solid fa-quote-left"></i>

                                @if ($expert->highlight_quote)
                                    <p class="highlight-quote mb-0">{{ $expert->highlight_quote }}</p>
                                @endif

                                @if ($expert->long_description)
                                    <div class="expert-profile-bio">{!! $expert->long_description !!}</div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($detailFaqs->isNotEmpty())
        <section class="expert-profile-faq-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        @include('partials.detail-faq-section', [
                            'accordionId' => 'expertFaqAccordion',
                        ])
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($relatedExperts->isNotEmpty())
        @include('partials.expert-cards', [
            'experts' => $relatedExperts,
            'sectionClass' => 'page-section-green expert-related-team-section',
            'headerEyebrow' => 'Our Expert Team',
            'headerTitle' => 'Related Team Members',
            'showViewAll' => true,
            'viewAllLabel' => 'View All Team',
            'viewAllUrl' => route('experts'),
        ])
    @endif
@endsection
