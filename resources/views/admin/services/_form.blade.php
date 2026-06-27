@php
    $isEdit = isset($service);
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" placeholder="Enter service title" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $service->slug ?? '') }}" placeholder="Auto-generated if empty">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Used for the service page URL.</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" placeholder="0">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Lower numbers appear first on the website.</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', $isEdit ? (int) $service->status : 1);
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

    <div class="col-md-4">
        <div class="form-group mb-3">
            @include('admin.media.partials.url-field', [
                'name' => 'thumbnail',
                'currentValue' => $isEdit ? $service->thumbnail : '',
                'label' => 'Thumbnail Image URL',
                'required' => ! $isEdit,
            ])
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="short_description">Short Description</label>
            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief summary shown in listings">{{ old('short_description', $service->short_description ?? '') }}</textarea>
            @error('short_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="long_description">Long Description</label>
            <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description" rows="8">{{ old('long_description', $service->long_description ?? '') }}</textarea>
            @error('long_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        @include('admin.media.partials.gallery-url-field', [
            'existingImages' => $isEdit ? $service->images : collect(),
        ])
    </div>
</div>
