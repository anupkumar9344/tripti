@extends('admin.layouts.app')

@section('title', 'Roles & Permissions')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    @admincan('roles.create')
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add Role
                        </a>
                    @endadmincan
                </div>
                <h4 class="page-title">Roles & Permissions</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-13 mb-3">Group permissions by section and assign roles to staff. Super Admin always has full access.</p>
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_roles">
                            <thead class="thead-light">
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Staff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="fw-semibold">{{ $role->name }}</td>
                                        <td>{{ number_format($role->permissions_count) }}</td>
                                        <td>{{ number_format($role->users_count) }}</td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'permissionPrefix' => 'roles',
                                                'editUrl' => route('admin.roles.edit', $role),
                                                'deleteUrl' => $role->name === \App\Support\AdminPermissions::SUPER_ADMIN_ROLE || $role->users_count > 0
                                                    ? null
                                                    : route('admin.roles.destroy', $role),
                                                'deleteTitle' => 'Delete role?',
                                                'deleteText' => 'This role will be permanently removed.',
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
            const table = document.querySelector('#datatable_roles');
            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50],
                    labels: {
                        placeholder: 'Search roles...',
                        noRows: 'No roles found.',
                        noResults: 'No matching roles found.',
                    },
                });
            }
        });
    </script>
@endpush
