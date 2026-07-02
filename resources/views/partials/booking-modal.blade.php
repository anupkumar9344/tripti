<div class="rx-modal modal fade" id="rx_booking_from">
    <div class="rx-modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="sub-title"><h4>Check Availability</h4></div>
            <button type="button" class="qty-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
            <div class="modal-body">
                <div class="rx-booking-from">
                    <form action="#">
                        <div class="rx-inner-input">
                            <label for="checkin">Check in*</label>
                            <input type="text" id="checkin" class="rx-from-control datepicker">
                        </div>
                        <div class="rx-inner-input">
                            <label for="checkout">Check Out*</label>
                            <input type="text" id="checkout" class="rx-from-control datepicker">
                        </div>
                        <div class="rx-inner-input">
                            <label for="room-type">Room Type*</label>
                            <select class="rx-from-control form-select" id="room-type">
                                <option selected>Select</option>
                                <option value="1">Junior Suite</option>
                                <option value="2">Twin Room</option>
                                <option value="3">Quad Room</option>
                                <option value="4">Deluxe Room</option>
                                <option value="5">Executive Room</option>
                                <option value="6">Presidential Room</option>
                            </select>
                        </div>
                        <div class="rx-inner-input">
                            <label for="adults">Adults*</label>
                            <select class="rx-from-control form-select" id="adults">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="rx-inner-input">
                            <label for="children">Children*</label>
                            <select class="rx-from-control form-select" id="children">
                                <option selected>Select</option>
                                <option value="0">None</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="rx-inner-button">
                            <a href="{{ route('contact') }}" class="rx-btn-two">Book Room</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
