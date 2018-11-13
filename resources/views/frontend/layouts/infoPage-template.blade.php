@extends('frontend.layouts.main')


@section('title')
    | {{ $title }}
@endsection

@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>{{ $title }}</h2>
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