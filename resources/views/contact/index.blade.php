@extends('layouts.app')

@section('title', 'Contact Us | Tripti Hotel')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbTitle' => 'Contact'])
    <section class="section-contact padding-t-50 padding-b-100">
        <div class="container">
            <div class="row mb-minus-24">
                <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000">
                    <div class="rx-contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.857!3d22.7196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sHotel!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="rx-contact-form">
                        <div class="sub-title"><h4>Get In Touch</h4></div>
                        <form action="#">
                            <div class="rx-input-box">
                                <label for="name">Your Name*</label>
                                <input type="text" id="name" class="rx-form-control" required>
                            </div>
                            <div class="rx-input-box">
                                <label for="email">Your Email*</label>
                                <input type="email" id="email" class="rx-form-control" required>
                            </div>
                            <div class="rx-input-box">
                                <label for="subject">Subject*</label>
                                <input type="text" id="subject" class="rx-form-control" required>
                            </div>
                            <div class="rx-input-box">
                                <label for="message">Message*</label>
                                <textarea class="rx-form-control" rows="4" id="message" required></textarea>
                            </div>
                            <div class="rx-inner-button">
                                <button type="button" class="rx-btn-two">Send Message</button>
                            </div>
                        </form>
                        <div class="rx-contact-info margin-t-24">
                            <p><strong>Address:</strong> 987-A, Dudhivadar, Rajkot, Gujarat, Bharat - 360410.</p>
                            <p><strong>Phone:</strong> +91 (1234) 567 890</p>
                            <p><strong>Email:</strong> example@rx-email.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
