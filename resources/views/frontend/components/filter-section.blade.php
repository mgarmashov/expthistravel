@php

@endphp

<section class="filter-section">
{{--    <div class="dark-layout">--}}
    <div class="container application-layout">
        {{--<div class="application-layout">--}}

            @auth
                @if(Auth::user()->scores())
                    <h4>Your top interests</h4>
                    <div class="charts-block">
                        <div class="col-sm-6">
                            @php
                                $i = 1;
                            @endphp
                            @foreach(Auth::user()->scores()->slice(0,4) as $id => $score)
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
                @endif
            @endauth

            @include('frontend.components.filter-form')

        {{--</div>--}}
    </div>
{{--    </div>--}}
</section>
