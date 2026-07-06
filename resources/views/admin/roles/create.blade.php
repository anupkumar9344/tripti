@extends('admin.layouts.app')

@section('title', 'Add Role')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Role</h4>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Role Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label class="form-label" for="name">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Front Desk Manager" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mt-3 admin-form-actions">
                            <button type="submit" class="btn btn-primary w-100">Save Role</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-light w-100 mt-2">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card permission-role-card">
                    <div class="card-header d-flex align-items-start justify-content-between gap-3">
                        <div>
                            <h4 class="card-title mb-1">Permissions</h4>
                            <p class="text-muted font-13 mb-0">Choose what this role can view, create, edit, and delete in the admin panel.</p>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        @error('permissions')<div class="alert alert-danger font-13">{{ $message }}</div>@enderror
                        @include('admin.partials.permission-groups', [
                            'permissionSections' => $permissionSections,
                            'selectedPermissions' => $selectedPermissions,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
