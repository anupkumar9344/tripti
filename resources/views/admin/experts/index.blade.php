@extends('admin.layouts.app')

@section('title', 'Expert Team')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.experts.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Expert
                    </a>
                </div>
                <h4 class="page-title">Expert Team</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Experts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_experts">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Expert</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($experts as $expert)
                                    <tr>
                                        <td>{{ $expert->sort_order }}</td>
                                        <td>
                                            <img src="{{ $expert->photoUrl() }}" alt="{{ $expert->name }}" height="40" class="rounded me-2">
                                            <span class="d-inline-block align-middle">
                                                <span class="fw-semibold d-block">{{ $expert->name }}</span>
                                                @if ($expert->specialty)
                                                    <span class="text-muted font-13">{{ Str::limit($expert->specialty, 60) }}</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $expert->designation ?? '—' }}</td>
                                        <td>
                                            @if ($expert->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.experts.edit', $expert) }}" class="me-2" title="Edit">
                                                <i class="las la-pen text-secondary font-16"></i>
                                            </a>
                                            <form action="{{ route('admin.experts.destroy', $expert) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete expert?" data-text="This expert and their photo will be permanently removed.">
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
            const table = document.querySelector('#datatable_experts');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search experts...',
                        noRows: 'No experts found. Add your first expert.',
                        noResults: 'No matching experts found.',
                    },
                });

                table.classList.add('table', 'table-striped', 'table-bordered', 'mb-0');
            }
        });
    </script>
@endpush
