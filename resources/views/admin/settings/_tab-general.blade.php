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
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Website Welcome Modal</h4>
                @php
                    $welcomeEnabled = filter_var(old('welcome_modal_enabled', $settings['welcome_modal_enabled'] ?? false), FILTER_VALIDATE_BOOLEAN);
                    $welcomeMediaType = old('welcome_modal_media_type', $settings['welcome_modal_media_type'] ?? 'image');
                @endphp
                <div class="form-check form-switch form-switch-success mb-0">
                    <input type="hidden" name="welcome_modal_enabled" value="0">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="welcome_modal_enabled"
                        name="welcome_modal_enabled"
                        value="1"
                        @checked($welcomeEnabled)
                    >
                    <label class="form-check-label font-13" for="welcome_modal_enabled">Enabled</label>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted font-13 mb-3">Shown to visitors when they first open the website. Dismissed for 24 hours, or shown again when you update this content.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="welcome_modal_title">Title</label>
                            <input type="text" class="form-control @error('welcome_modal_title') is-invalid @enderror" id="welcome_modal_title" name="welcome_modal_title" value="{{ old('welcome_modal_title', $settings['welcome_modal_title'] ?? '') }}" placeholder="Welcome to Tripti Hotel">
                            @error('welcome_modal_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="welcome_modal_media_type">Media Type</label>
                            <select class="form-select @error('welcome_modal_media_type') is-invalid @enderror" id="welcome_modal_media_type" name="welcome_modal_media_type">
                                <option value="none" @selected($welcomeMediaType === 'none')>No media</option>
                                <option value="image" @selected($welcomeMediaType === 'image')>Image</option>
                                <option value="video" @selected($welcomeMediaType === 'video')>Video</option>
                            </select>
                            @error('welcome_modal_media_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label class="form-label" for="welcome_modal_message">Message</label>
                            <textarea class="form-control @error('welcome_modal_message') is-invalid @enderror" id="welcome_modal_message" name="welcome_modal_message" rows="3" placeholder="Short welcome message for your visitors">{{ old('welcome_modal_message', $settings['welcome_modal_message'] ?? '') }}</textarea>
                            @error('welcome_modal_message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 js-welcome-media-image" @if($welcomeMediaType !== 'image') style="display:none;" @endif>
                        <div class="form-group mb-0">
                            @include('admin.media.partials.url-field', [
                                'name' => 'welcome_modal_image',
                                'currentValue' => $settings['welcome_modal_image'] ?? '',
                                'label' => 'Welcome Image',
                            ])
                            <span class="form-text text-muted font-12">Recommended: 1200×675px landscape image.</span>
                        </div>
                    </div>
                    <div class="col-md-6 js-welcome-media-video" @if($welcomeMediaType !== 'video') style="display:none;" @endif>
                        <div class="form-group mb-0">
                            <label class="form-label" for="welcome_modal_video_url">Video URL</label>
                            <input type="text" class="form-control @error('welcome_modal_video_url') is-invalid @enderror" id="welcome_modal_video_url" name="welcome_modal_video_url" value="{{ old('welcome_modal_video_url', $settings['welcome_modal_video_url'] ?? '') }}" placeholder="YouTube, Vimeo, or direct video URL">
                            @error('welcome_modal_video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="form-text text-muted font-12">Supports YouTube, Vimeo, or a direct MP4/WebM link.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="welcome_modal_button_text">Button Text</label>
                            <input type="text" class="form-control @error('welcome_modal_button_text') is-invalid @enderror" id="welcome_modal_button_text" name="welcome_modal_button_text" value="{{ old('welcome_modal_button_text', $settings['welcome_modal_button_text'] ?? '') }}" placeholder="Explore Rooms">
                            @error('welcome_modal_button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="welcome_modal_button_url">Button URL</label>
                            <input type="text" class="form-control @error('welcome_modal_button_url') is-invalid @enderror" id="welcome_modal_button_url" name="welcome_modal_button_url" value="{{ old('welcome_modal_button_url', $settings['welcome_modal_button_url'] ?? '') }}" placeholder="/rooms">
                            @error('welcome_modal_button_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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

        var welcomeMediaType = document.getElementById('admin_welcome_modal_media_type');
        var welcomeImageField = document.querySelector('.js-welcome-media-image');
        var welcomeVideoField = document.querySelector('.js-welcome-media-video');

        if (welcomeMediaType && welcomeImageField && welcomeVideoField) {
            welcomeMediaType.addEventListener('change', function () {
                var value = welcomeMediaType.value;
                welcomeImageField.style.display = value === 'image' ? '' : 'none';
                welcomeVideoField.style.display = value === 'video' ? '' : 'none';
            });
        }

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
