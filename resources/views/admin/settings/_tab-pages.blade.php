<div class="row g-3 align-items-start">
    <div class="col-lg-4">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Team Page</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="team_page_eyebrow">Eyebrow</label>
                    <input type="text" class="form-control @error('team_page_eyebrow') is-invalid @enderror" id="team_page_eyebrow" name="team_page_eyebrow" value="{{ old('team_page_eyebrow', $settings['team_page_eyebrow']) }}" placeholder="Our Leadership">
                    @error('team_page_eyebrow')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="team_page_title">Title</label>
                    <input type="text" class="form-control @error('team_page_title') is-invalid @enderror" id="team_page_title" name="team_page_title" value="{{ old('team_page_title', $settings['team_page_title']) }}" placeholder="Meet Our Expert Team">
                    @error('team_page_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="team_page_intro">Introduction</label>
                    <textarea class="form-control @error('team_page_intro') is-invalid @enderror" id="team_page_intro" name="team_page_intro" rows="3">{{ old('team_page_intro', $settings['team_page_intro']) }}</textarea>
                    @error('team_page_intro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Homepage Visit Us</h4>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label" for="visit_us_eyebrow">Eyebrow</label>
                            <input type="text" class="form-control @error('visit_us_eyebrow') is-invalid @enderror" id="visit_us_eyebrow" name="visit_us_eyebrow" value="{{ old('visit_us_eyebrow', $settings['visit_us_eyebrow']) }}" placeholder="Visit Us">
                            @error('visit_us_eyebrow')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="form-label" for="visit_us_title">Title</label>
                            <input type="text" class="form-control @error('visit_us_title') is-invalid @enderror" id="visit_us_title" name="visit_us_title" value="{{ old('visit_us_title', $settings['visit_us_title']) }}" placeholder="Welcome to Tripti Hotel">
                            @error('visit_us_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="visit_us_description">Description</label>
                    <textarea class="form-control @error('visit_us_description') is-invalid @enderror" id="visit_us_description" name="visit_us_description" rows="3">{{ old('visit_us_description', $settings['visit_us_description']) }}</textarea>
                    @error('visit_us_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    @include('admin.media.partials.url-field', [
                        'name' => 'visit_us_bg_image',
                        'currentValue' => $settings['visit_us_bg_image'] ?? '',
                        'label' => 'Background Image',
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border shadow-none mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Contact Page</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="contact_locations_title">Locations Title</label>
                    <input type="text" class="form-control @error('contact_locations_title') is-invalid @enderror" id="contact_locations_title" name="contact_locations_title" value="{{ old('contact_locations_title', $settings['contact_locations_title']) }}" placeholder="Our Locations">
                    @error('contact_locations_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="contact_form_title">Form Title</label>
                    <input type="text" class="form-control @error('contact_form_title') is-invalid @enderror" id="contact_form_title" name="contact_form_title" value="{{ old('contact_form_title', $settings['contact_form_title']) }}" placeholder="Send Us a Message">
                    @error('contact_form_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="contact_locations_description">Locations Description</label>
                    <textarea class="form-control @error('contact_locations_description') is-invalid @enderror" id="contact_locations_description" name="contact_locations_description" rows="2">{{ old('contact_locations_description', $settings['contact_locations_description']) }}</textarea>
                    @error('contact_locations_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="contact_form_description">Form Description</label>
                    <textarea class="form-control @error('contact_form_description') is-invalid @enderror" id="contact_form_description" name="contact_form_description" rows="2">{{ old('contact_form_description', $settings['contact_form_description']) }}</textarea>
                    @error('contact_form_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
