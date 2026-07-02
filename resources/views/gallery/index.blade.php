@extends('layouts.app')

@section('title', 'Gallery | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Gallery'])
    <section class="section-gallery padding-t-50 padding-b-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="rx-banner text-center rx-banner-effects">
                        <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Gallery<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                        <h4>Our <span>Gallery</span></h4>
                    </div>
                </div>
                @for($i = 1; $i <= 9; $i++)
                    <div class="col-lg-4 col-sm-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000">
                        <div class="rx-gallery-card">
                            <a href="{{ asset('assets/img/gallery/' . $i . '.jpg') }}" data-fancybox="gallery">
                                <img src="{{ asset('assets/img/gallery/' . $i . '.jpg') }}" alt="Gallery {{ $i }}">
                            </a>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
