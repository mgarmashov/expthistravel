@extends('frontend.layouts.main')

@section('content')
    <!--HEADER SECTION-->
    @php
        $homeImages = [
            'windsurf',
            'boat',
            'food',
            'bus',
            'bikes',
            'asia1',
            'asia2',
            'asia3',
            'asia4',
            'beach1',
            'beach2',
            'beach3',
            'beach4',
            'waterfall',
        ];
        $rand = array_rand($homeImages, 2);
    @endphp
    <section>
        <div class="tourz-search" style="background-image: url(../images/home-large-image/{{ $homeImages[$rand[0]] }}.jpg)">
            <div class="dark-layout">
                <div class="container">
                    <div class="row">
                        <div class="tourz-search-1">
                            <h1>Find out the best suitable travel experience for you!</h1>
                            <p>We offer you small test. All you need is choose some pictures!</p>
                            <p>Our special images and your associations will help you to define most interesting kinds of rest and getting impressions</p>
                            <a class="waves-effect waves-light tourz-sear-btn" href="{{ route('test') }}"> Let's start!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END HEADER SECTION-->
    <!--====== POPULAR TOUR PLACES ==========-->
    <section>
        <div class="rows pla pad-bot-redu tb-space">
            <div class="pla1 p-home container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title spe-title-1">
                    <h2>Some interesting <span>Tours</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <div class="popu-places-home">
                    @php $i=0; @endphp
                    @foreach(\App\Models\Product::query()->inRandomOrder()->limit(4)->with('countries')->get() as $product)
                        @php
                            $countries = array_pluck($product->countries->toArray(), 'name');
                            $countries = implode(', ', $countries);
                        @endphp

                        <div class="col-md-6 col-sm-6 col-xs-12 place">
                            <div class="col-md-6 col-sm-12 col-xs-12"> <img src="{{ cropImage($product->image, 250, 230) }}" alt="" /> </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h3>{{ $product->name }}</h3>
                                <span> {!! $countries !!} </span>
                                <p>{{ $product->sedcription_short }}</p> <a href="tour-details.html" class="link-btn">more info</a> </div>
                        </div>
                        @php $i++; @endphp
                        @if($i %2 == 0)
                </div>
                <div class="popu-places-home">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--====== TIPS BEFORE TRAVEL ==========-->
    <section>
        <div class="rows tips tips-home home_title" style="background-image: url(../images/home-large-image/{{ $homeImages[$rand[1]] }}.jpg)">
            <div class="light-layout tb-space ">
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
                                    <a href="#"><img src="{{ asset('images/Location-Manager.png') }}" alt=""> </a>
                                </li>
                                <!-- PRIVATE GUIDE -->
                                <li>
                                    <a href="#"><img src="{{ asset('images/Private-Guide.png') }}" alt=""> </a>
                                </li>
                                <!-- ARRANGEMENTS -->
                                <li>
                                    <a href="#"><img src="{{ asset('images/Arrangements.png') }}" alt=""> </a>
                                </li>
                                <!-- EVENT ACTIVITIES -->
                                <li>
                                    <a href="#"><img src="{{ asset('images/Events-Activities.png') }}" alt=""> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection