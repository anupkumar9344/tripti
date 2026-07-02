<section class="section-room padding-tb-50">
    <div class="container">
        <div class="row mb-minus-24 room-popup">
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="rx-banner text-center rx-banner-effects">
                    <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Luxury Suites<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                    <h4>Our Best <span>Rooms</span></h4>
                </div>
            </div>
            @include('partials.static.room-card', ['title' => 'Junior Suite', 'image' => 1, 'price' => '250$ / N', 'delay' => ''])
            @include('partials.static.room-card', ['title' => 'Twin Room', 'image' => 2, 'price' => '300$ / N', 'delay' => '200'])
            @include('partials.static.room-card', ['title' => 'Quad Room', 'image' => 3, 'price' => '350$ / N', 'delay' => '400'])
            @include('partials.static.room-card', ['title' => 'Deluxe Room', 'image' => 4, 'price' => '400$ / N', 'delay' => ''])
            @include('partials.static.room-card', ['title' => 'Executive Room', 'image' => 5, 'price' => '450$ / N', 'delay' => '200'])
            @include('partials.static.room-card', ['title' => 'Presidential Room', 'image' => 6, 'price' => '500$ / N', 'delay' => '400'])
        </div>
    </div>
</section>
