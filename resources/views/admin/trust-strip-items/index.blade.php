@extends('admin.layouts.app')

@section('title', 'Trust Strip')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.trust-strip-items.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Item
                    </a>
                </div>
                <h4 class="page-title">Trust Strip</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Home Page Trust Strip</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_trust_strip_items">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Icon</th>
                                    <th>Label</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trustStripItems as $item)
                                    <tr>
                                        <td>{{ $item->sort_order }}</td>
                                        <td>
                                            <img src="{{ $item->imageUrl() }}" alt="{{ $item->label }}" height="36" class="rounded">
                                        </td>
                                        <td>{{ $item->label }}</td>
                                        <td>
                                            @if ($item->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/') }}#home-trust" class="me-2" title="View" target="_blank">
                                                <i class="las la-eye text-secondary font-16"></i>
                                            </a>
                                            <a href="{{ route('admin.trust-strip-items.edit', $item) }}" class="me-2" title="Edit">
                                                <i class="las la-pen text-secondary font-16"></i>
                                            </a>
                                            <form action="{{ route('admin.trust-strip-items.destroy', $item) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete item?" data-text="This item will be removed from the home page trust strip.">
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
            const table = document.querySelector('#datatable_trust_strip_items');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search items...',
                        noRows: 'No items found. Add your first trust strip item.',
                        noResults: 'No matching items found.',
                    },
                });
            }
        });
    </script>
@endpush
