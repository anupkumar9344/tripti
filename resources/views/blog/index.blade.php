@extends('layouts.app')

@section('title', 'Blog | Sahaj Aarogyam')

@section('content')
    @include('partials.page-header', ['title' => 'Blog', 'breadcrumb' => 'Blog'])

    @php
        $posts = [
            ['image' => 'post-1.jpg', 'title' => '5 Natural Ways to Improve Your Gut Health', 'excerpt' => 'Good gut health is the foundation of overall well-being. A healthy gut improves digestion, boosts immunity, enhances mood, and helps maintain a healthy weight.', 'date' => 'May 29, 2026'],
            ['image' => 'post-2.jpg', 'title' => 'Ayurveda vs Modern Lifestyle Disorders', 'excerpt' => 'Modern lifestyle has led to an increase in disorders like obesity, diabetes, hypertension, PCOS, thyroid issues, and stress-related conditions.', 'date' => 'May 29, 2026'],
            ['image' => 'post-3.jpg', 'title' => 'How Physiotherapy Helps in Chronic Pain Recovery', 'excerpt' => 'Chronic pain can affect your daily life and limit your ability to move, work, and enjoy the things you love.', 'date' => 'May 29, 2026'],
            ['image' => 'post-4.jpg', 'title' => 'Understanding Panchakarma Detox Benefits', 'excerpt' => 'Panchakarma is a cornerstone of Ayurvedic healing — a structured detox process that cleanses the body and restores balance.', 'date' => 'May 15, 2026'],
            ['image' => 'post-5.jpg', 'title' => 'Weight Loss Without Crash Diets', 'excerpt' => 'Sustainable weight management comes from balanced nutrition, metabolism support, and lifestyle changes.', 'date' => 'May 10, 2026'],
            ['image' => 'post-6.jpg', 'title' => 'Non-Surgical Options for Back Pain', 'excerpt' => 'Most back pain can be treated effectively without surgery through physiotherapy, Ayurveda, and structured rehabilitation.', 'date' => 'April 28, 2026'],
        ];
    @endphp

    <div class="home-blog-posts">
        <div class="container">
            <div class="home-blog-posts-header text-center wow fadeInUp">
                <h2>Blog Post</h2>
            </div>

            <div class="row g-4">
                @foreach ($posts as $index => $post)
                    <div class="col-lg-4 col-md-6">
                        <article class="home-blog-card wow fadeInUp" data-wow-delay="{{ number_format($index * 0.1, 1) }}s">
                            <div class="home-blog-card-image">
                                <img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}">
                            </div>
                            <div class="home-blog-card-body">
                                <ul class="home-blog-card-meta">
                                    <li><i class="fa-solid fa-user"></i> sahajaarogyam</li>
                                    <li><i class="fa-solid fa-calendar-days"></i> {{ $post['date'] }}</li>
                                    <li><i class="fa-solid fa-folder"></i> Blog</li>
                                </ul>
                                <h3>{{ $post['title'] }}</h3>
                                <p>{{ $post['excerpt'] }}</p>
                                <span class="home-blog-readmore">Read more</span>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
