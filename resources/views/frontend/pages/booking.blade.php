@extends('frontend.layouts.main')
@push('after_styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
@section('title')Booking | {{env('APP_NAME')}}@endsection

@section('content')
    <section class="booking-page">
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
                        <div class="col s12 m6">
                            <label for="b-field-name">First name</label>
                            <input class="small-line" type="text" id="b-field-name" name="b_name" value="{{ Auth::user() && Auth::user()->name ? Auth::user()->name : ''  }}"  aria-required="true" required>
                        </div>
                        <div class="col s12 m6">
                            <label for="b-field-surname">Surname</label>
                            <input class="small-line" type="text" id="b-field-surname" name="b_surname" value="{{ Auth::user() && Auth::user()->surname ? Auth::user()->surname : ''  }}"   aria-required="true"  required>
                        </div>
                    </div>

                    <div class="row margin20">
                        <div class="col s12 m6">
                            <label for="b-field-email">Email</label>
                            <input class="small-line" type="email" id="b-field-email" name="b_email" value="{{ Auth::user() && Auth::user()->email ? Auth::user()->email : ''  }}"   aria-required="true"  required>
                        </div>
                        <div class="col s12 m6">
                            <label for="b-field-phone">Phone number</label>
                            <input class="small-line" type="text" id="b-field-phone" name="b_phone"   aria-required="true"  required>
                        </div>
                    </div>

                    @php($productsDisabled = count($oldItinerariesIds) || count($oldProductsIds) ? true : false)
                    @if($productsDisabled)
                        <div class="row margin40">
                            @if(count($oldItinerariesIds))
                            <div class="col s12 m6">
                                <label>Your Itineraries</label>
                                <table>
                                    @foreach($oldItinerariesIds as $id)
                                    <tr>
                                        <td>{{$loop->index + 1}}. <a href="{{ route('itinerary', ['id'=>$id]) }}">{{ \App\Models\Itinerary::find($id)->name }}</a></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            @endif
                            @if(count($oldProductsIds))
                                <div class="col s12 m6">
                                    <label>Your Experiences</label>
                                    <table>
                                        @foreach($oldProductsIds as $id)
                                            <tr>
                                                <td>{{$loop->index + 1}}. <a href="{{ route('product', ['id'=>$id]) }}">{{ \App\Models\Product::find($id)->name }}</a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="row margin40 @if($productsDisabled) hidden @endif">
                        <div class="col s12" id="b-itineraries-block">
                            <label for="b-field-itineraries">Select your itineraries</label>
                            <select multiple name="b_itineraries[]" id="b-field-itineraries">
{{--                                <option value="" disabled selected>Select your experience</option>--}}
                                @foreach(\App\Models\Itinerary::all() as $itinerary)
                                    <option value="{{ $itinerary->id }}" @if($oldItinerariesIds->contains($itinerary->id)) selected @endif>{{ $itinerary->name }}</option>
                                @endforeach
                            </select>
                            <span class="small brown-text"><i>Ready-made itineraries including recommended experiences. Want to request changes to your route or activities? Just add these to notes section below.</i></span>
                        </div>
                    </div>

                    <div class="row margin40 @if($productsDisabled) hidden @endif">
                        <div class="col s12" id="b-products-block">
                            <label for="b-field-products">Select your experience</label>
                            <select multiple name="b_products[]" id="b-field-products">
{{--                                <option value="" disabled selected>Select your experience</option>--}}
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}" @if($oldProductsIds->contains($product->id)) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <span class="small brown-text"><i>We’ll create your unique trip based on your choice of experiences. Special requests? Just add these to notes section below.</i></span>
                        </div>
                    </div>

                    <div class="row margin40 booking-dates-section" id="b-dates-block">
                        <div class="col s12">
                            <label>Do you have fixed dates for this trip?</label>
                            <div class="">
                                <label for="b-field-dates-yes">
                                    <input name="b_field_dates" id="b-field-dates-yes" class="with-gap" type="radio" value="yes"  aria-required="true">
                                    <span>Yes</span>
                                </label>
                                <div class="booking-dates-fields hidden" id="dates-fields">
                                    <div class="inline-block">
                                    <span>Departure date</span>
                                    {{--<input type="text" id="b-field-dates-from" name="b_field_dates_from" class="small-line">--}}
                                    <input type="date" id="b-field-dates-from" name="b_field_dates_from" class="small-line">
                                    </div>
                                    <div class="inline-block">
                                    <span>Return date</span>&nbsp;
                                    {{--<input type="text" id="b-field-dates-to" name="b_field_dates_to" class="small-line">--}}
                                    <input type="date" id="b-field-dates-to" name="b_field_dates_to" class="small-line">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label for="b-field-dates-no">
                                    <input name="b_field_dates" id="b-field-dates-no" class="with-gap" type="radio" value="no"  aria-required="true">
                                    <span>No, I’m flexible</span>
                                </label>
                            </div>
                            <span class="small brown-text"><i>We’ll suggest travel dates for you. Rough dates in mind? Add these to the notes section below</i></span>
                        </div>
                    </div>

                    <div class="row margin40" id="b-how-many-travellers">
                        <div class="col s12">
                            <label>How many people are travelling?</label>
                        </div>
                            <label for="b-how-many-adults" class="col-lg-2 col-sm-4 col-sm-6">
                                <input name="b_how_many_adults" id="b-how-many-adults" class="small-line" type="number" min="0" max="10" value="{{ $oldAdults }}">
                                <span>Adults</span>
                            </label>
                            <label for="b-how-many-child" class="col-lg-2 col-sm-4 col-sm-6">
                                <input name="b_how_many_child" id="b-how-many-child" class="small-line" type="number" min="0" max="10" value="{{ $oldChilds }}">
                                <span>Children (Aged 0-16)</span>
                            </label>
                    </div>

                    <div class="row margin40" id="b-how-can-help">
                        <div class="col s12">
                            <label>How can we help you book your trip?</label>
                        </div>
                        <div></div>
                        <div class="col s12 m6 l3 xl3">
                            <label for="b-how-can-help-experiences" class="">
                                <input name="" id="b-how-can-help-experiences" class="styled" type="checkbox" checked disabled>
                                <span>Experiences<i class="tooltipped tiny material-icons" data-tooltip="Activities and excursions">help_outline</i></span>
                            </label>
                            <input name="b_how_can_help[experiences]" class="hidden" type="checkbox" checked>
                        </div>
                        <div class="col s12 m6 l3 xl3">
                            <label for="b-how-can-help-accom" class="">
                                <input name="b_how_can_help[accom]" id="b-how-can-help-accom" class="styled" type="checkbox">
                                <span>Accommodation<i class="tooltipped tiny material-icons" data-tooltip="Where to rest your head">help_outline</i></span>
                            </label>
                        </div>
                        <div class="col s12 m6 l3 xl3">
                            <label for="b-how-can-help-transport" class="">
                                <input name="b_how_can_help[transport]" id="b-how-can-help-transport" class="styled" type="checkbox">
                                <span>Transport <i class="tooltipped tiny material-icons" data-tooltip="Flights, train, ferry, private/ group transfers, car hire, etc.">help_outline</i></span>
                            </label>
                        </div>
                        <div class="col s12 m6 l3 xl3">
                            <label for="b-how-can-help-all" class="label-with-info">
                                <input name="b_how_can_help[all]" id="b-how-can-help-all" class="styled" type="checkbox">
                                <span>All of the above</span>
                                <span class="small"><i>Your entire trip taken care of!</i></span>
                            </label>
                        </div>
                    </div>

                    <div class="row margin40">
                        <div class="col s12">
                            <label for="comment">Trip notes/ requests</label>
                            <textarea name="b_comment" id="b-comment" rows="20"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" value="Plan my trip" class="tourz-sear-btn v2-ser-btn col s12">
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
      var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
      var nonSupportDate = $('[type="date"]').prop('type') != 'date';
      console.log('this is iOS? '+iOS);
      console.log('browser doesn`t support input[date] (old Safarii): '+nonSupportDate);
      if(nonSupportDate == true || iOS === false) {
        $('#b-field-dates-from').replaceWith('<input type="text" id="b-field-dates-from" name="b_field_dates_from" class="small-line">')
        $('#b-field-dates-to').replaceWith('<input type="text" id="b-field-dates-to" name="b_field_dates_to" class="small-line">')
      }
    </script>
    <script>
        //show/gide dates fields
        document.getElementById('b-dates-block').onclick = function () {
            if (document.getElementById('b-field-dates-yes').checked == true) {
                document.getElementById('dates-fields').classList.remove('hidden');
                document.getElementById('b-field-dates-from').required = true;
                document.getElementById('b-field-dates-to').required = true;

            } else {
                document.getElementById('dates-fields').classList.add('hidden');
                document.getElementById('b-field-dates-from').required = false;
                document.getElementById('b-field-dates-to').required = false;
            }
        }
    </script>

    <script>
      if(nonSupportDate == true || iOS === false) {
        $(function () {
          var dateFormat = "M dd, yy", //Nov 29, 2019
            from = $("#b-field-dates-from")
              .datepicker({
                minDate: new Date(),
                autoClose: true
              })
              .on("change", function () {
                to.datepicker({
                  minDate: getDate(this),
                  autoClose: true
                });
              }),
            to = $("#b-field-dates-to").datepicker({
              minDate: new Date(),
              autoClose: true
            })
              .on("change", function () {
                from.datepicker({
                  minDate: new Date(),
                  autoClose: true,
                  maxDate: getDate(this)
                });
              });

          function getDate(element) {
            var date;
            try {
              date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
              date = null;
            }

            return date;
          }
        });
      }
    </script>

    <script>
        //Materialize Tooltip
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.tooltipped');
            var instances = M.Tooltip.init(elems, {
                exitDelay: 0,
                enterDelay: 200,
                margin: 5,
                inDuration: 300,
                outDuration: 250,
                position: 'right',
                transitionMovement: 10
            });
        });
    </script>
    <script>
        //"check all" button
        document.getElementById('b-how-can-help-all').onclick = function() {
            checkElements(this, 'b-how-can-help')
        }

        function checkElements(clickedElement, container) {
            var elements = $('#'+container+' input:enabled');
            if (clickedElement.checked) {
                for ( var el of elements) {
                    el.checked = true;
                }
            } else {
                for ( var el of elements) {
                    el.checked = false;
                }
            }
        }

        for (var id of ['b-how-can-help-experiences','b-how-can-help-accom','b-how-can-help-transport']) {
            document.getElementById(id).onclick = function() {
                document.getElementById('b-how-can-help-all').checked = false
            }
        }

    </script>

    <script>
        $('input[type="submit"]').click(function() {
              if (requiredValidation()) {
                event.preventDefault();
              }
        });
        $('#b-field-products').change(function(){
          requiredValidation()
        });
        $('#b-field-itineraries').change(function(){
          requiredValidation()
        });

        function requiredValidation() {
          if($('#b-field-products').val().length == 0 && $('#b-field-itineraries').val().length == 0) {
            $('#b-products-block').addClass('invalid');
            $('#b-itineraries-block').addClass('invalid');
            return true;
          } else {
            $('#b-products-block').removeClass('invalid');
            $('#b-itineraries-block').removeClass('invalid');
            return false;
          }
        }

    </script>
@endpush



