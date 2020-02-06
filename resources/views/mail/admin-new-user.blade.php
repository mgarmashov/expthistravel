@extends('mail.template')

@section('preheader')
    New user have registered
@endsection


@section('content')
    <h1>New user has registered</h1>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <b>Email:</b> {{ $user->email }}
            </td>
            <tr>
            <td>
                People: {{ 111config('questions')['q_who_travels'][$quizResults['q_who_travels']] ?? '' }}
                <ul>
                    @if(isset($quizResults['q_how_many_adults'])) <li>Adults: {{ $quizResults['q_how_many_adults'] }}</li> @endif
                    @if(isset($quizResults['q_how_many_child'])) <li>Child: {{ $quizResults['q_how_many_child'] }}</li> @endif
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                Duration: {{intval($quizResults['q_how_long_from']) ?? ''}} - {{ intval($quizResults['q_how_long_to']) == 29 ? '28+' : intval($quizResults['q_how_long_to']) }}

            </td>
        </tr>
        <tr>
            <td>
                Months:
                @if(isset($quizResults['q3']))
                <ul>
                    @foreach($quizResults['q3'] as $id)
                        <li>{{ config('questions.q3.'.$id) }}</li>
                    @endforeach
                </ul>
                @endif
            </td>
        </tr>
        <tr>
            <td>Answers:
                <table border="1">
                    @foreach($activityAnswers as $answer)
                        <tr>
                            <td>{{ $answer->activity()->name }}</td>
                            @php
                                switch ($answer->answer) {
                                    case 'like':
                                        $color = '#8DFF91';
                                        break;
                                    case 'dislike':
                                        $color = '#FF8284';
                                        break;
                                    default:
                                        $color = 'white';
                                        break;
                                }
                            @endphp
                            <td style="background: {{ $color }}">{{ $answer->answer }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('crud.users.edit', ['user' => $user->id]) }}">Watch at the system</a>
            </td>
        </tr>
    </table>
@endsection
