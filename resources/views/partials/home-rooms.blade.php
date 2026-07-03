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
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($index % 3) * 100 }}">
                    @include('partials.room-type-card', ['room' => $room])
                </div>
            @endforeach
        </div>

        <div class="home-rooms-footer text-center" data-aos="fade-up" data-aos-duration="1000">
            <a href="{{ route('rooms') }}" class="home-rooms-view-all">View All Rooms</a>
        </div>
    </div>
</section>
