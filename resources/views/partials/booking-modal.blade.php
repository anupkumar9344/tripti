<div class="rx-modal modal fade" id="rx_booking_from">
    <div class="rx-modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="sub-title"><h4>Check Availability</h4></div>
            <button type="button" class="qty-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
            <div class="modal-body">
                <div class="rx-booking-from">
                    <form action="{{ route('booking') }}" method="GET">
                        <div class="rx-inner-input">
                            <label for="checkin">Check in*</label>
                            <input type="date" id="checkin" name="check_in" class="rx-from-control" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="rx-inner-input">
                            <label for="checkout">Check Out*</label>
                            <input type="date" id="checkout" name="check_out" class="rx-from-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                        <div class="rx-inner-input">
                            <label for="adults">Adults*</label>
                            <select class="rx-from-control form-select" id="adults" name="adults" required>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($i === 2)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="rx-inner-input">
                            <label for="children">Children</label>
                            <select class="rx-from-control form-select" id="children" name="children">
                                @for ($i = 0; $i <= 4; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="rx-inner-button">
                            <button type="submit" class="rx-btn-two">Find Rooms</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
