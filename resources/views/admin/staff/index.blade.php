@extends('admin.layouts.app')

@section('title', 'Staff')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    @admincan('staff.create')
                        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add Staff
                        </a>
                    @endadmincan
                </div>
                <h4 class="page-title">Staff Members</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-13 mb-3">Create staff accounts and assign roles to control what each person can access in the admin panel.</p>
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_staff">
                            <thead class="thead-light">
                                <tr>
                                    <th>Staff</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffMembers as $member)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $member->avatarUrl() }}" alt="{{ $member->name }}" class="rounded-circle me-2" width="36" height="36">
                                                <span class="fw-semibold">{{ $member->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $member->email }}</td>
                                        <td><span class="badge badge-soft-primary">{{ $member->roleLabel() }}</span></td>
                                        <td>
                                            @if ($member->status)
                                                <span class="badge badge-soft-success">Active</span>
                                            @else
                                                <span class="badge badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.partials.table-actions', [
                                                'permissionPrefix' => 'staff',
                                                'editUrl' => route('admin.staff.edit', $member),
                                                'deleteUrl' => $member->isSuperAdmin() || $member->id === auth()->id() ? null : route('admin.staff.destroy', $member),
                                                'deleteTitle' => 'Delete staff member?',
                                                'deleteText' => 'This staff account will be permanently removed.',
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
            const table = document.querySelector('#datatable_staff');
            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50],
                    labels: {
                        placeholder: 'Search staff...',
                        noRows: 'No staff members found.',
                        noResults: 'No matching staff found.',
                    },
                });
            }
        });
    </script>
@endpush
