@extends('layouts.app')

@section('title', $post->seoMetaTitle())
@section('meta_description', $post->seoMetaDescription())
@section('meta_keywords', $post->seoKeywordsText())
@section('meta_robots', $post->seo_robots ?? 'index, follow')
@section('og_title', $post->seoOgTitle())
@section('og_description', $post->seoOgDescription())
@section('og_image', $post->seoOgImageUrl())

@section('content')
    @include('partials.breadcrumb', [
        'breadcrumbTitle' => $post->title,
        'breadcrumbParent' => 'Blog',
        'breadcrumbParentUrl' => route('blog'),
    ])

    <section class="blog-detail-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <article class="blog-detail-article" data-aos="fade-up" data-aos-duration="1000">
                        <div class="blog-detail-hero">
                            <img src="{{ $post->featuredImageUrl() }}" alt="{{ $post->title }}">
                        </div>

                        <div class="blog-detail-meta">
                            @if ($post->formattedDateLong())
                                <span><i class="ri-calendar-line"></i> {{ $post->formattedDateLong() }}</span>
                            @endif
                            <span><i class="ri-price-tag-3-line"></i> {{ $post->primaryCategory() }}</span>
                            @if ($post->author)
                                <span><i class="ri-user-line"></i> {{ $post->author }}</span>
                            @endif
                        </div>

                        <h1 class="blog-detail-title">{{ $post->title }}</h1>

                        @if ($post->excerpt)
                            <p class="blog-detail-excerpt">{{ $post->excerpt }}</p>
                        @endif

                        <div class="blog-detail-content">
                            {!! $post->content !!}
                        </div>

                        @if ($post->tagList() !== [])
                            <div class="blog-detail-tags">
                                @foreach ($post->tagList() as $tag)
                                    <span>{{ ucwords($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </article>
                </div>

                <div class="col-lg-4">
                    <aside class="blog-detail-sidebar" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                        <div class="blog-sidebar-card">
                            <h2 class="blog-sidebar-title">Recent Posts</h2>
                            <ul class="blog-sidebar-list">
                                @forelse ($relatedPosts as $related)
                                    <li>
                                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                        @if ($related->formattedDate())
                                            <time>{{ $related->formattedDate() }}</time>
                                        @endif
                                    </li>
                                @empty
                                    <li class="blog-sidebar-empty">No other posts yet.</li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="blog-sidebar-card">
                            <h2 class="blog-sidebar-title">Plan Your Stay</h2>
                            <p class="blog-sidebar-text">Ready to experience Tripti Hotel? Explore our rooms or get in touch with our team.</p>
                            <div class="blog-sidebar-actions">
                                <a href="{{ route('rooms') }}" class="blog-sidebar-btn">View Rooms</a>
                                <a href="{{ route('contact') }}" class="blog-sidebar-link">Contact Us</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
