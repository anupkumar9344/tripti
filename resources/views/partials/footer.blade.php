@php
    $siteName = $settings['website_name'] ?: 'Sahaj Aarogyam';
    $footerAbout = $settings['footer_about'] ?: 'Integrated wellness clinic providing physiotherapy, Ayurveda, pain management, and holistic healing solutions in Indore.';
    $address = $settings['address'] ?: '560 Sector B Greater Brajeshwari, Near Agrawal Public School, Indore, India, 452001';
    $phonePrimary = $settings['phone_1'] ?: '+91 94259 63336';
    $emailPrimary = $settings['email_1'] ?: 'info@sahajaarogyam.com';
    $emailSecondary = $settings['email_2'] ?: 'sahajaarogyam@gmail.com';
    $whatsappNumber = preg_replace('/\D+/', '', $settings['whatsapp_number'] ?: '9425963336');
@endphp

<!-- Footer Main Start -->
<footer class="footer-main">
    <div class="container">
        <div class="row g-4 g-lg-5 footer-top">
            <div class="col-lg-3 col-md-6">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="footer-brand-logo">
                        <img src="{{ asset('images/logo/logo.webp') }}" alt="{{ $siteName }}">
                    </a>
                    <p class="footer-brand-text">{{ $footerAbout }}</p>
                    <div class="footer-social-links">
                        <ul>
                            @if ($settings['facebook_url'])
                                <li><a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                            @endif
                            @if ($settings['instagram_url'])
                                <li><a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                            @endif
                            @if ($settings['youtube_url'])
                                <li><a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                            @endif
                            @if ($whatsappNumber)
                                <li><a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fa-solid fa-angle-right"></i> Home</a></li>
                        <li><a href="{{ url('/about-us') }}"><i class="fa-solid fa-angle-right"></i> About Us</a></li>
                        <li><a href="{{ url('/our-expert-team') }}"><i class="fa-solid fa-angle-right"></i> Our Expert Team</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Services</a></li>
                        <li><a href="{{ url('/health-programs') }}"><i class="fa-solid fa-angle-right"></i> Health Programs &amp; Camps</a></li>
                        <li><a href="{{ url('/treatment') }}"><i class="fa-solid fa-angle-right"></i> Treatment</a></li>
                        <li><a href="{{ url('/blog') }}"><i class="fa-solid fa-angle-right"></i> Blogs</a></li>
                        <li><a href="{{ url('/gallery') }}"><i class="fa-solid fa-angle-right"></i> Gallery</a></li>
                        <li><a href="{{ url('/contact-us') }}"><i class="fa-solid fa-angle-right"></i> Contact us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-links">
                    <h3>Our Services</h3>
                    <ul>
                        @forelse ($footerServices as $footerService)
                            <li><a href="{{ route('services.show', $footerService->slug) }}"><i class="fa-solid fa-angle-right"></i> {{ $footerService->title }}</a></li>
                        @empty
                            <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Services</a></li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-links">
                    <h3>Program</h3>
                    <ul>
                        <li><a href="{{ url('/health-programs') }}"><i class="fa-solid fa-angle-right"></i> Weight Management Program</a></li>
                        <li><a href="{{ url('/health-programs') }}"><i class="fa-solid fa-angle-right"></i> Spine &amp; Posture Camp</a></li>
                        <li><a href="{{ url('/health-programs') }}"><i class="fa-solid fa-angle-right"></i> Stress &amp; Sleep Retreat</a></li>
                        <li><a href="{{ url('/health-programs') }}"><i class="fa-solid fa-angle-right"></i> PCOD &amp; Hormonal Wellness</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-links footer-contact-links">
                    <h3>Contact Info</h3>
                    <ul class="footer-contact-list">
                        <li>
                            <span class="footer-contact-icon"><i class="fa-solid fa-location-dot"></i></span>
                            <span>{{ $address }}</span>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fa-solid fa-phone"></i></span>
                            <a href="tel:{{ preg_replace('/\s+/', '', $phonePrimary) }}">{{ $phonePrimary }}</a>
                        </li>
                        @if ($settings['phone_2'])
                            <li>
                                <span class="footer-contact-icon"><i class="fa-solid fa-phone"></i></span>
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone_2']) }}">{{ $settings['phone_2'] }}</a>
                            </li>
                        @endif
                        <li>
                            <span class="footer-contact-icon"><i class="fa-solid fa-envelope"></i></span>
                            <a href="mailto:{{ $emailPrimary }}">{{ $emailPrimary }}</a>
                        </li>
                        @if ($emailSecondary)
                            <li>
                                <span class="footer-contact-icon"><i class="fa-solid fa-envelope"></i></span>
                                <a href="mailto:{{ $emailSecondary }}">{{ $emailSecondary }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-bar">
        <div class="container">
            <div class="footer-copyright">
                <div class="footer-copyright-text">
                    <p>&copy;{{ date('Y') }} {{ $siteName }}. All Rights Reserved.</p>
                </div>
                <div class="footer-privacy-policy">
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Main End -->
