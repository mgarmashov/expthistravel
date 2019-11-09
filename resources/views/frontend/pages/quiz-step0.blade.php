@extends('frontend.layouts.main')

@section('title')Quiz - part 2 | {{env('APP_NAME')}}@endsection
@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">

                <div class="application-layout col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">

                    <form action="{{route('quiz-step1')}}" class="step2-form" method="post" id="step0-form">

                        <h4>What experience are you looking for?</h4>
                        <div id="q-experience">
                            <div class="col-sm-6">
                                @foreach(\App\Models\Experience::all() as $experience)

                                    <div class="checkbox checkbox-info checkbox-circle">
                                        <label for="q-experience-{{$experience->id}}">
                                            <input class="with-gap" name="experience" type="radio" value="{{$experience->id}}" id="q-experience-{{$experience->id}}"  />
                                            <span>{{$experience->name}}</span>
                                        </label>
                                    </div>

                                    @if($loop->index == $loop->count/2 - 1 || $loop->index == ($loop->count - 1)/2)
                            </div>
                            <div class="col-sm-6">
                                    @endif

                                @endforeach
                            </div>
                            <div class="clearfix"></div>
                            <hr class="margin10">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-info checkbox-circle">
                                    <label for="q-experience-all">
                                        <input class="with-gap" name="experience" type="radio" value="0" id="q-experience-all" checked  />
                                        <span>I’m not sure - inspire me</span>
                                    </label>
                                </div>
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