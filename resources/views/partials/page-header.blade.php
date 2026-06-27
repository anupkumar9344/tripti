@php
    $headerBg = $bgImage ?? 'images/home-about-team.jpg';
@endphp

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="page-header-bg" style="background-image: url('{{ asset($headerBg) }}');"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $title }}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb ?? $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
