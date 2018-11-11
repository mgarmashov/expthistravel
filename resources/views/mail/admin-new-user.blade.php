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
                People:
                @if($quizResults['q1'])
                    <ul>
                        @foreach($quizResults['q1'] as $id)
                            <li>{{ config('questions.q1.'.$id) }}</li>
                        @endforeach
                    </ul>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                Duration:
                @if($quizResults['q2'])
                <ul>
                    @foreach($quizResults['q2'] as $id)
                        <li>{{ config('questions.q2.'.$id) }}</li>
                    @endforeach
                </ul>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                Months:
                @if($quizResults['q3'])
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
                            <td style="background: {{ $answer->answer == 'like' ? '8DFF91' : $answer->answer == 'dislike' ? '#FF8284' : 'white' }}">{{ $answer->answer }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('crud.users.show', ['user' => $user->id]) }}">Watch at the system</a>
            </td>
        </tr>
    </table>
@endsection