@extends('mail.template')

@section('preheader')
    You've got new message
@endsection


@section('content')
    <h1>You've got new message</h1>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                You've got new message from page <a href="{{route('contacts')}}">{{route('contacts')}}</a>
                <table border="1">
                    <tr>
                        <td>Name</td>
                        <td>{{ $request->input('name') }}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>{{ $request->input('subject') }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $request->input('email') }}</td>
                    </tr>
                    <tr>
                        <td>Phone number</td>
                        <td>{{ $request->input('phone') }}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{{ $request->input('message') }}</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
@endsection