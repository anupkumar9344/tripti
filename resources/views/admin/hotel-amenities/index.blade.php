@extends('admin.layouts.app')

@section('title', 'Amenities')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.hotel-amenities.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add New
                    </a>
                </div>
                <h4 class="page-title">All Amenities</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_amenities">
                            <thead class="thead-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($amenities as $amenity)
                                    <tr>
                                        <td>
                                            @if ($amenity->icon)
                                                <i class="fa-solid {{ $amenity->icon }} me-2"></i>
                                            @endif
                                            {{ $amenity->title }}
                                        </td>
                                        <td>
                                            @if ($amenity->status)
                                                <span class="badge badge-soft-success">Enabled</span>
                                            @else
                                                <span class="badge badge-soft-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-table-actions">
                                                <a href="{{ route('admin.hotel-amenities.edit', $amenity) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.hotel-amenities.toggle-status', $amenity) }}"
                                                    method="POST"
                                                    class="js-confirm-toggle d-inline"
                                                    data-title="{{ $amenity->status ? 'Disable amenity?' : 'Enable amenity?' }}"
                                                    data-text="{{ $amenity->status ? 'This amenity will be disabled and hidden from use.' : 'This amenity will be enabled again.' }}"
                                                    data-confirm-text="{{ $amenity->status ? 'Yes, disable' : 'Yes, enable' }}"
                                                    data-confirm-variant="{{ $amenity->status ? 'danger' : 'success' }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $amenity->status ? 'danger' : 'success' }}">
                                                        <i class="las la-{{ $amenity->status ? 'ban' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.hotel-amenities.destroy', $amenity) }}" method="POST" class="js-confirm-delete d-inline" data-title="Delete amenity?" data-text="This amenity will be permanently removed.">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
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
            const table = document.querySelector('#datatable_amenities');
            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    labels: { placeholder: 'Search amenities...', noRows: 'No amenities found.', noResults: 'No matching amenities found.' },
                });
            }
        });
    </script>
@endpush
