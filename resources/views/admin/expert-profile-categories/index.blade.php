@extends('admin.layouts.app')

@section('title', 'Team Categories')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.expert-profile-categories.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Category
                    </a>
                </div>
                <h4 class="page-title">Team Categories</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Team Categories</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted font-13">Create categories here, then add content for each expert on the expert edit page. Only categories with content appear on the public profile.</p>
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_profile_categories">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Category</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->sort_order }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            @if ($category->icon)
                                                <i class="fa-solid {{ $category->icon }} me-1"></i>
                                                <span class="font-13 text-muted">{{ $category->icon }}</span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if ($category->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.expert-profile-categories.edit', $category) }}" class="me-2" title="Edit">
                                                <i class="las la-pen text-secondary font-16"></i>
                                            </a>
                                            <form action="{{ route('admin.expert-profile-categories.destroy', $category) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete category?" data-text="This category and all expert content linked to it will be removed.">
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
            const table = document.querySelector('#datatable_profile_categories');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search categories...',
                        noRows: 'No categories found. Add your first category.',
                        noResults: 'No matching categories found.',
                    },
                });
            }
        });
    </script>
@endpush
