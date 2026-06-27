<!-- Footer Main Start -->
<footer class="footer-main">
    <div class="container">
        <div class="row g-4 g-lg-5 footer-top">
            <div class="col-lg-3 col-md-6">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="footer-brand-logo">
                        <img src="{{ asset('images/logo/logo.webp') }}" alt="Sahaj Aarogyam">
                    </a>
                    <p class="footer-brand-text">Integrated wellness clinic providing physiotherapy, Ayurveda, pain management, and holistic healing solutions in Indore.</p>
                    <div class="footer-social-links">
                        <ul>
                            <li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="https://wa.me/919425963336" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a></li>
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
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Alternative Therapies</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Mental Wellness</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Aesthetic Wellness</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Metabolic Care</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Ayurveda &amp; Detox</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fa-solid fa-angle-right"></i> Pain &amp; Rehabilitation</a></li>
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
                            <span>560 Sector B Greater Brajeshwari, Near Agrawal Public School, Indore, India, 452001</span>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fa-solid fa-phone"></i></span>
                            <a href="tel:+919425963336">+91 94259 63336</a>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fa-solid fa-envelope"></i></span>
                            <a href="mailto:info@sahajaarogyam.com">info@sahajaarogyam.com</a>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fa-solid fa-envelope"></i></span>
                            <a href="mailto:sahajaarogyam@gmail.com">sahajaarogyam@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-bar">
        <div class="container">
            <div class="footer-copyright">
                <div class="footer-copyright-text">
                    <p>&copy;{{ date('Y') }} Sahaj Aarogyam. All Rights Reserved.</p>
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
