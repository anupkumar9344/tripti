@extends('layouts.app')

@section('title', $expert->name . ' | Team | Tripti Hotel')

@section('content')
    @php
        $phone = $contactSettings['phone_1'] ?? $sitePhone ?? null;
        $phoneHref = $phone ? preg_replace('/\s+/', '', $phone) : null;
        $whatsapp = preg_replace('/\D+/', '', (string) ($contactSettings['whatsapp_number'] ?? ''));
        $aboutContent = $expert->long_description ?: $expert->short_description;
    @endphp

    @include('partials.breadcrumb', [
        'breadcrumbTitle' => $expert->name,
        'breadcrumbParent' => 'Team',
        'breadcrumbParentUrl' => route('experts'),
    ])

    <section class="expert-detail-section padding-t-50 padding-b-100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="expert-detail-media-wrap" data-aos="fade-up" data-aos-duration="1000">
                        <div class="expert-detail-photo">
                            <img src="{{ $expert->photoUrl() }}" alt="{{ $expert->name }}">
                            @if ($expert->specialty)
                                <span class="expert-detail-photo-badge">{{ $expert->specialty }}</span>
                            @endif
                        </div>

                        @if ($expert->experience_label || $expert->qualifications)
                            <div class="expert-detail-award-card">
                                <span class="expert-detail-award-icon"><i class="ri-award-line"></i></span>
                                <div>
                                    @if ($expert->experience_label)
                                        <strong>{{ $expert->experience_label }}</strong>
                                    @endif
                                    @if ($expert->qualifications)
                                        <span>{{ $expert->qualifications }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="expert-detail-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="expert-detail-meta">
                            @if ($expert->specialty)
                                <span class="expert-detail-meta-badge">{{ $expert->specialty }}</span>
                            @endif
                            @if ($expert->designation)
                                <span class="expert-detail-meta-role">{{ $expert->designation }}</span>
                            @endif
                        </div>

                        <h1 class="expert-detail-title">
                            {{ $expert->name }}
                            @if ($expert->specialty_location)
                                <span class="expert-detail-location">{{ $expert->specialty_location }}</span>
                            @endif
                        </h1>

                        @if ($expert->short_description)
                            <p class="expert-detail-lead">{{ $expert->short_description }}</p>
                        @endif

                        <div class="expert-detail-stats">
                            @if ($expert->experience_label)
                                <div class="expert-detail-stat">
                                    <i class="ri-award-line"></i>
                                    <div>
                                        <strong>{{ $expert->experience_label }}</strong>
                                        <span>Experience</span>
                                    </div>
                                </div>
                            @endif
                            @if ($expert->specialty)
                                <div class="expert-detail-stat">
                                    <i class="ri-briefcase-line"></i>
                                    <div>
                                        <strong>{{ $expert->specialty }}</strong>
                                        <span>Department</span>
                                    </div>
                                </div>
                            @endif
                            @if ($expert->patients_treated)
                                <div class="expert-detail-stat">
                                    <i class="ri-user-smile-line"></i>
                                    <div>
                                        <strong>{{ $expert->patients_treated }}</strong>
                                        <span>Guest Impact</span>
                                    </div>
                                </div>
                            @endif
                            @if ($qualificationItems->isNotEmpty())
                                <div class="expert-detail-stat">
                                    <i class="ri-medal-line"></i>
                                    <div>
                                        <strong>{{ $qualificationItems->count() }}</strong>
                                        <span>Core Skills</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($expert->highlight_quote)
                            <blockquote class="expert-detail-quote">
                                <i class="ri-double-quotes-l" aria-hidden="true"></i>
                                <p>{{ $expert->highlight_quote }}</p>
                            </blockquote>
                        @endif

                        @if ($aboutContent)
                            <div class="expert-detail-about">
                                <h2>About {{ $expert->name }}</h2>
                                <div class="expert-detail-about-body">
                                    @if ($expert->long_description)
                                        {!! nl2br(e($expert->long_description)) !!}
                                    @else
                                        <p>{{ $expert->short_description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($qualificationItems->isNotEmpty())
                            <div class="expert-detail-skills">
                                <h2>Expertise &amp; Qualifications</h2>
                                <ul class="expert-detail-skills-list">
                                    @foreach ($qualificationItems as $item)
                                        <li><i class="ri-check-line"></i>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <aside class="expert-detail-sidebar" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                        <div class="expert-detail-contact-card">
                            <span class="expert-detail-contact-label">Connect With Our Team</span>
                            <h2 class="expert-detail-contact-name">{{ $expert->name }}</h2>
                            @if ($expert->designation)
                                <p class="expert-detail-contact-role">{{ $expert->designation }}</p>
                            @endif

                            <ul class="expert-detail-contact-meta">
                                @if ($expert->specialty)
                                    <li><i class="ri-briefcase-line"></i> {{ $expert->specialty }}</li>
                                @endif
                                @if ($expert->experience_label)
                                    <li><i class="ri-award-line"></i> {{ $expert->experience_label }}</li>
                                @endif
                            </ul>

                            <div class="expert-detail-contact-actions">
                                <a href="{{ route('booking') }}" class="home-room-btn">
                                    <i class="ri-calendar-check-line"></i> Book Your Stay
                                </a>
                                @if ($phoneHref)
                                    <a href="tel:{{ $phoneHref }}" class="expert-detail-sidebar-link">
                                        <i class="ri-phone-line"></i> {{ $phone }}
                                    </a>
                                @endif
                                @if ($whatsapp !== '')
                                    <a href="https://wa.me/{{ $whatsapp }}" class="expert-detail-sidebar-link expert-detail-sidebar-link--whatsapp" target="_blank" rel="noopener">
                                        <i class="ri-whatsapp-line"></i> WhatsApp Us
                                    </a>
                                @endif
                                <a href="{{ route('experts') }}" class="expert-detail-sidebar-link expert-detail-sidebar-link--outline">
                                    <i class="ri-team-line"></i> View All Team
                                </a>
                                <a href="{{ route('contact') }}" class="expert-detail-contact-link">Need help? Contact us</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            @if ($detailFaqs->isNotEmpty())
                <div class="expert-detail-faq" data-aos="fade-up" data-aos-duration="1000">
                    <div class="expert-detail-faq-header text-center">
                        <span class="team-page-eyebrow">Questions</span>
                        <h2 class="team-page-title team-page-title--section">Frequently Asked <span>Questions</span></h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="expert-detail-faq-accordion accordion" id="expertFaqAccordion">
                                @foreach ($detailFaqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="expertFaqHeading{{ $index }}">
                                            <button
                                                class="accordion-button{{ $index === 0 ? '' : ' collapsed' }}"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#expertFaqCollapse{{ $index }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-controls="expertFaqCollapse{{ $index }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h3>
                                        <div
                                            id="expertFaqCollapse{{ $index }}"
                                            class="accordion-collapse collapse{{ $index === 0 ? ' show' : '' }}"
                                            aria-labelledby="expertFaqHeading{{ $index }}"
                                            data-bs-parent="#expertFaqAccordion">
                                            <div class="accordion-body">
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($relatedExperts->isNotEmpty())
                <div class="expert-detail-related" data-aos="fade-up" data-aos-duration="1000">
                    <div class="team-page-header text-center">
                        <span class="team-page-eyebrow">Our Expert Team</span>
                        <h2 class="team-page-title team-page-title--section">Related Team Members</h2>
                    </div>
                    <div class="row g-4">
                        @foreach ($relatedExperts as $index => $relatedExpert)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($index % 3) * 100 }}">
                                @include('partials.team-card', ['expert' => $relatedExpert])
                            </div>
                        @endforeach
                    </div>
                    <div class="team-related-action text-center">
                        <a href="{{ route('experts') }}" class="team-page-cta-btn team-page-cta-btn--outline">View All Team</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
