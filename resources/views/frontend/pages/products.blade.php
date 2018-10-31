@extends('frontend.layouts.main')

@section('title')
    | Search
@endsection

@push('after_styles')

@endpush

@section('content')

    <section>
        <div class="rows inner_banner inner_banner_2">
            <div class="container">
                <h2><span>Regular Package -</span> Top Regular Packages In The World</h2>
                <ul>
                    <li><a href="#inner-page-title">Home</a>
                    </li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                    <li><a href="#inner-page-title" class="bread-acti">Regular Package</a>
                    </li>
                </ul>
                <p>Book travel packages and enjoy your holidays with distinctive experience</p>
            </div>
        </div>
    </section>
    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>TOP <span>Regular packages</span> in this Year</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                @foreach($products as $product)
                    <div class="rows p2_2">
                        <div class="col-md-6 col-sm-6 col-xs-12 p2_1">
                            <img src="{{ cropImage($product->image, 550, 353) }}" alt="" /> </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 p2">
                            <h3>{{ $product->name }} <span><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></span></h3>
                            <p>{{ $product->description_short }}</p>
                            <div class="ticket">
                                <ul>
                                    <li>Available Tickets : 48</li>
                                    <li>Start Date : 12.01.2015</li>
                                    <li>End Date : 12.01.2015</li>
                                </ul>
                            </div>
                            <div class="featur">
                                <h4>Package Locations</h4>
                                <ul>
                                    <li>Rio, Brazil(3 days)</li>
                                    <li>8 Breakfast, 3 Dinners</li>
                                    <li>First class Sightseeing</li>
                                    <li>Lorem ipsum</li>
                                </ul>
                            </div>
                            <div class="p2_book">
                                <ul>
                                    <li><a href="booking.html" class="link-btn">Book Now</a> </li>
                                    <li><a href="tour-details.html" class="link-btn">View Package</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--====== TIPS BEFORE TRAVEL ==========-->
    <section>
        <div class="rows tips tips-home tb-space home_title">
            <div class="container tips_1">
                <!-- TIPS BEFORE TRAVEL -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h3>Tips Before Travel</h3>
                    <div class="tips_left tips_left_1">
                        <h5>Bring copies of your passport</h5>
                        <p>Aliquam pretium id justo eget tristique. Aenean feugiat vestibulum blandit.</p>
                    </div>
                    <div class="tips_left tips_left_2">
                        <h5>Register with your embassy</h5>
                        <p>Mauris efficitur, ante sit amet rhoncus malesuada, orci justo sollicitudin.</p>
                    </div>
                    <div class="tips_left tips_left_3">
                        <h5>Always have local cash</h5>
                        <p>Donec et placerat ante. Etiam et velit in massa. </p>
                    </div>
                </div>
                <!-- CUSTOMER TESTIMONIALS -->
                <div class="col-md-8 col-sm-6 col-xs-12 testi-2">
                    <!-- TESTIMONIAL TITLE -->
                    <h3>Customer Testimonials</h3>
                    <div class="testi">
                        <h4>John William</h4>
                        <p>Ut sed sem quis magna ultricies lacinia et sed tortor. Ut non tincidunt nisi, non elementum lorem. Aliquam gravida sodales</p> <address>Illinois, United States of America</address> </div>
                    <!-- ARRANGEMENTS & HELPS -->
                    <h3>Arrangement & Helps</h3>
                    <div class="arrange">
                        <ul>
                            <!-- LOCATION MANAGER -->
                            <li>
                                <a href="#"><img src="images/Location-Manager.png" alt=""> </a>
                            </li>
                            <!-- PRIVATE GUIDE -->
                            <li>
                                <a href="#"><img src="images/Private-Guide.png" alt=""> </a>
                            </li>
                            <!-- ARRANGEMENTS -->
                            <li>
                                <a href="#"><img src="images/Arrangements.png" alt=""> </a>
                            </li>
                            <!-- EVENT ACTIVITIES -->
                            <li>
                                <a href="#"><img src="images/Events-Activities.png" alt=""> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@push('after_scripts')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}
    {{--<script>--}}
    {{--$(document).ready(function() {--}}
    {{--$('#filter-country').select2();--}}
    {{--$('#filter-month').select2();--}}
    {{--$('#filter-duration').select2();--}}
    {{--});--}}
    {{--</script>--}}


    <script>
        document.getElementById('submit-btn').onclick = function() {
            let form = document.getElementById('filter-form');
            form.submit();
        }
    </script>
@endpush