@extends('admin.layouts.app')

@section('title', 'Inquiries')

@php
    $pageTitle = match ($status) {
        'new' => 'New Inquiries',
        'in_progress' => 'In Progress',
        'quoted' => 'Quoted Inquiries',
        'closed' => 'Closed Inquiries',
        'cancelled' => 'Cancelled Inquiries',
        default => 'All Inquiries',
    };

    $hasExtraFilters = filled($filters['period'] ?? null)
        || filled($filters['date_from'] ?? null)
        || filled($filters['date_to'] ?? null);
@endphp

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .inquiry-admin-stat {
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(115, 86, 165, 0.1);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .inquiry-admin-stat:hover,
        .inquiry-admin-stat.is-active {
            border-color: rgba(115, 86, 165, 0.35);
            box-shadow: 0 4px 14px rgba(115, 86, 165, 0.08);
        }
        .inquiry-filter-period {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .inquiry-filter-period .btn {
            font-size: 12px;
        }
        .inquiry-filter-period .btn.active {
            background: #7356a5;
            border-color: #7356a5;
            color: #fff;
        }
        #inquiryFiltersOffcanvas {
            width: min(100%, 360px);
        }
        #inquiryFiltersOffcanvas .offcanvas-body {
            min-height: calc(100vh - 56px);
        }
    </style>
@endpush

