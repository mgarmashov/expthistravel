@extends('frontend.layouts.main')

@php
    $title = !empty($article->seo_title) ? $article->seo_title : $article->name;
    $description = !empty($article->seo_description) ? $article->seo_description : (!empty($article->description_short) ? $article->description_short : mb_substr(strip_tags($article->description_long), 0, 160));
    $title = !empty($article->seo_h1) ? $article->seo_h1 : $article->name;
@endphp

@section('title')
    {{ $title }} | {{ env('APP_NAME') }}
@endsection

@push('seo')
    <meta name="description" content="{!!  $description !!}">
    <meta property="og:description" content="{!! $description !!}"/>

    @if(!empty($article->keywords))
        <meta name="keywords" content="{{ $article->keywords }}">
    @endif
@endpush


@if(!empty($article->image))
@section('og-image'){{ asset($article->image) }}@endsection
@endif


@push('after_styles')

@endpush

@section('content')

    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
                <!--===== POSTS ======-->
                <div class="rows">
                    <div class="posts">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if($article->image)<img src="{{ asset(cropImage($article->image, 550, 353)) }}" alt="{{ $article->name }}" /> @endif
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h3>{{ $article->name }}</h3>
                            <h5><span class="post_author">{{ $article->date()->format('jS \\of F, Y') }}</span></h5>
                            <div class="post-btn">
                                <ul>
                                    <li><a href="https://web.facebook.com/sharer/sharer.php?u={{ URL::current() }}"  target="_blank"><i class="fa fa-facebook fb1"></i> Share On Facebook</a>
                                    </li>
                                    <li><a href="https://twitter.com/intent/tweet?text={{ urlencode($article->name) }}&url={{ URL::current() }}&hashtags=ExperienceThisTravel" target="_blank"><i class="fa fa-twitter tw1"></i> Share On Twitter</a>
                                    </li>
                                </ul>
                            </div>
                            {{ $article->description_long }}
                    </div>
                </div>
                <!--===== POST END ======-->
                <div class="spe-title">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
                @include('frontend.components.section-popularTravelExperiences')
            </div>
        </div>
    </section>



@endsection

@push('after_scripts')

@endpush