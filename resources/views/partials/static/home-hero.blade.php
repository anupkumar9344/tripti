<section class="section-hero margin-b-50">
    <div class="container-fulid">
        <div class="row">
            <div class="col-12">
                <div class="rx-slider">
                    @for($i = 1; $i <= 3; $i++)
                        <div class="rx-slide slide-{{ $i }}">
                            <img src="{{ asset('assets/img/hero/box-hero-' . $i . '.png') }}" alt="" class="banner-arrow-img">
                            <div class="rx-hero-contact">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="inner-contact slider-animation">
                                                <p>Luxury Hotel & Restaurant</p>
                                                <h2>Enjoy Your <span>Dream</span> Time With <span>Luxury</span> Experience</h2>
                                                <div class="booking-now">
                                                    <div class="ico"><i class="ri-phone-line"></i></div>
                                                    <div class="booking-text">
                                                        <p>Book Now</p>
                                                        <span>987 654 3210</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
