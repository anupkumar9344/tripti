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
    } elseif ($errors->hasAny(['visit_us_eyebrow', 'visit_us_title', 'visit_us_description', 'visit_us_bg_image', 'team_page_eyebrow', 'team_page_title', 'team_page_intro', 'contact_locations_title', 'contact_locations_description', 'contact_form_title', 'contact_form_description'])) {
        $activeTab = 'pages';
    } elseif ($errors->hasAny(['facebook_url', 'instagram_url', 'youtube_url', 'google_map_embed'])) {
        $activeTab = 'social';
    } elseif ($errors->hasAny($seoKeys)) {
        $activeTab = 'seo';
    } elseif ($errors->hasAny(['website_name', 'footer_about', 'website_logo', 'website_favicon', 'admin_login_image'])) {
        $activeTab = 'general';
    }
@endphp

<div class="card mb-0">
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
                @include('admin.settings._tab-general')
            </div>

            <div class="tab-pane fade {{ $activeTab === 'contact' ? 'show active' : '' }}" id="settings-contact" role="tabpanel" aria-labelledby="settings-contact-tab">
                @include('admin.settings._tab-contact')
            </div>

            <div class="tab-pane fade {{ $activeTab === 'pages' ? 'show active' : '' }}" id="settings-pages" role="tabpanel" aria-labelledby="settings-pages-tab">
                @include('admin.settings._tab-pages')
            </div>

            <div class="tab-pane fade {{ $activeTab === 'social' ? 'show active' : '' }}" id="settings-social" role="tabpanel" aria-labelledby="settings-social-tab">
                @include('admin.settings._tab-social')
            </div>

            <div class="tab-pane fade {{ $activeTab === 'seo' ? 'show active' : '' }}" id="settings-seo" role="tabpanel" aria-labelledby="settings-seo-tab">
                @include('admin.settings._tab-seo')
            </div>
        </div>
    </div>
</div>
