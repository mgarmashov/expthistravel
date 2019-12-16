@extends('frontend.layouts.main')

@section('title')Search | {{env('APP_NAME')}}@endsection

@push('after_styles')

@endpush

@section('content')

{{--    @include('frontend.components.filter-section')--}}

    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg container--products-list" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    {{--@if(isset($filter['applyScores']) && $filter['applyScores'] == 'yes')--}}
                        {{--<h2>Your <span>experiences</span></h2>--}}
                        {{--<div class="title-line">--}}
                            {{--<div class="tl-1"></div>--}}
                            {{--<div class="tl-2"></div>--}}
                            {{--<div class="tl-3"></div>--}}
                        {{--</div>--}}
                        {{--<p>Based on your interests and preferences. Handpicked for you</p>--}}
                    {{--@else--}}
                        <h2>All <span>itineraries</span></h2>
                        <div class="title-line">
                            <div class="tl-1"></div>
                            <div class="tl-2"></div>
                            <div class="tl-3"></div>
                        </div>
                        @if(!Auth::check() || !Auth::user()->totalScores)
                            <p>Discover our incredible range of travel experiences.</p>
                            <p>Get personalised travel inspiration here - <a class="link-large" href="{{ route('quiz-step1') }}">Get Started</a></p>
                        @endif
                    {{--@endif--}}

                </div>
                @include('frontend.components.list-itineraries')
            </div>
        </div>
    </section>

    @include('frontend.components.popup-googleForm')

@endsection

@push('after_scripts')

@endpush
