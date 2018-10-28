@extends('frontend.layouts.main')

@section('content')
  <section>
    <div class="form form-spac">
      <div class="rows container">
        <div class="nf">Page Not Found</div>
        <div class="nf1">404</div>
        <div class="links">
          <h4>Top Website Pages</h4>
          <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{route('how-we-work')}}">How we work</a></li>
            <li><a href="{{route('contacts')}}">Contact us</a></li>
          </ul>
          <ul>
            @guest
              <li><a href="{{ route('login') }}">Sign In</a></li>
              <li><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
            @else
              <li><a href="{{ route('profile') }}">Profile</a></li>
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