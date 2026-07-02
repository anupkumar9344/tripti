@extends('layouts.app')

@section('title', 'FAQ | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'FAQ'])
    <section class="section-faq padding-t-50 padding-b-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="rx-banner text-center rx-banner-effects">
                        <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">FAQ<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                        <h4>Frequently Asked <span>Questions</span></h4>
                    </div>
                </div>
                @php
                    $faqs = [
                        'What Facilities Does Your Hotel Have?',
                        'How Do I Book A Room For My Vacation?',
                        'How We are best among others?',
                        'Is There Any Fitness Center In Your Hotel?',
                        'What Type Of Room Service Do You Offer?',
                    ];
                @endphp
                <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="rx-faq">
                        <div class="accordion" id="accordionLeft">
                            @foreach($faqs as $index => $question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingL{{ $index }}">
                                        <button class="accordion-button shadow-none {{ $index === 2 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL{{ $index }}" aria-expanded="{{ $index === 2 ? 'true' : 'false' }}">
                                            {{ $question }}
                                        </button>
                                    </h2>
                                    <div id="collapseL{{ $index }}" class="accordion-collapse collapse {{ $index === 2 ? 'show' : '' }}" data-bs-parent="#accordionLeft">
                                        <div class="accordion-body"><p>Our hotel offers premium amenities including dining, spa, fitness center, pool, and concierge services for a complete luxury experience.</p></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <div class="rx-faq">
                        <div class="accordion" id="accordionRight">
                            @foreach($faqs as $index => $question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingR{{ $index }}">
                                        <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseR{{ $index }}">
                                            {{ $question }}
                                        </button>
                                    </h2>
                                    <div id="collapseR{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
                                        <div class="accordion-body"><p>Contact our front desk or use the Book Now button to check availability and reserve your preferred room type.</p></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
