@extends('layouts.app')

@section('title', 'Blog | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Blog', 'breadcrumb' => 'Blog'])

    <div class="home-blog-posts">
        <div class="container">
            <div class="home-blog-posts-header text-center wow fadeInUp">
                <h2>Blog Post</h2>
            </div>

            <div class="row g-4">
                @foreach ($posts as $index => $post)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-blog-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                            <a href="{{ route('blog.show', $post['slug']) }}" class="home-blog-card-image">
                                <img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}">
                            </a>
                            <div class="home-blog-card-body">
                                <ul class="home-blog-card-meta">
                                    <li><i class="fa-solid fa-user"></i> sahajaarogyam</li>
                                    <li><i class="fa-solid fa-calendar-days"></i> {{ $post['date'] }}</li>
                                    <li><i class="fa-solid fa-folder"></i> Blog</li>
                                </ul>
                                <h3><a href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a></h3>
                                <p>{{ $post['excerpt'] }}</p>
                                <a href="{{ route('blog.show', $post['slug']) }}" class="home-blog-readmore">Read more</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
