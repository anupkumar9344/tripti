<div class="row g-3 align-items-start">
    <div class="col-lg-7">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Contact Details</h4>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="email_1">Email 1</label>
                            <input type="email" class="form-control @error('email_1') is-invalid @enderror" id="email_1" name="email_1" value="{{ old('email_1', $settings['email_1']) }}" placeholder="Primary email">
                            @error('email_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="email_2">Email 2</label>
                            <input type="email" class="form-control @error('email_2') is-invalid @enderror" id="email_2" name="email_2" value="{{ old('email_2', $settings['email_2']) }}" placeholder="Secondary email">
                            @error('email_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="phone_1">Phone 1</label>
                            <input type="text" class="form-control @error('phone_1') is-invalid @enderror" id="phone_1" name="phone_1" value="{{ old('phone_1', $settings['phone_1']) }}" placeholder="Primary phone">
                            @error('phone_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="phone_2">Phone 2</label>
                            <input type="text" class="form-control @error('phone_2') is-invalid @enderror" id="phone_2" name="phone_2" value="{{ old('phone_2', $settings['phone_2']) }}" placeholder="Secondary phone">
                            @error('phone_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label class="form-label" for="whatsapp_number">WhatsApp</label>
                            <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="WhatsApp number">
                            @error('whatsapp_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Location &amp; Hours</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="address">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Business address">{{ old('address', $settings['address']) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Shown on the contact page and footer.</span>
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="opening_hours">Opening Hours</label>
                    <textarea class="form-control @error('opening_hours') is-invalid @enderror" id="opening_hours" name="opening_hours" rows="3" placeholder="Mon - Sat: 9:00 AM - 8:00 PM&#10;Sunday: Closed">{{ old('opening_hours', $settings['opening_hours']) }}</textarea>
                    @error('opening_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">One line per schedule entry.</span>
                </div>
            </div>
        </div>
    </div>
</div>
