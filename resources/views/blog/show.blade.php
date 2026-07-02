@extends('layouts.app')

@section('title', 'Blog Details | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Blog Details', 'breadcrumbParent' => 'Blog', 'breadcrumbParentUrl' => route('blog')])
    <section class="section-blog-details padding-t-50 padding-b-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-lg-8 col-12 mb-24">
                    <div class="rx-blog-details-img" data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ asset('assets/img/blog-details/1.jpg') }}" alt="Blog">
                    </div>
                    <div class="rx-blog-details-contact" data-aos="fade-up" data-aos-duration="1000">
                        <span>June 28, 2024 - Restaurant</span>
                        <h4>Best way to enjoy luxury dining at our hotel</h4>
                        <p>Discover exceptional cuisine crafted by our award-winning chefs. From intimate dinners to grand celebrations, Tripti Hotel offers dining experiences that delight every palate.</p>
                        <p>Our restaurant blends local flavors with international techniques, served in an elegant atmosphere perfect for business lunches or romantic evenings.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-24">
                    <div class="rx-blog-sidebar" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="sub-title"><h4>Recent Posts</h4></div>
                        <ul>
                            <li><a href="{{ route('blog.show') }}">Wellness guide: 5 steps to a perfect stay</a></li>
                            <li><a href="{{ route('blog.show') }}">Relax and recharge at our spa retreat</a></li>
                            <li><a href="{{ route('blog.show') }}">Host unforgettable events at Tripti Hotel</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
