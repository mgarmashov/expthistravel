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

                <form class="" id="filter-form" method="get" action="{{ route('search') }}">
                    <div class="row">
                        <div class="input-field col s4">
                            <select id="filter-country" multiple>
                                <option value="0" disabled selected>Select country</option>
                                <option value="all">Any</option>
                                @foreach(\App\Models\Country::all() as $country)
                                    <option value="{{$country->id}}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @php
                            $months = [
                                1 => 'January',
                                2 => 'February',
                                3 => 'March',
                                4 => 'April',
                                5 => 'May',
                                6 => 'June',
                                7 => 'July',
                                8 => 'August',
                                9 => 'September',
                                10 => 'October',
                                11 => 'November',
                                12 => 'December'
                            ];
                        @endphp
                        <div class="input-field col s4">
                            <select id="filter-month" multiple>
                                <option value="" disabled selected>Select month</option>
                                <option value="all">Any</option>
                                @foreach($months as $key => $month)
                                    <option value="{{ $key }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

{{--                        {{ dd($filter['duration']) }}--}}
                        {{--{{ dd(in_array('up7', $filter['duration'])) }}--}}
                        <div class="input-field col s4">
                            <select id="filter-duration" multiple>
                                <option value="0" disabled selected>Select duration</option>
                                <option value="all" {{ in_array('all', $filter['duration']) ? 'selected' : '' }}>Any</option>
                                <option value="up7" {{ in_array('up7', $filter['duration']) ? 'selected' : '' }}>7 nights or less</option>
                                <option value="8-13" {{ in_array('8-13', $filter['duration']) ? 'selected' : '' }}>8 to 13 nights</option>
                                <option value="14more" {{ in_array('14more', $filter['duration']) ? 'selected' : '' }}>14 nights or more</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12" id="submit-btn">
                            <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn v2-ser-btn">
                        </div>
                    </div>
                </form>

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

@push('after_scripts')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$('#filter-country').select2();--}}
            {{--$('#filter-month').select2();--}}
            {{--$('#filter-duration').select2();--}}
        {{--});--}}
    {{--</script>--}}


    <script>
        document.getElementById('submit-btn').onclick = function() {
            let form = document.getElementById('filter-form');
            form.submit();
        }
    </script>
@endpush