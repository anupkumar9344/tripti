@extends('admin.layouts.app')

@section('title', 'Inquiry Details')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h4 class="page-title mb-0">Inquiry #{{ $inquiry->id }}</h4>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.hotel-inquiries.edit', $inquiry) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="las la-pen me-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.hotel-inquiries.index') }}" class="btn btn-light btn-sm">Back to list</a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Inquiry Details</h4>
                    <span class="badge {{ $inquiry->statusBadgeClass() }}">{{ $inquiry->statusLabel() }}</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Type</p>
                            <p class="fw-semibold mb-0">{{ $inquiry->typeLabel() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Source</p>
                            <p class="fw-semibold mb-0">{{ $inquiry->sourceLabel() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Subject</p>
                            <p class="fw-semibold mb-0">{{ $inquiry->subject ?: '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Received</p>
                            <p class="fw-semibold mb-0">{{ $inquiry->created_at?->format('d M Y, h:i A') }}</p>
                        </div>
                        @if ($inquiry->inquiry_type === \App\Models\HotelInquiry::TYPE_ROOM)
                            <div class="col-md-6">
                                <p class="text-muted mb-1 font-13">Room Type</p>
                                <p class="fw-semibold mb-0">{{ $inquiry->roomType?->name ?: 'Any / not specified' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1 font-13">Stay Dates</p>
                                <p class="fw-semibold mb-0">
                                    @if ($inquiry->check_in_date)
                                        {{ $inquiry->check_in_date->format('d M Y') }}
                                        @if ($inquiry->check_out_date)
                                            – {{ $inquiry->check_out_date->format('d M Y') }}
                                        @endif
                                    @else
                                        —
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1 font-13">Guests</p>
                                <p class="fw-semibold mb-0">
                                    @if ($inquiry->adults)
                                        {{ $inquiry->adults }} adults@if($inquiry->children > 0), {{ $inquiry->children }} children@endif
                                    @else
                                        —
                                    @endif
                                </p>
                            </div>
                        @endif
                        <div class="col-12">
                            <p class="text-muted mb-1 font-13">Message</p>
                            <p class="mb-0">{!! nl2br(e($inquiry->message)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Guest Contact</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Name</p>
                            <p class="fw-semibold mb-0">{{ $inquiry->guest_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Phone</p>
                            <p class="fw-semibold mb-0"><a href="tel:{{ preg_replace('/\s+/', '', $inquiry->guest_phone) }}">{{ $inquiry->guest_phone }}</a></p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Email</p>
                            <p class="fw-semibold mb-0">
                                @if ($inquiry->guest_email)
                                    <a href="mailto:{{ $inquiry->guest_email }}">{{ $inquiry->guest_email }}</a>
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Update Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hotel-inquiries.update-status', $inquiry) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                @foreach (\App\Models\HotelInquiry::statuses() as $statusOption)
                                    <option value="{{ $statusOption }}" @selected(old('status', $inquiry->status) === $statusOption)>
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
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="admin_notes">Admin Notes</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4" placeholder="Follow-up notes, quote sent, etc.">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save Status</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hotel-inquiries.destroy', $inquiry) }}" method="POST" class="js-confirm-delete" data-title="Delete inquiry?" data-text="This inquiry will be permanently removed.">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
