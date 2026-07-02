<div class="row g-3 align-items-start">
    <div class="col-lg-8">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Basic Meta Tags</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="seo_meta_title">Default Meta Title</label>
                    <input type="text" class="form-control @error('seo_meta_title') is-invalid @enderror" id="seo_meta_title" name="seo_meta_title" value="{{ old('seo_meta_title', $settings['seo_meta_title']) }}" placeholder="Tripti Hotel | Luxury Stay & Hospitality">
                    @error('seo_meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Used when a page does not set its own title.</span>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="seo_meta_description">Meta Description</label>
                    <textarea class="form-control @error('seo_meta_description') is-invalid @enderror" id="seo_meta_description" name="seo_meta_description" rows="3" placeholder="Brief summary for search engines">{{ old('seo_meta_description', $settings['seo_meta_description']) }}</textarea>
                    @error('seo_meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control @error('seo_meta_keywords') is-invalid @enderror" id="seo_meta_keywords" name="seo_meta_keywords" value="{{ old('seo_meta_keywords', $settings['seo_meta_keywords']) }}" placeholder="Tripti Hotel, luxury hotel, rooms, booking">
                            @error('seo_meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="seo_meta_author">Meta Author</label>
                            <input type="text" class="form-control @error('seo_meta_author') is-invalid @enderror" id="seo_meta_author" name="seo_meta_author" value="{{ old('seo_meta_author', $settings['seo_meta_author']) }}" placeholder="Tripti Hotel">
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
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border shadow-none mb-3">
            <div class="card-header">
                <h4 class="card-title mb-0">Search Console</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <label class="form-label" for="seo_google_site_verification">Google Verification</label>
                    <input type="text" class="form-control @error('seo_google_site_verification') is-invalid @enderror" id="seo_google_site_verification" name="seo_google_site_verification" value="{{ old('seo_google_site_verification', $settings['seo_google_site_verification']) }}" placeholder="Verification code">
                    @error('seo_google_site_verification')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Paste only the <code>content</code> value from the meta tag.</span>
                </div>
            </div>
        </div>

        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Open Graph &amp; Twitter</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="seo_og_title">OG Title</label>
                    <input type="text" class="form-control @error('seo_og_title') is-invalid @enderror" id="seo_og_title" name="seo_og_title" value="{{ old('seo_og_title', $settings['seo_og_title']) }}" placeholder="Title for social sharing">
                    @error('seo_og_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    @include('admin.media.partials.url-field', [
                        'name' => 'seo_og_image',
                        'currentValue' => $settings['seo_og_image'] ?? '',
                        'label' => 'OG Image',
                    ])
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="seo_og_description">OG Description</label>
                    <textarea class="form-control @error('seo_og_description') is-invalid @enderror" id="seo_og_description" name="seo_og_description" rows="2" placeholder="Description for social sharing">{{ old('seo_og_description', $settings['seo_og_description']) }}</textarea>
                    @error('seo_og_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="seo_twitter_card">Twitter Card</label>
                    <select class="form-select @error('seo_twitter_card') is-invalid @enderror" id="seo_twitter_card" name="seo_twitter_card">
                        @php $twitterCard = old('seo_twitter_card', $settings['seo_twitter_card'] ?? 'summary_large_image'); @endphp
                        <option value="summary" {{ $twitterCard === 'summary' ? 'selected' : '' }}>Summary</option>
                        <option value="summary_large_image" {{ $twitterCard === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                    </select>
                    @error('seo_twitter_card')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="seo_twitter_site">Twitter Handle</label>
                    <input type="text" class="form-control @error('seo_twitter_site') is-invalid @enderror" id="seo_twitter_site" name="seo_twitter_site" value="{{ old('seo_twitter_site', $settings['seo_twitter_site']) }}" placeholder="@triptihotel">
                    @error('seo_twitter_site')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
