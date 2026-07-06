@php
    use App\Support\AdminPermissions;
    $isEdit = isset($staff);
    $selectedRole = old('role', $isEdit ? $staff->roles->first()?->name : '');
    $statusValue = (string) old('status', $isEdit ? (int) $staff->status : 1);
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $staff->name ?? '') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $staff->email ?? '') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="password">Password @if(!$isEdit)<span class="text-danger">*</span>@endif</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" @if(!$isEdit) required @endif>
            @if ($isEdit)
                <span class="form-text text-muted font-12">Leave blank to keep the current password.</span>
            @endif
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="password_confirmation">Confirm Password @if(!$isEdit)<span class="text-danger">*</span>@endif</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" @if(!$isEdit) required @endif>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="role">Role <span class="text-danger">*</span></label>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required @if($isEdit && $staff->isSuperAdmin()) disabled @endif>
                <option value="">Select role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @selected($selectedRole === $role->name)>{{ $role->name }}</option>
                @endforeach
            </select>
            @if ($isEdit && $staff->isSuperAdmin())
                <input type="hidden" name="role" value="{{ AdminPermissions::SUPER_ADMIN_ROLE }}">
            @endif
            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required @if($isEdit && $staff->isSuperAdmin()) disabled @endif>
                <option value="1" @selected($statusValue === '1')>Active</option>
                <option value="0" @selected($statusValue === '0')>Inactive</option>
            </select>
            @if ($isEdit && $staff->isSuperAdmin())
                <input type="hidden" name="status" value="1">
            @endif
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group mb-0">
    @include('admin.media.partials.url-field', [
        'name' => 'image',
        'currentValue' => old('image', $isEdit ? ($staff->image ?? '') : ''),
        'label' => 'Profile Photo',
    ])
</div>
