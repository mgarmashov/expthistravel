@extends('frontend.layouts.main')

@section('title')Quiz - part 2 | {{env('APP_NAME')}}@endsection
@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container-fluid inn-page-con-bg tb-space" id="inner-page-title">

                <div class="application-layout col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">

                    <form action="{{route('quiz-step1')}}" class="step2-form" method="post" id="step0-form">
                        <h4>Choose your experience</h4>
                        <div id="q-experience">
                            <div class="col-xs-12 margin10">
                                <div class="checkbox checkbox-info checkbox-circle">
                                    <label for="q-experience-all">
                                        <input class="with-gap" name="experience" type="radio" value="0" id="q-experience-all" checked />
                                        <span>Inspire me</span>
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="margin10">
                            </div>
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-info checkbox-circle">
                                    <label for="q-experience-choose">
                                        <input class="with-gap" name="experience" type="radio" value="1" id="q-experience-choose" />
                                        <span>What experience are you looking for?</span>
                                    </label>
                                </div>
                                <select id="q-experience-list" multiple name="q_experiences[]" disabled>
                                    <option value="" disabled selected>Choose your experience</option>
                                    @foreach(\App\Models\Experience::all() as $experience)
                                        <option value="{{$experience->id}}">{{ $experience->name }}</option>
                                    @endforeach
                                </select>
                            </div>


@php //todo надо сохранять отдельно ответ "все" или ответы про экспериенс. не только в сессию @endphp


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
      jQuery(document).ready(function($) {
        $('input[name="experience"]').change(function(e) {
console.log($('input[name="experience"]:checked').val());
          if ($('input[name="experience"]:checked').val() == 0) {
            $('#q-experience-list').prop('disabled', true)
          } else {
            $('#q-experience-list').prop('disabled', false)
          }
          $('#q-experience-list').formSelect();
        });
      });

    </script>
    <script>
      document.getElementById('submit-btn').onclick = function() {
          document.getElementById('step0-form').submit();
      }

    </script>

    <script>

      function getAnswer() {
        var radios = document.getElementsByName('experience');

        for (var i = 0, length = radios.length; i < length; i++)
        {
          if (radios[i].checked)
          {
            return radios[i].value;
          }
        }
      }
    </script>
@endpush
