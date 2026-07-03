@php
    $isEdit = isset($facility);
@endphp

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Facility Details</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $facility->title ?? '') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="icon">Icon Class @include('admin.partials.icon-reference-link')</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $facility->icon ?? '') }}" placeholder="fa-utensils">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief description shown on the home page amenities section.">{{ old('short_description', $facility->short_description ?? '') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Image &amp; Display</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    @include('admin.media.partials.url-field', [
                        'name' => 'image',
                        'currentValue' => $isEdit ? ($facility->image ?? '') : '',
                        'label' => 'Facility Image',
                    ])
                    <span class="form-text text-muted font-12">Shown in the home page amenities showcase.</span>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="is_featured">Featured on Home <span class="text-danger">*</span></label>
                    @php $featuredValue = (string) old('is_featured', $isEdit ? (int) $facility->is_featured : 0); @endphp
                    <select class="form-select @error('is_featured') is-invalid @enderror" id="is_featured" name="is_featured" required>
                        <option value="1" @selected($featuredValue === '1')>Yes — show on home page</option>
                        <option value="0" @selected($featuredValue === '0')>No</option>
                    </select>
                    @error('is_featured')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="sort_order">Display Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $facility->sort_order ?? 0) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            @php $statusValue = (string) old('status', $isEdit ? (int) $facility->status : 1); @endphp
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" @selected($statusValue === '1')>Enabled</option>
                                <option value="0" @selected($statusValue === '0')>Disabled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
