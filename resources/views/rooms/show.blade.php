@extends('layouts.app')

@section('title', 'Room Details | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Room Details', 'breadcrumbParent' => 'Rooms', 'breadcrumbParentUrl' => route('rooms')])
    <section class="section-room-details padding-t-50 padding-b-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-lg-4 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000">
                    <div class="rx-room-details-sidebar">
                        <div class="sub-title"><h4>Reservation</h4></div>
                        <div class="inner-room-details">
                            <form action="#">
                                <div class="rx-room-details-from"><label>Check In</label><input type="text" class="rx-from-control datepicker"></div>
                                <div class="rx-room-details-from"><label>Check Out</label><input type="text" class="rx-from-control datepicker"></div>
                                <div class="rx-side-from"><div class="rx-side-from-buttons"><a class="rx-btn-two" href="{{ route('contact') }}">Book Now</a></div></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 mb-24">
                    <div class="rx-room-details-main-contact">
                        <div class="rx-main-room" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="slider room-slider-for">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="rx-room-details-image"><img src="{{ asset('assets/img/room-details/' . $i . '.jpg') }}" alt="Room"></div>
                                @endfor
                            </div>
                            <div class="slider room-slider-nav">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="rx-room-details-inner"><img src="{{ asset('assets/img/room-details/' . $i . '.jpg') }}" alt="Room"></div>
                                @endfor
                            </div>
                        </div>
                        <div class="rx-inner-details" data-aos="fade-up" data-aos-duration="1000">
                            <div class="rx-title"><h4>Tripti Junior Suite</h4></div>
                            <div class="inner-text">
                                <p>Experience refined comfort in our Junior Suite — spacious layout, premium bedding, and thoughtful amenities designed for a relaxing stay.</p>
                            </div>
                            <div class="rx-details-inner">
                                <div class="inner-room-details">
                                    <div class="sub-title"><h4>Amenities</h4></div>
                                    <div class="row">
                                        <div class="col-lg-6 rx-cols-room"><ul><li>42 Inch flat screen TV</li><li>In-room Safe</li><li>Mini-refrigerator</li></ul></div>
                                        <div class="col-lg-6 rx-cols-room"><ul><li>Complimentary Wi-Fi</li><li>Breakfast</li><li>Complimentary bottled water</li></ul></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
