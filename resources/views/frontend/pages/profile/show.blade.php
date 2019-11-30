@extends('frontend.layouts.main')

@section('title')Profile | {{env('APP_NAME')}}@endsection

@section('content')

@php
    $user = \Illuminate\Support\Facades\Auth::user();
@endphp
<section>
    <div class="db">
        <div class="db-l">
            @include('frontend.components.profile-left-part')
        </div>

        <div class="db-2">
            <div class="db-2-com db-2-main">
                <h4>My Profile</h4>
                <div class="db-2-main-com db-2-main-com-table">
                    <table class="">
                        <tbody>
                            <tr>
                                <td>Username / login</td>
                                <td>{{ $user->login ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>First name</td>
                                <td>{{ $user->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Surname</td>
                                <td>{{ $user->surname ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }} {!! $user->email_verified_at ? '<span class="db-done">Verified</span>' : '<span class="db-not-done">Unverified</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="db-mak-pay-bot">
                        <a href="{{ route('profile.edit') }}" class="waves-effect waves-light btn-large">Edit my profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@push('after_scripts')
    <script>

    </script>
@endpush