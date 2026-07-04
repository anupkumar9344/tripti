<div class="col-lg-4 col-sm-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" @if(!empty($delay)) data-aos-delay="{{ $delay }}" @endif>
    <div class="rx-rooms-main-box">
        <div class="rooms-box-front">
            <img src="{{ asset('assets/img/rooms/' . $image . '.jpg') }}" alt="{{ $title }}">
            <div class="content-wrap"><div class="inner-contact"><h4>{{ $title }}</h4></div></div>
        </div>
        <div class="rooms-box-back">
            <img src="{{ asset('assets/img/rooms/' . $image . '.jpg') }}" alt="{{ $title }}">
            <div class="content-wrap">
                <div class="box-overlay"></div>
                <div class="inner-back-side">
                    <div class="rx-price"><span>{{ $price }}</span></div>
                    <div class="sub-inner-contact">
                        <h5>{{ $title }}</h5>
                        <ul>
                            <li>Daily cleaning</li>
                            <li>Room Service</li>
                            <li>Housekeeping</li>
                            <li>Wi-Fi & Parking</li>
                        </ul>
                    </div>
                    <div class="last-contact">
                        <a href="{{ route('booking') }}" class="inner-button">Book Now</a>
                        <a href="{{ route('rooms.show') }}" class="inner-button"><i class="ri-arrow-right-up-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
