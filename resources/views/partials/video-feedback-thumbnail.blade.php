@if (filled($video->thumbnail))
    <img
        src="{{ $video->thumbnailUrl() }}"
        alt="{{ $alt ?? $video->displayTitle() }}"
        class="{{ $class ?? '' }}"
        loading="lazy"
        @isset($attrs){!! $attrs !!}@endisset
    >
@elseif ($video->usesInlineVideoPoster())
    <video
        class="video-feedback-thumb-media {{ $class ?? '' }}"
        src="{{ $video->playableUrl() }}"
        preload="metadata"
        muted
        playsinline
        @isset($attrs){!! $attrs !!}@endisset
    ></video>
@elseif ($video->thumbnailUrl())
    <img
        src="{{ $video->thumbnailUrl() }}"
        alt="{{ $alt ?? $video->displayTitle() }}"
        class="{{ $class ?? '' }}"
        loading="lazy"
        @isset($attrs){!! $attrs !!}@endisset
    >
@else
    <span class="video-feedback-thumb-fallback {{ $class ?? '' }}" @isset($attrs){!! $attrs !!}@endisset>
        <i class="fa-solid fa-video"></i>
    </span>
@endif
