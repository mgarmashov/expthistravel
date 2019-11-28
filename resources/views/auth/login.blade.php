@extends('frontend.layouts.main')

@section('content')
    <section class="background-image" @include('frontend.components.randomBgStyle')>
        <div class="dark-layout">
            <div class="container">
                <div class="tr-regi-form">
                    <h4>Sign In</h4>
                    {{--<p>It's free and always will be.</p>--}}
                    <form class="col s12" method="post" action="{{ route('login') }}" id="login-form">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="email" class="validate" value="{{ old('email') }}" id="email">
                                <label for="email">Email</label>
                                @if ($errors->has('email'))
                                    <span class="red-text" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="password" name="password" class="validate" id="password">
                                <label for="password">Password</label>
                                @if ($errors->has('password'))
                                    <span class="red-text" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        @csrf
                        <div class="row">
                            <div class="input-field col s12" id="submit-btn">
                                <i class="waves-effect waves-light btn-large full-btn waves-input-wrapper" style="">
                                    <input type="submit" value="submit" class="waves-button-input">
                                </i>
                            </div>
                        </div>
                    </form>
                    <p>
                        <a href="{{ route('password.request') }}">forgot password</a> |
                        Are you a new user? <a href="{{ route('register') }}">Register</a>
                    </p>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            var form = document.getElementById('login-form');
            var fields = [];
            fields.push(form.querySelector('input[name="email"]'));
            fields.push(form.querySelector('input[name="password"]'));
            for ( var input of fields ) {
                if (input.value == null || input.value == '' || input.value == 'NaN' || input.value == 'undefined') {
                    break;
                }
                form.submit();
            }
        }
    </script>
@endpush


