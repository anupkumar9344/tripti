@php
    $ratingLabel = $patientFeedbackSettings['patient_feedback_rating_label'] ?? 'Excellent';
    $totalReviews = $patientFeedbackSettings['patient_feedback_total_reviews'] ?? '346';
    $readMoreUrl = $patientFeedbackSettings['patient_feedback_read_more_url'] ?? '#';
@endphp

@if ($patientReviews->isNotEmpty())
    <div class="home-patient-feedback">
        <div class="container">
            <div class="home-patient-feedback-header text-center wow fadeInUp">
                <h2>Our Patient Feedback</h2>
                <div class="home-patient-feedback-rating">
                    <span class="home-patient-feedback-rating-label">{{ $ratingLabel }}</span>
                    <div class="home-patient-feedback-stars" aria-label="5 out of 5 stars">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                    <p class="home-patient-feedback-count">Based on <strong>{{ $totalReviews }} reviews</strong></p>
                    <div class="home-patient-feedback-google" aria-hidden="true">
                        <i class="fa-brands fa-google"></i>
                        <span>Google Reviews</span>
                    </div>
                </div>
            </div>

            <div class="home-patient-feedback-slider-wrap wow fadeInUp" data-wow-delay="0.15s">
                <button type="button" class="home-patient-feedback-nav home-patient-feedback-prev" aria-label="Previous review">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="swiper home-patient-feedback-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($patientReviews as $review)
                            <div class="swiper-slide">
                                <article class="home-feedback-card">
                                    <div class="home-feedback-card-top">
                                        <div class="home-feedback-author">
                                            <span class="home-feedback-avatar home-feedback-avatar--{{ $review->avatar_tone }}">{{ $review->avatarInitial() }}</span>
                                            <div>
                                                <h3>{{ $review->reviewer_name }}</h3>
                                                @if ($review->review_time)
                                                    <time>{{ $review->review_time }}</time>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="home-feedback-google-badge" aria-label="Google review">
                                            <i class="fa-brands fa-google"></i>
                                        </span>
                                    </div>
                                    <div class="home-feedback-card-rating">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @if ($review->is_verified)
                                            <span class="home-feedback-verified"><i class="fa-solid fa-circle-check"></i> Verified</span>
                                        @endif
                                    </div>
                                    <div class="home-feedback-card-text">
                                        <p class="home-feedback-review-text">{{ $review->review_text }}</p>
                                        <button type="button" class="home-feedback-read-more" aria-expanded="false">Read more</button>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="home-patient-feedback-nav home-patient-feedback-next" aria-label="Next review">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            @if ($readMoreUrl)
                <div class="home-patient-feedback-action text-center wow fadeInUp" data-wow-delay="0.25s">
                    <a href="{{ $readMoreUrl }}" class="btn-default" target="_blank" rel="noopener noreferrer">Read More Reviews <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            @endif
        </div>
    </div>
@endif
