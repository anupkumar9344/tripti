@extends('admin.layouts.app')

@section('title', 'Health Programs')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.health-programs.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Program
                    </a>
                </div>
                <h4 class="page-title">Health Programs</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Programs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_health_programs">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Program</th>
                                    <th>Home</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($healthPrograms as $program)
                                    <tr>
                                        <td>{{ $program->sort_order }}</td>
                                        <td>
                                            <img src="{{ $program->imageUrl() }}" alt="{{ $program->title }}" height="40" class="rounded me-2">
                                            <span class="d-inline-block align-middle">
                                                <span class="fw-semibold d-block">{{ $program->title }}</span>
                                                @if ($program->date_time)
                                                    <span class="text-muted font-12">{{ $program->date_time }}</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @if ($program->active_on_home)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($program->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($program->status)
                                                <a href="{{ route('health-programs') }}" class="me-2" title="View" target="_blank">
                                                    <i class="las la-eye text-secondary font-16"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.health-programs.edit', $program) }}" class="me-2" title="Edit">
                                                <i class="las la-pen text-secondary font-16"></i>
                                            </a>
                                            <form action="{{ route('admin.health-programs.destroy', $program) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete program?" data-text="This health program will be removed from the website.">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 border-0" title="Delete">
                                                    <i class="las la-trash-alt text-secondary font-16"></i>
                                                </button>
                                            </form>
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
            const table = document.querySelector('#datatable_health_programs');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search programs...',
                        noRows: 'No programs found. Add your first program.',
                        noResults: 'No matching programs found.',
                    },
                });
            }
        });
    </script>
@endpush
