@php
    $sectionClass = $sectionClass ?? '';
    $showViewAll = $showViewAll ?? false;
@endphp

<div class="home-what-we-treat {{ $sectionClass }}">
    <div class="home-what-we-treat-overlay"></div>
    <div class="container position-relative">
        <div class="home-what-we-treat-header text-center">
            <h2 class="wow fadeInUp">What We Treat</h2>
            @if ($sectionClass === 'page-section-green')
                <p class="text-white mt-3 wow fadeInUp" data-wow-delay="0.1s">Non-surgical, integrated care for pain and chronic conditions.</p>
            @endif
        </div>

        @if ($treatments->isNotEmpty())
            <div class="row g-4">
                @foreach ($treatments as $index => $treatment)
                    <div class="col-lg-4 col-md-6">
                        <div class="home-treat-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-treat-card-icon">
                                @if ($treatment->icon)
                                    <i class="fa-solid {{ $treatment->icon }}"></i>
                                @else
                                    <img src="{{ $treatment->imageUrl() }}" alt="{{ $treatment->title }}">
                                @endif
                            </div>
                            <div class="home-treat-card-body">
                                <h3>{{ $treatment->title }}</h3>
                                @if ($treatment->short_description)
                                    <p>{{ $treatment->short_description }}</p>
                                @endif
                            </div>
                            <a href="{{ route('treatment.show', $treatment->slug) }}" class="home-treat-card-link">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($showViewAll)
            <div class="home-what-we-treat-action text-center wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ url('/treatment') }}" class="btn-default btn-highlighted">View All</a>
            </div>
        @endif
    </div>
</div>
