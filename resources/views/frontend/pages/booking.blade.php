@extends('frontend.layouts.main')

@section('title')
    | Booking
@endsection

@section('content')
    <section>
        <div class="tr-register"  @include('frontend.components.randomBgStyle')>
            <div class="dark-layout">
                <div class="application-layout col-md-10 col-md-offset-1 margin70">
                <div class="spe-title">
                    <h2>Let us plan your <span>trip</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Submit a booking enquiry and we’ll create your customised travel itinerary</p>
                </div>
                <form class="form-with-labels" method="post" action="{{ route('sendBooking') }}">
                    <div class="row">
                        <div class="col s12">
                            <label for="place">Destination</label>
                            <select multiple name="countries[]" id="place">
                                <option value="" disabled selected>Select countries</option>
                                @foreach(\App\Models\Country::all() as $country)
                                    <option value="{{ $country->id }}" @if($oldCountryId == $country->id) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col s12">
                            <label for="products">Select your experience</label>
                            <select multiple name="products[]" id="products">
                                <option value="" disabled selected>Select your experience</option>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}" @if($oldProductsIds->contains($product->id)) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col s12">
                            <label for="months">When would you like to go?</label>
                            <select multiple name="months[]" id="months">
                                <option value="" disabled selected>Choose months when you plan to travel</option>
                                @foreach(monthsList() as $key => $value)
                                    <option value="{{ $key }}" @if($oldMonths->contains($key)) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <label for="name">First name</label>
                            <input type="text" id="name" name="name" value="{{ Auth::user() && Auth::user()->name ? Auth::user()->name : ''  }}">
                        </div>
                        <div class="col s12 m6">
                            <label for="surname">Surname</label>
                            <input type="text" id="surname" name="surname" value="{{ Auth::user() && Auth::user()->surname ? Auth::user()->surname : ''  }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user() && Auth::user()->email ? Auth::user()->email : ''  }}">
                        </div>
                        <div class="col s12 m6">
                            <label for="phone">Phone number</label>
                            <input type="text" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <label for="people">How many people are travelling?</label>
                            <input type="text" id="people" name="people">
                        </div>
                        <div class="col s12 m6">
                            <label for="duration">How long do you plan to travel</label>
                            <input type="text" id="duration" name="duration">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label for="comment">Additional comments or request</label>
                            <textarea name="comment" id="comment" rows="12"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        {{--<div class="input-field col s12 m6 offset-m3">--}}
                            <input type="submit" value="Plan my trip" class="tourz-sear-btn v2-ser-btn col s12">
                        {{--</div>--}}
                    </div>
                    @csrf
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



