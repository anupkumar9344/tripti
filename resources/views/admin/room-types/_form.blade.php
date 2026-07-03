@php
    $isEdit = isset($roomType);
@endphp

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Room Details</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $roomType->name ?? '') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief description shown on the home page room cards.">{{ old('short_description', $roomType->short_description ?? '') }}</textarea>
                    @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        <div class="form-group mb-0">
                            <label class="form-label" for="max_children">Max Children <span class="text-danger">*</span></label>
                            <input type="number" min="0" max="20" class="form-control @error('max_children') is-invalid @enderror" id="max_children" name="max_children" value="{{ old('max_children', $roomType->max_children ?? 0) }}" required>
                            @error('max_children')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
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
                        'currentValue' => $isEdit ? ($roomType->image ?? '') : '',
                        'label' => 'Room Image',
                        'required' => ! $isEdit,
                    ])
                    <span class="form-text text-muted font-12">Shown on the home page and room listings.</span>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="category">Room / Suite <span class="text-danger">*</span></label>
                    @php $categoryValue = old('category', $roomType->category ?? 'room'); @endphp
                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                        <option value="room" @selected($categoryValue === 'room')>Room</option>
                        <option value="suite" @selected($categoryValue === 'suite')>Suite</option>
                    </select>
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="is_featured">Featured on Home <span class="text-danger">*</span></label>
                    @php $featuredValue = (string) old('is_featured', $isEdit ? (int) $roomType->is_featured : 0); @endphp
                    <select class="form-select @error('is_featured') is-invalid @enderror" id="is_featured" name="is_featured" required>
                        <option value="1" @selected($featuredValue === '1')>Yes — show on home page</option>
                        <option value="0" @selected($featuredValue === '0')>No</option>
                    </select>
                    @error('is_featured')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="sort_order">Display Order</label>
                            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $roomType->sort_order ?? 0) }}">
                            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            @php $statusValue = (string) old('status', $isEdit ? (int) $roomType->status : 1); @endphp
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" @selected($statusValue === '1')>Enabled</option>
                                <option value="0" @selected($statusValue === '0')>Disabled</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
