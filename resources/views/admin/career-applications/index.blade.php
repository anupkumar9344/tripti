@extends('admin.layouts.app')

@section('title', 'Career Applications')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Career Applications</h4>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.career-applications.index') }}" class="btn btn-sm {{ $status === '' ? 'btn-primary' : 'btn-outline-primary' }}">All ({{ $counts['all'] }})</a>
                <a href="{{ route('admin.career-applications.index', ['status' => 'new']) }}" class="btn btn-sm {{ $status === 'new' ? 'btn-primary' : 'btn-outline-primary' }}">New ({{ $counts['new'] }})</a>
                <a href="{{ route('admin.career-applications.index', ['status' => 'reviewed']) }}" class="btn btn-sm {{ $status === 'reviewed' ? 'btn-primary' : 'btn-outline-primary' }}">Reviewed ({{ $counts['reviewed'] }})</a>
                <a href="{{ route('admin.career-applications.index', ['status' => 'shortlisted']) }}" class="btn btn-sm {{ $status === 'shortlisted' ? 'btn-primary' : 'btn-outline-primary' }}">Shortlisted ({{ $counts['shortlisted'] }})</a>
                <a href="{{ route('admin.career-applications.index', ['status' => 'rejected']) }}" class="btn btn-sm {{ $status === 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}">Rejected ({{ $counts['rejected'] }})</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Applications</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_careers">
                            <thead class="thead-light">
                                <tr>
                                    <th>Applicant</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold d-block">{{ $application->name }}</span>
                                            <span class="text-muted font-13">{{ $application->email }}</span>
                                        </td>
                                        <td>{{ $application->opening?->title ?? $application->position }}</td>
                                        <td><span class="badge {{ $application->statusBadgeClass() }}">{{ $application->statusLabel() }}</span></td>
                                        <td class="text-nowrap font-13">{{ $application->created_at?->format('d M Y, h:i A') ?? '—' }}</td>
                                        <td>
                                            <a href="{{ route('admin.career-applications.show', $application) }}" class="btn btn-sm btn-soft-primary">
                                                <i class="ti ti-eye"></i> View
                                            </a>
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
            const table = document.querySelector('#datatable_careers');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search applications...',
                        noRows: 'No career applications yet.',
                        noResults: 'No matching applications found.',
                    },
                });
            }
        });
    </script>
@endpush
