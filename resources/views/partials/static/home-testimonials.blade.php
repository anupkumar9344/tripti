<section class="section-testimonials padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="rx-banner text-center rx-banner-effects">
                    <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Testimonials<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                    <h4>Echoes of <span>Brilliance</span></h4>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="owl-carousel rx-testimonials-slider">
                    @foreach([
                        ['img' => 1, 'name' => 'Isabella Bianchi', 'role' => 'Manager'],
                        ['img' => 2, 'name' => 'Saddika Alard', 'role' => 'Team Leader'],
                        ['img' => 3, 'name' => 'Stephen Smith', 'role' => 'Co Founder'],
                    ] as $review)
                        <div class="row mb-minus-24">
                            <div class="col-md-4 col-12 mb-24">
                                <div class="rx-testimonials-img"><img src="{{ asset('assets/img/testimonials/' . $review['img'] . '.jpg') }}" alt="{{ $review['name'] }}"></div>
                            </div>
                            <div class="col-md-8 col-12 mb-24">
                                <div class="rx-testimonials-contact">
                                    <div class="rx-inner-banner"><h4>{{ $review['name'] }}</h4><span>({{ $review['role'] }})</span></div>
                                    <div class="inner-contact">
                                        <p>"An exceptional stay — elegant rooms, attentive staff, and world-class dining. We will definitely return."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
