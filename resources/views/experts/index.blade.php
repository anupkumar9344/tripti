@extends('layouts.app')

@section('title', 'Our Expert Team | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Our Expert Team', 'breadcrumb' => 'Experts'])

    @php
        $experts = [
            ['image' => 'team-1.jpg', 'name' => 'Dr. Ravindra Verma', 'role' => 'Founder & Chairman', 'specialty' => 'Alternative Therapy Specialist', 'stats' => '25+ Years Experience', 'bio' => 'Leads the overall integrated treatment system and treatment philosophy.'],
            ['image' => 'team-2.jpg', 'name' => 'Dr. Rachana Gangrade', 'role' => 'Co-Founder & Managing Director', 'specialty' => 'Dietitian & Nutritionist', 'stats' => '25+ Years Experience | Ph.D. in Food & Nutrition', 'bio' => 'Expert in Integrated Nutrition for Metabolic Health, Weight Loss & Lifestyle Disorders.'],
            ['image' => 'team-3.jpg', 'name' => 'Dr. Pankaj Jain', 'role' => 'Director & Chief Medical Officer', 'specialty' => 'Ayurveda & Panchakarma Specialist', 'stats' => '25+ Years Experience | Kerala Panchakarma Specialist', 'bio' => 'Expert in Integrated Ayurveda & Panchakarma for Chronic Diseases, Pain Management & Metabolic Disorders.'],
            ['image' => 'team-4.jpg', 'name' => 'Dr. Shaziya Gandhi', 'role' => 'Co-Founder & Director', 'specialty' => 'Unani Medicine & Hijama Specialist', 'stats' => '16+ Years Experience | BUMS', 'bio' => 'Expert in Integrated Unani Healing for Detoxification, Pain Management & Lifestyle Disorders.'],
            ['image' => 'team-5.jpg', 'name' => 'Dr. Sanjay Patel', 'role' => 'Head of Physiotherapy', 'specialty' => 'Pain & Rehabilitation Specialist', 'stats' => '18+ Years Experience | MPT Orthopedics', 'bio' => 'Specialist in non-surgical pain relief, spine disorders, and advanced physiotherapy rehabilitation.'],
            ['image' => 'team-6.jpg', 'name' => 'Dr. Neha Singh', 'role' => 'Senior Wellness Consultant', 'specialty' => 'Acupuncture & Acupressure Specialist', 'stats' => '12+ Years Experience | Certified Acupuncturist', 'bio' => 'Expert in acupuncture, acupressure, and integrative therapies for chronic pain and wellness recovery.'],
        ];
    @endphp

    <div class="home-meet-experts page-section-green">
        <div class="home-meet-experts-overlay"></div>
        <div class="container position-relative">
            <div class="home-meet-experts-header text-center">
                <span class="home-meet-experts-eyebrow wow fadeInUp">Meet Our Experts</span>
                <h2 class="wow fadeInUp" data-wow-delay="0.1s">A Multidisciplinary Team</h2>
            </div>

            <div class="row g-4">
                @foreach ($experts as $index => $expert)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-expert-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.08, 2) }}s">
                            <div class="home-expert-card-media">
                                <img src="{{ asset('images/' . $expert['image']) }}" alt="{{ $expert['name'] }}">
                            </div>
                            <div class="home-expert-card-body">
                                <h3 class="home-expert-card-name">{{ $expert['name'] }}</h3>
                                <p class="home-expert-card-role">{{ $expert['role'] }}</p>
                                <p class="home-expert-card-specialty">{{ $expert['specialty'] }}</p>
                                <hr class="home-expert-card-divider">
                                <p class="home-expert-card-stats">{{ $expert['stats'] }}</p>
                                <p class="home-expert-card-bio">{{ $expert['bio'] }}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
