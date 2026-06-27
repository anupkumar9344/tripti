<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="page-header-bg" style="background-image: url('{{ asset('images/' . $item['image']) }}');"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">{!! $item['heading'] ?? e($item['title']) !!}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ $parentUrl }}">{{ $parentTitle }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Page Detail Single Start -->
<div class="page-service-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="page-single-sidebar">
                    <div class="page-catagery-list wow fadeInUp">
                        <h3>{{ $sidebarTitle }}</h3>
                        <ul>
                            @foreach ($allItems as $navItem)
                                <li class="{{ $navItem['slug'] === $item['slug'] ? 'active' : '' }}">
                                    <a href="{{ route($detailRoute, $navItem['slug']) }}">{{ $navItem['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                        <div class="sidebar-cta-image">
                            <figure>
                                <img src="{{ asset('images/gallery-4.jpg') }}" alt="Book a consultation at Sahaj Aarogyam">
                            </figure>
                        </div>
                        <div class="sidebar-cta-content">
                            <h3>Book a consultation for personalised care</h3>
                            <a href="{{ url('/contact-us') }}" class="btn-default">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="service-single-content">
                    <div class="service-featured-image wow fadeInUp">
                        <figure>
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}">
                        </figure>
                    </div>

                    <div class="service-entry">
                        @foreach ($item['intro'] as $index => $paragraph)
                            <p class="wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">{{ $paragraph }}</p>
                        @endforeach

                        <div class="discover-peace-box">
                            <h2 class="text-anime-style-2">{!! $item['highlight_heading'] !!}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $item['highlight_text'] }}</p>

                            <div class="discover-peace-item-list">
                                @foreach ($item['highlights'] as $index => $highlight)
                                    <div class="discover-peace-item wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                                        <div class="icon-box">
                                            <i class="fa-solid {{ $highlight['icon'] }}"></i>
                                        </div>
                                        <div class="discover-peace-item-content">
                                            <h3>{{ $highlight['title'] }}</h3>
                                            <p>{{ $highlight['text'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="discover-peace-info-box wow fadeInUp" data-wow-delay="0.3s">
                                <div class="icon-box">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div class="discover-peace-info-content">
                                    <h3>{{ $item['info_text'] }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="service-benefits-box">
                            <h2 class="text-anime-style-2">{!! $item['benefits_heading'] !!}</h2>
                            <p class="wow fadeInUp">{{ $item['benefits_text'] }}</p>

                            <ul class="wow fadeInUp" data-wow-delay="0.1s">
                                @foreach ($item['benefits_list'] as $benefit)
                                    <li>{{ $benefit }}</li>
                                @endforeach
                            </ul>

                            <div class="service-benefits-image wow fadeInUp" data-wow-delay="0.2s">
                                <figure>
                                    <img src="{{ asset('images/' . $item['benefits_image']) }}" alt="{{ $item['title'] }} benefits">
                                </figure>
                            </div>
                        </div>

                        <div class="service-process-box">
                            <h2 class="text-anime-style-2">{!! $item['process_heading'] !!}</h2>
                            <p class="wow fadeInUp">{{ $item['process_text'] }}</p>

                            <div class="service-process-steps">
                                @foreach ($item['steps'] as $index => $step)
                                    <div class="how-work-step wow fadeInUp" data-wow-delay="{{ number_format(($index + 1) * 0.1, 1) }}s">
                                        <div class="how-work-step-no">
                                            <h2>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</h2>
                                        </div>
                                        <div class="how-work-step-content">
                                            <h3>{{ $step['title'] }}</h3>
                                            <p>{{ $step['text'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="page-single-faqs">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Common questions</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently asked <span>questions</span></h2>
                        </div>

                        <div class="faq-accordion accordion wow fadeInUp" data-wow-delay="0.1s" id="detailFaqAccordion">
                            @foreach ($item['faqs'] as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="detailFaqHeading{{ $index }}">
                                        <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#detailFaqCollapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="detailFaqCollapse{{ $index }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="detailFaqCollapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="detailFaqHeading{{ $index }}" data-bs-parent="#detailFaqAccordion">
                                        <div class="accordion-body">
                                            <p>{{ $faq['answer'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Detail Single End -->
