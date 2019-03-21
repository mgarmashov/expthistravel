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
                <h4>Edit My Profile </h4>
                <div class="db-2-main-com db-2-main-com-table">
                    <form action="{{ route('profile.save') }}" method="POST" id="profile-form">
                        <table class="responsive-table">
                            <tbody>
                            <tr>
                                <td>Username / login</td>
                                <td>:</td>
                                <td>
                                    @if($user->login)
                                        {{ $user->login }}
                                    @else
                                        <input type="text" name="login">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>First name</td>
                                <td>:</td>
                                <td><input type="text" name="name" value="{{ old('name') ?? $user->name ?? ''}}"></td>
                            </tr>
                            <tr>
                                <td>Surname</td>
                                <td>:</td>
                                <td><input type="text" name="surname" value="{{ old('surname') ?? $user->surname ?? ''}}"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $user->email }} {!! $user->email_verified_at ? '<span class="db-done">Verified</span>' : '<span class="db-not-done">Unverified</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><input type="text" name="phone" value="{{ old('phone') ?? $user->phone ?? ''}}"></td>
                            </tr>
                            </tbody>
                        </table>
                        @csrf
                        <input type="submit" class="hiddendiv">
                    </form>
                    <div class="db-mak-pay-bot">
                        <a href="#" class="waves-effect waves-light btn-large" id="profile-save-btn">Save</a>
                        <a href="{{ route('profile.show') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@push('after_scripts')
    <script>
        document.getElementById('profile-save-btn').onclick = function() {
            event.preventDefault();
            let form = document.getElementById('profile-form');
            form.submit();
        }
    </script>
@endpush