<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Dashboard') - Sahaj Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-media.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>
<body id="body" class="dark-sidebar">

    <!-- Sidebar -->
    <div class="left-sidebar">
        <div class="brand">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('images/logo/logo.webp') }}" alt="Sahaj Aarogyam" class="admin-sidebar-logo">
            </a>
        </div>

        <div class="sidebar-user-pro media border-end">
            <div class="position-relative mx-auto">
                <img src="{{ auth()->user()->avatarUrl() }}" alt="user" class="rounded-circle thumb-md">
                <span class="online-icon position-absolute end-0"><i class="mdi mdi-record text-success"></i></span>
            </div>
            <div class="media-body ms-2 user-detail align-self-center">
                <h5 class="font-14 m-0 fw-bold">{{ auth()->user()->name }}</h5>
                <p class="opacity-50 mb-0">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="menu-content h-100" data-simplebar>
            <div class="menu-body navbar-vertical">
                <ul class="navbar-nav">
                    <li class="menu-label mt-0 text-primary font-12 fw-semibold">M<span>enu</span></li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="ti ti-smart-home menu-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-label mt-0 text-primary font-12 fw-semibold">C<span>ontent</span></li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                            <i class="ti ti-briefcase menu-icon"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.treatments.*') ? 'active' : '' }}" href="{{ route('admin.treatments.index') }}">
                            <i class="ti ti-medical-cross menu-icon"></i>
                            <span>Treatments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        @php
                            $teamMenuOpen = request()->routeIs('admin.experts.*') || request()->routeIs('admin.expert-profile-categories.*');
                        @endphp
                        <a
                            class="nav-link"
                            href="#sidebarTeam"
                            data-bs-toggle="collapse"
                            role="button"
                            aria-expanded="{{ $teamMenuOpen ? 'true' : 'false' }}"
                            aria-controls="sidebarTeam"
                        >
                            <i class="ti ti-users menu-icon"></i>
                            <span>Team</span>
                        </a>
                        <div class="collapse {{ $teamMenuOpen ? 'show' : '' }}" id="sidebarTeam">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.experts.*') ? 'active' : '' }}" href="{{ route('admin.experts.index') }}">Team Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.expert-profile-categories.*') ? 'active' : '' }}" href="{{ route('admin.expert-profile-categories.index') }}">Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                            <i class="ti ti-mail menu-icon"></i>
                            <span>Contact Messages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}" href="{{ route('admin.about.edit') }}">
                            <i class="ti ti-info-circle menu-icon"></i>
                            <span>About Us</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.why-choose-items.*') ? 'active' : '' }}" href="{{ route('admin.why-choose-items.index') }}">
                            <i class="ti ti-star menu-icon"></i>
                            <span>Why Choose Us</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}" href="{{ route('admin.media.index') }}">
                            <i class="ti ti-photo menu-icon"></i>
                            <span>Media Library</span>
                        </a>
                    </li>
                    <li class="menu-label mt-0 text-primary font-12 fw-semibold">S<span>ettings</span></li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}" href="{{ route('admin.settings.general') }}">
                            <i class="ti ti-settings menu-icon"></i>
                            <span>General Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
                            <i class="ti ti-user menu-icon"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <nav class="navbar-custom" id="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">
                <li>
                    <a class="nav-link arrow-none nav-icon" href="{{ url('/') }}" target="_blank" title="View Website" aria-label="View Website">
                        <i class="ti ti-world"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <img src="{{ auth()->user()->avatarUrl() }}" alt="profile-user" class="rounded-circle me-2 thumb-sm" />
                            <div>
                                <small class="d-none d-md-block font-11">Admin</small>
                                <span class="d-none d-md-block fw-semibold font-12">{{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                            <i class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="page-content-tab">
            <div class="container-fluid">
                @include('admin.partials.alerts')

                @yield('content')
            </div>

            <footer class="footer text-center text-sm-start">
                &copy; {{ date('Y') }} Sahaj Admin
            </footer>
        </div>
    </div>

    @include('admin.media.partials.preview-modal')
    @include('admin.media.partials.rename-modal')

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/admin-confirm.js') }}"></script>
    <script>
        window.SahajMediaConfig = {
            browseUrl: @json(route('admin.media.browse')),
            uploadUrl: @json(route('admin.media.store')),
            updateUrlTemplate: @json(route('admin.media.update', ['mediaFile' => '__MEDIA__'])),
            deleteUrlTemplate: @json(route('admin.media.destroy', ['mediaFile' => '__MEDIA__'])),
            downloadUrlTemplate: @json(route('admin.media.download', ['mediaFile' => '__MEDIA__'])),
            csrfToken: @json(csrf_token()),
        };
    </script>
    <script src="{{ asset('admin/assets/js/media-manager.js') }}"></script>
    @stack('scripts')
</body>
</html>
