@extends('frontend.layouts.main')

@php
    $totalCounter = count(\App\Models\Activity::all());
@endphp

@section('content')
    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Answer few questions</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Press if you like things on picture</p>
                    <p id="counter" data-number=1 >1/{{ $totalCounter }}</p>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    @php
                        $activity = \App\Models\Activity::query()->inRandomOrder()->first();
                    @endphp

                        <div class="col-xs-12 quiz-question">
                            <div id="activity-container">
                                <div class="avtivity-item" id="activity-item" data-activity="{{ $activity->id }}">
                                    <div class="v_place_img">
                                        <img src="{{ asset(cropImage($activity->image, 700, 400)) }}" alt="" />
                                    </div>
                                    <div class="b_pack rows text-center">
                                        <div class="col-md-8 col-md-offset-2">
                                            <h4>{{ $activity->name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 btn-quiz btn-quiz-img dislike" data-kind="dislike">
                                <img src="{{ asset('images/icon-thumb-down.png') }}" alt="">
                            </div>
                            <div class="col-xs-2 btn-quiz btn-quiz-img like" data-kind="like">
                                <img src="{{ asset('images/icon-thumb-up.png') }}" alt="">
                            </div>
                        </div>
                </div>
                <div class="spe-title col-sm-8 col-sm-offset-2">
                    <a href="#" class="btn-quiz">I'm not sure</a>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('after_scripts')
    <script>
        let buttons = document.getElementsByClassName('btn-quiz');
        let counter = document.getElementById('counter');
        let answers = {};
        for ( let button of buttons ) {
            button.onclick = function() {
                event.preventDefault();
                let step = parseInt(counter.dataset.number);
                let activityId = parseInt(document.getElementById('activity-item').dataset.activity);
                let answer = (this.dataset.kind == 'like') ? 'like' : (this.dataset.kind == 'dislike') ? 'dislike' : 'missed';

                answers[step] = {
                    'activity' : activityId,
                    'answer' : answer
                };

                getQuestion(answers);

                //update counter on page
                step++;
                counter.innerText = step+'/{{$totalCounter}}';
                counter.dataset.number = step;

                if (step == {{ $totalCounter }}+1 ) {
                    for ( let el of document.getElementsByClassName('btn-quiz')) {
                        el.hidden = true;
                    }
                }
            }
        }

        function getQuestion(answers) {
            let container = document.getElementById('activity-container');
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('getQuestion') }}',
                data: {
                    'answers': answers
                },

                beforeSend: function(){

                },

                success: function(data)
                {
                    document.getElementById('activity-item').dataset.activity = data.id;
                    container.getElementsByTagName('img')[0].src = data.image;
                    container.getElementsByTagName('h4')[0].innerText = data.name;
                },

            })
        }
    </script>
@endpush