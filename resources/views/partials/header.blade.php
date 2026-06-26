<!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="{{ url('/') }}">
						<img src="{{ asset('images/logo/logo.webp') }}" alt="Sahaj Aarogyam">
					</a>
					<!-- Logo End -->

					<!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/about-us') }}">About us</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/treatment') }}">Treatment</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/services') }}">Services</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">More</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/our-expert-team') }}">Our expert team</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/health-programs') }}">Health programs</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/gallery') }}">Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/blog') }}">Blogs</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/contact-us') }}">Contact us</a></li>
                            </ul>
                        </div>
                        
                        <!-- Header Contact Btn Start -->
                        <div class="header-contact-btn">
                            <a href="#" class="btn-default js-book-appointment" data-bs-toggle="modal" data-bs-target="#bookAppointmentModal">Book Appointment</a>
                        </div>
                        <!-- Header Contact Btn End -->
					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
	<!-- Header End -->
