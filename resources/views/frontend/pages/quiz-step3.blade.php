@extends('frontend.layouts.main')

@section('title')Quiz - part 3 | {{env('APP_NAME')}}@endsection

@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Almost there, now save your answers</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Page 3/3</p>
                </div>

                <div class="application-layout col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
                    <form class="col s12" method="post" action="{{ route('quiz-register') }}" id="register-form">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
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
                                <input id="password" type="password" class="validate"  name="password">
                                <label for="password">Password</label>
                                @if ($errors->has('password'))
                                    <span class="red-text" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password_confirmation" type="password" class="validate" name="password_confirmation">
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                        </div>
                        <input type="hidden" name="quiz-results" value="{{ $dataUrl ?? '' }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12" id="submit-btn">
                                <i class="waves-effect waves-light btn-large full-btn waves-input-wrapper" style=""><input type="submit" value="submit" class="waves-button-input"></i> </div>
                        </div>
                    </form>
                    {{--<p>Are you a already member ? <a href="{{route('login')}}">Click to Login</a>--}}
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