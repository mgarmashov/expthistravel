@extends('frontend.layouts.main')

@section('title')
    | Optimal tours
@endsection

@push('after_styles')
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />--}}
@endpush

@section('content')

    <!--====== PLACES ==========-->
    <section class="charts-section">
        <div class="container">
            <div class="application-layout">

                @auth
                <h4>Your top interests</h4>
                    <div class="charts-block">
                        <div class="col-sm-6">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($scores as $id => $score)
                                <div class="row">
                                    <div class="col-sm-4 label-column"><span class="chart-label">{{ $score['name'] }}</span></div>
                                    <div class="col-sm-8 chart-column"><div class="chart-line" style="width: {{$score['percent']}}%;">{{ $score['percent'] }}%</div></div>
                                </div>
                                @if($i%2 == 0)
                        </div>
                        <div class="col-sm-6">
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endauth

                @include('frontend.components.filter')

            </div>
        </div>
    </section>
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Top <span>Sight Seeings</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <div>
                    @foreach($bestProducts as $product)
                        @php
                            $countries = array_pluck($product->countries->toArray(), 'name');
                            $countries = implode(', ', $countries);
                        @endphp
                        <div class="col-md-4 col-sm-6 col-xs-12 b_packages">
{{--                            <div class="band"><img src="{{ asset('images/band.png') }}" alt="" /> </div>--}}
                            <div class="v_place_img"><img src="{{ cropImage($product->image, 377, 218) }}" alt="{{ $product->name }}" title="{{ $product->name }}" /> </div>
                            <div class="b_pack rows">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="product-list-name">
                                        <a href="{{ route('product', ['id' => $product->id]) }}">{{ $product->name }} <br />
                                            <span class="v_pl_name">{!! $countries !!}</span>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection

