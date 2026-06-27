<div class="form-group mb-3">
    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $whyChooseItem->title ?? '') }}" required placeholder="Root-Cause Diagnosis">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="form-label" for="icon">Icon Class</label>
    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $whyChooseItem->icon ?? '') }}" placeholder="fa-shield-halved">
    @error('icon')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <span class="form-text text-muted font-12">Font Awesome class without the <code>fa-solid</code> prefix, e.g. <code>fa-shield-halved</code>.</span>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="short_description">Short Description</label>
    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief text shown under the title on the home page.">{{ old('short_description', $whyChooseItem->short_description ?? '') }}</textarea>
    @error('short_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $whyChooseItem->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', isset($whyChooseItem) ? (int) $whyChooseItem->status : 1);
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
