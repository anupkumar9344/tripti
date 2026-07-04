@extends('admin.layouts.app')

@section('title', 'Booking ' . $booking->booking_number)

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h4 class="page-title mb-0">Booking {{ $booking->booking_number }}</h4>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-light btn-sm">Back to list</a>
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
                    <h4 class="card-title mb-0">Stay Details</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Room Type</p>
                            <p class="fw-semibold mb-0">{{ $booking->roomType?->name ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Assigned Room</p>
                            <p class="fw-semibold mb-0">{{ $booking->room?->room_number ?? 'Not assigned' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Check-in</p>
                            <p class="fw-semibold mb-0">{{ $booking->check_in->format('d M Y') }} @if($booking->check_in_time) · {{ $booking->check_in_time }} @endif</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Check-out</p>
                            <p class="fw-semibold mb-0">{{ $booking->check_out->format('d M Y') }} @if($booking->check_out_time) · {{ $booking->check_out_time }} @endif</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Guests</p>
                            <p class="fw-semibold mb-0">{{ $booking->adults }} adults, {{ $booking->children }} children</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Nights</p>
                            <p class="fw-semibold mb-0">{{ $booking->nights }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Room Fare</p>
                            <p class="fw-semibold mb-0">₹{{ number_format((float) $booking->room_fare, 0) }} / night</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Total Amount</p>
                            <p class="fw-semibold mb-0">₹{{ number_format((float) $booking->total_amount, 0) }}</p>
                        </div>
                        @if ($booking->promo_code)
                            <div class="col-md-6">
                                <p class="text-muted mb-1 font-13">Promo Code</p>
                                <p class="fw-semibold mb-0">{{ $booking->promo_code }}</p>
                            </div>
                        @endif
                        @if ($booking->special_requests)
                            <div class="col-12">
                                <p class="text-muted mb-1 font-13">Special Requests</p>
                                <p class="mb-0">{{ $booking->special_requests }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">Guest Details</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Name</p>
                            <p class="fw-semibold mb-0">{{ $booking->guestName() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Booking For</p>
                            <p class="fw-semibold mb-0">{{ $booking->booking_for === 'someone_else' ? 'Someone else' : 'Myself' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Email</p>
                            <p class="fw-semibold mb-0"><a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Phone</p>
                            <p class="fw-semibold mb-0"><a href="tel:{{ preg_replace('/\s+/', '', $booking->phone) }}">{{ $booking->phone }}</a></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Country</p>
                            <p class="fw-semibold mb-0">{{ $booking->country ?: '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 font-13">Marketing Consent</p>
                            <p class="fw-semibold mb-0">{{ $booking->marketing_consent ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>

                    @if (! empty($booking->guests))
                        <hr class="my-3">
                        <h5 class="mb-3">Additional Guests</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking->guests as $index => $guest)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ trim(($guest['first_name'] ?? '') . ' ' . ($guest['last_name'] ?? '')) ?: '—' }}</td>
                                            <td>{{ $guest['country'] ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Payment</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Method</p>
                            <p class="fw-semibold mb-0">{{ $booking->paymentMethodLabel() }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Status</p>
                            <p class="fw-semibold mb-0">{{ $booking->paymentStatusLabel() }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1 font-13">Gateway</p>
                            <p class="fw-semibold mb-0">{{ $booking->payment_gateway ?: '—' }}</p>
                        </div>
                        @if ($booking->payment_order_id)
                            <div class="col-md-6">
                                <p class="text-muted mb-1 font-13">Order ID</p>
                                <p class="fw-semibold mb-0">{{ $booking->payment_order_id }}</p>
                            </div>
                        @endif
                        @if ($booking->payment_reference)
                            <div class="col-md-6">
                                <p class="text-muted mb-1 font-13">Payment Reference</p>
                                <p class="fw-semibold mb-0">{{ $booking->payment_reference }}</p>
                            </div>
                        @endif
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
                    <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label" for="status">Booking Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" @selected($booking->status === 'pending')>Pending</option>
                                <option value="confirmed" @selected($booking->status === 'confirmed')>Confirmed</option>
                                <option value="completed" @selected($booking->status === 'completed')>Completed</option>
                                <option value="cancelled" @selected($booking->status === 'cancelled')>Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="payment_status">Payment Status</label>
                            <select name="payment_status" id="payment_status" class="form-select">
                                <option value="pending" @selected($booking->payment_status === 'pending')>Pending</option>
                                <option value="paid" @selected($booking->payment_status === 'paid')>Paid</option>
                                <option value="failed" @selected($booking->payment_status === 'failed')>Failed</option>
                                <option value="refunded" @selected($booking->payment_status === 'refunded')>Refunded</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="admin_notes">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Timeline</h4>
                </div>
                <div class="card-body">
                    <p class="mb-2"><span class="text-muted font-13">Created:</span><br><strong>{{ $booking->created_at?->format('d M Y, h:i A') }}</strong></p>
                    <p class="mb-2"><span class="text-muted font-13">Confirmed:</span><br><strong>{{ $booking->confirmed_at?->format('d M Y, h:i A') ?? '—' }}</strong></p>
                    <p class="mb-0"><span class="text-muted font-13">Cancelled:</span><br><strong>{{ $booking->cancelled_at?->format('d M Y, h:i A') ?? '—' }}</strong></p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="js-confirm-delete" data-title="Delete booking?" data-text="This booking record will be permanently removed.">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">Delete Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
