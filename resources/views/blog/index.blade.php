@extends('layouts.app')

@section('title', 'Blog | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Blog'])

    <section class="blog-listing-section padding-tb-50">
        <div class="container">
            <div class="home-blog-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="home-blog-eyebrow">Blog</span>
                <h1 class="home-blog-title">Latest <span>News</span></h1>
                <p class="home-blog-intro">Explore hotel stories, travel tips, dining highlights, and event inspiration from our team.</p>
            </div>

            @if ($posts->isNotEmpty())
                <div class="row g-4">
                    @foreach ($posts as $index => $post)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($index % 3) * 100 }}">
                            @include('partials.hotel-blog-card', ['post' => $post])
                        </div>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="blog-listing-pagination">
                        {{ $posts->links('partials.pagination') }}
                    </div>
                @endif
            @else
                <div class="blog-listing-empty text-center" data-aos="fade-up" data-aos-duration="1000">
                    <p>No blog posts published yet. Please check back soon.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
