@php
    $navItems = [
        ['label' => 'Home', 'url' => url('/'), 'active' => request()->is('/')],
        ['label' => 'About', 'url' => route('about'), 'active' => request()->routeIs('about')],
        ['label' => 'Rooms', 'url' => route('rooms'), 'active' => request()->routeIs('rooms*')],
        ['label' => 'Facilities', 'url' => route('facilities'), 'active' => request()->routeIs('facilities')],
        ['label' => 'Gallery', 'url' => route('gallery'), 'active' => request()->routeIs('gallery')],
        ['label' => 'Team', 'url' => route('experts'), 'active' => request()->routeIs('experts*')],
        ['label' => 'Blog', 'url' => route('blog'), 'active' => request()->routeIs('blog*')],
        ['label' => 'FAQ', 'url' => route('faq'), 'active' => request()->routeIs('faq')],
        ['label' => 'Contact', 'url' => route('contact'), 'active' => request()->routeIs('contact')],
    ];
@endphp

<header class="site-header">
    <div class="rx-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rx-inner-menu-desk">
                        <a href="{{ url('/') }}" class="rx-header-btn" aria-label="{{ $siteName }}">
                            <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}">
                        </a>
                        <button class="navbar-toggler shadow-none rx-toggle-menu" type="button"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-2-line"></i>
                        </button>
                        <div class="rx-main-menu" id="navbarSupportedContent">
                            <ul class="site-nav">
                                @foreach ($navItems as $item)
                                    @if (! empty($item['children']))
                                        <li class="nav-item rx-dropdown {{ $item['active'] ? 'active' : '' }}">
                                            <a class="nav-link rx-dropdown-item {{ $item['active'] ? 'active' : '' }}" href="javascript:void(0)">{{ $item['label'] }}</a>
                                            <ul class="rx-dropdown-menu">
                                                @foreach ($item['children'] as $child)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ $child['url'] }}">{{ $child['label'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link {{ $item['active'] ? 'active' : '' }}" href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
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
            <button type="button" class="rx-close-menu" aria-label="Close menu">&times;</button>
        </div>
        <div class="rx-menu-inner">
            <div class="rx-menu-contact">
                <div class="rx-mobile-contact-bar">
                    @if ($sitePhone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}"><i class="ri-phone-line"></i>{{ $sitePhone }}</a>
                    @endif
                    @if ($siteEmail)
                        <a href="mailto:{{ $siteEmail }}"><i class="ri-mail-line"></i>{{ $siteEmail }}</a>
                    @endif
                </div>
                <ul>
                    @foreach ($navItems as $item)
                        @if (! empty($item['children']))
                            <li>
                                <a href="javascript:void(0)">{{ $item['label'] }}</a>
                                <ul class="sub-menu">
                                    @foreach ($item['children'] as $child)
                                        <li><a href="{{ $child['url'] }}">{{ $child['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                        @endif
                    @endforeach
                </ul>
                <a href="javascript:void(0)" class="rx-btn-one rx-mobile-book-btn" data-bs-toggle="modal" data-bs-target="#rx_booking_from">Book Now</a>
            </div>
        </div>
    </div>
</header>
