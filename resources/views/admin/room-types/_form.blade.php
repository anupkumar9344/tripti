<div class="form-group mb-3">
    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $roomType->name ?? '') }}" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="fare">Fare (₹) <span class="text-danger">*</span></label>
            <input type="number" min="0" step="0.01" class="form-control @error('fare') is-invalid @enderror" id="fare" name="fare" value="{{ old('fare', $roomType->fare ?? 0) }}" required>
            @error('fare')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="max_adults">Max Adults <span class="text-danger">*</span></label>
            <input type="number" min="1" max="20" class="form-control @error('max_adults') is-invalid @enderror" id="max_adults" name="max_adults" value="{{ old('max_adults', $roomType->max_adults ?? 2) }}" required>
            @error('max_adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="max_children">Max Children <span class="text-danger">*</span></label>
            <input type="number" min="0" max="20" class="form-control @error('max_children') is-invalid @enderror" id="max_children" name="max_children" value="{{ old('max_children', $roomType->max_children ?? 0) }}" required>
            @error('max_children')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="category">Room / Suite <span class="text-danger">*</span></label>
            @php $categoryValue = old('category', $roomType->category ?? 'room'); @endphp
            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                <option value="room" @selected($categoryValue === 'room')>Room</option>
                <option value="suite" @selected($categoryValue === 'suite')>Suite</option>
            </select>
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="is_featured">Featured <span class="text-danger">*</span></label>
            @php $featuredValue = (string) old('is_featured', isset($roomType) ? (int) $roomType->is_featured : 0); @endphp
            <select class="form-select @error('is_featured') is-invalid @enderror" id="is_featured" name="is_featured" required>
                <option value="1" @selected($featuredValue === '1')>Featured</option>
                <option value="0" @selected($featuredValue === '0')>Unfeatured</option>
            </select>
            @error('is_featured')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $roomType->sort_order ?? 0) }}">
            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group mb-0">
    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
    @php $statusValue = (string) old('status', isset($roomType) ? (int) $roomType->status : 1); @endphp
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
        <option value="1" @selected($statusValue === '1')>Enabled</option>
        <option value="0" @selected($statusValue === '0')>Disabled</option>
    </select>
    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
