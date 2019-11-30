<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title', env('APP_NAME'))</title>
    {{--<!--== META TAGS ==-->--}}
    <meta charset="utf-8">
    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @if(env('google_site_verification'))
        <meta name="google-site-verification" content="{{ env('google_site_verification') }}" />
    @endif
    @stack('seo')
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}"/>
    <meta property="og:title" content="@yield('title',  env('APP_NAME') )" />
    <meta property="og:url" content="{{ url()->full() }}"/>
    <meta property="og:image" content="@yield('og-image', asset('images/favicon2.png'))"/>
    <meta property="og:image:secure_url" itemprop="image" content="@yield('og-image', asset('images/favicon2.png'))" />
    <meta property="fb:admins" content="373637163058493"/>

    {{--<!-- FAV ICON -->--}}
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}">
    {{--<!-- GOOGLE FONTS -->--}}
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">
    {{--<!-- FONT-AWESOME ICON CSS -->--}}
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    {{--<!--== ALL CSS FILES ==-->--}}
    @yield('before_styles')
    @stack('before_styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}?v={{ filemtime(public_path('css/materialize.css')) }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}?v={{ filemtime(public_path('css/style.css')) }}">
    <link rel="stylesheet" href="{{asset('css/mob.css')}}?v={{ filemtime(public_path('css/mob.css')) }}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/personal.css')}}?v={{ filemtime(public_path('css/personal.css')) }}">
    @yield('after_styles')
    @stack('after_styles')
    {{--<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->--}}
    {{--<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->--}}
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
@include('frontend.components.preloader')

@include('frontend.components.mobile-menu')

@include('frontend.components.header')

@yield('content')


<!--====== FOOTER 2 ==========-->
<section>
    <div class="rows">
        <div class="footer">
            <div class="container">
                <div class="foot-sec2">
                    <div>
                        <div class="row">
                            <div class="col-sm-4 foot-spec foot-com">
                                <h4><span>Experience</span> This Travel</h4>
                                <p>Travel Experiences Made For You.</p>
                            </div>
                            <div class="col-sm-4 foot-spec foot-com">
                                <h4><span>SUPPORT</span> & HELP</h4>
                                <ul class="one-column">
                                    <li> <a href="{{ route('quiz-step0') }}">Inspire Me</a> </li>
                                    <li> <a href="{{ route('experiences') }}">Experiences </a></li>
                                    <li> <a href="{{ route('bookingPage') }}">Plan My Trip</a></li>
                                    <li> <a href="{{ route('blog') }}">Travel Insights</a></li>
                                    @foreach (\App\Models\Page::orderBy('updated_at', 'desc')->get() as $page)
                                        <li><a href="{{route('index') .'/'. $page->slug }}">{{ $page->name }}</a></li>
                                    @endforeach

                                    {{--<li> <a href="{{ route('') }}">Blog</a></li>--}}
                                    {{--<li> <a href="{{ route('') }}">FAQ</a></li>--}}
                                    {{--<li> <a href="{{ route('') }}">Terms and Conditions</a></li>--}}
                                    <li> <a href="{{ route('login') }}">Sign In/ Register</a></li>
                                    <li> <a href="{{ route('contacts') }}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 foot-social foot-spec foot-com">
                                <h4><span>Follow</span> us</h4>
                                <p>Get inspiration on your feed and share your travel experiences with us #ExperienceThis</p>
                                <ul>
                                    <li><a href="{{ config('socials.facebook.url') }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                                    <li><a href="{{ config('socials.instagram.url') }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
                                    <li><a href="{{ config('socials.twitter.url') }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                                </ul>
                                <div class="clearfix"></div>
                                @stack('popup-btn')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== FOOTER - COPYRIGHT ==========-->
<section>
    <div class="rows copy">
        <div class="container">
            <p>Experience This Travel © {{ \Carbon\Carbon::now()->year >='2019' ? \Carbon\Carbon::now()->year : 2019 }}</p>
        </div>
    </div>
</section>

<!--========= Scripts ===========-->
@yield('before_scripts')
@stack('before_scripts')
@if(env('APP_URL') == env('PROD_URL'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('gtag', 'UA-129822952-1') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('gtag', 'UA-129822952-1') }}');
    </script>
@endif
<script src="{{asset('js/jquery-latest.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/materialize.min.js')}}?v={{ filemtime(public_path('js/materialize.min.js')) }}"></script>
<script>
    const productToOrder = "{{ route('productToOrder')}}";
    const orderPage = "{{ route('orderPage')}}";
</script>
<script src="{{asset('js/custom.js')}}?v={{ filemtime(public_path('js/custom.js')) }}"></script>
@yield('after_scripts')
@stack('after_scripts')
</body>

</html>
