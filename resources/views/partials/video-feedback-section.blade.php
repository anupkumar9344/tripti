@if ($videoFeedbacks->isNotEmpty())
    <div class="video-feedback-section" id="video-feedbacks">
        <div class="container">
            <div class="video-feedback-header text-center wow fadeInUp">
                <span class="video-feedback-eyebrow">{{ $eyebrow ?? 'Feedbacks' }}</span>
                <h2>{{ $title ?? 'Patient Video Stories' }}</h2>
                <p class="video-feedback-lead">Real recovery journeys shared by our patients in short video stories.</p>
            </div>
        </div>

        <div class="video-feedback-slider-wrap wow fadeInUp" data-wow-delay="0.1s">
            <button type="button" class="video-feedback-nav video-feedback-prev" aria-label="Previous video">
                <i class="fa-solid fa-arrow-left"></i>
            </button>

            <div class="swiper video-feedback-swiper">
                <div class="swiper-wrapper">
                    @foreach ($videoFeedbacks as $video)
                        <div class="swiper-slide">
                            <div
                                class="video-feedback-reel"
                                data-embed-url="{{ $video->inlineEmbedUrl() }}"
                                data-direct-video="{{ $video->isDirectVideo() ? '1' : '0' }}"
                            >
                                <div class="video-feedback-reel-poster">
                                    @include('partials.video-feedback-thumbnail', [
                                        'video' => $video,
                                        'class' => 'video-feedback-reel-poster-media',
                                        'alt' => 'Patient video feedback',
                                    ])
                                    <span class="video-feedback-reel-overlay"></span>
                                    <button type="button" class="video-feedback-play" aria-label="Play patient video feedback">
                                        <i class="fa-solid fa-play"></i>
                                    </button>
                                </div>
                                <div class="video-feedback-reel-player" aria-hidden="true"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="button" class="video-feedback-nav video-feedback-next" aria-label="Next video">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
@endif
