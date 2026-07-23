@if ($items->isNotEmpty())
    <div class="gallery-bento" data-aos="fade-up" data-aos-duration="1000">
        @foreach ($items as $item)
            <article class="gallery-bento-item{{ $item->isVideo() ? ' is-video' : '' }}{{ $item->is_featured ? ' is-featured' : '' }}">
                <a
                    href="{{ $item->popupHref() }}"
                    class="gallery-bento-link"
                    data-fancybox="{{ $fancyboxGroup ?? 'hotel-gallery' }}"
                    @if ($item->isVideo()) data-type="iframe" @endif
                    data-caption="{{ $item->title }}"
                >
                    <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}" loading="lazy">
                    <span class="gallery-bento-shade" aria-hidden="true"></span>

                    @if ($item->isVideo())
                        <span class="gallery-bento-action is-play" aria-hidden="true">
                            <i class="ri-play-fill"></i>
                        </span>
                    @elseif ($item->is_featured)
                        <span class="gallery-bento-action is-heart" aria-hidden="true">
                            <i class="ri-heart-fill"></i>
                        </span>
                    @endif

                    <span class="gallery-bento-meta">
                        <strong>{{ $item->title }}</strong>
                    </span>
                </a>
            </article>
        @endforeach
    </div>
@endif
