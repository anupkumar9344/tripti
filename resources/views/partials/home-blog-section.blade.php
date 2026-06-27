@if ($homeBlogPosts->isNotEmpty())
    <div class="home-blog-posts">
        <div class="container">
            <div class="home-blog-posts-header text-center wow fadeInUp">
                <h2>Blog Post</h2>
            </div>

            <div class="row g-4">
                @foreach ($homeBlogPosts as $index => $post)
                    <div class="col-lg-4 col-md-6">
                        @include('partials.blog-card', [
                            'post' => $post,
                            'delay' => number_format($index * 0.1, 1).'s',
                            'showCursor' => true,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
