@php
    $activeTab = 'general';
    $seoKeys = [
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_meta_author',
        'seo_robots',
        'seo_og_title',
        'seo_og_description',
        'seo_og_image',
        'seo_twitter_card',
        'seo_twitter_site',
        'seo_google_site_verification',
    ];

    if ($errors->hasAny(['email_1', 'email_2', 'phone_1', 'phone_2', 'whatsapp_number', 'address', 'opening_hours'])) {
        $activeTab = 'contact';
    } elseif ($errors->hasAny(['visit_us_eyebrow', 'visit_us_title', 'visit_us_description', 'visit_us_bg_image', 'contact_locations_title', 'contact_locations_description', 'contact_form_title', 'contact_form_description'])) {
        $activeTab = 'pages';
    } elseif ($errors->hasAny(['facebook_url', 'instagram_url', 'youtube_url', 'google_map_embed'])) {
        $activeTab = 'social';
    } elseif ($errors->hasAny($seoKeys)) {
        $activeTab = 'seo';
    } elseif ($errors->hasAny(['website_name', 'footer_about', 'website_logo'])) {
        $activeTab = 'general';
    }
@endphp

<div class="card mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'general' ? 'active' : '' }}" id="settings-general-tab" data-bs-toggle="tab" data-bs-target="#settings-general" type="button" role="tab" aria-controls="settings-general" aria-selected="{{ $activeTab === 'general' ? 'true' : 'false' }}">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'contact' ? 'active' : '' }}" id="settings-contact-tab" data-bs-toggle="tab" data-bs-target="#settings-contact" type="button" role="tab" aria-controls="settings-contact" aria-selected="{{ $activeTab === 'contact' ? 'true' : 'false' }}">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'pages' ? 'active' : '' }}" id="settings-pages-tab" data-bs-toggle="tab" data-bs-target="#settings-pages" type="button" role="tab" aria-controls="settings-pages" aria-selected="{{ $activeTab === 'pages' ? 'true' : 'false' }}">Pages</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'social' ? 'active' : '' }}" id="settings-social-tab" data-bs-toggle="tab" data-bs-target="#settings-social" type="button" role="tab" aria-controls="settings-social" aria-selected="{{ $activeTab === 'social' ? 'true' : 'false' }}">Social &amp; Map</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'seo' ? 'active' : '' }}" id="settings-seo-tab" data-bs-toggle="tab" data-bs-target="#settings-seo" type="button" role="tab" aria-controls="settings-seo" aria-selected="{{ $activeTab === 'seo' ? 'true' : 'false' }}">SEO</button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade {{ $activeTab === 'general' ? 'show active' : '' }}" id="settings-general" role="tabpanel" aria-labelledby="settings-general-tab">
                <h5 class="mb-3">Website Identity</h5>
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
                        <div class="form-group mb-3">
                            <label class="form-label" for="footer_about">Footer About Text</label>
                            <textarea class="form-control @error('footer_about') is-invalid @enderror" id="footer_about" name="footer_about" rows="3" placeholder="Short description shown in the website footer">{{ old('footer_about', $settings['footer_about']) }}</textarea>
                            @error('footer_about')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            @include('admin.media.partials.url-field', [
                                'name' => 'website_logo',
                                'currentValue' => $settings['website_logo'] ?? '',
                                'label' => 'Website Logo',
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{ $activeTab === 'contact' ? 'show active' : '' }}" id="settings-contact" role="tabpanel" aria-labelledby="settings-contact-tab">
                <h5 class="mb-3">Contact Information</h5>
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
                        <div class="form-group mb-3">
                            <label class="form-label" for="whatsapp_number">WhatsApp Number</label>
                            <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="WhatsApp number">
                            @error('whatsapp_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Location &amp; Hours</h5>
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

            <div class="tab-pane fade {{ $activeTab === 'pages' ? 'show active' : '' }}" id="settings-pages" role="tabpanel" aria-labelledby="settings-pages-tab">
                <h5 class="mb-3">Homepage Visit Us Section</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="visit_us_eyebrow">Visit Us Eyebrow</label>
                            <input type="text" class="form-control @error('visit_us_eyebrow') is-invalid @enderror" id="visit_us_eyebrow" name="visit_us_eyebrow" value="{{ old('visit_us_eyebrow', $settings['visit_us_eyebrow']) }}" placeholder="Visit Us">
                            @error('visit_us_eyebrow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="form-label" for="visit_us_title">Visit Us Title</label>
                            <input type="text" class="form-control @error('visit_us_title') is-invalid @enderror" id="visit_us_title" name="visit_us_title" value="{{ old('visit_us_title', $settings['visit_us_title']) }}" placeholder="Serving Indore &amp; Nearby">
                            @error('visit_us_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="visit_us_description">Visit Us Description</label>
                            <textarea class="form-control @error('visit_us_description') is-invalid @enderror" id="visit_us_description" name="visit_us_description" rows="3">{{ old('visit_us_description', $settings['visit_us_description']) }}</textarea>
                            @error('visit_us_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            @include('admin.media.partials.url-field', [
                                'name' => 'visit_us_bg_image',
                                'currentValue' => $settings['visit_us_bg_image'] ?? '',
                                'label' => 'Visit Us Background Image',
                            ])
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Contact Page Content</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="contact_locations_title">Locations Title</label>
                            <input type="text" class="form-control @error('contact_locations_title') is-invalid @enderror" id="contact_locations_title" name="contact_locations_title" value="{{ old('contact_locations_title', $settings['contact_locations_title']) }}" placeholder="Our Locations">
                            @error('contact_locations_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="contact_form_title">Contact Form Title</label>
                            <input type="text" class="form-control @error('contact_form_title') is-invalid @enderror" id="contact_form_title" name="contact_form_title" value="{{ old('contact_form_title', $settings['contact_form_title']) }}" placeholder="Send Us a Message">
                            @error('contact_form_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="contact_locations_description">Locations Description</label>
                            <textarea class="form-control @error('contact_locations_description') is-invalid @enderror" id="contact_locations_description" name="contact_locations_description" rows="2">{{ old('contact_locations_description', $settings['contact_locations_description']) }}</textarea>
                            @error('contact_locations_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label" for="contact_form_description">Contact Form Description</label>
                            <textarea class="form-control @error('contact_form_description') is-invalid @enderror" id="contact_form_description" name="contact_form_description" rows="2">{{ old('contact_form_description', $settings['contact_form_description']) }}</textarea>
                            @error('contact_form_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{ $activeTab === 'social' ? 'show active' : '' }}" id="settings-social" role="tabpanel" aria-labelledby="settings-social-tab">
                <h5 class="mb-3">Social Links</h5>
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
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Google Map</h5>
                <div class="row">
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

            <div class="tab-pane fade {{ $activeTab === 'seo' ? 'show active' : '' }}" id="settings-seo" role="tabpanel" aria-labelledby="settings-seo-tab">
                <h5 class="mb-3">Basic Meta Tags</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_title">Default Meta Title</label>
                            <input type="text" class="form-control @error('seo_meta_title') is-invalid @enderror" id="seo_meta_title" name="seo_meta_title" value="{{ old('seo_meta_title', $settings['seo_meta_title']) }}" placeholder="Sahaj Aarogyam | Integrated Wellness Clinic in Indore">
                            @error('seo_meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="form-text text-muted font-12">Used when a page does not set its own title.</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_description">Meta Description</label>
                            <textarea class="form-control @error('seo_meta_description') is-invalid @enderror" id="seo_meta_description" name="seo_meta_description" rows="3" placeholder="Brief summary for search engines">{{ old('seo_meta_description', $settings['seo_meta_description']) }}</textarea>
                            @error('seo_meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control @error('seo_meta_keywords') is-invalid @enderror" id="seo_meta_keywords" name="seo_meta_keywords" value="{{ old('seo_meta_keywords', $settings['seo_meta_keywords']) }}" placeholder="wellness, physiotherapy, Ayurveda">
                            @error('seo_meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="form-text text-muted font-12">Comma-separated keywords.</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_author">Meta Author</label>
                            <input type="text" class="form-control @error('seo_meta_author') is-invalid @enderror" id="seo_meta_author" name="seo_meta_author" value="{{ old('seo_meta_author', $settings['seo_meta_author']) }}" placeholder="Sahaj Aarogyam">
                            @error('seo_meta_author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="seo_robots">Robots</label>
                            <input type="text" class="form-control @error('seo_robots') is-invalid @enderror" id="seo_robots" name="seo_robots" value="{{ old('seo_robots', $settings['seo_robots']) }}" placeholder="index, follow">
                            @error('seo_robots')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Open Graph &amp; Twitter</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_og_title">OG Title</label>
                            <input type="text" class="form-control @error('seo_og_title') is-invalid @enderror" id="seo_og_title" name="seo_og_title" value="{{ old('seo_og_title', $settings['seo_og_title']) }}" placeholder="Title for social sharing">
                            @error('seo_og_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            @include('admin.media.partials.url-field', [
                                'name' => 'seo_og_image',
                                'currentValue' => $settings['seo_og_image'] ?? '',
                                'label' => 'OG Image',
                            ])
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_og_description">OG Description</label>
                            <textarea class="form-control @error('seo_og_description') is-invalid @enderror" id="seo_og_description" name="seo_og_description" rows="2" placeholder="Description for social sharing">{{ old('seo_og_description', $settings['seo_og_description']) }}</textarea>
                            @error('seo_og_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_twitter_card">Twitter Card Type</label>
                            <select class="form-select @error('seo_twitter_card') is-invalid @enderror" id="seo_twitter_card" name="seo_twitter_card">
                                @php $twitterCard = old('seo_twitter_card', $settings['seo_twitter_card'] ?? 'summary_large_image'); @endphp
                                <option value="summary" {{ $twitterCard === 'summary' ? 'selected' : '' }}>Summary</option>
                                <option value="summary_large_image" {{ $twitterCard === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                            </select>
                            @error('seo_twitter_card')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="seo_twitter_site">Twitter Site Handle</label>
                            <input type="text" class="form-control @error('seo_twitter_site') is-invalid @enderror" id="seo_twitter_site" name="seo_twitter_site" value="{{ old('seo_twitter_site', $settings['seo_twitter_site']) }}" placeholder="@sahajaarogyam">
                            @error('seo_twitter_site')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Search Console</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label" for="seo_google_site_verification">Google Site Verification</label>
                            <input type="text" class="form-control @error('seo_google_site_verification') is-invalid @enderror" id="seo_google_site_verification" name="seo_google_site_verification" value="{{ old('seo_google_site_verification', $settings['seo_google_site_verification']) }}" placeholder="Verification code from Google Search Console">
                            @error('seo_google_site_verification')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="form-text text-muted font-12">Paste only the <code>content</code> value from the meta tag.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
