@extends('admin.layouts.app')

@section('title', 'Facilities')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.hotel-facilities.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add New
                    </a>
                </div>
                <h4 class="page-title">All Facilities</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_facilities">
                            <thead class="thead-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facilities as $facility)
                                    <tr>
                                        <td>
                                            @if ($facility->icon)
                                                <i class="fa-solid {{ $facility->icon }} me-2"></i>
                                            @endif
                                            {{ $facility->title }}
                                        </td>
                                        <td>
                                            @if ($facility->status)
                                                <span class="badge badge-soft-success">Enabled</span>
                                            @else
                                                <span class="badge badge-soft-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-table-actions">
                                                <a href="{{ route('admin.hotel-facilities.edit', $facility) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.hotel-facilities.toggle-status', $facility) }}"
                                                    method="POST"
                                                    class="js-confirm-toggle d-inline"
                                                    data-title="{{ $facility->status ? 'Disable facility?' : 'Enable facility?' }}"
                                                    data-text="{{ $facility->status ? 'This facility will be disabled and hidden from use.' : 'This facility will be enabled again.' }}"
                                                    data-confirm-text="{{ $facility->status ? 'Yes, disable' : 'Yes, enable' }}"
                                                    data-confirm-variant="{{ $facility->status ? 'danger' : 'success' }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $facility->status ? 'danger' : 'success' }}">
                                                        <i class="las la-{{ $facility->status ? 'ban' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.hotel-facilities.destroy', $facility) }}" method="POST" class="js-confirm-delete d-inline" data-title="Delete facility?" data-text="This facility will be permanently removed.">
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
            const table = document.querySelector('#datatable_facilities');
            if (table) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
