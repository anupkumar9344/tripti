<section class="section-blog padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                <div class="rx-banner text-center rx-banner-effects">
                    <p><img src="{{ asset('assets/img/banner/left-shape.svg') }}" alt="" class="svg-img left-side">Blog<img src="{{ asset('assets/img/banner/right-shape.svg') }}" alt="" class="svg-img right-side"></p>
                    <h4>Latest <span>News</span></h4>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="owl-carousel rx-blog-slider">
                    @foreach([
                        ['img' => 1, 'date' => 'June 28, 2024 - Restaurant', 'title' => 'Best way to enjoy luxury dining at our hotel.'],
                        ['img' => 2, 'date' => 'June 30, 2024 - Gym', 'title' => 'Wellness guide: 5 steps to a perfect stay.'],
                        ['img' => 3, 'date' => 'June 16, 2024 - Spa', 'title' => 'Relax and recharge at our spa retreat.'],
                        ['img' => 4, 'date' => 'June 10, 2024 - Events', 'title' => 'Host unforgettable events at Tripti Hotel.'],
                    ] as $post)
                        <div class="rx-blog-card">
                            <div class="rx-blog-img"><img src="{{ asset('assets/img/blog/' . $post['img'] . '.jpg') }}" alt=""></div>
                            <div class="rx-blog-contact">
                                <span>{{ $post['date'] }}</span>
                                <h4><a href="{{ route('blog.show') }}">{{ $post['title'] }}</a></h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
