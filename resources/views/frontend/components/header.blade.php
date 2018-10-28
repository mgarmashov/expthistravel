<!--HEADER SECTION-->
<section>
    <!-- TOP BAR -->
    <div class="ed-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ed-com-t1-right">
                        <ul>
                            @guest
                                <li>
                                    <a href="{{ route('login') }}">Sign In</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('profile') }}">{{Auth::user()->name ?? Auth::user()->email}} - Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sign Out
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </ul>
                    </div>
                    <div class="ed-com-t1-social">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGO AND MENU SECTION -->
    <div class="top-logo" data-spy="affix" data-offset-top="250">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wed-logo">
                        <a href="{{route('index')}}"><img src="{{ asset('images/logo_500.png') }}" alt="" />
                        </a>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li><a href="#">Home</a>
                            </li>
                            <li class="about-menu">
                                <a href="family-package.html" class="mm-arr">Packages</a>
                                <!-- MEGA MENU 1 -->
                                <div class="mm-pos">
                                    <div class="about-mm m-menu">
                                        <div class="m-menu-inn">
                                            <div class="mm1-com mm1-s1">
                                                <div class="ed-course-in">
                                                    <a class="course-overlay menu-about" href="all-package.html">
                                                        <img src="images/sight/5.jpg" alt="">
                                                        <span>Popular Package</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mm1-com mm1-s2">
                                                <p>Want to change the world? At Berkeley we’re doing just that. When you join the Golden Bear community, you’re part of an institution that shifts the global conversation every single day.</p>
                                                <a href="all-package.html" class="mm-r-m-btn">Read more</a>
                                            </div>
                                            <div class="mm1-com mm1-s3">
                                                <ul>
                                                    <li><a href="booking-all.html">All Booking</a></li>
                                                    <li><a href="booking-tour-package.html">Tour Package Booking</a></li>
                                                    <li><a href="booking-hotel.html">Hotel Booking</a></li>
                                                    <li><a href="booking-car-rentals.html">Car Rentals Booking</a></li>
                                                    <li><a href="booking-flight.html">Flight Booking</a></li>
                                                    <li><a href="booking-slider.html">Slider Booking</a></li>
                                                </ul>
                                            </div>
                                            <div class="mm1-com mm1-s4">
                                                <ul>
                                                    <li><a href="all-package.html">All Package</a></li><li><a href="family-package.html">Family Package</a></li>
                                                    <li><a href="honeymoon-package.html">Honeymoon Package</a></li>
                                                    <li><a href="group-package.html">Group Package</a></li>
                                                    <li><a href="weekend-package.html">WeekEnd Package</a></li>
                                                    <li><a href="regular-package.html">Regular Package</a></li>
                                                    <li><a href="custom-package.html">Custom Package</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">Contact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END HEADER SECTION-->