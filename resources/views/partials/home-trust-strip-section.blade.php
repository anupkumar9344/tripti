@if ($trustStripItems->isNotEmpty())
    <div class="home-trust-strip" id="home-trust">
        <div class="trust-strip-inner">
            <div class="container-fluid">
                <div class="swiper trust-strip-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($trustStripItems->merge($trustStripItems) as $item)
                            <div class="swiper-slide">
                                <div class="trust-strip-item">
                                    <div class="trust-strip-icon">
                                        <img src="{{ $item->imageUrl() }}" alt="{{ $item->label }}">
                                    </div>
                                    <p>{{ $item->label }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <span class="trust-strip-edge trust-strip-edge-left" aria-hidden="true"></span>
            <span class="trust-strip-edge trust-strip-edge-right" aria-hidden="true"></span>
        </div>
    </div>
@endif
