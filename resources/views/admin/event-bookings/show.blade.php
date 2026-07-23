@extends('admin.layouts.app')

@section('title', 'Booking ' . $booking->reference_number)

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h4 class="page-title mb-0">Booking {{ $booking->reference_number }}</h4>
                <div class="d-flex flex-wrap gap-2">
                    @admincan('event-bookings.edit')
                    <a href="{{ route('admin.event-bookings.edit', $booking) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                    @endadmincan
                    <a href="{{ route('admin.event-bookings.index') }}" class="btn btn-light btn-sm">Back to list</a>
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
                <div class="card-header">
                    <h4 class="card-title mb-0">Event Details</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Booking Type</p>
                            <p class="fw-semibold mb-0">{{ $booking->typeLabel() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Program / Event</p>
                            <p class="fw-semibold mb-0">{{ $booking->program_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Event Date</p>
                            <p class="fw-semibold mb-0">{{ $booking->event_date->format('d M Y') }}@if($booking->event_time) · {{ $booking->event_time }}@endif</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Number of People</p>
                            <p class="fw-semibold mb-0">{{ $booking->number_of_people }}</p>
                        </div>
                        <div class="col-12">
                            <p class="text-muted mb-1 font-13">Purpose</p>
                            <p class="mb-0">{{ $booking->purpose }}</p>
                        </div>
                        @if ($booking->additional_notes)
                            <div class="col-12">
                                <p class="text-muted mb-1 font-13">Additional Notes</p>
                                <p class="mb-0">{{ $booking->additional_notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Payment Details</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Booking Amount</p>
                            <p class="fw-semibold mb-0">{{ $booking->booking_amount !== null ? '₹'.number_format((float) $booking->booking_amount, 0) : 'Not quoted yet' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Advance Received</p>
                            <p class="fw-semibold mb-0">{{ $booking->advance_amount !== null ? '₹'.number_format((float) $booking->advance_amount, 0) : '—' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Balance Due</p>
                            <p class="fw-semibold mb-0">{{ $booking->balanceAmount() !== null ? '₹'.number_format($booking->balanceAmount(), 0) : '—' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Advance Status</p>
                            <p class="mb-0"><span class="badge {{ $booking->advancePaymentBadgeClass() }}">{{ $booking->advancePaymentLabel() }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Advance Paid On</p>
                            <p class="fw-semibold mb-0">{{ $booking->advance_paid_at?->format('d M Y') ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Contact Details</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Name</p>
                            <p class="fw-semibold mb-0">{{ $booking->contact_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Phone</p>
                            <p class="fw-semibold mb-0"><a href="tel:{{ preg_replace('/\s+/', '', $booking->phone) }}">{{ $booking->phone }}</a></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Email</p>
                            <p class="fw-semibold mb-0">@if($booking->email)<a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>@else — @endif</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Company / Organization</p>
                            <p class="fw-semibold mb-0">{{ $booking->company_name ?: '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Source</p>
                            <p class="fw-semibold mb-0">{{ $booking->sourceLabel() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Submitted</p>
                            <p class="fw-semibold mb-0">{{ $booking->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Status</h4>
                </div>
                <div class="card-body">
                    <p class="mb-3"><span class="badge {{ $booking->statusBadgeClass() }}">{{ $booking->statusLabel() }}</span></p>

                    @admincan('event-bookings.update-status')
                    <form action="{{ route('admin.event-bookings.update-status', $booking) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label" for="status">Update Status</label>
                            <select class="form-select" id="status" name="status" required>
                                @foreach (\App\Models\EventBooking::statuses() as $statusOption)
                                    <option value="{{ $statusOption }}" @selected($booking->status === $statusOption)>{{ (new \App\Models\EventBooking(['status' => $statusOption]))->statusLabel() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="admin_notes">Admin Notes</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Status</button>
                    </form>
                    @else
                        @if ($booking->admin_notes)
                            <p class="text-muted mb-1 font-13">Admin Notes</p>
                            <p class="mb-0">{{ $booking->admin_notes }}</p>
                        @endif
                    @endadmincan
                </div>
            </div>

            @admincan('event-bookings.delete')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.event-bookings.destroy', $booking) }}" method="POST" class="js-confirm-delete" data-title="Delete booking?" data-text="This event booking will be permanently removed.">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete Booking</button>
                    </form>
                </div>
            </div>
            @endadmincan
        </div>
    </div>
@endsection
