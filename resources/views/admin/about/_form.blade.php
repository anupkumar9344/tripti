@php
    $activeTab = 'home';

    if ($errors->hasAny([
        'about_home_title', 'about_home_title_highlight', 'about_home_description',
        'about_home_image', 'about_home_badge_number',
    ])) {
        $activeTab = 'home';
    } elseif ($errors->hasAny([
        'about_page_title', 'about_page_title_highlight', 'about_page_description',
        'about_page_image', 'about_page_badge_number',
    ])) {
        $activeTab = 'page';
    } elseif ($errors->hasAny([
        'about_stat_1_count', 'about_stat_1_label',
        'about_stat_2_count', 'about_stat_2_label',
        'about_stat_3_count', 'about_stat_3_label',
        'about_stat_4_count', 'about_stat_4_label',
    ])) {
        $activeTab = 'stats';
    }
@endphp

<div class="card mb-0">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'home' ? 'active' : '' }}" id="about-home-tab" data-bs-toggle="tab" data-bs-target="#about-home" type="button" role="tab" aria-controls="about-home" aria-selected="{{ $activeTab === 'home' ? 'true' : 'false' }}">Home Page</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'page' ? 'active' : '' }}" id="about-page-tab" data-bs-toggle="tab" data-bs-target="#about-page" type="button" role="tab" aria-controls="about-page" aria-selected="{{ $activeTab === 'page' ? 'true' : 'false' }}">About Page</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'stats' ? 'active' : '' }}" id="about-stats-tab" data-bs-toggle="tab" data-bs-target="#about-stats" type="button" role="tab" aria-controls="about-stats" aria-selected="{{ $activeTab === 'stats' ? 'true' : 'false' }}">Stats</button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade {{ $activeTab === 'home' ? 'show active' : '' }}" id="about-home" role="tabpanel" aria-labelledby="about-home-tab">
                @include('admin.about._section-fields', [
                    'prefix' => 'about_home',
                    'settings' => $settings,
                    'useEditor' => false,
                ])
            </div>

            <div class="tab-pane fade {{ $activeTab === 'page' ? 'show active' : '' }}" id="about-page" role="tabpanel" aria-labelledby="about-page-tab">
                @include('admin.about._section-fields', [
                    'prefix' => 'about_page',
                    'settings' => $settings,
                    'useEditor' => true,
                ])
            </div>

            <div class="tab-pane fade {{ $activeTab === 'stats' ? 'show active' : '' }}" id="about-stats" role="tabpanel" aria-labelledby="about-stats-tab">
                <div class="card border shadow-none mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">About Page Stats</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted font-13 mb-3">Manage the four counter boxes on the About Us page.</p>

                        @foreach ([1, 2, 3, 4] as $index)
                            <div class="row {{ $loop->last ? 'mb-0' : 'mb-3' }}">
                                <div class="col-lg-3">
                                    <div class="form-group {{ $loop->last ? 'mb-0' : 'mb-3 mb-lg-0' }}">
                                        <label class="form-label" for="about_stat_{{ $index }}_count">Stat {{ $index }} Count</label>
                                        <input type="text" class="form-control @error('about_stat_'.$index.'_count') is-invalid @enderror" id="about_stat_{{ $index }}_count" name="about_stat_{{ $index }}_count" value="{{ old('about_stat_'.$index.'_count', $settings['about_stat_'.$index.'_count']) }}">
                                        @error('about_stat_'.$index.'_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group mb-0">
                                        <label class="form-label" for="about_stat_{{ $index }}_label">Label</label>
                                        <input type="text" class="form-control @error('about_stat_'.$index.'_label') is-invalid @enderror" id="about_stat_{{ $index }}_label" name="about_stat_{{ $index }}_label" value="{{ old('about_stat_'.$index.'_label', $settings['about_stat_'.$index.'_label']) }}">
                                        @error('about_stat_'.$index.'_label')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
