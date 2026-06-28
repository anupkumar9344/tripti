@php
    $prefix = $prefix ?? 'about_home';
    $useEditor = $useEditor ?? false;
    $descriptionField = $prefix.'_description';
@endphp

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Section Content</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="{{ $prefix }}_title">Heading</label>
                    <input type="text" class="form-control @error($prefix.'_title') is-invalid @enderror" id="{{ $prefix }}_title" name="{{ $prefix }}_title" value="{{ old($prefix.'_title', $settings[$prefix.'_title']) }}" placeholder="A holistic path to">
                    @error($prefix.'_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="{{ $prefix }}_title_highlight">Heading Highlight</label>
                    <input type="text" class="form-control @error($prefix.'_title_highlight') is-invalid @enderror" id="{{ $prefix }}_title_highlight" name="{{ $prefix }}_title_highlight" value="{{ old($prefix.'_title_highlight', $settings[$prefix.'_title_highlight']) }}" placeholder="natural healing">
                    @error($prefix.'_title_highlight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="{{ $descriptionField }}">Description</label>
                    <textarea class="form-control @error($descriptionField) is-invalid @enderror" id="{{ $descriptionField }}" name="{{ $descriptionField }}" rows="{{ $useEditor ? 10 : 3 }}">{{ old($descriptionField, $settings[$descriptionField]) }}</textarea>
                    @error($descriptionField)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Image &amp; Badge</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="{{ $prefix }}_badge_number">Badge Number</label>
                    <input type="text" class="form-control @error($prefix.'_badge_number') is-invalid @enderror" id="{{ $prefix }}_badge_number" name="{{ $prefix }}_badge_number" value="{{ old($prefix.'_badge_number', $settings[$prefix.'_badge_number']) }}" placeholder="25">
                    @error($prefix.'_badge_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="form-text text-muted font-12">Shown as 25+ Years of Trusted Care on the website.</span>
                </div>

                <div class="form-group mb-0">
                    @include('admin.media.partials.url-field', [
                        'name' => $prefix.'_image',
                        'currentValue' => $settings[$prefix.'_image'] ?? '',
                        'label' => 'Section Image',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
