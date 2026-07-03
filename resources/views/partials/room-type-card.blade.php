@php
    $isModel = is_object($room) && method_exists($room, 'imageUrl');
    $title = $isModel ? $room->name : $room['name'];
    $imageUrl = $isModel ? $room->imageUrl() : $room['image'];
    $description = $isModel ? $room->short_description : ($room['short_description'] ?? null);
    $fare = $isModel ? $room->fare : ($room['fare'] ?? null);
    $detailsUrl = $isModel ? route('rooms.show', $room) : route('rooms');
@endphp

<article class="home-room-card">
    <div class="home-room-card-media">
        <img src="{{ $imageUrl }}" alt="{{ $title }}">
        @if ($isModel && $room->is_featured)
            <span class="home-room-card-badge">Featured</span>
        @endif
    </div>
    <div class="home-room-card-body">
        @if ($isModel)
            <span class="home-room-card-category">{{ $room->categoryLabel() }}</span>
        @endif
        <h3 class="home-room-card-title">{{ $title }}</h3>
        @if ($fare)
            <p class="home-room-card-price">From ₹{{ number_format((float) $fare, 0) }} / night</p>
        @endif
        @if ($description)
            <p class="home-room-card-text">{{ $description }}</p>
        @endif
        @if ($isModel)
            <ul class="home-room-card-meta">
                <li><i class="ri-user-line"></i> Up to {{ $room->max_adults }} adults</li>
                @if ($room->max_children > 0)
                    <li><i class="ri-group-line"></i> {{ $room->max_children }} children</li>
                @endif
            </ul>
        @endif
        <div class="home-room-card-actions">
            <a href="javascript:void(0)" class="home-room-btn" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a>
            <a href="{{ $detailsUrl }}" class="home-room-link">View Details <i class="ri-arrow-right-line"></i></a>
        </div>
    </div>
</article>
