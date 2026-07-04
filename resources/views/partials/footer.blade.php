@php
    $footerAbout = $siteSettings['footer_about'] ?? 'Our hotel seamlessly blends timeless charm with modern amenities, offering an unparalleled experience for travelers.';
    $footerAddress = $siteSettings['address'] ?? '987-A, Dudhivadar, Rajkot, Gujarat, Bharat - 360410';
    $footerEmail = $siteEmail ?? ($siteSettings['email_1'] ?? 'info@triptihotel.com');
    $footerPhone = $sitePhone ?? ($siteSettings['phone_1'] ?? '+91 98765 43210');
    $footerPhone2 = $siteSettings['phone_2'] ?? null;
    $footerEmail2 = $siteSettings['email_2'] ?? null;
    $footerHours = $siteSettings['opening_hours'] ?? null;
    $whatsappNumber = preg_replace('/\D+/', '', (string) ($siteSettings['whatsapp_number'] ?? ''));
    $phoneDigits = preg_replace('/\D+/', '', (string) $footerPhone);

    $socialLinks = array_filter([
        ['url' => $siteSettings['facebook_url'] ?? null, 'icon' => 'ri-facebook-fill', 'label' => 'Facebook'],
        ['url' => $siteSettings['instagram_url'] ?? null, 'icon' => 'ri-instagram-line', 'label' => 'Instagram'],
        ['url' => $siteSettings['youtube_url'] ?? null, 'icon' => 'ri-youtube-fill', 'label' => 'YouTube'],
    ], fn (array $item) => filled($item['url']));
@endphp

<footer class="site-footer">
    <div class="site-footer-main">
        <div class="container">
            <div class="row g-4 g-xl-5">
                <div class="col-lg-4 col-md-6">
                    <div class="site-footer-brand">
                        <a href="{{ url('/') }}" class="site-footer-logo">
                            <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}">
                        </a>
                        <p class="site-footer-about">{{ $footerAbout }}</p>

                        @if ($socialLinks !== [] || $whatsappNumber !== '')
                            <div class="site-footer-social">
                                @foreach ($socialLinks as $social)
                                    <a href="{{ $social['url'] }}" class="site-footer-social-link" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}">
                                        <i class="{{ $social['icon'] }}"></i>
                                    </a>
                                @endforeach
                                @if ($whatsappNumber !== '')
                                    <a href="https://wa.me/{{ $whatsappNumber }}" class="site-footer-social-link" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                                        <i class="ri-whatsapp-line"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <div class="site-footer-col">
                        <h3 class="site-footer-title">Explore</h3>
                        <ul class="site-footer-links">
                            <li><a href="{{ route('rooms') }}">Rooms &amp; Suites</a></li>
                            <li><a href="{{ route('gallery') }}">Gallery</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('booking') }}">Book Now</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <div class="site-footer-col">
                        <h3 class="site-footer-title">Quick Links</h3>
                        <ul class="site-footer-links">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="site-footer-col">
                        <h3 class="site-footer-title">Contact Us</h3>
                        <ul class="site-footer-contact">
                            @if ($footerAddress)
                                <li>
                                    <span class="site-footer-contact-icon"><i class="ri-map-pin-line"></i></span>
                                    <span>{{ $footerAddress }}</span>
                                </li>
                            @endif
                            @if ($footerEmail)
                                <li>
                                    <span class="site-footer-contact-icon"><i class="ri-mail-line"></i></span>
                                    <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a>
                                </li>
                            @endif
                            @if ($footerEmail2)
                                <li>
                                    <span class="site-footer-contact-icon"><i class="ri-mail-send-line"></i></span>
                                    <a href="mailto:{{ $footerEmail2 }}">{{ $footerEmail2 }}</a>
                                </li>
                            @endif
                            @if ($footerPhone)
                                <li>
                                    <span class="site-footer-contact-icon"><i class="ri-phone-line"></i></span>
                                    <a href="tel:{{ $phoneDigits }}">{{ $footerPhone }}</a>
                                </li>
                            @endif
                            @if ($footerPhone2)
                                <li>
                                    <span class="site-footer-contact-icon"><i class="ri-phone-fill"></i></span>
                                    <a href="tel:{{ preg_replace('/\D+/', '', $footerPhone2) }}">{{ $footerPhone2 }}</a>
                                </li>
                            @endif
                            @if ($footerHours)
                                <li>
                                    <span class="site-footer-contact-icon"><i class="ri-time-line"></i></span>
                                    <span>{!! nl2br(e($footerHours)) !!}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-footer-bottom">
        <div class="container">
            <div class="site-footer-bottom-inner">
                <p class="site-footer-copy">&copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ $siteName }}</a>. All Rights Reserved.</p>
                <div class="site-footer-bottom-links">
                    <a href="{{ route('privacy-policy') }}">Privacy</a>
                    <a href="{{ route('terms-and-conditions') }}">Terms</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>
