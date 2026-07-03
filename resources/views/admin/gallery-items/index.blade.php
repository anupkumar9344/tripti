@extends('admin.layouts.app')

@section('title', 'Gallery')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.gallery-items.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Item
                    </a>
                </div>
                <h4 class="page-title">Gallery</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Gallery Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_gallery_items">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Home</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->sort_order }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if ($item->isVideo())
                                                <span class="badge badge-soft-info">Video</span>
                                            @else
                                                <span class="badge badge-soft-primary">Image</span>
                                            @endif
                                            @if ($item->is_featured)
                                                <span class="badge badge-soft-warning ms-1">Featured</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->display_on_home)
                                                <span class="badge badge-soft-success">Yes</span>
                                            @else
                                                <span class="badge badge-soft-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'editUrl' => route('admin.gallery-items.edit', $item),
                                                'deleteUrl' => route('admin.gallery-items.destroy', $item),
                                                'deleteTitle' => 'Delete item?',
                                                'deleteText' => 'This gallery item will be removed from the website.',
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
            const table = document.querySelector('#datatable_gallery_items');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search gallery items...',
                        noRows: 'No gallery items found. Add your first item.',
                        noResults: 'No matching items found.',
                    },
                });
            }
        });
    </script>
@endpush
