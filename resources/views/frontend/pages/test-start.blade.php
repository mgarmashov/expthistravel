@extends('frontend.layouts.main')

@section('content')
    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Answer few questions</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Press if you like things on picture</p>
                    <p>1/25</p>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    @php
                        $activity = \App\Models\Activity::query()->inRandomOrder()->first();
                    @endphp

                        <div class="col-xs-12 quiz-question">
                            <div class="v_place_img">
                                <img src="{{ cropImage($activity->image, 700, 400) }}" alt="" />
                            </div>
                            <div class="b_pack rows text-center">
                                <div class="col-md-8 col-md-offset-2">
                                    <h4>
                                        <a href="#">{{ $activity->name }}</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-xs-2 btn-quiz dislike">
                                <img src="{{ asset('images/icon-thumb-down.png') }}" alt="">
                            </div>
                            <div class="col-xs-2 btn-quiz like">
                                <img src="{{ asset('images/icon-thumb-up.png') }}" alt="">
                            </div>
                        </div>
                </div>
                <div class="spe-title col-sm-8 col-sm-offset-2">
                    <a href="#">I'm not sure</a>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('after_scripts')

@endpush