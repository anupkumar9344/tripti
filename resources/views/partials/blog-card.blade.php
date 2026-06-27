<article class="home-blog-card wow fadeInUp" @if(isset($delay)) data-wow-delay="{{ $delay }}" @endif>
    <a href="{{ route('blog.show', $post->slug) }}" class="home-blog-card-image" @if($showCursor ?? false) data-cursor-text="View" @endif>
        <img src="{{ $post->featuredImageUrl() }}" alt="{{ $post->title }}">
    </a>
    <div class="home-blog-card-body">
        <ul class="home-blog-card-meta">
            @if ($post->author)
                <li><i class="fa-solid fa-user"></i> {{ $post->author }}</li>
            @endif
            @if ($post->formattedDate())
                <li><i class="fa-solid fa-calendar-days"></i> {{ $post->formattedDate() }}</li>
            @endif
            <li><i class="fa-solid fa-folder"></i> Blog</li>
        </ul>
        <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
        @if ($post->excerpt)
            <p>{{ $post->excerpt }}</p>
        @endif
        <a href="{{ route('blog.show', $post->slug) }}" class="home-blog-readmore">Read more</a>
    </div>
</article>
