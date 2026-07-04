@extends('admin.layouts.app')

@section('title', 'Bookings')

@php
    $pageTitle = match ($status) {
        'pending' => 'Pending Bookings',
        'confirmed' => 'Confirmed Bookings',
        'completed' => 'Completed Bookings',
        'cancelled' => 'Cancelled Bookings',
        default => 'All Bookings',
    };

    $hasExtraFilters = filled($filters['period'] ?? null)
        || filled($filters['date_from'] ?? null)
        || filled($filters['date_to'] ?? null);
@endphp

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .booking-admin-stat {
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(115, 86, 165, 0.1);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .booking-admin-stat:hover,
        .booking-admin-stat.is-active {
            border-color: rgba(115, 86, 165, 0.35);
            box-shadow: 0 4px 14px rgba(115, 86, 165, 0.08);
        }
        .booking-filter-period {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .booking-filter-period .btn {
            font-size: 12px;
        }
        .booking-filter-period .btn.active {
            background: #7356a5;
            border-color: #7356a5;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h4 class="page-title mb-0">{{ $pageTitle }}</h4>
                <button
                    type="button"
                    class="btn btn-outline-primary"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#bookingFiltersOffcanvas"
                    aria-controls="bookingFiltersOffcanvas"
                >
                    <i class="ti ti-filter me-1"></i> Filters
                    @if ($hasExtraFilters)
                        <span class="badge bg-primary ms-1">On</span>
                    @endif
                </button>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.bookings.index') }}" class="card booking-admin-stat {{ $status === '' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">All Bookings</p>
                    <h4 class="mb-0">{{ number_format($counts['all']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="card booking-admin-stat {{ $status === 'pending' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Pending</p>
                    <h4 class="mb-0 text-warning">{{ number_format($counts['pending']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" class="card booking-admin-stat {{ $status === 'confirmed' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Confirmed</p>
                    <h4 class="mb-0 text-success">{{ number_format($counts['confirmed']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}" class="card booking-admin-stat {{ $status === 'completed' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Completed</p>
                    <h4 class="mb-0 text-primary">{{ number_format($counts['completed']) }}</h4>
                </div>
            </a>
        </div>
    </div>

    @if ($hasExtraFilters)
        <div class="alert alert-light border mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="font-13">
                <strong>Active filters:</strong>
                @if ($filters['period'] && $filters['period'] !== 'custom')
                    <span class="badge badge-soft-primary ms-1">{{ str_replace('_', ' ', ucfirst($filters['period'])) }}</span>
                @endif
                @if ($filters['date_from'] || $filters['date_to'])
                    <span class="badge badge-soft-secondary ms-1">
                        {{ $filters['date_from'] ?: '…' }} to {{ $filters['date_to'] ?: '…' }}
                    </span>
                @endif
            </div>
            <a href="{{ route('admin.bookings.index', array_filter(['status' => $status ?: null])) }}" class="btn btn-sm btn-light">Clear date filters</a>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $pageTitle }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_bookings">
                            <thead class="thead-light">
                                <tr>
                                    <th>Booking</th>
                                    <th>Guest</th>
                                    <th>Room</th>
                                    <th>Stay</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold d-block">{{ $booking->booking_number }}</span>
                                            <span class="text-muted font-12">{{ $booking->created_at?->format('d M Y, h:i A') }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold d-block">{{ $booking->guestName() }}</span>
                                            <span class="d-block font-12">{{ $booking->email }}</span>
                                            <span class="text-muted font-12">{{ $booking->phone }}</span>
                                        </td>
                                        <td>{{ $booking->roomType?->name ?? '—' }}</td>
                                        <td class="text-nowrap font-13">
                                            {{ $booking->check_in->format('d M Y') }}
                                            <br>
                                            {{ $booking->check_out->format('d M Y') }}
                                            <span class="text-muted">({{ $booking->nights }}n)</span>
                                        </td>
                                        <td class="fw-semibold">₹{{ number_format((float) $booking->total_amount, 0) }}</td>
                                        <td>
                                            <span class="d-block font-13">{{ $booking->paymentMethodLabel() }}</span>
                                            <span class="badge badge-soft-{{ $booking->payment_status === 'paid' ? 'success' : 'secondary' }}">
                                                {{ $booking->paymentStatusLabel() }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($booking->status === 'confirmed')
                                                <span class="badge badge-soft-success">Confirmed</span>
                                            @elseif ($booking->status === 'completed')
                                                <span class="badge badge-soft-primary">Completed</span>
                                            @elseif ($booking->status === 'cancelled')
                                                <span class="badge badge-soft-danger">Cancelled</span>
                                            @else
                                                <span class="badge badge-soft-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">View</a>
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

    <div class="offcanvas offcanvas-end" tabindex="-1" id="bookingFiltersOffcanvas" aria-labelledby="bookingFiltersOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="bookingFiltersOffcanvasLabel">Filter Bookings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="offcanvas-body d-flex flex-column" id="bookingFiltersForm">
            <div class="mb-3">
                <label class="form-label" for="filter_status">Status</label>
                <select name="status" id="filter_status" class="form-select">
                    <option value="" @selected($filters['status'] === '')>All Bookings</option>
                    <option value="pending" @selected($filters['status'] === 'pending')>Pending</option>
                    <option value="confirmed" @selected($filters['status'] === 'confirmed')>Confirmed</option>
                    <option value="completed" @selected($filters['status'] === 'completed')>Completed</option>
                    <option value="cancelled" @selected($filters['status'] === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Quick period</label>
                <div class="booking-filter-period">
                    @foreach ([
                        'today' => 'Today',
                        'last_7_days' => 'Last 7 days',
                        'current_month' => 'Current month',
                        'last_month' => 'Last month',
                        'this_year' => 'This year',
                        'last_year' => 'Last year',
                    ] as $periodKey => $periodLabel)
                        <button
                            type="button"
                            class="btn btn-outline-secondary booking-period-btn {{ ($filters['period'] ?? '') === $periodKey ? 'active' : '' }}"
                            data-period="{{ $periodKey }}"
                        >
                            {{ $periodLabel }}
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="period" id="filter_period" value="{{ $filters['period'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="filter_date_from">Date from</label>
                <input type="date" name="date_from" id="filter_date_from" class="form-control" value="{{ $filters['date_from'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="filter_date_to">Date to</label>
                <input type="date" name="date_to" id="filter_date_to" class="form-control" value="{{ $filters['date_to'] ?? '' }}">
            </div>

            <p class="text-muted font-12 mb-4">Date filters apply to booking created date.</p>

            <div class="mt-auto d-grid gap-2">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-light">Reset All</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#datatable_bookings');
            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search bookings...',
                        noRows: 'No bookings found.',
                        noResults: 'No matching bookings found.',
                    },
                });
            }

            const periodInput = document.getElementById('filter_period');
            const dateFrom = document.getElementById('filter_date_from');
            const dateTo = document.getElementById('filter_date_to');
            const periodButtons = document.querySelectorAll('.booking-period-btn');

            function setPeriod(period) {
                periodInput.value = period;
                periodButtons.forEach(function (btn) {
                    btn.classList.toggle('active', btn.dataset.period === period);
                });
            }

            periodButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    setPeriod(btn.dataset.period);
                    dateFrom.value = '';
                    dateTo.value = '';
                });
            });

            [dateFrom, dateTo].forEach(function (input) {
                input.addEventListener('change', function () {
                    if (dateFrom.value || dateTo.value) {
                        setPeriod('custom');
                    }
                });
            });
        });
    </script>
@endpush
