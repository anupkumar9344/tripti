<div class="row g-3 align-items-start">
    <div class="col-lg-5">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Social Links</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="facebook_url">Facebook</label>
                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}" placeholder="https://facebook.com/...">
                    @error('facebook_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="instagram_url">Instagram</label>
                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}" placeholder="https://instagram.com/...">
                    @error('instagram_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="youtube_url">YouTube</label>
                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}" placeholder="https://youtube.com/...">
                    @error('youtube_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Google Map</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <label class="form-label" for="google_map_embed">Embed URL</label>
                    <textarea class="form-control @error('google_map_embed') is-invalid @enderror" id="google_map_embed" name="google_map_embed" rows="5" placeholder="Paste the Google Maps iframe src URL">{{ old('google_map_embed', $settings['google_map_embed']) }}</textarea>
                    @error('google_map_embed')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Use the iframe <code>src</code> value from Google Maps → Share → Embed a map.</span>
                </div>
            </div>
        </div>
    </div>
</div>
