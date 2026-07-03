@php
    use App\Models\BlogPost;

    $homeBlogPosts = ($homeBlogPosts ?? BlogPost::query()->forHome()->limit(4)->get());

    if ($homeBlogPosts->isEmpty()) {
        $homeBlogPosts = BlogPost::query()->activeOrdered()->limit(4)->get();
    }
@endphp

@if ($homeBlogPosts->isNotEmpty())
    <section class="home-blog-section padding-tb-50">
        <div class="container">
            <div class="home-blog-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="home-blog-eyebrow">Blog</span>
                <h2 class="home-blog-title">Latest <span>News</span></h2>
                <p class="home-blog-intro">Stories, tips, and updates from Tripti Hotel — dining, wellness, events, and more.</p>
            </div>

            <div class="row g-4">
                @foreach ($homeBlogPosts as $index => $post)
                    <div class="col-lg-3 col-md-6">
                        @include('partials.hotel-blog-card', [
                            'post' => $post,
                            'delay' => ($index % 4) * 100,
                        ])
                    </div>
                @endforeach
            </div>

            <div class="home-blog-footer text-center" data-aos="fade-up" data-aos-duration="1000">
                <a href="{{ route('blog') }}" class="home-blog-view-all">View All Posts</a>
            </div>
        </div>
    </section>
@endif
