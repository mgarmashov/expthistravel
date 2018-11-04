@extends('frontend.layouts.main')

@section('title')
    | Booking
@endsection

@section('content')
    <section>
        <div class="tr-register"  style="background-image: url(../images/home-large-image/{{ randomBgImage() }}">
            <div class="dark-layout">
                <div class="application-layout col-md-10 col-md-offset-1 margin70">
            {{--<div class="tr-regi-form v2-search-form">--}}
                <div class="spe-title">
                    <h2>Booking by <span>Email</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Send the offer and we will connect with you</p>
                </div>
                <form class="" method="post" action="{{ route('sendBooking') }}">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="place" class="autocomplete validate" name="places">
                            <label for="place">Select Country or place</label>
                        </div>
                        <div class="input-field col s12">
                            <select multiple name="products">
                                <option value="" disabled selected>Select your experience</option>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="from" name="from">
                            <label for="from">Arrival Date</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="to" name="to">
                            <label for="to">Departure Date</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select>
                                <option value="" disabled selected>No of adults</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="1">4</option>
                                <option value="1">5</option>
                                <option value="1">6</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <select>
                                <option value="" disabled selected>No of childrens</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="1">4</option>
                                <option value="1">5</option>
                                <option value="1">6</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <select>
                                <option value="" disabled selected>Min Price</option>
                                <option value="1">$200</option>
                                <option value="2">$500</option>
                                <option value="3">$1000</option>
                                <option value="1">$5000</option>
                                <option value="1">$10,000</option>
                                <option value="1">$50,000</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <select>
                                <option value="" disabled selected>Max Price</option>
                                <option value="1">$200</option>
                                <option value="2">$500</option>
                                <option value="3">$1000</option>
                                <option value="1">$5000</option>
                                <option value="1">$10,000</option>
                                <option value="1">$50,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn v2-ser-btn">
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
        $(document).ready(function() {
            $('#place').autocomplete({
                data: {
                    @foreach(\App\Models\Country::all() as $country)
                    "{{ $country->name }}": null,
                    @endforeach
                },
                limit: 8, // The max amount of results that can be shown at once. Default: Infinity.
                onAutocomplete: function (val) {
// Callback function when value is autcompleted.
                },
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
        });
    </script>
@endpush



