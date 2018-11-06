<!--HEADER SECTION-->
<section>
    <!-- TOP BAR -->
    <div class="ed-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-btns">
                        <ul>
                            @guest
                                <li>
                                    <a class="bright" href="{{ route('orderPage') }}">&nbsp;<i class="fa fa-shopping-cart"></i>&nbsp;
                                    </a>
                                </li>
                                <li>
                                    <a class="medium" href="{{ route('login') }}">Sign In</a>
                                </li>
                                <li>
                                    <a class="nav-link dark" href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @else
                                <li class="with-counter">
                                    <a class="bright" href="{{ route('orderPage') }}">&nbsp;<i class="fa fa-shopping-cart"></i>&nbsp;
                                    </a>
                                    <span>{{ count(Auth::user()->products()->get()) }}</span>
                                </li>
                                <li>
                                    <a class="medium" href="{{ route('profile') }}">{{Auth::user()->name ?? Auth::user()->email}} - Profile</a>
                                </li>
                                <li>
                                    <a class="dark" href="{{ route('logout') }}"
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
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
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
                            {{--<li><a href="{{ route('index') }}">Home</a></li>--}}
                            <li><a href="{{route('experiences')}}">Experiences</a></li>
                            <li><a href="{{route('how-we-work')}}">How we work</a></li>
                            <li><a href="{{route('contacts')}}">Contact us</a></li>
                            <li class="yellow"><a href="{{route('quiz-part1')}}">Find the best trip</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END HEADER SECTION-->