@php
    $isEdit = isset($heroBanner);
    $secondaryType = old('secondary_type', $heroBanner->secondary_type ?? 'link');
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            <label class="form-label" for="title">Heading <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $heroBanner->title ?? '') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="eyebrow">Eyebrow</label>
            <input type="text" class="form-control @error('eyebrow') is-invalid @enderror" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $heroBanner->eyebrow ?? '') }}" placeholder="Welcome to Sahaj Aarogyam">
            @error('eyebrow')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="text">Description</label>
            <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="3">{{ old('text', $heroBanner->text ?? '') }}</textarea>
            @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            @include('admin.media.partials.url-field', [
                'name' => 'image',
                'currentValue' => $isEdit ? $heroBanner->image : '',
                'label' => 'Banner Image URL',
                'required' => ! $isEdit,
            ])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="primary_label">Primary Button Text</label>
            <input type="text" class="form-control @error('primary_label') is-invalid @enderror" id="primary_label" name="primary_label" value="{{ old('primary_label', $heroBanner->primary_label ?? 'Book Appointment') }}">
            @error('primary_label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        @include('admin.partials.page-link-field', [
            'name' => 'primary_url',
            'id' => 'primary_url',
            'label' => 'Primary Button Link',
            'currentValue' => $isEdit ? ($heroBanner->primary_url ?? '') : url('/contact-us'),
        ])
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="secondary_type">Secondary Action Type</label>
            <select class="form-select @error('secondary_type') is-invalid @enderror" id="secondary_type" name="secondary_type">
                <option value="">None</option>
                <option value="link" @selected($secondaryType === 'link')>Button Link</option>
                <option value="video" @selected($secondaryType === 'video')>Video Popup</option>
            </select>
            @error('secondary_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="secondary_label">Secondary Button Text</label>
            <input type="text" class="form-control @error('secondary_label') is-invalid @enderror" id="secondary_label" name="secondary_label" value="{{ old('secondary_label', $heroBanner->secondary_label ?? '') }}" placeholder="Watch Video">
            @error('secondary_label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        @include('admin.partials.page-link-field', [
            'name' => 'secondary_url',
            'id' => 'secondary_url',
            'label' => 'Secondary Button Link',
            'currentValue' => $isEdit ? ($heroBanner->secondary_url ?? '') : '',
        ])
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $heroBanner->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', $isEdit ? (int) $heroBanner->status : 1);
            @endphp
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="1" @selected($statusValue === '1')>Active</option>
                <option value="0" @selected($statusValue === '0')>Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
