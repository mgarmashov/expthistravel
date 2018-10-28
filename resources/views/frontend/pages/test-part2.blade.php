@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Answer few questions</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Page 2/3</p>
                </div>

                <div class="application-layout col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">

                    <form action="{{route('test-part3')}}" class="part2-form" method="post">
                    <h4>Who is travelling?</h4>
                        <div class="col-xs-12" id="q1">
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input name="q1[solo]" id="q1-solo" class="styled" type="checkbox">
                                <label for="q1-solo">I’m going solo </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input name="q1[couple]" id="q1-couple" class="styled" type="checkbox">
                                <label for="q1-couple">Couple</label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input name="q1[group]" id="q1-group" class="styled" type="checkbox">
                                <label for="q1-group">Group – friends/ family</label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input name="q1[family]" id="q1-family" class="styled" type="checkbox">
                                <label for="q1-family">Family with little ones</label>
                            </div>
                            <hr>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input name="q1[all]" id="q1-all" class="styled" type="checkbox">
                                <label for="q1-all">Not sure</label>
                            </div>
                        </div>

                    <h4>How long do you want to go for?</h4>
                    <div class="col-xs-12"  id="q2">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input name="q2[up7]" id="q2-up7" class="styled" type="checkbox">
                            <label for="q2-up7">7 nights or less </label>
                        </div>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input name="q2[8-13]" id="q2-8-13" class="styled" type="checkbox">
                            <label for="q2-8-13">8 to 13 nights</label>
                        </div>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input name="q2[14more]" id="q2-14more" class="styled" type="checkbox">
                            <label for="q2-14more">14 nights or more</label>
                        </div>
                        <hr>
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input name="q2[all]" id="q2-all" class="styled" type="checkbox">
                            <label for="q2-all">I don’t mind</label>
                        </div>
                    </div>

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
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input name="q3[0]" id="q3-all" class="styled" type="checkbox">
                                <label for="q3-all">I don’t mind</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                            <hr>
                        <div class="col-sm-6">
                            @foreach($months as $val => $month)

                                <div class="checkbox checkbox-info checkbox-circle">
                                    <input name="q3[{{$val}}]" id="q3-{{$val}}" class="styled" type="checkbox">
                                    <label for="q3-{{$val}}">{{ $month }}</label>
                                </div>
                                @if($val == 6)
                        </div>
                        <div class="col-sm-6">
                                @endif

                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @csrf
                    <div class="col-sm-6 col-sm-offset-3">
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
            document.getElementsByTagName('form')[0].submit();
        }

    </script>

    <script>
        for (let id of ['q1', 'q2', 'q3']) {
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
@endpush