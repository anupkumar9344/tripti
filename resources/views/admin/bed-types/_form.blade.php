<div class="form-group mb-3">
    <label class="form-label" for="name">Bed Type <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $bedType->name ?? '') }}" required placeholder="Queen">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-0">
    <label class="form-label" for="sort_order">Display Order</label>
    <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $bedType->sort_order ?? 0) }}">
    @error('sort_order')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
