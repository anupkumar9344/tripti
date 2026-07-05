@php
    $isEdit = isset($inquiry);
    $inquiryModel = $inquiry ?? $hotelInquiry ?? null;
    $selectedType = old('inquiry_type', $inquiryModel->inquiry_type ?? \App\Models\HotelInquiry::TYPE_ROOM);
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="inquiry_type">Inquiry Type <span class="text-danger">*</span></label>
            <select class="form-select @error('inquiry_type') is-invalid @enderror" id="inquiry_type" name="inquiry_type" required>
                @foreach (\App\Models\HotelInquiry::types() as $type)
                    <option value="{{ $type }}" @selected($selectedType === $type)>
                        {{ match ($type) {
                            'room' => 'Room',
                            'event' => 'Event',
                            'banquet' => 'Banquet',
                            'general' => 'General',
                            default => 'Other',
                        } }}
                    </option>
                @endforeach
            </select>
            @error('inquiry_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="source">Source <span class="text-danger">*</span></label>
            @php $sourceValue = old('source', $inquiryModel->source ?? \App\Models\HotelInquiry::SOURCE_MANUAL); @endphp
            <select class="form-select @error('source') is-invalid @enderror" id="source" name="source" required>
                @foreach (\App\Models\HotelInquiry::sources() as $source)
                    <option value="{{ $source }}" @selected($sourceValue === $source)>
                        {{ match ($source) {
                            'phone' => 'Phone',
                            'email' => 'Email',
                            'walk_in' => 'Walk-in',
                            'website' => 'Website',
                            default => 'Manual',
                        } }}
                    </option>
                @endforeach
            </select>
            @error('source')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="guest_name">Guest Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('guest_name') is-invalid @enderror" id="guest_name" name="guest_name" value="{{ old('guest_name', $inquiryModel->guest_name ?? '') }}" required>
            @error('guest_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="guest_phone">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('guest_phone') is-invalid @enderror" id="guest_phone" name="guest_phone" value="{{ old('guest_phone', $inquiryModel->guest_phone ?? '') }}" required>
            @error('guest_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="form-label" for="guest_email">Email</label>
            <input type="email" class="form-control @error('guest_email') is-invalid @enderror" id="guest_email" name="guest_email" value="{{ old('guest_email', $inquiryModel->guest_email ?? '') }}">
            @error('guest_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="subject">Subject</label>
    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $inquiryModel->subject ?? '') }}" placeholder="Room booking, wedding event, etc.">
    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div id="inquiry-room-fields" class="border rounded p-3 mb-3 bg-light">
    <p class="text-muted font-13 mb-3">Room inquiry details</p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3 mb-md-0">
                <label class="form-label" for="room_type_id">Room Type</label>
                @php $roomTypeId = old('room_type_id', $inquiryModel->room_type_id ?? ''); @endphp
                <select class="form-select @error('room_type_id') is-invalid @enderror" id="room_type_id" name="room_type_id">
                    <option value="">— Any / Not specified —</option>
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->id }}" @selected((string) $roomTypeId === (string) $roomType->id)>{{ $roomType->name }}</option>
                    @endforeach
                </select>
                @error('room_type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3 mb-md-0">
                <label class="form-label" for="check_in_date">Check-in</label>
                <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" id="check_in_date" name="check_in_date" value="{{ old('check_in_date', optional($inquiryModel?->check_in_date)->format('Y-m-d')) }}">
                @error('check_in_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-0">
                <label class="form-label" for="check_out_date">Check-out</label>
                <input type="date" class="form-control @error('check_out_date') is-invalid @enderror" id="check_out_date" name="check_out_date" value="{{ old('check_out_date', optional($inquiryModel?->check_out_date)->format('Y-m-d')) }}">
                @error('check_out_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="form-group mb-0">
                <label class="form-label" for="adults">Adults</label>
                <input type="number" min="1" max="20" class="form-control @error('adults') is-invalid @enderror" id="adults" name="adults" value="{{ old('adults', $inquiryModel->adults ?? '') }}">
                @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-0">
                <label class="form-label" for="children">Children</label>
                <input type="number" min="0" max="20" class="form-control @error('children') is-invalid @enderror" id="children" name="children" value="{{ old('children', $inquiryModel->children ?? 0) }}">
                @error('children')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="message">Message <span class="text-danger">*</span></label>
    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required placeholder="Describe the guest request or inquiry details.">{{ old('message', $inquiryModel->message ?? '') }}</textarea>
    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            @php $statusValue = old('status', $inquiryModel->status ?? \App\Models\HotelInquiry::STATUS_NEW); @endphp
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                @foreach (\App\Models\HotelInquiry::statuses() as $statusOption)
                    <option value="{{ $statusOption }}" @selected($statusValue === $statusOption)>
                        {{ match ($statusOption) {
                            'new' => 'New',
                            'in_progress' => 'In Progress',
                            'quoted' => 'Quoted',
                            'closed' => 'Closed',
                            'cancelled' => 'Cancelled',
                            default => ucfirst($statusOption),
                        } }}
                    </option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group mb-0">
    <label class="form-label" for="admin_notes">Admin Notes</label>
    <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="3" placeholder="Internal follow-up notes, quote details, etc.">{{ old('admin_notes', $inquiryModel->admin_notes ?? '') }}</textarea>
    @error('admin_notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('inquiry_type');
            const roomFields = document.getElementById('inquiry-room-fields');

            function toggleRoomFields() {
                if (!typeSelect || !roomFields) {
                    return;
                }

                roomFields.style.display = typeSelect.value === 'room' ? '' : 'none';
            }

            typeSelect?.addEventListener('change', toggleRoomFields);
            toggleRoomFields();
        });
    </script>
@endpush
