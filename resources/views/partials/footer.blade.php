<footer>
    <div class="rx-main-footer padding-tb-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-lg-3 col-sm-6 col-12 mb-24 footer-order-1">
                    <div class="rx-social-media">
                        <div class="rx-logo">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Tripti Hotel">
                        </div>
                        <div class="inner-contact">
                            <p>Our hotel seamlessly blends timeless charm with modern amenities, offering an unparalleled experience for travelers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6 col-420-full mb-24 footer-order-2">
                    <div class="rx-footer-items">
                        <div class="rx-items-heading"><h4>Explore</h4></div>
                        <div class="rx-items-contact">
                            <ul>
                                <li><a href="{{ route('rooms') }}">Rooms & Suites</a></li>
                                <li><a href="{{ route('facilities') }}">Facilities</a></li>
                                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6 col-420-full mb-24 footer-order-4">
                    <div class="rx-footer-items">
                        <div class="rx-items-heading"><h4>Quick Links</h4></div>
                        <div class="rx-items-contact">
                            <ul>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                                <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-6 col-420-full mb-24 footer-order-5">
                    <div class="rx-footer-other-info">
                        <div class="inner-info">
                            <h5>Address</h5>
                            <p>987-A, Dudhivadar, Rajkot, Gujarat, Bharat - 360410.</p>
                        </div>
                        <div class="inner-info">
                            <h5>Email</h5>
                            <a href="mailto:example@rx-email.com">example@rx-email.com</a>
                        </div>
                        <div class="inner-info">
                            <h5>Phone No</h5>
                            <a href="tel:+911234567890">+91 (1234) 567 890</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rx-footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rx-footer-inner-contact">
                        <div class="rx-footer-left-side-contact">
                            <p>&copy; {{ date('Y') }} <a href="{{ url('/') }}">Tripti Hotel</a>, All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
