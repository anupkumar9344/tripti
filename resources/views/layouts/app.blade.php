<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.head-meta')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/swiper-bundle.min.css') }}">
    @php
        $styleCss = public_path('assets/css/style.css');
        $brandCss = public_path('assets/css/brand.css');
        $mainJs = public_path('assets/js/main.js');
        $styleVer = is_file($styleCss) ? filemtime($styleCss) : time();
        $brandVer = is_file($brandCss) ? filemtime($brandCss) : time();
        $mainVer = is_file($mainJs) ? filemtime($mainJs) : time();
    @endphp
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ $styleVer }}">
    <link rel="stylesheet" href="{{ asset('assets/css/brand.css') }}?v={{ $brandVer }}">
    @stack('styles')
</head>
<body id="Top">

    <div class="rx-loader">
        <span class="loader"></span>
    </div>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @include('partials.booking-modal')

    <a href="#Top" class="back-to-top result-placeholder">
        <i class="ri-arrow-up-double-fill"></i>
        <div class="back-to-top-wrap active-progress">
            <svg viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
            </svg>
        </div>
    </a>

    <script src="{{ asset('assets/js/vendor/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/aos.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/smoothscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ $mainVer }}"></script>
    @stack('scripts')
</body>
</html>
