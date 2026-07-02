@php
    $services = [
        ['n' => 1, 'title' => 'Basic Facilities', 'items' => ['Reception/Front Desk', 'Room Service', 'Housekeeping', 'Wi-Fi & Parking']],
        ['n' => 2, 'title' => 'Room Amenities', 'items' => ['Comfortable Bedding', 'Bathroom & Pool', 'TV, AC & Heating', 'Mini Bar & Safe']],
        ['n' => 3, 'title' => 'Dining Options', 'items' => ['Restaurant & Cafe', 'Bar & Lounge', 'Cafe & Canteen', 'Room service']],
        ['n' => 4, 'title' => 'Leisure Facilities', 'items' => ['Swimming pool', 'Gym / Fitness center', 'Spa & Beauty', 'Sauna & Steam Room']],
        ['n' => 5, 'title' => 'Business Services', 'items' => ['Conference Hall', 'Meeting Rooms', 'Business Center', 'Wi-Fi & Internet']],
        ['n' => 6, 'title' => 'Family Facilities', 'items' => ['Kids Club', 'Babysitting Services', 'Family Rooms', 'Game zone']],
        ['n' => 7, 'title' => 'Additional Services', 'items' => ['Concierge', 'Laundry & Dry Cleaning', 'Shuttle Service', 'Pet-Friendly']],
        ['n' => 8, 'title' => 'Special Features', 'items' => ['Custom Rooms', 'Garden & Golf', 'Terrace', 'Event Spaces']],
    ];
@endphp
<section class="section-services padding-tb-50">
    <div class="container">
        <div class="row mb-minus-24">
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="rx-banner text-center rx-banner-effects">
                    <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Facilities<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                    <h4>Our Best <span>Services</span></h4>
                </div>
            </div>
            @foreach($services as $service)
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-24 rx-575-50" data-aos="flip-left" data-aos-duration="1000">
                    <div class="rx-services">
                        <div class="services-ico">
                            <img src="{{ asset('assets/img/services/' . $service['n'] . '.svg') }}" alt="" class="svg-img">
                        </div>
                        <div class="services-contact">
                            <h5>{{ $service['title'] }}</h5>
                            <ul>
                                @foreach($service['items'] as $item)
                                    <li>- {{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
