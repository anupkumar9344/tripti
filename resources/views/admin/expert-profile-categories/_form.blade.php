<div class="form-group mb-3">
    <label class="form-label" for="title">Category Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $expertProfileCategory->title ?? '') }}" required placeholder="Role in Integrated Healthcare System">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="form-label" for="icon">Icon Class @include('admin.partials.icon-reference-link')</label>
    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $expertProfileCategory->icon ?? '') }}" placeholder="fa-hospital">
    @error('icon')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <span class="form-text text-muted font-12">Font Awesome class without the <code>fa-solid</code> prefix, e.g. <code>fa-hospital</code>.</span>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $expertProfileCategory->sort_order ?? 0) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-0">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php
                $statusValue = (string) old('status', isset($expertProfileCategory) ? (int) $expertProfileCategory->status : 1);
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
