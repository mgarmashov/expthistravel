<!-- MOBILE MENU -->
<section>
    <div class="ed-mob-menu">
        <div class="ed-mob-menu-con">
            <div class="ed-mm-left">
                <div class="wed-logo">
                    <a href="{{route('index')}}">
{{--                        <img src="{{ asset('images/logo_500.png') }}" alt="" />--}}
                        <img src="{{ asset('images/logo4.png') }}" alt="" />
                    </a>
                </div>
            </div>
            <div class="ed-mm-right">
                <div class="ed-mm-menu">
                    <a href="#!" class="ed-micon"><i class="fa fa-bars"></i></a>
                    <div class="ed-mm-inn">
                        <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>
                        <h4>Home pages</h4>
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="btn-get-started btn-get-started-mobile"><a href="{{route('quiz-part1')}}">Get started</a></li>
                            <li><a href="{{route('experiences')}}">Experiences</a></li>
                            <li><a href="{{route('contacts')}}">Contact</a></li>
                            @if($about = \App\Models\Page::getPage('about'))
                                <li><a href="{{route($about->slug)}}">{{ $about->name }}</a></li>
                            @endif
                        </ul>
                        <h4>User pages</h4>
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
                </div>
            </div>
        </div>
    </div>
</section>