@php
    use App\Models\PatientReview;

    $homeTestimonials = ($homeTestimonials ?? PatientReview::query()->activeOrdered()->limit(6)->get());
    $ratingLabel = ($settings ?? [])['patient_feedback_rating_label'] ?? 'Excellent';
    $totalReviews = ($settings ?? [])['patient_feedback_total_reviews'] ?? '428';

    if ($homeTestimonials->isEmpty()) {
        $homeTestimonials = collect([
            ['reviewer_name' => 'Isabella Bianchi', 'review_time' => 'Verified Guest', 'review_text' => 'An exceptional stay — elegant rooms, attentive staff, and world-class dining. We will definitely return.', 'photo' => asset('assets/img/testimonials/1.jpg'), 'rating' => 5, 'is_verified' => true, 'avatar_tone' => 'accent', 'initial' => 'I'],
            ['reviewer_name' => 'Saddika Alard', 'review_time' => 'Verified Guest', 'review_text' => 'Beautiful property with warm hospitality. The spa and dining experience made our anniversary truly memorable.', 'photo' => asset('assets/img/testimonials/2.jpg'), 'rating' => 5, 'is_verified' => true, 'avatar_tone' => 'primary', 'initial' => 'S'],
            ['reviewer_name' => 'Stephen Smith', 'review_time' => 'Verified Guest', 'review_text' => 'Perfect for business travel — fast check-in, reliable Wi-Fi, and excellent room service throughout my stay.', 'photo' => asset('assets/img/testimonials/3.jpg'), 'rating' => 5, 'is_verified' => true, 'avatar_tone' => 'warm', 'initial' => 'S'],
        ]);
    }
@endphp

@if ($homeTestimonials->isNotEmpty())
    <section class="home-testimonials-section padding-tb-50">
        <div class="container">
            <div class="home-testimonials-header text-center" data-aos="fade-up" data-aos-duration="1000">
                <span class="home-testimonials-eyebrow">Testimonials</span>
                <h2 class="home-testimonials-title">Echoes of <span>Brilliance</span></h2>
                <div class="home-testimonials-meta">
                    <span class="home-testimonials-meta-label">{{ $ratingLabel }}</span>
                    <span class="home-testimonials-meta-stars" aria-hidden="true">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </span>
                    <span class="home-testimonials-meta-count">Based on {{ $totalReviews }} reviews</span>
                </div>
            </div>

            <div class="home-testimonials-showcase" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <button type="button" class="home-testimonials-nav home-testimonials-prev" data-testimonial-prev aria-label="Previous testimonial">
                    <i class="ri-arrow-left-s-line"></i>
                </button>

                <div class="home-testimonials-track">
                    @foreach ($homeTestimonials as $index => $review)
                        @php
                            $isModel = is_object($review) && method_exists($review, 'photoUrl');
                            $name = $isModel ? $review->reviewer_name : $review['reviewer_name'];
                            $reviewTime = $isModel ? $review->review_time : ($review['review_time'] ?? null);
                            $reviewText = $isModel ? $review->review_text : $review['review_text'];
                            $rating = $isModel ? (int) $review->rating : (int) ($review['rating'] ?? 5);
                            $isVerified = $isModel ? $review->is_verified : ($review['is_verified'] ?? false);
                            $photoUrl = $isModel ? $review->photoUrl() : ($review['photo'] ?? null);
                            $avatarTone = $isModel ? $review->avatar_tone : ($review['avatar_tone'] ?? 'accent');
                            $avatarInitial = $isModel ? $review->avatarInitial() : ($review['initial'] ?? strtoupper(substr($name, 0, 1)));
                        @endphp
                        <article class="home-testimonials-slide{{ $index === 0 ? ' is-active' : '' }}" data-testimonial-slide="{{ $index }}">
                            <div class="home-testimonials-card">
                                <div class="home-testimonials-stars" aria-label="{{ $rating }} out of 5 stars">
                                    @for ($i = 0; $i < $rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>

                                <blockquote class="home-testimonials-quote">
                                    <p>&ldquo;{{ $reviewText }}&rdquo;</p>
                                </blockquote>

                                <div class="home-testimonials-author">
                                    <div class="home-testimonials-photo">
                                        @if ($photoUrl)
                                            <img src="{{ $photoUrl }}" alt="{{ $name }}">
                                        @else
                                            <div class="home-testimonials-avatar home-testimonials-avatar--{{ $avatarTone }}">
                                                <span>{{ $avatarInitial }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="home-testimonials-author-copy">
                                        <h3 class="home-testimonials-name">{{ $name }}</h3>
                                        @if ($reviewTime)
                                            <p class="home-testimonials-time">{{ $reviewTime }}</p>
                                        @endif
                                        @if ($isVerified)
                                            <span class="home-testimonials-verified"><i class="fa-solid fa-circle-check"></i> Verified Guest</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <button type="button" class="home-testimonials-nav home-testimonials-next" data-testimonial-next aria-label="Next testimonial">
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>

            <div class="home-testimonials-dots" role="tablist" aria-label="Testimonials">
                @foreach ($homeTestimonials as $index => $review)
                    @php
                        $isModel = is_object($review);
                        $name = $isModel ? $review->reviewer_name : $review['reviewer_name'];
                    @endphp
                    <button
                        type="button"
                        class="home-testimonials-dot{{ $index === 0 ? ' is-active' : '' }}"
                        role="tab"
                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                        data-testimonial-dot="{{ $index }}"
                    >
                        <span class="visually-hidden">{{ $name }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </section>
@endif
