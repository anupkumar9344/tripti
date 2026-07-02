@extends('layouts.app')

@section('title', 'Team | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Team'])
    <section class="section-team padding-t-50 padding-b-100">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="rx-banner text-center rx-banner-effects">
                        <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Team<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                        <h4>Meet Our <span>Team</span></h4>
                    </div>
                </div>
                <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="owl-carousel rx-team-slider">
                        @foreach([
                            ['img' => 1, 'name' => 'John Carter', 'role' => 'CEO'],
                            ['img' => 2, 'name' => 'Sarah Miller', 'role' => 'General Manager'],
                            ['img' => 3, 'name' => 'David Lee', 'role' => 'Head Chef'],
                            ['img' => 4, 'name' => 'Emma Wilson', 'role' => 'Receptionist'],
                        ] as $member)
                            <div class="rx-team-card">
                                <div class="rx-team-img"><img src="{{ asset('assets/img/team/' . $member['img'] . '.jpg') }}" alt="{{ $member['name'] }}"></div>
                                <div class="rx-team-contact"><h5>{{ $member['name'] }}</h5><span>{{ $member['role'] }}</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
