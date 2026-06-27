@if ($detailFaqs->isNotEmpty())
    <div class="page-single-faqs">
        <div class="section-title">
            <h3 class="wow fadeInUp">Common questions</h3>
            <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently asked <span>questions</span></h2>
        </div>

        <div class="faq-accordion accordion wow fadeInUp" data-wow-delay="0.1s" id="{{ $accordionId }}">
            @foreach ($detailFaqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{{ $accordionId }}Heading{{ $index }}">
                        <button
                            class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#{{ $accordionId }}Collapse{{ $index }}"
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-controls="{{ $accordionId }}Collapse{{ $index }}"
                        >
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div
                        id="{{ $accordionId }}Collapse{{ $index }}"
                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
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
@endif
