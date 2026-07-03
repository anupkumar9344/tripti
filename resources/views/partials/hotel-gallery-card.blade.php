<article class="hotel-gallery-card">
    <a
        href="{{ $item->popupHref() }}"
        class="hotel-gallery-card-link"
        data-fancybox="hotel-gallery"
        @if ($item->isVideo()) data-type="iframe" @endif
        data-caption="{{ $item->title }}"
    >
        <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}">
        <span class="hotel-gallery-card-overlay" aria-hidden="true"></span>
        <span class="hotel-gallery-card-content">
            <span class="hotel-gallery-card-icon">
                <i class="ri-{{ $item->isVideo() ? 'play' : 'zoom-in' }}-line"></i>
            </span>
            <strong>{{ $item->title }}</strong>
            @if ($item->description)
                <span>{{ $item->description }}</span>
            @endif
        </span>
        @if ($item->is_featured)
            <span class="hotel-gallery-card-badge">Featured</span>
        @endif
    </a>
</article>
