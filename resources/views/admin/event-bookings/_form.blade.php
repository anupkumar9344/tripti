@php
    $bookingModel = $booking ?? $eventBooking ?? null;
@endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label" for="booking_type">Booking Type <span class="text-danger">*</span></label>
        @php $typeValue = old('booking_type', $bookingModel->booking_type ?? \App\Models\EventBooking::TYPE_BANQUET); @endphp
        <select class="form-select @error('booking_type') is-invalid @enderror" id="booking_type" name="booking_type" required>
            @foreach (\App\Models\EventBooking::types() as $type)
                <option value="{{ $type }}" @selected($typeValue === $type)>{{ $type === 'meeting' ? 'Meeting' : 'Banquet' }}</option>
            @endforeach
        </select>
        @error('booking_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="contact_name">Contact Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name', $bookingModel->contact_name ?? '') }}" required>
        @error('contact_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $bookingModel->phone ?? '') }}" required>
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $bookingModel->email ?? '') }}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="company_name">Company / Organization</label>
        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $bookingModel->company_name ?? '') }}">
        @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="number_of_people">Number of People <span class="text-danger">*</span></label>
        <input type="number" min="1" class="form-control @error('number_of_people') is-invalid @enderror" id="number_of_people" name="number_of_people" value="{{ old('number_of_people', $bookingModel->number_of_people ?? '') }}" required>
        @error('number_of_people')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="program_name">Program / Event Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('program_name') is-invalid @enderror" id="program_name" name="program_name" value="{{ old('program_name', $bookingModel->program_name ?? '') }}" required>
        @error('program_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="event_date">Event Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date', optional($bookingModel->event_date ?? null)->format('Y-m-d')) }}" required>
        @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="event_time">Event Time</label>
        <input type="time" class="form-control @error('event_time') is-invalid @enderror" id="event_time" name="event_time" value="{{ old('event_time', $bookingModel->event_time ?? '') }}">
        @error('event_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="source">Source <span class="text-danger">*</span></label>
        @php $sourceValue = old('source', $bookingModel->source ?? \App\Models\EventBooking::SOURCE_MANUAL); @endphp
        <select class="form-select @error('source') is-invalid @enderror" id="source" name="source" required>
            @foreach (\App\Models\EventBooking::sources() as $source)
                <option value="{{ $source }}" @selected($sourceValue === $source)>{{ (new \App\Models\EventBooking(['source' => $source]))->sourceLabel() }}</option>
            @endforeach
        </select>
        @error('source')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
        @php $statusValue = old('status', $bookingModel->status ?? \App\Models\EventBooking::STATUS_NEW); @endphp
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
            @foreach (\App\Models\EventBooking::statuses() as $statusOption)
                <option value="{{ $statusOption }}" @selected($statusValue === $statusOption)>{{ (new \App\Models\EventBooking(['status' => $statusOption]))->statusLabel() }}</option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="purpose">Purpose <span class="text-danger">*</span></label>
        <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3" required>{{ old('purpose', $bookingModel->purpose ?? '') }}</textarea>
        @error('purpose')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="additional_notes">Additional Notes</label>
        <textarea class="form-control @error('additional_notes') is-invalid @enderror" id="additional_notes" name="additional_notes" rows="3">{{ old('additional_notes', $bookingModel->additional_notes ?? '') }}</textarea>
        @error('additional_notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <hr class="my-1">
        <p class="text-muted font-13 mb-2">Payment details are set by admin after quoting the event.</p>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="booking_amount">Booking Amount (₹)</label>
        <input type="number" step="0.01" min="0" class="form-control @error('booking_amount') is-invalid @enderror" id="booking_amount" name="booking_amount" value="{{ old('booking_amount', $bookingModel->booking_amount ?? '') }}" placeholder="Total quoted amount">
        @error('booking_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="advance_amount">Advance Received (₹)</label>
        <input type="number" step="0.01" min="0" class="form-control @error('advance_amount') is-invalid @enderror" id="advance_amount" name="advance_amount" value="{{ old('advance_amount', $bookingModel->advance_amount ?? '') }}" placeholder="Advance payment">
        @error('advance_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="advance_paid_at">Advance Paid On</label>
        <input type="date" class="form-control @error('advance_paid_at') is-invalid @enderror" id="advance_paid_at" name="advance_paid_at" value="{{ old('advance_paid_at', optional($bookingModel->advance_paid_at ?? null)->format('Y-m-d')) }}">
        @error('advance_paid_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="admin_notes">Admin Notes</label>
        <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes', $bookingModel->admin_notes ?? '') }}</textarea>
        @error('admin_notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
