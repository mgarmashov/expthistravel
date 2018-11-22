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

                    <form class="col s12" method="post" action="{{ route('password.email') }}" id="reset-form">
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

                        @csrf
                        <div class="row">
                            <div class="input-field col s12" id="submit-btn">
                                <i class="waves-effect waves-light btn-large full-btn waves-input-wrapper" style="">
                                    <input type="submit" value="Send password reset link" class="waves-button-input">
                                </i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection


@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            let form = document.getElementById('reset-form');
            form.submit();
        }
    </script>
@endpush
