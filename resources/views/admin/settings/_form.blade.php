<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Website Identity</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="website_name">Website Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('website_name') is-invalid @enderror" id="website_name" name="website_name" value="{{ old('website_name', $settings['website_name']) }}" required>
                    @error('website_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-0">
                    <label class="form-label" for="website_logo">Website Logo</label>
                    <input type="file" class="form-control @error('website_logo') is-invalid @enderror" id="website_logo" name="website_logo" accept="image/*">
                    @error('website_logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if (! empty($settings['website_logo']))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings['website_logo']) }}" alt="Website logo" class="img-thumbnail" style="max-height: 80px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Contact Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
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
                    <label class="form-label" for="phone_1">Phone Number 1</label>
                    <input type="text" class="form-control @error('phone_1') is-invalid @enderror" id="phone_1" name="phone_1" value="{{ old('phone_1', $settings['phone_1']) }}" placeholder="Primary phone">
                    @error('phone_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="form-label" for="phone_2">Phone Number 2</label>
                    <input type="text" class="form-control @error('phone_2') is-invalid @enderror" id="phone_2" name="phone_2" value="{{ old('phone_2', $settings['phone_2']) }}" placeholder="Secondary phone">
                    @error('phone_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-0">
                    <label class="form-label" for="whatsapp_number">WhatsApp Number</label>
                    <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="WhatsApp number">
                    @error('whatsapp_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Location & Hours</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label" for="address">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Business address">{{ old('address', $settings['address']) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Shown on the contact page and footer.</span>
                </div>
            </div>

            <div class="col-md-12">
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

<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Social & Map</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="form-label" for="facebook_url">Facebook URL</label>
                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}" placeholder="https://facebook.com/...">
                    @error('facebook_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="form-label" for="instagram_url">Instagram URL</label>
                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}" placeholder="https://instagram.com/...">
                    @error('instagram_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="form-label" for="youtube_url">YouTube URL</label>
                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}" placeholder="https://youtube.com/...">
                    @error('youtube_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-0">
                    <label class="form-label" for="google_map_embed">Google Map Embed URL</label>
                    <textarea class="form-control @error('google_map_embed') is-invalid @enderror" id="google_map_embed" name="google_map_embed" rows="3" placeholder="Paste the Google Maps iframe src URL">{{ old('google_map_embed', $settings['google_map_embed']) }}</textarea>
                    @error('google_map_embed')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Use the iframe <code>src</code> value from Google Maps → Share → Embed a map.</span>
                </div>
            </div>
        </div>
    </div>
</div>
