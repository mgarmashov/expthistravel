@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title">
                    <h2>Answer few questions</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Page 3/3</p>
                </div>

                <div>

                </div>

                <div class="application-layout">
                    <p>Almost done. Register please for keeping your answers and relating with your profile</p>
                    <form class="col s12" method="post" action="{{ route('test-register') }}">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="email" class="validate" name="email">
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="password" class="validate"  name="password">
                                <label>Password</label>
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
                    <p>Are you a already member ? <a href="login.html">Click to Login</a>
                    </p>
                </div>

            </div>
        </div>





    </section>
@endsection


@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            document.getElementsByTagName('form')[0].submit();
        }
    </script>
@endpush