@extends('admin.layouts.app')

@section('title', 'Premium Services')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.premium-services.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add New
                    </a>
                </div>
                <h4 class="page-title">Premium Services</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_premium_services">
                            <thead class="thead-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>
                                            @if ($service->icon)
                                                <i class="fa-solid {{ $service->icon }} me-2"></i>
                                            @endif
                                            {{ $service->title }}
                                        </td>
                                        <td>{{ $service->price ? '₹'.number_format($service->price, 2) : '—' }}</td>
                                        <td>
                                            @if ($service->status)
                                                <span class="badge badge-soft-success">Enabled</span>
                                            @else
                                                <span class="badge badge-soft-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-table-actions">
                                                <a href="{{ route('admin.premium-services.edit', $service) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.premium-services.toggle-status', $service) }}"
                                                    method="POST"
                                                    class="js-confirm-toggle d-inline"
                                                    data-title="{{ $service->status ? 'Disable service?' : 'Enable service?' }}"
                                                    data-text="{{ $service->status ? 'This premium service will be disabled.' : 'This premium service will be enabled again.' }}"
                                                    data-confirm-text="{{ $service->status ? 'Yes, disable' : 'Yes, enable' }}"
                                                    data-confirm-variant="{{ $service->status ? 'danger' : 'success' }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $service->status ? 'danger' : 'success' }}">
                                                        <i class="las la-{{ $service->status ? 'ban' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.premium-services.destroy', $service) }}" method="POST" class="js-confirm-delete d-inline" data-title="Delete service?" data-text="This premium service will be permanently removed.">
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
            const table = document.querySelector('#datatable_premium_services');
            if (table) {
                new simpleDatatables.DataTable(table, { searchable: true, fixedHeight: false, perPage: 10 });
            }
        });
    </script>
@endpush
