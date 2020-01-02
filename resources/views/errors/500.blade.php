@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="form form-spac">
            <div class="rows container">
                <div class="nf">Server Error</div>
                <div class="nf1">500</div>
                <div class="links">
                    <p>Sorry. There is some error. Please try again or send error message to developer team.</p>
                    @php
                    $default_error_message = "Error is unfamiliar... If the error persists please contact the development team:";
                    @endphp
                    {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}

                    <h4>Top Website Pages</h4>
                    <ul>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        @if($page = \App\Models\Page::getPage('about'))
                            <li><a href="{{route('index') .'/'. $page->slug }}">{{ $page->name }}</a></li>
                        @endif
                        <li><a href="{{route('contacts')}}">Contact us</a></li>
                    </ul>
                    <ul>
                        @guest
                            <li><a href="{{ route('login') }}">Sign In</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                        @else
                            <li><a href="{{ route('profile.products') }}">Profile</a></li>
                            <li><a href="{{ route('logout') }}"
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
    </section>

@endsection
