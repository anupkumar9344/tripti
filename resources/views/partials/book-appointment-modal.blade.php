<!-- Book Appointment Modal Start -->
<div class="modal fade book-appointment-modal" id="bookAppointmentModal" tabindex="-1" aria-labelledby="bookAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="book-appointment-modal-heading">
                    <span class="modal-eyebrow">Book Your Visit</span>
                    <h2 class="modal-title" id="bookAppointmentModalLabel">Schedule an Appointment</h2>
                    <p class="modal-subtitle">Share your details and our team will confirm your appointment shortly.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="book-appointment-form-wrap">
                    <div class="appointment-form">
                        <form id="bookAppointmentForm" action="#" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <label class="form-label" for="appointment_name">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="appointment_name" placeholder="Enter your name" required>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label class="form-label" for="appointment_phone">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" id="appointment_phone" placeholder="Enter phone number" required>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <label class="form-label" for="appointment_email">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="appointment_email" placeholder="Enter email address" required>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label class="form-label" for="appointment_service">Service</label>
                                    <select name="service" class="form-control form-select" id="appointment_service" required>
                                        <option value="" disabled selected>Select a service</option>
                                        <option value="pain_relief">Pain Relief Therapy</option>
                                        <option value="hijama">Hijama Cupping</option>
                                        <option value="unani">Unani Medicine</option>
                                        <option value="physiotherapy">Physiotherapy</option>
                                        <option value="consultation">General Consultation</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label class="form-label" for="appointment_date">Preferred Date</label>
                                    <input type="date" name="date" class="form-control" id="appointment_date" required>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <label class="form-label" for="appointment_message">Message <span class="text-muted">(optional)</span></label>
                                    <textarea name="message" class="form-control" id="appointment_message" rows="3" placeholder="Tell us about your concern"></textarea>
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-form-btn">
                                        <button type="submit" class="btn-default">Submit Appointment Request</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="book-appointment-success d-none" role="status">
                    <div class="book-appointment-success-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3>Request Received</h3>
                    <p>Thank you. This is a demo booking form — we will connect the live workflow later.</p>
                    <button type="button" class="btn-default btn-highlighted" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Book Appointment Modal End -->
