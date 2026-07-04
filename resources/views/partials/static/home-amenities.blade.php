<section class="section-amenities padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="rx-banner text-center rx-banner-effects">
                    <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Luxury Comforts<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                    <h4>Our <span>Amenities</span></h4>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="owl-carousel rx-amenities-slider">
                    @foreach([
                        ['img' => 1, 'title' => 'Restro & Cafe', 'text' => 'Welcome to The Gourmet Haven, where culinary excellence meets a serene and inviting ambiance.'],
                        ['img' => 2, 'title' => 'Spa & Beauty', 'text' => 'Rejuvenate your body and mind with our premium spa treatments and wellness services.'],
                        ['img' => 3, 'title' => 'Gym & Fitness', 'text' => 'Stay active during your stay with our fully equipped fitness center and personal trainers.'],
                        ['img' => 4, 'title' => 'Swimming Pool', 'text' => 'Relax by our outdoor pool with stunning views and poolside service.'],
                    ] as $amenity)
                        <div class="row mb-minus-24">
                            <div class="col-lg-8 col-12 mb-24">
                                <div class="rx-amenities-img"><img src="{{ asset('assets/img/amenities/' . $amenity['img'] . '.jpg') }}" alt="{{ $amenity['title'] }}"></div>
                            </div>
                            <div class="col-lg-4 col-12 mb-24">
                                <div class="rx-amenities-contact amenities-animation">
                                    <div class="inner-banner"><h4>{{ $amenity['title'] }}</h4></div>
                                    <p>{{ $amenity['text'] }}</p>
                                    <div class="amenities-btn"><a href="{{ route('contact') }}" class="rx-btn-two">Learn More</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
