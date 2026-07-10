@extends('layouts.app')

@section('title', 'FAQ | Tripti Hotel')

@section('content')
    @php
        $eyebrow = $faqPageSettings['faq_page_eyebrow'] ?? 'FAQ';
        $pageTitle = $faqPageSettings['faq_page_title'] ?? 'Frequently Asked Questions';
        $titleWords = preg_split('/\s+/', trim($pageTitle), -1, PREG_SPLIT_NO_EMPTY);
        $titleLead = count($titleWords) > 1 ? implode(' ', array_slice($titleWords, 0, -1)) : '';
        $titleHighlight = count($titleWords) > 1 ? end($titleWords) : $pageTitle;
        $splitAt = (int) ceil($faqPageItems->count() / 2);
        $leftFaqs = $faqPageItems->take($splitAt);
        $rightFaqs = $faqPageItems->slice($splitAt);
    @endphp

    @include('partials.breadcrumb', ['breadcrumbTitle' => 'FAQ'])
    <section class="section-faq padding-t-50 padding-b-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="rx-banner text-center rx-banner-effects">
                        {{-- <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">{{ $eyebrow }}<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p> --}}
                        <h4>
                            @if ($titleLead)
                                {{ $titleLead }} <span>{{ $titleHighlight }}</span>
                            @else
                                <span>{{ $titleHighlight }}</span>
                            @endif
                        </h4>
                    </div>
                </div>

                @if ($leftFaqs->isNotEmpty())
                    <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="rx-faq">
                            <div class="accordion" id="accordionLeft">
                                @foreach ($leftFaqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingL{{ $faq->id }}">
                                            <button
                                                class="accordion-button shadow-none{{ $index === 0 ? '' : ' collapsed' }}"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseL{{ $faq->id }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            >
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div
                                            id="collapseL{{ $faq->id }}"
                                            class="accordion-collapse collapse{{ $index === 0 ? ' show' : '' }}"
                                            data-bs-parent="#accordionLeft"
                                        >
                                            <div class="accordion-body"><p>{{ $faq->answer }}</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if ($rightFaqs->isNotEmpty())
                    <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <div class="rx-faq">
                            <div class="accordion" id="accordionRight">
                                @foreach ($rightFaqs as $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingR{{ $faq->id }}">
                                            <button
                                                class="accordion-button shadow-none collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseR{{ $faq->id }}"
                                            >
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div
                                            id="collapseR{{ $faq->id }}"
                                            class="accordion-collapse collapse"
                                            data-bs-parent="#accordionRight"
                                        >
                                            <div class="accordion-body"><p>{{ $faq->answer }}</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
