@extends('frontend.layouts.main')


@section('title', $title.' | '.env('APP_NAME'))

@push('seo')
    @if($description)
        <meta name="description" content="{!!  $description !!}">
        <meta property="og:description" content="{!! $description !!}"/>
    @endif

    @if($keywords)
        <meta name="keywords" content="{{ $keywords }}">
    @endif
@endpush


@if(!empty($image))
    @section('og-image'){{ asset($image) }}@endsection
@endif

@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h1>{{ $h1 }}</h1>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                </div>
                <div class="wysiwyg-content col-xs-10 col-xs-offset-1">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </section>

@endsection