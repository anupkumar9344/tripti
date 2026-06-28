@extends('admin.layouts.app')

@section('title', 'Treatments')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.treatments.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Treatment
                    </a>
                </div>
                <h4 class="page-title">Treatments</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Treatments</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted font-13">Manage the &ldquo;What We Treat&rdquo; section. Items with <strong>Display on Home</strong> enabled appear on the home page when active.</p>
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_treatments">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Treatment</th>
                                    <th>Icon</th>
                                    <th>Home</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($treatments as $treatment)
                                    <tr>
                                        <td>{{ $treatment->sort_order }}</td>
                                        <td>
                                            <img src="{{ $treatment->imageUrl() }}" alt="{{ $treatment->title }}" height="40" class="rounded me-2">
                                            <span class="d-inline-block align-middle">
                                                <span class="fw-semibold d-block">{{ $treatment->title }}</span>
                                                @if ($treatment->short_description)
                                                    <span class="text-muted font-12">{{ \Illuminate\Support\Str::limit($treatment->short_description, 70) }}</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @if ($treatment->icon)
                                                <i class="fa-solid {{ $treatment->icon }} me-1"></i>
                                                <span class="font-13 text-muted">{{ $treatment->icon }}</span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if ($treatment->display_on_home)
                                                <span class="badge badge-soft-success">Yes</span>
                                            @else
                                                <span class="badge badge-soft-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($treatment->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'viewUrl' => $treatment->status ? route('treatment.show', $treatment->slug) : null,
                                                'viewTitle' => 'View',
                                                'viewTarget' => '_blank',
                                                'editUrl' => route('admin.treatments.edit', $treatment),
                                                'deleteUrl' => route('admin.treatments.destroy', $treatment),
                                                'deleteTitle' => 'Delete treatment?',
                                                'deleteText' => 'This treatment will be removed from the website.',
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
            const table = document.querySelector('#datatable_treatments');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search treatments...',
                        noRows: 'No treatments found. Add your first treatment.',
                        noResults: 'No matching treatments found.',
                    },
                });
            }
        });
    </script>
@endpush
