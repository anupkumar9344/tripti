@extends('admin.layouts.app')

@section('title', 'My Profile')

@php
    $memberSince = $user->created_at?->format('d M Y');
@endphp

@push('styles')
    <link href="{{ asset('admin/assets/css/admin-profile.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">My Profile</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card admin-profile-card">
                <div class="card-body">
                    <div class="met-profile">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="met-profile-main">
                                    <div class="met-profile-main-pic admin-profile-avatar-wrap">
                                        <img
                                            src="{{ $user->avatarUrl() }}"
                                            alt="{{ $user->name }}"
                                            height="110"
                                            class="rounded-circle admin-profile-avatar-preview"
                                            id="profileAvatarPreview"
                                        >
                                        <label for="profileImageInput" class="met-profile_main-pic-change" title="Change profile photo">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name">{{ $user->name }}</h5>
                                        <p class="mb-0 met-user-name-post">Administrator</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 ms-auto align-self-center">
                                <ul class="list-unstyled personal-detail mb-0">
                                    <li>
                                        <i class="las la-user text-secondary font-22 align-middle me-2"></i>
                                        <b>Name</b> : {{ $user->name }}
                                    </li>
                                    <li class="mt-2">
                                        <i class="las la-envelope text-secondary font-22 align-middle me-2"></i>
                                        <b>Email</b> : {{ $user->email }}
                                    </li>
                                    <li class="mt-2">
                                        <i class="las la-calendar text-secondary font-22 align-middle me-2"></i>
                                        <b>Member Since</b> : {{ $memberSince }}
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-4 align-self-center">
                                <div class="row justify-content-lg-end">
                                    <div class="col-auto text-end border-end">
                                        <span class="btn btn-soft-primary btn-icon-circle btn-icon-circle-sm mb-2">
                                            <i class="ti ti-shield-check"></i>
                                        </span>
                                        <p class="mb-0 fw-semibold">Role</p>
                                        <h4 class="m-0 fw-bold font-18">Admin</h4>
                                    </div>
                                    <div class="col-auto">
                                        <span class="btn btn-soft-success btn-icon-circle btn-icon-circle-sm mb-2">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <p class="mb-0 fw-semibold">Status</p>
                                        <h4 class="m-0 fw-bold font-18">
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Personal Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileUpdateForm">
                        @csrf
                        @method('PUT')

                        <input type="file" class="d-none" id="profileImageInput" name="image" accept="image/*">

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="name">Name</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="las la-user"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your name" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="email">Email Address</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="las la-at"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your email" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label">Profile Photo</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="admin-profile-upload-box">
                                    <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}" class="admin-profile-upload-preview rounded-circle" id="profileUploadPreview">
                                    <div class="flex-grow-1 min-w-0">
                                        <label for="profileImageInput" class="btn btn-sm btn-outline-primary mb-2">Choose Image</label>
                                        <p class="text-muted font-12 mb-0">Upload a square image for best results. Max 2MB.</p>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-lg-8 col-xl-9 offset-lg-4 offset-xl-3 admin-form-actions">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-light ms-1">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.password') }}" method="POST" id="profilePasswordForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="current_password">Current Password</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="admin-profile-password-field">
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter current password" required>
                                    <button type="button" class="admin-profile-password-toggle" data-target="current_password" aria-label="Show password">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="password">New Password</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="admin-profile-password-field">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password" required>
                                    <button type="button" class="admin-profile-password-toggle" data-target="password" aria-label="Show password">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="password_confirmation">Confirm Password</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="admin-profile-password-field">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
                                    <button type="button" class="admin-profile-password-toggle" data-target="password_confirmation" aria-label="Show password">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-lg-8 col-xl-9 offset-lg-4 offset-xl-3 admin-form-actions">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                                <button type="reset" class="btn btn-light ms-1">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('profileImageInput');
            const avatarPreview = document.getElementById('profileAvatarPreview');
            const uploadPreview = document.getElementById('profileUploadPreview');

            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    const file = imageInput.files?.[0];

                    if (!file) {
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        if (avatarPreview) {
                            avatarPreview.src = event.target.result;
                        }
                        if (uploadPreview) {
                            uploadPreview.src = event.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                });
            }

            document.querySelectorAll('.admin-profile-password-toggle').forEach(function (button) {
                button.addEventListener('click', function () {
                    const input = document.getElementById(button.dataset.target);

                    if (!input) {
                        return;
                    }

                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    button.innerHTML = isPassword
                        ? '<i class="ti ti-eye-off"></i>'
                        : '<i class="ti ti-eye"></i>';
                    button.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                });
            });
        });
    </script>
@endpush
