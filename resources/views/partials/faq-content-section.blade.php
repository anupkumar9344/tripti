@if ($faqs->isNotEmpty())
    <div class="home-faq">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="home-faq-content">
                        @if ($eyebrow || $title || $description)
                            <div class="home-faq-header wow fadeInUp">
                                @if ($eyebrow)
                                    <span class="home-faq-eyebrow">{{ $eyebrow }}</span>
                                @endif
                                @if ($title)
                                    <h2>{{ $title }}</h2>
                                @endif
                                @if ($description)
                                    <p>{{ $description }}</p>
                                @endif
                            </div>
                        @endif

                        <div class="home-faq-accordion accordion wow fadeInUp" data-wow-delay="0.1s" id="{{ $accordionId }}">
                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item home-faq-item">
                                    <h3 class="accordion-header" id="{{ $accordionId }}Heading{{ $index }}">
                                        <button
                                            class="accordion-button{{ $index === 0 ? '' : ' collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $accordionId }}Collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="{{ $accordionId }}Collapse{{ $index }}"
                                        >
                                            {{ $faq->question }}
                                        </button>
                                    </h3>
                                    <div
                                        id="{{ $accordionId }}Collapse{{ $index }}"
                                        class="accordion-collapse collapse{{ $index === 0 ? ' show' : '' }}"
                                        aria-labelledby="{{ $accordionId }}Heading{{ $index }}"
                                        data-bs-parent="#{{ $accordionId }}"
                                    >
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="home-faq-media wow fadeInUp" data-wow-delay="0.15s">
                        <figure class="home-faq-image">
                            <img src="{{ $imageUrl }}" alt="{{ $title ?: 'FAQs' }}">
                        </figure>
                        <a href="{{ url('/contact-us') }}" class="home-faq-contact-box">
                            <span class="home-faq-contact-icon"><i class="ri-phone-line"></i></span>
                            <span class="home-faq-contact-text">
                                <strong>{{ $contactLabel }}</strong>
                                @if ($contactPhone)
                                    <span>Call us at {{ $contactPhone }}</span>
                                @endif
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
