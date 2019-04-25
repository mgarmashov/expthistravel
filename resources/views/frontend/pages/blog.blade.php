@extends('frontend.layouts.main')

@section('title')Blog | {{env('APP_NAME')}}@endsection

@push('after_styles')

@endpush

@section('content')
    <!--====== BANNER ==========-->
    <section>
        <div class="rows inner_banner" @include('frontend.components.randomBgStyle')>
            <div class="container">
                <h2><a href="{{ route('blog') }}"><span>Blog Posts</span></a></h2>
                {{--<ul>--}}
                {{--<li><a href="{{ route('blog') }}">Travel Insights</a> </li>--}}
                {{--<li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>--}}
                {{--<li><a href="{{ url()->current() }}" class="bread-acti">{{ $title }}</a> </li>--}}
                {{--</ul>--}}
                <p>Travel insights from the team at Experience This</p>
            </div>
        </div>
    </section>
    <!--====== ALL POST ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg pad-bot-redu-5" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h1>Travel Insights</h1>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                </div>
                <!--===== POSTS ======-->
                <div class="rows">
                    @foreach($articles as $article)
                        <div class="posts">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if($article->image)<img src="{{ asset(cropImage($article->image, 550, 353)) }}" alt="{{ $article->name }}" /> @endif
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="{{ route('article', ['slug' => $article->slug ?? $article->id]) }}">
                                    <h3>{{ $article->name }}</h3>
                                </a>
                                <h5><span class="post_author">{{ $article->date()->format('j F Y') }}</span></h5>
                                <p>{!! $article->description_short !!}</p>
                                <a href="{{ route('article', ['slug' => $article->slug ?? $article->id]) }}" class="link-btn">Read more</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--===== POST END ======-->

                <div class="spe-title inside-container margin20">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
                <h2 class="center-align margin40" style="font-size: 36px">Popular travel <span class="red-text">experiences</span></h2>
                @include('frontend.components.section-popularTravelExperiences')
            </div>

        </div>

    </section>


@endsection

@push('after_scripts')

@endpush