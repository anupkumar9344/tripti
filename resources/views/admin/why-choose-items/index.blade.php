@extends('admin.layouts.app')

@section('title', 'Why Choose Us')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.why-choose-items.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Item
                    </a>
                </div>
                <h4 class="page-title">Why Choose Sahaj Aarogyam</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Home &amp; About Section Items</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted font-13">Manage the cards shown in the &ldquo;Why Choose Sahaj Aarogyam&rdquo; section on the home page and the matching section on the about page.</p>
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_why_choose_items">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Short Description</th>
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
                                            @if ($item->icon)
                                                <i class="fa-solid {{ $item->icon }} me-1"></i>
                                                <span class="font-13 text-muted">{{ $item->icon }}</span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->short_description, 80) ?: '—' }}</td>
                                        <td>
                                            @if ($item->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'editUrl' => route('admin.why-choose-items.edit', $item),
                                                'deleteUrl' => route('admin.why-choose-items.destroy', $item),
                                                'deleteTitle' => 'Delete item?',
                                                'deleteText' => 'This item will be removed from the home and about pages.',
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
            const table = document.querySelector('#datatable_why_choose_items');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search items...',
                        noRows: 'No items found. Add your first item.',
                        noResults: 'No matching items found.',
                    },
                });
            }
        });
    </script>
@endpush
