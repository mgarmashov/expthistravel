<!--HEADER SECTION-->
<section  data-spy="affix" data-offset-top="250">
    <!-- TOP BAR -->
    <div class="ed-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-btns">
                        <ul>
                            @guest
                                <li class="with-counter">
                                    <a class="bright" href="{{ route('orderPage') }}">&nbsp;<i class="fa fa-shopping-cart"></i>&nbsp;
                                    </a>
                                    <span id="order-counter" data-total="{{session('cart') ? count(session('cart')) : 0 }}">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                                </li>
                                <li>
                                    <a class="medium" href="{{ route('login') }}">Sign In / Register</a>
                                </li>
                                {{--<li>--}}
                                    {{--<a class="nav-link dark" href="{{ route('register') }}">Sign Up</a>--}}
                                {{--</li>--}}
                            @else
                                <li class="with-counter">
                                    <a class="bright" href="{{ route('orderPage') }}">&nbsp;<i class="fa fa-shopping-cart"></i>&nbsp;
                                    </a>
                                    <span id="order-counter" data-total="{{ count(Auth::user()->products()->get()) }}">{{ count(Auth::user()->products()->get()) }}</span>
                                </li>
                                <li>
                                    <a class="medium" href="{{ route('profile.products') }}">{{Auth::user()->name ?? Auth::user()->email}} - Profile</a>
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
                            <li><a href="{{ config('socials.facebook.url') }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                            <li><a href="{{ config('socials.instagram.url') }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
                            <li><a href="{{ config('socials.twitter.url') }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGO AND MENU SECTION -->
    <div class="top-logo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wed-logo">
{{--                        <a href="{{route('index')}}"><img src="{{ asset('images/logo_500.png') }}" alt="" />--}}
                        {{--<a href="{{route('index')}}"><img src="{{ asset('images/logo4.png') }}" alt="" />--}}
                        <a href="{{route('index')}}"><img src="{{ asset('images/logos/ExperienceThisTravel-Logo-Grey.svg') }}" alt="" />
                        </a>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="btn-get-started"><a href="{{route('quiz-step0')}}">Get started</a></li>
                            <li><a href="{{route('experiences')}}">Experiences</a></li>
{{--                            <li><a href="{{route('itineraries')}}">Itineraries</a></li>--}}
                            <li><a href="{{route('contacts')}}">Contact</a></li>
                            @if($page = \App\Models\Page::getPage('about'))
                                <li><a href="{{route('index') .'/'. $page->slug }}">{{ $page->name }}</a></li>
                            @endif
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END HEADER SECTION-->
