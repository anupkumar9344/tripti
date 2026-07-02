<header>
    <div class="rx-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rx-inner-menu-desk">
                        <a href="{{ url('/') }}" class="rx-header-btn">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Tripti Hotel">
                        </a>
                        <button class="navbar-toggler shadow-none rx-toggle-menu" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-2-line"></i>
                        </button>
                        <div class="rx-main-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                                </li>
                                <li class="nav-item rx-dropdown">
                                    <a class="nav-link rx-dropdown-item" href="javascript:void(0)">Rooms</a>
                                    <ul class="rx-dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('rooms') }}">All Rooms</a></li>
                                        <li><a class="dropdown-item" href="{{ route('rooms.show') }}">Room Details</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                                </li>
                                <li class="nav-item rx-dropdown">
                                    <a class="nav-link rx-dropdown-item" href="javascript:void(0)">Pages</a>
                                    <ul class="rx-dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('team') }}">Team</a></li>
                                        <li><a class="dropdown-item" href="{{ route('facilities') }}">Facilities</a></li>
                                        <li><a class="dropdown-item" href="{{ route('faq') }}">FAQ</a></li>
                                        <li><a class="dropdown-item" href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
                                </li>
                            </ul>
                            <div class="header-button">
                                <a href="javascript:void(0)" class="rx-btn-one" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rx-mobile-menu-overlay"></div>
    <div id="rx-mobile-menu" class="rx-mobile-menu">
        <div class="rx-menu-title">
            <span class="menu_title">Menu</span>
            <button type="button" class="rx-close-menu">&times;</button>
        </div>
        <div class="rx-menu-inner">
            <div class="rx-menu-contact">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li>
                        <a href="javascript:void(0)">Rooms</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('rooms') }}">All Rooms</a></li>
                            <li><a href="{{ route('rooms.show') }}">Room Details</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li>
                        <a href="javascript:void(0)">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('team') }}">Team</a></li>
                            <li><a href="{{ route('facilities') }}">Facilities</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