@section('content')
    <div class="row mb-1">
        <div class="col-sm-12">
            <div class="page-title-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h4 class="page-title mb-0">{{ $pageTitle }}</h4>
                <div class="d-flex flex-wrap gap-2">
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#inquiryFiltersOffcanvas"
                        aria-controls="inquiryFiltersOffcanvas"
                    >
                        <i class="ti ti-filter me-1"></i> Filters
                        @if ($hasExtraFilters || filled($filters['status'] ?? null))
                            <span class="badge bg-primary ms-1">On</span>
                        @endif
                    </button>
                    @admincan('inquiries.create')
                    <a href="{{ route('admin.hotel-inquiries.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Inquiry
                    </a>
                    @endadmincan
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.hotel-inquiries.index', array_filter(['period' => $filters['period'] ?: null, 'date_from' => $filters['date_from'], 'date_to' => $filters['date_to']])) }}" class="card inquiry-admin-stat {{ $status === '' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">All</p>
                    <h4 class="mb-0">{{ number_format($counts['all']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.hotel-inquiries.index', array_filter(['status' => 'new', 'period' => $filters['period'] ?: null, 'date_from' => $filters['date_from'], 'date_to' => $filters['date_to']])) }}" class="card inquiry-admin-stat {{ $status === 'new' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">New</p>
                    <h4 class="mb-0 text-success">{{ number_format($counts['new']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.hotel-inquiries.index', array_filter(['status' => 'in_progress', 'period' => $filters['period'] ?: null, 'date_from' => $filters['date_from'], 'date_to' => $filters['date_to']])) }}" class="card inquiry-admin-stat {{ $status === 'in_progress' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">In Progress</p>
                    <h4 class="mb-0 text-warning">{{ number_format($counts['in_progress']) }}</h4>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-6">
            <a href="{{ route('admin.hotel-inquiries.index', array_filter(['status' => 'quoted', 'period' => $filters['period'] ?: null, 'date_from' => $filters['date_from'], 'date_to' => $filters['date_to']])) }}" class="card inquiry-admin-stat {{ $status === 'quoted' ? 'is-active' : '' }}">
                <div class="card-body py-3">
                    <p class="mb-1 text-muted font-13">Quoted</p>
                    <h4 class="mb-0 text-info">{{ number_format($counts['quoted']) }}</h4>
                </div>
            </a>
        </div>
    </div>

    @if ($hasExtraFilters || filled($filters['status'] ?? null))
        <div class="alert alert-light border mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="font-13">
                <strong>Active filters:</strong>
                @if ($filters['status'])
                    <span class="badge badge-soft-primary ms-1">{{ str_replace('_', ' ', ucfirst($filters['status'])) }}</span>
                @endif
                @if ($filters['period'] && $filters['period'] !== 'custom')
                    <span class="badge badge-soft-secondary ms-1">{{ str_replace('_', ' ', ucfirst($filters['period'])) }}</span>
                @endif
                @if ($filters['date_from'] || $filters['date_to'])
                    <span class="badge badge-soft-secondary ms-1">
                        {{ $filters['date_from'] ?: '…' }} to {{ $filters['date_to'] ?: '…' }}
                    </span>
                @endif
            </div>
            <a href="{{ route('admin.hotel-inquiries.index') }}" class="btn btn-sm btn-light">Reset All</a>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h4 class="card-title mb-0">{{ $pageTitle }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_inquiries">
                            <thead class="thead-light">
                                <tr>
                                    <th>Guest</th>
                                    <th>Type</th>
                                    <th>Subject</th>
                                    <th>Room / Stay</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inquiries as $inquiry)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold d-block">{{ $inquiry->guest_name }}</span>
                                            <span class="text-muted font-12">{{ $inquiry->guest_phone }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-primary">{{ $inquiry->typeLabel() }}</span>
                                            <span class="d-block text-muted font-12 mt-1">{{ $inquiry->sourceLabel() }}</span>
                                        </td>
                                        <td>{{ $inquiry->subject ?: \Illuminate\Support\Str::limit($inquiry->message, 40) }}</td>
                                        <td class="font-13">
                                            @if ($inquiry->inquiry_type === \App\Models\HotelInquiry::TYPE_ROOM)
                                                <span class="d-block">{{ $inquiry->roomType?->name ?: 'Any room' }}</span>
                                                @if ($inquiry->check_in_date)
                                                    <span class="text-muted">{{ $inquiry->check_in_date->format('d M Y') }}@if($inquiry->check_out_date) – {{ $inquiry->check_out_date->format('d M Y') }}@endif</span>
                                                @endif
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $inquiry->statusBadgeClass() }}">{{ $inquiry->statusLabel() }}</span>
                                        </td>
                                        <td class="text-nowrap font-13">{{ $inquiry->created_at?->format('d M Y, h:i A') }}</td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'permissionPrefix' => 'inquiries',
                                                'viewUrl' => route('admin.hotel-inquiries.show', $inquiry),
                                                'editUrl' => route('admin.hotel-inquiries.edit', $inquiry),
                                                'deleteUrl' => route('admin.hotel-inquiries.destroy', $inquiry),
                                                'deleteTitle' => 'Delete inquiry?',
                                                'deleteText' => 'This inquiry will be permanently removed.',
                                            ])
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No inquiries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="inquiryFiltersOffcanvas" aria-labelledby="inquiryFiltersOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="inquiryFiltersOffcanvasLabel">Filter Inquiries</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.hotel-inquiries.index') }}" method="GET" class="offcanvas-body d-flex flex-column" id="inquiryFiltersForm">
            <div class="mb-3">
                <label class="form-label" for="filter_status">Status</label>
                <select name="status" id="filter_status" class="form-select">
                    <option value="" @selected($filters['status'] === '')>All Inquiries</option>
                    <option value="new" @selected($filters['status'] === 'new')>New</option>
                    <option value="in_progress" @selected($filters['status'] === 'in_progress')>In Progress</option>
                    <option value="quoted" @selected($filters['status'] === 'quoted')>Quoted</option>
                    <option value="closed" @selected($filters['status'] === 'closed')>Closed</option>
                    <option value="cancelled" @selected($filters['status'] === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Quick period</label>
                <div class="inquiry-filter-period">
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
                            class="btn btn-outline-secondary inquiry-period-btn {{ ($filters['period'] ?? '') === $periodKey ? 'active' : '' }}"
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

            <p class="text-muted font-12 mb-4">Date filters apply to inquiry created date.</p>

            <div class="mt-auto d-grid gap-2">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('admin.hotel-inquiries.index') }}" class="btn btn-light">Reset All</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#datatable_inquiries');

            if (table && !table.querySelector('tbody tr td[colspan]')) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search inquiries...',
                        noRows: 'No inquiries found.',
                        noResults: 'No matching inquiries found.',
                    },
                });
            }

            const periodInput = document.getElementById('filter_period');
            const dateFrom = document.getElementById('filter_date_from');
            const dateTo = document.getElementById('filter_date_to');
            const periodButtons = document.querySelectorAll('.inquiry-period-btn');

            function setPeriod(period) {
                if (!periodInput) {
                    return;
                }

                periodInput.value = period;
                periodButtons.forEach(function (btn) {
                    btn.classList.toggle('active', btn.dataset.period === period);
                });
            }

            periodButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    setPeriod(btn.dataset.period);
                    if (dateFrom) {
                        dateFrom.value = '';
                    }
                    if (dateTo) {
                        dateTo.value = '';
                    }
                });
            });

            [dateFrom, dateTo].forEach(function (input) {
                if (!input) {
                    return;
                }

                input.addEventListener('change', function () {
                    if ((dateFrom && dateFrom.value) || (dateTo && dateTo.value)) {
                        setPeriod('custom');
                    }
                });
            });

            const filterOffcanvas = document.getElementById('inquiryFiltersOffcanvas');
            document.querySelectorAll('[data-bs-target="#inquiryFiltersOffcanvas"]').forEach(function (button) {
                button.addEventListener('click', function () {
                    if (filterOffcanvas && window.bootstrap && window.bootstrap.Offcanvas) {
                        window.bootstrap.Offcanvas.getOrCreateInstance(filterOffcanvas).show();
                    }
                });
            });
        });
    </script>
@endpush
