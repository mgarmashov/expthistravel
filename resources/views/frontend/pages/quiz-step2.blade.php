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
                </div>

                <div class="application-layout col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">

                    <form action="{{route('quiz-step3')}}" class="step2-form" method="post" id="step2-form">

                        @include('frontend.components.q-where-to-go')
                        @include('frontend.components.q-when-to-go')
                        @include('frontend.components.q-how-long')
                        @include('frontend.components.q-who-travels')
                        @include('frontend.components.q-travel-style')
                        @include('frontend.components.q-preferred-sights')

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
        for (let id of ['q3', 'q-countries']) {
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
@endpush