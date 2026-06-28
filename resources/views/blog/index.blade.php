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
                @forelse ($posts as $index => $post)
                    <div class="col-lg-4 col-md-6">
                        @include('partials.blog-card', [
                            'post' => $post,
                            'delay' => number_format($index * 0.1, 1).'s',
                        ])
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center mb-0">No blog posts published yet.</p>
                    </div>
                @endforelse

                {{ $posts->links('partials.pagination') }}
            </div>
        </div>
    </div>
@endsection
