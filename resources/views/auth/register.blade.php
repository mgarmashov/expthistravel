@extends('frontend.layouts.main')

@section('content')
    <section class="background-image" @include('frontend.components.randomBgStyle')>
        <div class="dark-layout">
            <div class="container">
                <div class="tr-regi-form">
                            <h4>Create an Account</h4>
                            <p></p>
                            <form class="col s12" method="post" action="{{ route('quiz-register') }}" id="register-form">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="email" class="validate" name="email" value="{{ old('email') }}" required>
                                        <label>Email</label>
                                        @if ($errors->has('email'))
                                            <span class="red-text" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="password" class="validate"  name="password">
                                        <label>Password</label>
                                        @if ($errors->has('password'))
                                            <span class="red-text" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="password" class="validate" name="password_confirmation">
                                        <label>Confirm Password</label>
                                    </div>
                                </div>
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12" id="submit-btn">
                                        <i class="waves-effect waves-light btn-large full-btn waves-input-wrapper" style=""><input type="submit" value="submit" class="waves-button-input"></i> </div>
                                </div>
                            </form>
                            <p>Are you a already member ? <a href="{{route('login')}}">Click to Login</a>
                            </p>
                        </div>
            </div>
        </div>

    </section>
@endsection


@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            var form = document.getElementById('register-form');
            var fields = [];
            fields.push(form.querySelector('input[name="email"]'));
            fields.push(form.querySelector('input[name="password"]'));
            fields.push(form.querySelector('input[name="password_confirmation"]'));
            for ( var input of fields ) {
                if (input.value == null || input.value == '' || input.value == 'NaN' || input.value == 'undefined') {
                    break;
                }
                form.submit();
            }
        }
    </script>
@endpush