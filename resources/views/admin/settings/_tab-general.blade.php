<div class="row g-3 align-items-start">
    <div class="col-lg-4">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Website Identity</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="website_name">Website Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('website_name') is-invalid @enderror" id="website_name" name="website_name" value="{{ old('website_name', $settings['website_name']) }}" required>
                    @error('website_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="footer_about">Footer About Text</label>
                    <textarea class="form-control @error('footer_about') is-invalid @enderror" id="footer_about" name="footer_about" rows="3" placeholder="Short description shown in the website footer">{{ old('footer_about', $settings['footer_about']) }}</textarea>
                    @error('footer_about')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Admin Panel</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    @include('admin.media.partials.url-field', [
                        'name' => 'admin_login_image',
                        'currentValue' => $settings['admin_login_image'] ?? '',
                        'label' => 'Admin Login Image',
                    ])
                    <span class="form-text text-muted font-12">Wide landscape photo works best on the login page.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Brand Assets</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    @include('admin.media.partials.url-field', [
                        'name' => 'website_logo',
                        'currentValue' => $settings['website_logo'] ?? '',
                        'label' => 'Website Logo',
                    ])
                </div>

                <div class="form-group mb-0">
                    @include('admin.media.partials.url-field', [
                        'name' => 'website_favicon',
                        'currentValue' => $settings['website_favicon'] ?? '',
                        'label' => 'Site Icon (Favicon)',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
