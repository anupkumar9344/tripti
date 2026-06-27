@extends('layouts.app')

@section('title', $post->seoMetaTitle())
@section('meta_description', $post->seoMetaDescription())
@section('meta_keywords', $post->seoKeywordsText())
@section('meta_robots', $post->seo_robots)
@section('og_title', $post->seoOgTitle())
@section('og_description', $post->seoOgDescription())
@section('og_image', $post->seoOgImageUrl())

@section('content')
    <div class="page-header parallaxie">
        <div class="page-header-bg" style="background-image: url('{{ $post->featuredImageUrl() }}');"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $post->title }}</h1>
                        <div class="post-single-meta wow fadeInUp">
                            <ol class="breadcrumb">
                                @if ($post->author)
                                    <li><i class="fa-regular fa-user"></i> {{ $post->author }}</li>
                                @endif
                                @if ($post->formattedDate())
                                    <li><i class="fa-regular fa-clock"></i> {{ $post->formattedDate() }}</li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post-image wow fadeInUp">
                        <figure>
                            <img src="{{ $post->featuredImageUrl() }}" alt="{{ $post->title }}">
                        </figure>
                    </div>

                    <div class="post-content">
                        <div class="post-entry wow fadeInUp" data-wow-delay="0.1s">
                            {!! $post->content !!}
                        </div>

                        @if ($post->tagList())
                            <div class="post-tag-links">
                                <div class="row align-items-center g-3">
                                    <div class="col-lg-8">
                                        <div class="post-tags wow fadeInUp" data-wow-delay="0.2s">
                                            <span class="tag-links">
                                                Tags:
                                                @foreach ($post->tagList() as $tag)
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($relatedPosts->isNotEmpty())
        <div class="blog-related-posts">
            <div class="container">
                <div class="blog-related-posts-header text-center wow fadeInUp">
                    <h2>Related Articles</h2>
                    <p>Explore more health insights from Sahaj Aarogyam</p>
                </div>

                <div class="row g-4">
                    @foreach ($relatedPosts as $index => $related)
                        <div class="col-lg-4 col-md-6">
                            @include('partials.blog-card', [
                                'post' => $related,
                                'delay' => number_format($index * 0.1, 1).'s',
                            ])
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
