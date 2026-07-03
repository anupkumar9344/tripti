@php
    use App\Models\RoomType;

    $homeRooms = ($homeRooms ?? RoomType::query()->forHome()->limit(6)->get())->take(6);

    if ($homeRooms->isEmpty()) {
        $homeRooms = collect([
            ['name' => 'Deluxe Room', 'image' => asset('assets/img/rooms/1.jpg'), 'short_description' => 'Comfortable, well-appointed rooms ideal for business stays and short visits.', 'fare' => 3500],
            ['name' => 'Executive Suite', 'image' => asset('assets/img/rooms/2.jpg'), 'short_description' => 'Spacious suites with a separate living area for extended and business stays.', 'fare' => 5500],
            ['name' => 'Premium Suite', 'image' => asset('assets/img/rooms/3.jpg'), 'short_description' => 'Luxury suites with panoramic views and premium in-room comforts.', 'fare' => 6500],
        ]);
    }
@endphp

<section class="home-rooms-section padding-tb-50">
    <div class="container">
        <div class="home-rooms-header text-center" data-aos="fade-up" data-aos-duration="1000">
            <span class="home-rooms-eyebrow">Luxury Suites</span>
            <h2 class="home-rooms-title">Our Best <span>Rooms</span></h2>
            <p class="home-rooms-intro">Thoughtfully designed spaces with premium comfort, modern amenities, and warm hospitality for every stay.</p>
        </div>

        <div class="row g-4">
            @foreach ($homeRooms as $index => $room)
                @php
                    $isModel = is_object($room) && method_exists($room, 'imageUrl');
                    $title = $isModel ? $room->name : $room['name'];
                    $imageUrl = $isModel ? $room->imageUrl() : $room['image'];
                    $description = $isModel ? $room->short_description : $room['short_description'];
                    $fare = $isModel ? $room->fare : ($room['fare'] ?? null);
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <article class="home-room-card">
                        <div class="home-room-card-media">
                            <img src="{{ $imageUrl }}" alt="{{ $title }}">
                        </div>
                        <div class="home-room-card-body">
                            <h3 class="home-room-card-title">{{ $title }}</h3>
                            @if ($fare)
                                <p class="home-room-card-price">From ₹{{ number_format((float) $fare, 0) }} / night</p>
                            @endif
                            @if ($description)
                                <p class="home-room-card-text">{{ $description }}</p>
                            @endif
                            <div class="home-room-card-actions">
                                <a href="javascript:void(0)" class="home-room-btn" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a>
                                <a href="{{ route('rooms') }}" class="home-room-link">View Details <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="home-rooms-footer text-center" data-aos="fade-up" data-aos-duration="1000">
            <a href="{{ route('rooms') }}" class="home-rooms-view-all">View All Rooms</a>
        </div>
    </div>
</section>
