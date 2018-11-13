<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ env('APP_NAME') }} @yield('title')</title>
    {{--<!--== META TAGS ==-->--}}
    <meta charset="utf-8">
    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{--<!-- FAV ICON -->--}}
    <link rel="shortcut icon" href="{{asset('images/favicon32.png')}}">
    {{--<!-- GOOGLE FONTS -->--}}
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">
    {{--<!-- FONT-AWESOME ICON CSS -->--}}
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    {{--<!--== ALL CSS FILES ==-->--}}
    @yield('before_styles')
    @stack('before_styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/mob.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/personal.css')}}">
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
                                <p>Travel Experiences Made For You. Travel Planning Made Easy</p>
                            </div>
                            <div class="col-sm-4 foot-spec foot-com">
                                <h4><span>SUPPORT</span> & HELP</h4>
                                <ul class="two-columns">
                                    <li> <a href="{{ route('quiz-part1') }}">Personalised Travel Inspiration</a> </li>
                                    <li> <a href="{{ route('experiences') }}">Experiences </a></li>
                                    <li> <a href="{{ route('bookingPage') }}">Plan My Trip</a></li>
                                    @if($about = \App\Models\Page::about())
                                        <li><a href="{{route($about->slug)}}">{{ $about->name }}</a></li>
                                    @endif
                                    {{--<li> <a href="{{ route('') }}">Blog</a></li>--}}
                                    {{--<li> <a href="{{ route('') }}">FAQ</a></li>--}}
                                    {{--<li> <a href="{{ route('') }}">Terms and Conditions</a></li>--}}
                                    <li> <a href="{{ route('login') }}">Sign In/ Register</a></li>
                                    <li> <a href="{{ route('contacts') }}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 foot-social foot-spec foot-com">
                                <h4><span>Follow</span> with us</h4>
                                <p>Get inspiration on your feed and share your travel experiences with us #ExperienceThis</p>
                                <ul>
                                    <li><a href="https://www.facebook.com/ExperienceThisTravel"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                                    <li><a href="https://www.instagram.com/experience_this_travel"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                                    <li><a href="https://twitter.com/ExperienceThisTravel"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                                </ul>
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
            <p>Copyrights © 2018 Company Name. All Rights Reserved</p>
        </div>
    </div>
</section>
{{--<section>--}}
    {{--<div class="icon-float">--}}
        {{--<ul>--}}
            {{--<li><a href="#" class="sh">1k <br> Share</a> </li>--}}
            {{--<li><a href="#" class="fb1"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>--}}
            {{--<li><a href="#" class="gp1"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>--}}
            {{--<li><a href="#" class="tw1"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>--}}
            {{--<li><a href="#" class="li1"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>--}}
            {{--<li><a href="#" class="wa1"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>--}}
            {{--<li><a href="#" class="sh1"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> </li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</section>--}}
<!--========= Scripts ===========-->
@yield('before_scripts')
@stack('before_scripts')
<script src="{{asset('js/jquery-latest.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/materialize.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
@yield('after_scripts')
@stack('after_scripts')
</body>

</html>