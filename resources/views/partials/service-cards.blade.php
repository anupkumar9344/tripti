@php
    $showViewAll = $showViewAll ?? true;
    $showPagination = $showPagination ?? false;
@endphp

<div class="home-core-services">
    <div class="container">
        <div class="home-core-services-header text-center">
            <h2 class="wow fadeInUp">Our Core Services</h2>
        </div>

        @if ($services->isNotEmpty())
            <div class="row g-4">
                @foreach ($services as $index => $service)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-core-service-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <a href="{{ route('services.show', $service->slug) }}" class="home-core-service-media">
                                <img src="{{ $service->thumbnailUrl() }}" alt="{{ $service->title }}">
                                <span class="home-core-service-badge" aria-hidden="true">
                                    @if ($service->icon)
                                        <i class="fa-solid {{ $service->icon }}"></i>
                                    @else
                                        <i class="fa-solid fa-mortar-pestle"></i>
                                    @endif
                                </span>
                            </a>
                            <div class="home-core-service-content">
                                <h3><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></h3>
                                @if ($service->short_description)
                                    <p>{{ $service->short_description }}</p>
                                @endif
                                @if ($service->tagList())
                                    <ul class="home-core-service-tags">
                                        @foreach ($service->tagList() as $tag)
                                            <li><i class="fa-solid fa-circle-check"></i> {{ $tag }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <a href="{{ route('services.show', $service->slug) }}" class="home-core-service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach

                @if ($showPagination)
                    {{ $services->links('partials.pagination') }}
                @endif
            </div>
        @elseif ($showPagination)
            <p class="text-center mb-0">No services available yet.</p>
        @endif

        @if ($showViewAll)
            <div class="home-core-services-action text-center wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ url('/services') }}" class="btn-default">View All</a>
            </div>
        @endif
    </div>
</div>
