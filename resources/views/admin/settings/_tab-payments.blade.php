<div class="row g-3">
    <div class="col-12">
        <h5 class="mb-1">Razorpay</h5>
        <p class="text-muted font-13 mb-0">Enable online payments for room bookings. Use your Razorpay dashboard keys (test keys for staging, live keys for production).</p>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="razorpay_enabled">Enable Razorpay</label>
            @php
                $razorpayEnabled = (string) old('razorpay_enabled', isset($settings['razorpay_enabled']) ? (int) filter_var($settings['razorpay_enabled'], FILTER_VALIDATE_BOOLEAN) : 0);
            @endphp
            <select class="form-select @error('razorpay_enabled') is-invalid @enderror" id="razorpay_enabled" name="razorpay_enabled" required>
                <option value="1" @selected($razorpayEnabled === '1')>Enabled</option>
                <option value="0" @selected($razorpayEnabled === '0')>Disabled</option>
            </select>
            @error('razorpay_enabled')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="razorpay_key_id">Key ID</label>
            <input type="text" class="form-control @error('razorpay_key_id') is-invalid @enderror" id="razorpay_key_id" name="razorpay_key_id" value="{{ old('razorpay_key_id', $settings['razorpay_key_id'] ?? '') }}" placeholder="rzp_test_... or rzp_live_...">
            @error('razorpay_key_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="razorpay_key_secret">Key Secret</label>
            <input type="password" class="form-control @error('razorpay_key_secret') is-invalid @enderror" id="razorpay_key_secret" name="razorpay_key_secret" value="" placeholder="{{ filled($settings['razorpay_key_secret'] ?? null) ? 'Saved — leave blank to keep current' : 'Enter secret key' }}" autocomplete="new-password">
            @error('razorpay_key_secret')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Leave blank when updating other settings to keep the existing secret.</span>
        </div>
    </div>
</div>
