@php
    $isEdit = isset($treatment);
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $treatment->title ?? '') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $treatment->slug ?? '') }}" placeholder="Auto-generated if empty">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Used for the treatment page URL.</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $treatment->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', $isEdit ? (int) $treatment->status : 1);
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
            <label class="form-label" for="display_on_home">Display on Home <span class="text-danger">*</span></label>
            @php
                $homeValue = (string) old('display_on_home', $isEdit ? (int) $treatment->display_on_home : 0);
            @endphp
            <select class="form-select @error('display_on_home') is-invalid @enderror" id="display_on_home" name="display_on_home" required>
                <option value="1" @selected($homeValue === '1')>Yes</option>
                <option value="0" @selected($homeValue === '0')>No</option>
            </select>
            @error('display_on_home')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Show in the home page &ldquo;What We Treat&rdquo; section.</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="icon">Icon Class</label>
            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $treatment->icon ?? '') }}" placeholder="fa-award">
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Font Awesome class without the <code>fa-solid</code> prefix. Shown on home page cards.</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            @include('admin.media.partials.url-field', [
                'name' => 'image',
                'currentValue' => $isEdit ? $treatment->image : '',
                'label' => 'Image URL',
                'required' => ! $isEdit,
            ])
            <span class="form-text text-muted font-12">Shown on the treatment detail page.</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label class="form-label" for="short_description">Short Description</label>
            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3">{{ old('short_description', $treatment->short_description ?? '') }}</textarea>
            @error('short_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="form-text text-muted font-12">Shown on treatment cards on the home and listing pages.</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-0">
            <label class="form-label" for="long_description">Long Description</label>
            <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description" rows="10">{{ old('long_description', $treatment->long_description ?? '') }}</textarea>
            @error('long_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
