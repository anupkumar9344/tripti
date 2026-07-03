<div class="form-group mb-3">
    <label class="form-label" for="room_number">Room Number <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('room_number') is-invalid @enderror" id="room_number" name="room_number" value="{{ old('room_number', $room->room_number ?? '') }}" required placeholder="101">
    @error('room_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="floor">Floor</label>
            <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor', $room->floor ?? '') }}" placeholder="1st Floor">
            @error('floor')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="bed_type_id">Bed Type</label>
            <select class="form-select @error('bed_type_id') is-invalid @enderror" id="bed_type_id" name="bed_type_id">
                <option value="">— Select —</option>
                @foreach ($bedTypes as $bedType)
                    <option value="{{ $bedType->id }}" @selected((string) old('bed_type_id', $room->bed_type_id ?? '') === (string) $bedType->id)>{{ $bedType->name }}</option>
                @endforeach
            </select>
            @error('bed_type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="sort_order">Display Order</label>
            <input type="number" min="0" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $room->sort_order ?? 0) }}">
            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group mb-0">
    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
    @php $statusValue = (string) old('status', isset($room) ? (int) $room->status : 1); @endphp
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
        <option value="1" @selected($statusValue === '1')>Enabled</option>
        <option value="0" @selected($statusValue === '0')>Disabled</option>
    </select>
    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
