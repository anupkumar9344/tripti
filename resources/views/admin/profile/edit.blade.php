@extends('admin.layouts.app')

@section('title', 'My Profile')

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
            <div class="card">
                <div class="card-body">
                    <div class="met-profile">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="met-profile-main">
                                    <div class="met-profile-main-pic">
                                        <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}" height="110" class="rounded-circle">
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name">{{ $user->name }}</h5>
                                        <p class="mb-0 met-user-name-post">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled personal-detail mb-0">
                                    <li><i class="las la-user text-secondary font-22 align-middle me-2"></i> <b>Name</b> : {{ $user->name }}</li>
                                    <li class="mt-2"><i class="las la-envelope text-secondary font-22 align-middle me-2"></i> <b>Email</b> : {{ $user->email }}</li>
                                </ul>
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
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="name">Name</label>
                            <div class="col-lg-8 col-xl-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="email">Email</label>
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
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="image">Profile Image</label>
                            <div class="col-lg-8 col-xl-9">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="form-text text-muted font-12">Upload a square image for best results. Max 2MB.</span>
                            </div>
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-lg-8 col-xl-9 offset-lg-4 offset-xl-3">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
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
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="current_password">Current Password</label>
                            <div class="col-lg-8 col-xl-9">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter current password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="password">New Password</label>
                            <div class="col-lg-8 col-xl-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-xl-3 col-lg-4 text-lg-end mb-lg-0 align-self-center form-label" for="password_confirmation">Confirm Password</label>
                            <div class="col-lg-8 col-xl-9">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
                            </div>
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-lg-8 col-xl-9 offset-lg-4 offset-xl-3">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
