<article class="hotel-blog-card{{ !empty($cardClass) ? ' ' . $cardClass : '' }}" @if(isset($delay)) data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ $delay }}" @endif>
    <a href="{{ route('blog.show', $post->slug) }}" class="hotel-blog-card-media">
        <img src="{{ $post->featuredImageUrl() }}" alt="{{ $post->title }}">
        <div class="hotel-blog-card-overlay">
            <span class="hotel-blog-card-meta">{{ $post->metaLine() }}</span>
            <h3 class="hotel-blog-card-title">{{ $post->title }}</h3>
        </div>
    </a>
</article>
