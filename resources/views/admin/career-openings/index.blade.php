@extends('admin.layouts.app')

@section('title', 'Job Openings')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.career-openings.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Opening
                    </a>
                </div>
                <h4 class="page-title">Job Openings</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_career_openings">
                            <thead class="thead-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Applications</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($openings as $opening)
                                    <tr>
                                        <td class="fw-semibold">{{ $opening->title }}</td>
                                        <td>{{ $opening->department ?: '—' }}</td>
                                        <td>{{ $opening->job_type }}</td>
                                        <td>{{ $opening->applications_count }}</td>
                                        <td>
                                            @if ($opening->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'permissionPrefix' => 'career-openings',
                                                'editUrl' => route('admin.career-openings.edit', $opening),
                                                'deleteUrl' => route('admin.career-openings.destroy', $opening),
                                                'deleteTitle' => 'Delete opening?',
                                                'deleteText' => 'This job opening will be permanently removed.',
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
            const table = document.querySelector('#datatable_career_openings');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    labels: {
                        placeholder: 'Search openings...',
                        noRows: 'No job openings yet.',
                        noResults: 'No matching openings found.',
                    },
                });
            }
        });
    </script>
@endpush
