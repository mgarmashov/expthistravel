@extends('frontend.layouts.main')
@push('after_styles')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="{{asset('vendor/noUiSlider/nouislider.css')}}?v={{ filemtime(public_path('vendor/noUiSlider/nouislider.css')) }}">
@endpush
@section('title')Quiz - part 2 | {{env('APP_NAME')}}@endsection
@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>About your trip</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Just a few more questions to help us with our recommendations</p>
                    <p>Page 2/3</p>
                </div>

                <div class="application-layout col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">

                    <form action="{{route('quiz-step3')}}" class="step2-form" method="post" id="step2-form">
                    <h4>Who is travelling?</h4>
                        <div class="col-xs-12" id="q1">
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q1-solo">
                                    <input name="q1[solo]" id="q1-solo" class="styled" type="checkbox">
                                    <span>I’m going solo</span>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q1-couple">
                                    <input name="q1[couple]" id="q1-couple" class="styled" type="checkbox">
                                    <span>Couple</span>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q1-group">
                                    <input name="q1[group]" id="q1-group" class="styled" type="checkbox">
                                    <span>Group – friends/ family</span>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q1-family">
                                    <input name="q1[family]" id="q1-family" class="styled" type="checkbox">
                                    <span>Family with little ones</span>
                                </label>
                            </div>
                            <hr>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q1-all">
                                    <input name="q1[all]" id="q1-all" class="styled" type="checkbox">
                                    <span>Not sure</span>
                                </label>
                            </div>
                        </div>
                    <div id="q-how-many" class="hidden">
                        <h4>How many people in total?</h4>
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q-how-many-adults" class="col-xs-3">
                                    <input name="q_how_many_adults" id="q-how-many-adults" class="styled" type="number" min="0" max="10">
                                    <span>Adults</span>
                                </label>
                                <label for="q-how-many-child" class="col-xs-3">
                                    <input name="q_how_many_child" id="q-how-many-child" class="styled" type="number" min="0" max="10">
                                    <span>Children</span>
                                </label>
                                <label for="q-how-many-age" class="col-xs-4">
                                    <input name="q_how_many_age" id="q-how-many-age" class="styled" type="number" min="0" max="16">
                                    <span>Age of children</span>
                                </label>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <h4>How long do you want to go for?</h4>
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input name="q_how_long" id="q-how-long" class="styled hidden" type="number">
                            <span>Days:</span>
                            <div id="q-how-long-visible-slider" class="q-how-long-visible-slider"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    {{--<h4>How long do you want to go for?</h4>--}}
                    {{--<div class="col-xs-12"  id="q2">--}}
                        {{--<div class="checkbox checkbox-info checkbox-circle">--}}
                            {{--<label for="q2-up7">--}}
                                {{--<input name="q2[up7]" id="q2-up7" class="styled" type="checkbox">--}}
                                {{--<span>7 nights or less</span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="checkbox checkbox-info checkbox-circle">--}}
                            {{--<label for="q2-8-13">--}}
                                {{--<input name="q2[8-13]" id="q2-8-13" class="styled" type="checkbox">--}}
                                {{--<span>8 to 13 nights</span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="checkbox checkbox-info checkbox-circle">--}}
                            {{--<label for="q2-14more">--}}
                                {{--<input name="q2[14more]" id="q2-14more" class="styled" type="checkbox">--}}
                                {{--<span>14 nights or more</span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<hr>--}}
                        {{--<div class="checkbox checkbox-info checkbox-circle">--}}
                            {{--<label for="q2-all">--}}
                                {{--<input name="q2[all]" id="q2-all" class="styled" type="checkbox">--}}
                                {{--<span>I don’t mind</span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <h4>When do you want to go?</h4>
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
                        ]
                    @endphp
                    <div id="q3">
                        <div class="col-sm-6">
                            @foreach($months as $val => $month)

                                <div class="checkbox checkbox-info checkbox-circle">
                                    <label for="q3-{{$val}}">
                                        <input name="q3[{{$val}}]" id="q3-{{$val}}" class="styled" type="checkbox">
                                        <span>{{ $month }}</span>
                                    </label>
                                </div>
                                @if($val == 6)
                        </div>
                        <div class="col-sm-6">
                                @endif

                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                        <hr class="margin10">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-info checkbox-circle">
                                <label for="q3-all">
                                    <input name="q3[0]" id="q3-all" class="styled" type="checkbox">
                                    <span>I don’t mind</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <h4>Where do you want to go?</h4>
                    <div class="col-xs-12"  id="q-countries">
                        @foreach(\App\Models\Country::all() as $country)
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-countries-{{$country->id}}">
                                <input name="q_countries[{{$country->id}}]" id="q-countries-{{$country->id}}" class="styled" type="checkbox">
                                <span>{{$country->name}}</span>
                            </label>
                        </div>
                        @endforeach
                        <hr>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-countries-all">
                                <input name="q_countries[all]" id="q-countries-all" class="styled" type="checkbox">
                                <span>I don’t know yet - inspire me!</span>
                            </label>
                        </div>
                    </div>

                    <h4>Your preferred travel style?</h4>
                    <div class="col-xs-12"  id="q-travel-style">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-travel-style-full">
                                <input name="q_travel_style" id="q-travel-style-full" class="with-gap" type="radio" checked value="full">
                                <span>Full-on
                                    <i class="tooltipped tiny material-icons" data-tooltip="Always on the go, experiencing as much as possible">help_outline</i>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-travel-style-steady">
                                <input name="q_travel_style" id="q-travel-style-steady" class="with-gap" type="radio" value="steady">
                                <span>Steady
                                    <i class="tiny material-icons tooltipped" data-tooltip="Plenty to see and do but with some leisure time">help_outline</i>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-travel-style-chilled">
                                <input name="q_travel_style" id="q-travel-style-chilled" class="with-gap" type="radio" value="chilled">
                                <span>Chilled
                                    <i class="tooltipped tiny material-icons" data-tooltip="More time to relax">help_outline</i>
                                </span>
                            </label>
                        </div>
                    </div>

                    <h4>Your preferred sights and experiences?</h4>
                    <div class="col-xs-12"  id="q-preferred-sights">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-preferred-sights-main">
                                <input name="q_preferred_sight" id="q-preferred-sights-main" class="with-gap" type="radio" checked value="main">
                                <span>The main attractions
                                <i class="tooltipped tiny material-icons" data-tooltip="The most popular, not to be missed things to see and do">help_outline</i>
                            </span>
                            </label>
                        </div>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-preferred-sights-main-hidden">
                                <input name="q_preferred_sight" id="q-preferred-sights-main-hidden" class="with-gap" type="radio" value="main-hidden">
                                <span>Main attractions and hidden gems
                                <i class="tiny material-icons tooltipped" data-tooltip="A mix of must-see sights and unique experiences">help_outline</i>
                            </span>
                            </label>
                        </div>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <label for="q-preferred-sights-hidden">
                                <input name="q_preferred_sight" id="q-preferred-sights-hidden" class="with-gap" type="radio" value="hidden">
                                <span>Hidden gems
                                <i class="tooltipped tiny material-icons" data-tooltip="Avoid the crowds and take the road less travelled">help_outline</i>
                            </span>
                            </label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    @csrf
                    <div class="col-sm-6 col-sm-offset-3 margin30">
                        <i id="submit-btn" class="waves-effect waves-light tourz-sear-btn v2-ser-btn waves-input-wrapper" style="">
                            <input type="submit" value="Next" class="waves-button-input">

                        </i>
                    </div>
                    <div class="clearfix"></div>
                </form>
                </div>
            </div>
        </div>





    </section>
@endsection


@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            document.getElementById('step2-form').submit();
        }

    </script>

    <script>
        //"check" all button
        for (let id of ['q1', 'q2', 'q3', 'q-countries']) {
            document.getElementById(id+'-all').onclick = function() {
                checkElements(this, id)
            }
        }


        function checkElements(clickedElement, container) {
            let elements = document.getElementById(container).getElementsByTagName('input');
            if (clickedElement.checked) {
                for ( let el of elements) {
                    el.checked = true;
                }
            } else {
                for ( let el of elements) {
                    el.checked = false;
                }
            }
        }
    </script>

    <script>
        //Show questions "How many people" if user checked "group" or "family"
      howManyTriggerIds = ['q1-group', 'q1-family', 'q1-all'];
      for (let id of howManyTriggerIds) {
        document.getElementById(id).onclick = function() {
          for (let id of howManyTriggerIds) {
            if (document.getElementById(id).checked == true) {
              document.getElementById('q-how-many').classList.remove('hidden');
              break
            }
            document.getElementById('q-how-many').classList.add('hidden');
          }
        }
      }
    </script>

    <script>
        //Materialize Tooltip
      document.addEventListener('DOMContentLoaded', function() {
        let elems = document.querySelectorAll('.tooltipped');
        let instances = M.Tooltip.init(elems, {
          exitDelay: 0,
          enterDelay: 200,
          margin: 5,
          inDuration: 300,
          outDuration: 250,
          position: 'right',
          transitionMovement: 10
        });
      });
    </script>

    <script src="{{asset('vendor/noUiSlider/nouislider.min.js')}}?v={{ filemtime(public_path('vendor/noUiSlider/nouislider.min.js')) }}"></script>
    <script src="{{asset('vendor/wNumb/wNumb.min.js')}}?v={{ filemtime(public_path('vendor/wNumb/wNumb.min.js')) }}"></script>
    <script>
      let slider = document.getElementById('q-how-long-visible-slider');
      noUiSlider.create(slider, {
        start: 14,
        step: 1,
        tooltips: wNumb({decimals: 0}),
        connect: [true, false],
        range: {
          'min': 2,
          'max': 31
        },
        pips: {
          mode: 'values',
          values: [2, 7, 14, 21, 30],
          density: 9,
        }
      });

      slider.noUiSlider.on('change.one', function () {
        document.getElementById('q-how-long').value = slider.noUiSlider.get();
      });
      slider.noUiSlider.on('update.one', function () {
        tooltipText = document.querySelector('.noUi-tooltip').innerHTML;
        if (tooltipText == '31') {
          document.querySelector('.noUi-tooltip').innerHTML = '30+'
        }
      });


    </script>
@endpush