@extends('frontend.layouts.main')

@section('content')
    <section class="background-image" @include('frontend.components.randomBgStyle')>
        <div class="dark-layout">
            <div class="container">
                <div class="tr-regi-form">
                    <h4>Reset password</h4>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="email" class="validate" value="{{ old('email') }}">
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
                                <input type="password" name="password" class="validate" value="{{ old('password') }}">
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
                                <input type="password" name="password_confirmation" class="validate" value="{{ old('password_confirmation') }}">
                                <label>Confirm Password</label>
                                @if ($errors->has('password_confirmation'))
                                    <span class="red-text" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field col s12" id="submit-btn">
                                <i class="waves-effect waves-light btn-large full-btn waves-input-wrapper" style="">
                                    <input type="submit" value="Set new password" class="waves-button-input">
                                </i>
                            </div>
                        </div>
                    </form>
                </div>

                </div>
            </div>

        </div>

    </section>
@endsection

@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            var form = document.getElementById('reset-form');
            form.submit();
        }
    </script>
@endpush
