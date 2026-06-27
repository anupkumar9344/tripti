@extends('layouts.app')

@section('title', $post['title'] . ' | Sahaj Aarogyam')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="page-header-bg" style="background-image: url('{{ asset('images/' . $post['image']) }}');"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $post['title'] }}</h1>
                        <div class="post-single-meta wow fadeInUp">
                            <ol class="breadcrumb">
                                <li><i class="fa-regular fa-user"></i> {{ $post['author'] }}</li>
                                <li><i class="fa-regular fa-clock"></i> {{ $post['date'] }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Single Post Start -->
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post-image wow fadeInUp">
                        <figure>
                            <img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}">
                        </figure>
                    </div>

                    <div class="post-content">
                        <div class="post-entry wow fadeInUp" data-wow-delay="0.1s">
                            {!! $post['content'] !!}
                        </div>

                        <div class="post-tag-links">
                            <div class="row align-items-center g-3">
                                <div class="col-lg-8">
                                    <div class="post-tags wow fadeInUp" data-wow-delay="0.2s">
                                        <span class="tag-links">
                                            Tags:
                                            @foreach ($post['tags'] as $tag)
                                                <a href="{{ route('blog') }}">{{ $tag }}</a>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.2s">
                                        <ul>
                                            <li><a href="{{ url('/contact-us') }}" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="{{ url('/contact-us') }}" aria-label="Share on Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="{{ url('/contact-us') }}" aria-label="Share on YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                                            <li><a href="{{ url('/contact-us') }}" aria-label="Contact us"><i class="fa-brands fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Single Post End -->

    @if (! empty($relatedPosts))
        <div class="blog-related-posts">
            <div class="container">
                <div class="blog-related-posts-header text-center wow fadeInUp">
                    <h2>Related Articles</h2>
                    <p>Explore more health insights from Sahaj Aarogyam</p>
                </div>

                <div class="row g-4">
                    @foreach ($relatedPosts as $index => $related)
                        <div class="col-lg-4 col-md-6">
                            <article class="home-blog-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                                <a href="{{ route('blog.show', $related['slug']) }}" class="home-blog-card-image">
                                    <img src="{{ asset('images/' . $related['image']) }}" alt="{{ $related['title'] }}">
                                </a>
                                <div class="home-blog-card-body">
                                    <ul class="home-blog-card-meta">
                                        <li><i class="fa-solid fa-calendar-days"></i> {{ $related['date'] }}</li>
                                    </ul>
                                    <h3><a href="{{ route('blog.show', $related['slug']) }}">{{ $related['title'] }}</a></h3>
                                    <p>{{ $related['excerpt'] }}</p>
                                    <a href="{{ route('blog.show', $related['slug']) }}" class="home-blog-readmore">Read more</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <div class="blog-related-posts-action text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ route('blog') }}" class="btn-default">Back to All Blogs</a>
                </div>
            </div>
        </div>
    @endif
@endsection
