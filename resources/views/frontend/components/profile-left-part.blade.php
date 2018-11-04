
    <div class="db-l-1">
        @if(Auth::user()->name())
            <h3>{{ Auth::user()->name() }}</h3>
        @endif
        @if(Auth::user()->email)
            <p><a href="">{{ Auth::user()->email }}</a></p>
        @endif
        @if(Auth::user()->phone)
            <p>+790383933</p>
        @endif

    </div>
    <div class="db-l-2">
        <ul>
            <li>
                <a href="#"><img src="{{ asset('images/icon/dbl2.png') }}" alt="" /> Experience in cart</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('images/icon/dbl1.png') }}" alt="" /> Orders </a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('images/icon/dbl6.png') }}" alt="" /> My Profile</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('images/icon/dbl7.png') }}" alt="" /> Travel interests scale </a>
            </li>
        </ul>
    </div>
