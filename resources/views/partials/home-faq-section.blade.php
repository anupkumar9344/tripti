@php
    use App\Models\Setting;

    $eyebrow = $faqHomeSettings['faq_home_eyebrow'] ?? 'FAQs';
    $title = $faqHomeSettings['faq_home_title'] ?? 'Frequently Asked Questions';
    $description = $faqHomeSettings['faq_home_description'] ?? '';
    $imageUrl = Setting::imageUrl($faqHomeSettings['faq_home_image'] ?? null, 'faqs-image.jpg');
    $contactLabel = $faqHomeSettings['faq_home_contact_label'] ?? 'Still Have Questions?';
    $contactPhone = $settings['phone_1'] ?? '+91 94259 63336';
@endphp

@if ($homeFaqs->isNotEmpty())
    <div class="home-faq">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="home-faq-content">
                        <div class="home-faq-header wow fadeInUp">
                            @if ($eyebrow)
                                <span class="home-faq-eyebrow">{{ $eyebrow }}</span>
                            @endif
                            <h2>{{ $title }}</h2>
                            @if ($description)
                                <p>{{ $description }}</p>
                            @endif
                        </div>

                        <div class="home-faq-accordion accordion wow fadeInUp" data-wow-delay="0.1s" id="homeFaqAccordion">
                            @foreach ($homeFaqs as $index => $faq)
                                <div class="accordion-item home-faq-item">
                                    <h3 class="accordion-header" id="homeFaqHeading{{ $index }}">
                                        <button
                                            class="accordion-button{{ $index === 0 ? '' : ' collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#homeFaqCollapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="homeFaqCollapse{{ $index }}"
                                        >
                                            {{ $faq->question }}
                                        </button>
                                    </h3>
                                    <div
                                        id="homeFaqCollapse{{ $index }}"
                                        class="accordion-collapse collapse{{ $index === 0 ? ' show' : '' }}"
                                        aria-labelledby="homeFaqHeading{{ $index }}"
                                        data-bs-parent="#homeFaqAccordion"
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
                            <img src="{{ $imageUrl }}" alt="{{ $title }}">
                        </figure>
                        <a href="{{ url('/contact-us') }}" class="home-faq-contact-box">
                            <span class="home-faq-contact-icon"><i class="fa-solid fa-phone-volume"></i></span>
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
