@if ($galleryItems->isNotEmpty())
    <div class="page-gallery">
        <div class="container">
            <div class="row gallery-items">
                @foreach ($galleryItems as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="page-gallery-box">
                            @if ($item->isVideo())
                                <div class="video-gallery-image wow fadeInUp" data-wow-delay="{{ number_format($index * 0.06, 2) }}s">
                                    <a href="{{ $item->embedUrl() }}" class="popup-video" data-cursor-text="Play" title="{{ $item->title }}">
                                        <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}">
                                    </a>
                                </div>
                            @else
                                <div class="photo-gallery wow fadeInUp" data-wow-delay="{{ number_format($index * 0.06, 2) }}s">
                                    <a href="{{ $item->sourceUrl() }}" class="gallery-popup-image" data-cursor-text="View" title="{{ $item->title }}">
                                        <figure>
                                            <img src="{{ $item->thumbnailUrl() }}" alt="{{ $item->title }}">
                                        </figure>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
