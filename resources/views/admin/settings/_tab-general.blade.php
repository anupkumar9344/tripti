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

<div class="row g-3 mt-1">
    <div class="col-12">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Theme Colors</h4>
            </div>
            <div class="card-body">
                <p class="text-muted font-13 mb-3">Set the primary brand color for the public website and admin panel.</p>
                <div class="row g-3">
                    @php
                        $primaryColor = old('theme_primary_color', $settings['theme_primary_color'] ?? \App\Support\ThemeColors::DEFAULT_PRIMARY);
                        $adminPrimaryColor = old('admin_theme_primary_color', $settings['admin_theme_primary_color'] ?? \App\Support\AdminThemeColors::DEFAULT_PRIMARY);
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="theme_primary_color">Website Primary Color</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="color" class="form-control form-control-color @error('theme_primary_color') is-invalid @enderror" id="theme_primary_color" name="theme_primary_color" value="{{ $primaryColor }}" title="Choose website primary color">
                                <input type="text" class="form-control @error('theme_primary_color') is-invalid @enderror" id="theme_primary_color_hex" value="{{ $primaryColor }}" maxlength="7" inputmode="text" autocomplete="off" aria-label="Website primary color hex value">
                            </div>
                            <span class="form-text text-muted font-12">Buttons, links, accents, and highlights on the public site.</span>
                            @error('theme_primary_color')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="admin_theme_primary_color">Admin Primary Color</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="color" class="form-control form-control-color @error('admin_theme_primary_color') is-invalid @enderror" id="admin_theme_primary_color" name="admin_theme_primary_color" value="{{ $adminPrimaryColor }}" title="Choose admin primary color">
                                <input type="text" class="form-control @error('admin_theme_primary_color') is-invalid @enderror" id="admin_theme_primary_color_hex" value="{{ $adminPrimaryColor }}" maxlength="7" inputmode="text" autocomplete="off" aria-label="Admin primary color hex value">
                            </div>
                            <span class="form-text text-muted font-12">Sidebar, buttons, tabs, and login page in the admin panel.</span>
                            @error('admin_theme_primary_color')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        function bindThemeColorSync(colorId, hexId) {
            var colorInput = document.getElementById(colorId);
            var hexInput = document.getElementById(hexId);

            if (!colorInput || !hexInput) {
                return;
            }

            colorInput.addEventListener('input', function () {
                hexInput.value = colorInput.value;
            });

            hexInput.addEventListener('input', function () {
                if (/^#([0-9a-fA-F]{6})$/.test(hexInput.value)) {
                    colorInput.value = hexInput.value;
                }
            });

            hexInput.addEventListener('change', function () {
                var normalized = hexInput.value.trim();

                if (/^#([0-9a-fA-F]{6})$/.test(normalized)) {
                    colorInput.value = normalized;
                    hexInput.value = normalized.toLowerCase();
                } else if (/^#([0-9a-fA-F]{3})$/.test(normalized)) {
                    var hex = normalized.slice(1);
                    var expanded = '#' + hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    colorInput.value = expanded;
                    hexInput.value = expanded.toLowerCase();
                } else {
                    hexInput.value = colorInput.value;
                }
            });
        }

        bindThemeColorSync('theme_primary_color', 'theme_primary_color_hex');
        bindThemeColorSync('admin_theme_primary_color', 'admin_theme_primary_color_hex');

        var settingsForm = document.querySelector('form[action*="settings/general"]');

        if (settingsForm) {
            settingsForm.addEventListener('submit', function () {
                ['theme_primary_color', 'admin_theme_primary_color'].forEach(function (colorId) {
                    var colorInput = document.getElementById(colorId);
                    var hexInput = document.getElementById(colorId + '_hex');

                    if (!colorInput || !hexInput) {
                        return;
                    }

                    var normalized = hexInput.value.trim();

                    if (/^#([0-9a-fA-F]{6})$/.test(normalized)) {
                        colorInput.value = normalized;
                    } else if (/^#([0-9a-fA-F]{3})$/.test(normalized)) {
                        var hex = normalized.slice(1);
                        colorInput.value = '#' + hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                });
            });
        }
    })();
</script>
@endpush
