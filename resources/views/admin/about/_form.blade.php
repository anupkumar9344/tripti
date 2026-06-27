@php
    $activeTab = 'home';

    if ($errors->hasAny([
        'about_page_eyebrow', 'about_page_title', 'about_page_title_highlight', 'about_page_description',
        'about_page_image', 'about_page_badge_number', 'about_page_badge_suffix', 'about_page_badge_text',
        'about_page_button_text',
    ])) {
        $activeTab = 'page';
    } elseif ($errors->hasAny([
        'about_stat_1_count', 'about_stat_1_suffix', 'about_stat_1_label',
        'about_stat_2_count', 'about_stat_2_suffix', 'about_stat_2_label',
        'about_stat_3_count', 'about_stat_3_suffix', 'about_stat_3_label',
        'about_stat_4_count', 'about_stat_4_suffix', 'about_stat_4_label',
    ])) {
        $activeTab = 'stats';
    }
@endphp

<div class="card mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'home' ? 'active' : '' }}" id="about-home-tab" data-bs-toggle="tab" data-bs-target="#about-home" type="button" role="tab" aria-controls="about-home" aria-selected="{{ $activeTab === 'home' ? 'true' : 'false' }}">Home Page</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'page' ? 'active' : '' }}" id="about-page-tab" data-bs-toggle="tab" data-bs-target="#about-page" type="button" role="tab" aria-controls="about-page" aria-selected="{{ $activeTab === 'page' ? 'true' : 'false' }}">About Page</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'stats' ? 'active' : '' }}" id="about-stats-tab" data-bs-toggle="tab" data-bs-target="#about-stats" type="button" role="tab" aria-controls="about-stats" aria-selected="{{ $activeTab === 'stats' ? 'true' : 'false' }}">Stats Counts</button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade {{ $activeTab === 'home' ? 'show active' : '' }}" id="about-home" role="tabpanel" aria-labelledby="about-home-tab">
                <h5 class="mb-3">About Section on Home Page</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_eyebrow">Eyebrow Text</label>
                            <input type="text" class="form-control @error('about_home_eyebrow') is-invalid @enderror" id="about_home_eyebrow" name="about_home_eyebrow" value="{{ old('about_home_eyebrow', $settings['about_home_eyebrow']) }}" placeholder="About us">
                            @error('about_home_eyebrow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_button_text">Button Text</label>
                            <input type="text" class="form-control @error('about_home_button_text') is-invalid @enderror" id="about_home_button_text" name="about_home_button_text" value="{{ old('about_home_button_text', $settings['about_home_button_text']) }}" placeholder="Learn More About Us">
                            @error('about_home_button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_title">Heading (before highlight)</label>
                            <input type="text" class="form-control @error('about_home_title') is-invalid @enderror" id="about_home_title" name="about_home_title" value="{{ old('about_home_title', $settings['about_home_title']) }}" placeholder="A holistic path to">
                            @error('about_home_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_title_highlight">Heading Highlight</label>
                            <input type="text" class="form-control @error('about_home_title_highlight') is-invalid @enderror" id="about_home_title_highlight" name="about_home_title_highlight" value="{{ old('about_home_title_highlight', $settings['about_home_title_highlight']) }}" placeholder="natural healing">
                            @error('about_home_title_highlight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_description">Description</label>
                            <textarea class="form-control @error('about_home_description') is-invalid @enderror" id="about_home_description" name="about_home_description" rows="4">{{ old('about_home_description', $settings['about_home_description']) }}</textarea>
                            @error('about_home_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_badge_number">Badge Number</label>
                            <input type="text" class="form-control @error('about_home_badge_number') is-invalid @enderror" id="about_home_badge_number" name="about_home_badge_number" value="{{ old('about_home_badge_number', $settings['about_home_badge_number']) }}" placeholder="25">
                            @error('about_home_badge_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_badge_suffix">Suffix</label>
                            <input type="text" class="form-control @error('about_home_badge_suffix') is-invalid @enderror" id="about_home_badge_suffix" name="about_home_badge_suffix" value="{{ old('about_home_badge_suffix', $settings['about_home_badge_suffix']) }}" placeholder="+">
                            @error('about_home_badge_suffix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_home_badge_text">Badge Text</label>
                            <input type="text" class="form-control @error('about_home_badge_text') is-invalid @enderror" id="about_home_badge_text" name="about_home_badge_text" value="{{ old('about_home_badge_text', $settings['about_home_badge_text']) }}" placeholder="Years of Trusted Care">
                            @error('about_home_badge_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            @include('admin.media.partials.url-field', [
                                'name' => 'about_home_image',
                                'currentValue' => $settings['about_home_image'] ?? '',
                                'label' => 'Section Image',
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{ $activeTab === 'page' ? 'show active' : '' }}" id="about-page" role="tabpanel" aria-labelledby="about-page-tab">
                <h5 class="mb-3">About Page Intro Section</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_eyebrow">Eyebrow Text</label>
                            <input type="text" class="form-control @error('about_page_eyebrow') is-invalid @enderror" id="about_page_eyebrow" name="about_page_eyebrow" value="{{ old('about_page_eyebrow', $settings['about_page_eyebrow']) }}" placeholder="About us">
                            @error('about_page_eyebrow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_button_text">Button Text</label>
                            <input type="text" class="form-control @error('about_page_button_text') is-invalid @enderror" id="about_page_button_text" name="about_page_button_text" value="{{ old('about_page_button_text', $settings['about_page_button_text']) }}" placeholder="Meet Our Experts">
                            @error('about_page_button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_title">Heading (before highlight)</label>
                            <input type="text" class="form-control @error('about_page_title') is-invalid @enderror" id="about_page_title" name="about_page_title" value="{{ old('about_page_title', $settings['about_page_title']) }}" placeholder="A holistic path to">
                            @error('about_page_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_title_highlight">Heading Highlight</label>
                            <input type="text" class="form-control @error('about_page_title_highlight') is-invalid @enderror" id="about_page_title_highlight" name="about_page_title_highlight" value="{{ old('about_page_title_highlight', $settings['about_page_title_highlight']) }}" placeholder="natural healing">
                            @error('about_page_title_highlight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_description">Description</label>
                            <textarea class="form-control @error('about_page_description') is-invalid @enderror" id="about_page_description" name="about_page_description" rows="8">{{ old('about_page_description', $settings['about_page_description']) }}</textarea>
                            @error('about_page_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_badge_number">Badge Number</label>
                            <input type="text" class="form-control @error('about_page_badge_number') is-invalid @enderror" id="about_page_badge_number" name="about_page_badge_number" value="{{ old('about_page_badge_number', $settings['about_page_badge_number']) }}" placeholder="25">
                            @error('about_page_badge_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_badge_suffix">Suffix</label>
                            <input type="text" class="form-control @error('about_page_badge_suffix') is-invalid @enderror" id="about_page_badge_suffix" name="about_page_badge_suffix" value="{{ old('about_page_badge_suffix', $settings['about_page_badge_suffix']) }}" placeholder="+">
                            @error('about_page_badge_suffix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="about_page_badge_text">Badge Text</label>
                            <input type="text" class="form-control @error('about_page_badge_text') is-invalid @enderror" id="about_page_badge_text" name="about_page_badge_text" value="{{ old('about_page_badge_text', $settings['about_page_badge_text']) }}" placeholder="Years of Trusted Care">
                            @error('about_page_badge_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            @include('admin.media.partials.url-field', [
                                'name' => 'about_page_image',
                                'currentValue' => $settings['about_page_image'] ?? '',
                                'label' => 'Section Image',
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{ $activeTab === 'stats' ? 'show active' : '' }}" id="about-stats" role="tabpanel" aria-labelledby="about-stats-tab">
                <h5 class="mb-3">About Page Stats</h5>
                <p class="text-muted font-13 mb-4">Manage the four counter boxes shown on the About Us page.</p>

                @foreach ([1, 2, 3, 4] as $index)
                    <div class="border rounded p-3 mb-3">
                        <h6 class="mb-3">Stat {{ $index }}</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3 mb-md-0">
                                    <label class="form-label" for="about_stat_{{ $index }}_count">Count</label>
                                    <input type="text" class="form-control @error('about_stat_'.$index.'_count') is-invalid @enderror" id="about_stat_{{ $index }}_count" name="about_stat_{{ $index }}_count" value="{{ old('about_stat_'.$index.'_count', $settings['about_stat_'.$index.'_count']) }}">
                                    @error('about_stat_'.$index.'_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3 mb-md-0">
                                    <label class="form-label" for="about_stat_{{ $index }}_suffix">Suffix</label>
                                    <input type="text" class="form-control @error('about_stat_'.$index.'_suffix') is-invalid @enderror" id="about_stat_{{ $index }}_suffix" name="about_stat_{{ $index }}_suffix" value="{{ old('about_stat_'.$index.'_suffix', $settings['about_stat_'.$index.'_suffix']) }}" placeholder="+">
                                    @error('about_stat_'.$index.'_suffix')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group mb-0">
                                    <label class="form-label" for="about_stat_{{ $index }}_label">Label</label>
                                    <input type="text" class="form-control @error('about_stat_'.$index.'_label') is-invalid @enderror" id="about_stat_{{ $index }}_label" name="about_stat_{{ $index }}_label" value="{{ old('about_stat_'.$index.'_label', $settings['about_stat_'.$index.'_label']) }}">
                                    @error('about_stat_'.$index.'_label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
