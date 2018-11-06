@extends('frontend.layouts.main')

@section('title')
    | Booking
@endsection

@section('content')
    <section>
        <div class="tr-register"  style="background-image: url(../images/home-large-image/{{ randomBgImage() }}">
            <div class="dark-layout">
                <div class="application-layout col-md-10 col-md-offset-1 margin70">
                <div class="spe-title">
                    <h2>Booking by <span>Email</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                        <h4>
                            Thank you for your order.
                        </h4>
                    </div>
                </div>
                <div>
                    <h5>
                        We will connect with you.
                    </h5>
                    <a href="{{ route('index') }}">Go to main page</a>
                </div>

            </div>
            </div>
        </div>
    </section>
@endsection


@push('after_scripts')

@endpush



