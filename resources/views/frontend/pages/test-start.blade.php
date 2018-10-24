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
                    <p>Choose the most pleasant way of pastime</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2">
                    @foreach(\App\Models\Activity::query()->inRandomOrder()->limit(2)->get() as $activity)
                        <div class="col-xs-6 b_packages">
                            <div class="v_place_img">
                                <img src="{{ cropImage($activity->image, 400, 500) }}" alt="" />
                            </div>
                            <div class="b_pack rows">
                                <div class="col-md-8 col-md-8">
                                    <h4>
                                        <a href="#">{{ $activity->name }}</a>
                                    </h4>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="spe-title col-md-12">
                    <a href="#">I'm not sure</a>
                </div>
            </div>
        </div>
    </section>
@endsection