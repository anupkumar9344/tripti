@php
    $navItems = [
        ['label' => 'Home', 'url' => url('/'), 'active' => request()->is('/'), 'icon' => 'ri-home-4-line'],
        ['label' => 'About', 'url' => route('about'), 'active' => request()->routeIs('about'), 'icon' => 'ri-information-line'],
        ['label' => 'Rooms', 'url' => route('rooms'), 'active' => request()->routeIs('rooms*'), 'icon' => 'ri-hotel-bed-line'],
        ['label' => 'Gallery', 'url' => route('gallery'), 'active' => request()->routeIs('gallery'), 'icon' => 'ri-gallery-line'],
        ['label' => 'Careers', 'url' => route('careers'), 'active' => request()->routeIs('careers*'), 'icon' => 'ri-briefcase-line'],
        ['label' => 'Blog', 'url' => route('blog'), 'active' => request()->routeIs('blog*'), 'icon' => 'ri-article-line'],
        ['label' => 'FAQ', 'url' => route('faq'), 'active' => request()->routeIs('faq'), 'icon' => 'ri-question-answer-line'],
        ['label' => 'Contact', 'url' => route('contact'), 'active' => request()->routeIs('contact'), 'icon' => 'ri-customer-service-2-line'],
    ];
@endphp

<header class="site-header">
    <div class="rx-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="rx-inner-menu-desk">
                        <a href="{{ url('/') }}" class="rx-header-btn rx-header-logo" aria-label="{{ $siteName }}">
                            <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}">
                        </a>
                        <button class="navbar-toggler shadow-none rx-toggle-menu" type="button"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="rx-toggle-icon" aria-hidden="true"><i class="ri-menu-2-line"></i></span>
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
                                        <li class="nav-item {{ $item['active'] ? 'active' : '' }}">
                                            <a class="nav-link {{ $item['active'] ? 'active' : '' }}" href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="header-actions d-md-flex d-none">
                            @if ($sitePhone)
                                <a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}" class="header-phone-link">
                                    <i class="ri-phone-fill" aria-hidden="true"></i>
                                    <span>{{ $sitePhone }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rx-mobile-menu-overlay"></div>
    <div id="rx-mobile-menu" class="rx-mobile-menu">
        <div class="rx-mobile-menu-head">
            <a href="{{ url('/') }}" class="rx-mobile-menu-logo" aria-label="{{ $siteName }}">
                <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}">
            </a>
            <button type="button" class="rx-close-menu" aria-label="Close menu">
                <i class="ri-close-line" aria-hidden="true"></i>
            </button>
        </div>

        <div class="rx-menu-inner">
            <div class="rx-menu-contact">
                @if ($sitePhone || $siteEmail)
                    <div class="rx-mobile-contact-bar">
                        @if ($sitePhone)
                            <a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}" class="rx-mobile-contact-item">
                                <span class="rx-mobile-contact-icon"><i class="ri-phone-fill" aria-hidden="true"></i></span>
                                <span class="rx-mobile-contact-text">{{ $sitePhone }}</span>
                            </a>
                        @endif
                        @if ($siteEmail)
                            <a href="mailto:{{ $siteEmail }}" class="rx-mobile-contact-item">
                                <span class="rx-mobile-contact-icon"><i class="ri-mail-fill" aria-hidden="true"></i></span>
                                <span class="rx-mobile-contact-text">{{ $siteEmail }}</span>
                            </a>
                        @endif
                    </div>
                @endif

                <nav class="rx-mobile-nav" aria-label="Mobile navigation">
                    <ul class="rx-mobile-nav-list">
                        @foreach ($navItems as $item)
                            @if (! empty($item['children']))
                                <li class="rx-mobile-nav-item has-submenu">
                                    <a href="javascript:void(0)" class="rx-mobile-nav-link">
                                        <i class="{{ $item['icon'] ?? 'ri-arrow-right-s-line' }}" aria-hidden="true"></i>
                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach ($item['children'] as $child)
                                            <li><a href="{{ $child['url'] }}">{{ $child['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="rx-mobile-nav-item{{ $item['active'] ? ' active' : '' }}">
                                    <a href="{{ $item['url'] }}" class="rx-mobile-nav-link{{ $item['active'] ? ' active' : '' }}">
                                        <i class="{{ $item['icon'] ?? 'ri-arrow-right-s-line' }}" aria-hidden="true"></i>
                                        <span>{{ $item['label'] }}</span>
                                        <i class="ri-arrow-right-s-line rx-mobile-nav-arrow" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>

        <div class="rx-mobile-menu-foot">
            <a href="{{ route('booking') }}" class="rx-mobile-book-btn">
                <i class="ri-calendar-check-line" aria-hidden="true"></i>
                <span>Book Your Stay</span>
            </a>
        </div>
    </div>
</header>
