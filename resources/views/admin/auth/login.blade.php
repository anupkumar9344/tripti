<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin Login - Tripti Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ $siteFaviconUrl }}">
    <link rel="icon" href="{{ $siteFaviconUrl }}">
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/brand.css') }}" rel="stylesheet" type="text/css" />
    @include('admin.partials.theme-vars')
</head>
<body id="body" class="admin-auth-page admin-auth-page--hotel admin-auth-page--split">
    <div class="admin-auth-wrapper">
        <div class="admin-auth-form-panel">
            <div class="admin-auth-form-shell">
                <div class="admin-auth-main">
                    <div class="admin-auth-card-header">
                        <span class="admin-auth-badge">Hotel Admin Panel</span>
                        <h2>Welcome back</h2>
                        <p>Sign in to manage rooms, bookings, and hotel content.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger admin-auth-alert" role="alert">
                            <i class="ti ti-alert-circle"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form class="admin-auth-form" action="{{ route('admin.login.submit') }}" method="POST" id="adminLoginForm">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email address</label>
                            <div class="admin-auth-input-group admin-auth-input-group--icon-right @error('email') is-invalid @enderror">
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="admin@triptihotel.com"
                                    autocomplete="email"
                                    required
                                    autofocus
                                >
                                <span class="admin-auth-input-icon admin-auth-input-icon--right"><i class="ti ti-mail"></i></span>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Password</label>
                            <div class="admin-auth-input-group admin-auth-input-group--icon-right @error('password') is-invalid @enderror">
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    id="password"
                                    placeholder="Enter your password"
                                    autocomplete="current-password"
                                    required
                                >
                                <button type="button" class="admin-auth-toggle-password" id="togglePassword" aria-label="Show password">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check form-switch form-switch-success mb-0">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary admin-auth-submit" type="submit" id="loginSubmitBtn">
                                <span class="admin-auth-submit-text">Sign In to Dashboard</span>
                                <span class="admin-auth-submit-loader d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Signing in...
                                </span>
                                <i class="ti ti-arrow-right ms-1 admin-auth-submit-icon"></i>
                            </button>
                        </div>
                    </form>

                    <p class="admin-auth-footer-note mb-0">
                        Secure access for authorized hotel staff only.
                    </p>
                </div>
            </div>
        </div>

        <div class="admin-auth-brand">
            <div class="admin-auth-brand-panel">
                <div class="admin-auth-brand-visual">
                    <img
                        src="{{ asset('assets/img/amenities/1.jpg') }}"
                        alt="Tripti Hotel"
                        class="admin-auth-brand-image"
                    >
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const loginForm = document.getElementById('adminLoginForm');
            const submitBtn = document.getElementById('loginSubmitBtn');

            if (toggleButton && passwordInput) {
                toggleButton.addEventListener('click', function () {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    toggleButton.innerHTML = isPassword
                        ? '<i class="ti ti-eye-off"></i>'
                        : '<i class="ti ti-eye"></i>';
                    toggleButton.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                });
            }

            if (loginForm && submitBtn) {
                loginForm.addEventListener('submit', function () {
                    submitBtn.disabled = true;
                    submitBtn.querySelector('.admin-auth-submit-text')?.classList.add('d-none');
                    submitBtn.querySelector('.admin-auth-submit-loader')?.classList.remove('d-none');
                    submitBtn.querySelector('.admin-auth-submit-icon')?.classList.add('d-none');
                });
            }
        });
    </script>
</body>
</html>
