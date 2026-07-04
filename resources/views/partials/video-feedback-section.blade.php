@if ($videoFeedbacks->isNotEmpty())
    <section class="video-shorts-section padding-tb-50" id="video-feedbacks">
        <div class="container">
            <div class="video-shorts-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="video-shorts-eyebrow">{{ $eyebrow ?? 'Shorts Video' }}</span>
                <h2 class="video-shorts-title">{{ $title ?? 'See in practice' }}</h2>
                <p class="video-shorts-lead">{{ $lead ?? 'Real stories from our community' }}</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="video-shorts-slider-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <button type="button" class="video-shorts-nav video-shorts-prev" aria-label="Previous video">
                    <i class="ri-arrow-left-s-line"></i>
                </button>

                <div class="swiper video-feedback-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($videoFeedbacks as $index => $video)
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
                                            'alt' => 'Guest video short',
                                        ])
                                        <span class="video-feedback-reel-overlay"></span>
                                        <button type="button" class="video-feedback-play" aria-label="Play video short">
                                            <i class="ri-play-fill"></i>
                                        </button>
                                        <div class="video-shorts-user">
                                            <span class="video-shorts-avatar" aria-hidden="true">
                                                <i class="ri-hotel-bed-fill"></i>
                                            </span>
                                            <span class="video-shorts-handle">{{ $video->guestHandle() }}</span>
                                        </div>
                                    </div>
                                    <div class="video-feedback-reel-player" aria-hidden="true"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="video-shorts-nav video-shorts-next" aria-label="Next video">
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>
        </div>
    </section>
@endif
