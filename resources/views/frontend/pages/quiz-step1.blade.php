@extends('frontend.layouts.main')

@section('title')Quiz - part 1 | {{env('APP_NAME')}}@endsection

@section('content')
    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container-fluid inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>My kind of experiences</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Select the activities you're interested in <br/>
                        {{--<i><u>Like it</u></i> | <i><u>not for me</u></i> | <i><u>not sure...</u></i><br/>--}}
                        We’ll use your preferences to find the ideal travel experiences for you.
                    </p>
                </div>
                <div>
                    @foreach(\App\Models\Activity::all() as $activity)

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 b_packages b_packages--activity wow slideInUp" data-wow-duration="0.5s" data-activity="{{ $activity->id }}">
                        <!-- IMAGE -->
                        <div class="v_place_img"> <img src="{{ asset(cropImage($activity->image, 533, 308))  }}" alt="{{ $activity->name }}" title="{{ $activity->name }}" /> </div>
                        <!-- TOUR TITLE & ICONS -->
                        <div class="b_pack rows">
                            <!-- TOUR TITLE -->
                            <div class="col-sm-12">
                                <h4>{{ $activity->name }}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                @csrf
                <div class="col-sm-6 col-sm-offset-3">
                    <form action="{{route('quiz-step2')}}"method="post" id="step2-form">
                        @csrf
                    <i id="submit-btn" class="waves-effect waves-light tourz-sear-btn v2-ser-btn waves-input-wrapper" style="">
                        <input type="submit" value="Next" class="waves-button-input">

                    </i>
                    </form>
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
    </section>
@endsection


@push('after_scripts')
    <script>
      let activities = document.getElementsByClassName('b_packages--activity');
      for ( let activity of activities ) {
        activity.onclick = function() {
          this.classList.toggle('active');
        }
      }

      document.getElementById('submit-btn').onclick = function() {
        event.preventDefault();
        let actives = document.getElementsByClassName('active');
        let likes = [];
        for (active of actives ) {
          likes.push(active.dataset.activity);
        }

        $.ajax({
          type: "post",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route('saveAnswers') }}',
          data: {
            'likes': likes
          },

          beforeSend: function(){
            $('#preloader').delay(350).fadeIn('fast', function () {
              return window.location = "{{route('quiz-step2')}}";
            });

          },

          success: function(data)
          {
            return window.location = "{{route('quiz-step2')}}";
          },
        })
      }
    </script>
@endpush