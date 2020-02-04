@php

    $id = $id ?? 0;
    $user = \App\Models\User::find($id);
    $activities = \App\Models\Activity::all();
    $likes = \App\Models\QuizHistory::where('user', $id)->where('answer', 'like')->select('activity')->get();
    $dislikes = \App\Models\QuizHistory::where('user', $id)->where('answer', 'dislike')->select('activity')->get();
    $missed = \App\Models\QuizHistory::where('user', $id)->where('answer', 'missed')->select('activity')->get();

    $kinds = [
        'likes' => 'Likes',
        'dislikes' => 'Dislikes',
        'missed' => 'Missed',
    ];
@endphp

<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes')>
    <div class="">
        <row>
            <h3>Conditions</h3>
            <div>
                <table class="table table-condensed table-bordered">
                    <tbody>
                        <tr>
                            <td><b>Who is travelling? (old edition)</b></td>
                            <td>
                                @if($user && $user->q1)
                                    @foreach ($user->q1 as $value)
                                        <ul>
                                            <li>{{ config('questions')['q1'][$value] ?? '' }}</li>
                                        </ul>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Who is travelling? (new edition)</b></td>
                            <td>{{ config('questions')['q_who_travels'][$user->q_who_travels] ?? '' }} <br /><br />
                                Adults: {{ $user->q_how_many_adults }} <br />
                                Child: {{ $user->q_how_many_child }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>How long do you want to go for? (old edition)</b></td>
                            <td>
                                @if($user && $user->q2)
                                    @foreach ($user->q2 as $value)
                                        <ul>
                                            <li>{{ config('questions')['q2'][$value] ?? '' }}</li>
                                        </ul>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>How long do you want to go for? (new edition)</b></td>
                            <td> {{intval($user->q_how_long_from) ?? ''}} - {{ intval($user->q_how_long_to) == 29 ? '28+' : intval($user->q_how_long_to) }}</td>
                        </tr>
                        <tr>
                            <td><b>Where do you want to go?</b></td>
                            <td>
                                @if($user && $user->q_countries)
                                    @foreach ($user->q_countries as $value)
                                        <ul>
                                            <li>{{ \App\Models\Country::find($value)->name ?? 'All' }}</li>
                                        </ul>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>When do you want to go?</b></td>
                            <td>
                                @if($user && $user->q3)
                                    @foreach ($user->q3 as $value)
                                        <ul>
                                            <li>{{ config('questions')['q3'][$value] ?? '' }}</li>
                                        </ul>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Your preferred travel style?</b></td>
                            <td>{{ config('questions')['q_travel_style'][$user->q_travel_style] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Your preferred sights and experiences?</b></td>
                            <td>{{ config('questions')['q_preferred_sight'][$user->q_preferred_sight] ?? '' }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </row>
    </div>


    <div class="">
        <row>
            <h3>Interests</h3>
            <div>
                <table class="table table-condensed table-bordered">
                    <tbody>

                    @foreach ($kinds as $key => $label)
                        <tr>
                            <td><b>{{ $label }}</b></td>
                            <td>
                                @if(${$key})
                                    @foreach(${$key} as $item)
                                        @php
                                            $activity = $activities->firstWhere('id', $item->activity);
                                        @endphp
                                        {{ $activity->name ?? '' }} <br />
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </row>
    </div>

    <div>
        <row>
            <h3>Categories total scores</h3>
            <div>
                <table class="table table-condensed table-bordered">
                    <tbody>
                    @if($user && $user->totalScores)
                        @foreach ($user->totalScores as $key => $score)
                            <tr>
                                <td>{{ config('categories')[$key]['name'] ?? "error with name" }}</td>
                                <td>
                                    {{ $score }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                User has not passed the Quiz
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </row>
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <!-- no styles -->
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
    @endpush
@endif
