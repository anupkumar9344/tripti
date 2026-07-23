@extends('admin.layouts.app')

@section('title', 'Banquet & Meeting Bookings')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .event-booking-stat {
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(115, 86, 165, 0.1);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .event-booking-stat:hover,
        .event-booking-stat.is-active {
            border-color: rgba(115, 86, 165, 0.35);
            box-shadow: 0 4px 14px rgba(115, 86, 165, 0.08);
        }
    </style>
@endpush

@section('content')
  @php
      $pageTitle = match ($status) {
          'new' => 'New Event Bookings',
          'confirmed' => 'Confirmed Bookings',
          'completed' => 'Completed Bookings',
          'cancelled' => 'Cancelled Bookings',
          default => 'Banquet & Meeting Bookings',
      };
  @endphp

    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h4 class="page-title mb-0">{{ $pageTitle }}</h4>
                @admincan('event-bookings.create')
                <a href="{{ route('admin.event-bookings.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Add Booking
                </a>
                @endadmincan
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-xl col-md-4 col-6">
            <a href="{{ route('admin.event-bookings.index') }}" class="card event-booking-stat {{ $status === '' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">All</p>
                    <h4 class="mb-0">{{ number_format($counts['all']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-4 col-6">
            <a href="{{ route('admin.event-bookings.index', ['status' => 'new']) }}" class="card event-booking-stat {{ $status === 'new' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">New</p>
                    <h4 class="mb-0 text-warning">{{ number_format($counts['new']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-4 col-6">
            <a href="{{ route('admin.event-bookings.index', ['status' => 'confirmed']) }}" class="card event-booking-stat {{ $status === 'confirmed' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Confirmed</p>
                    <h4 class="mb-0 text-success">{{ number_format($counts['confirmed']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-4 col-6">
            <a href="{{ route('admin.event-bookings.index', ['status' => 'completed']) }}" class="card event-booking-stat {{ $status === 'completed' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Completed</p>
                    <h4 class="mb-0 text-info">{{ number_format($counts['completed']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl col-md-4 col-6">
            <a href="{{ route('admin.event-bookings.index', ['status' => 'cancelled']) }}" class="card event-booking-stat {{ $status === 'cancelled' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Cancelled</p>
                    <h4 class="mb-0 text-danger">{{ number_format($counts['cancelled']) }}</h4>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_event_bookings">
                            <thead class="thead-light">
                                <tr>
                                    <th>Ref.</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Program</th>
                                    <th>People</th>
                                    <th>Event Date</th>
                                    <th>Amount</th>
                                    <th>Advance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td><strong>{{ $booking->reference_number }}</strong></td>
                                        <td>{{ $booking->typeLabel() }}</td>
                                        <td>{{ $booking->contact_name }}</td>
                                        <td>{{ $booking->program_name }}</td>
                                        <td>{{ $booking->number_of_people }}</td>
                                        <td>{{ $booking->event_date->format('d M Y') }}@if($booking->event_time) · {{ $booking->event_time }}@endif</td>
                                        <td>{{ $booking->booking_amount !== null ? '₹'.number_format((float) $booking->booking_amount, 0) : '—' }}</td>
                                        <td>
                                            @if ($booking->booking_amount !== null)
                                                <div>₹{{ number_format((float) ($booking->advance_amount ?? 0), 0) }}</div>
                                                <span class="badge {{ $booking->advancePaymentBadgeClass() }}">{{ $booking->advancePaymentLabel() }}</span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td><span class="badge {{ $booking->statusBadgeClass() }}">{{ $booking->statusLabel() }}</span></td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'permissionPrefix' => 'event-bookings',
                                                'viewUrl' => route('admin.event-bookings.show', $booking),
                                                'editUrl' => route('admin.event-bookings.edit', $booking),
                                                'deleteUrl' => route('admin.event-bookings.destroy', $booking),
                                                'deleteTitle' => 'Delete booking?',
                                                'deleteText' => 'This event booking will be permanently removed.',
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#datatable_event_bookings');
            if (table) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
