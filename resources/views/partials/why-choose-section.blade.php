@php
    $sectionClass = $sectionClass ?? '';
    $eyebrow = $eyebrow ?? 'Why Sahaj Aarogyam';
    $title = $title ?? 'Why Choose Sahaj Aarogyam';
    $subtitle = $subtitle ?? 'A structured integrated healthcare brand — not just another clinic.';
@endphp

<div class="home-why-choose {{ $sectionClass }}">
    <div class="container">
        <div class="home-why-choose-header text-center">
            <span class="home-why-choose-eyebrow wow fadeInUp">{{ $eyebrow }}</span>
            <h2 class="wow fadeInUp" data-wow-delay="0.1s">{{ $title }}</h2>
            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $subtitle }}</p>
        </div>

        @if ($whyChooseItems->isNotEmpty())
            <div class="row g-4">
                @foreach ($whyChooseItems as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="home-why-choose-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                            <span class="home-why-choose-card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="home-why-choose-card-icon">
                                @if ($item->icon)
                                    <i class="fa-solid {{ $item->icon }}"></i>
                                @endif
                            </div>
                            <h3>{{ $item->title }}</h3>
                            @if ($item->short_description)
                                <p>{{ $item->short_description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
