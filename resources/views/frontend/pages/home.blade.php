@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="tourz-search" style="background-image: url({{ Setting::get('home_banner_image') }}); background-size: cover; background-position: center;">
            <div class="dark-layout" style="background: rgba(0,0,0,{{ Setting::get('home_banner_darkness') / 100 }})">
                <div class="container">
                    <div class="row">
                        <div class="tourz-search-1">
                            <h1>{{ \Backpack\Settings\app\Models\Setting::get('home_banner_text') }}</h1>
                            {{--<p>Discover amazing travel experiences suited to you <br>--}}
                                {{--–<br>--}}
                                {{--Design your tailormade trip--}}
                                {{--<br>– <br />--}}
                                {{--Your personalised travel itinerary, organised and booked for you<br>--}}
                                {{--–--}}
                                {{--<br>Create incredible travel memories</p>--}}
                            <a class="waves-effect waves-light tourz-sear-btn" href="{{ route('quiz-step1') }}"> Get started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="rows pla pad-bot-redu tb-space">
            <div class="pla1 p-home container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title spe-title-1">
                    <p class="preheader">Looking for inspiration? Try our Experience Finder.</p>
                    <h2>How it <span>works</span>:</h2>

                </div>
                <div class="howItWorks-container">
                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">1</div>
                            {{--<i class="fa fa-check"></i>--}}
                            <img src="{{ asset('images/icon-tick.png') }}" alt="">
                            <h5>Tell us what you’re looking for</h5>
                            <p>Answer a few questions to help us find your ideal trip</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">2</div>
                            {{--<i class="fa fa-thumbs-up" aria-hidden="true"></i>--}}
                            <img src="{{ asset('images/icon-thumb-up.png') }}" alt="">
                            <h5>Get personalised travel recommendations</h5>
                            <p>Discover trip inspiration tailored to your interests</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">3</div>
                            {{--<i class="fa fa-map-signs" aria-hidden="true"></i>--}}
                            <img src="{{ asset('images/icon-trip.png') }}" alt="">
                            <h5>Decide where to go and what to do</h5>
                            <p>Select a ready-made <b>itinerary</b> or pick and mix <b>experiences</b> to create a custom trip</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">4</div>
                            {{--<i class="fa fa-ticket" aria-hidden="true"></i>--}}
                            <img src="{{ asset('images/icon-ticket.png') }}" alt="">
                            <h5>Get your tailormade travel plan</h5>
                            <p>Request a quote and receive a personalised travel plan with your entire trip taken care of.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="rows pla pad-bot-redu tb-space">
            <div class="pla1 p-home container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title spe-title-1">
                    <a href="{{ route('itineraries') }}"><h2>Itineraries</h2></a>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Choose from our collection of expertly crafted itineraries, complete with incredible travel experiences</p>
                    <p><a href="{{ route('itineraries') }}">View all Itineraries</a></p>
                </div>
                @include('frontend.components.section-popularItineraries')
                <div class="popu-places-home">
                    <p class="center">
                        <a class="link-btn col-sm-6 col-sm-offset-3" href="{{ route('itineraries') }}">View all Itineraries</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="rows pla pad-bot-redu tb-space">
            <div class="pla1 p-home container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title spe-title-1">
                    <h2>Popular travel <span>experiences</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Discover our incredible range of travel experiences:</p>
                    <p><a href="{{ route('experiences') }}">View all Experiences</a></p>
                </div>
                @include('frontend.components.section-popularTravelExperiences')
            </div>
            <div class="popu-places-home">
                <p class="center">
                    <a class="link-btn col-sm-6 col-sm-offset-3" href="{{ route('experiences') }}">View all Experiences</a>
                </p>
            </div>
        </div>
    </section>

    <section>
        <div class="rows" style="background-image: url(../images/sea-water-bg.jpg">
            <div class="light-layout tb-space ">
                <div class="container home-why-container">

                    <h3>Why Experience This?</h3>
                    <div class="col-sm-12">
                        <div class="home-why-block">
                            <div class="img-container">
                                <img src="{{ asset('images/icon-holiday.png') }}" alt="">
                            </div>
                            <h5>Personalised inspiration, bespoke packages</h5>
                            <p>- Inspiring travel ideas to match your interests</p>
                            <p>- Tailormade, unique trips</p>
                            <p>- Travel with freedom and flexibility</p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="home-why-block">
                            <div class="img-container">
                                <img src="{{ asset('images/icon-expert.png') }}" alt="">
                            </div>
                            <h5>Unique and unforgettable travel experiences</h5>
                            <p>- Only the best experiences your destination has to offer</p>
                            <p>- Expertly curated travel itineraries</p>
                            <p>- Rewarding and fulfilling trips. Satisfaction guaranteed</p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="home-why-block">
                            <div class="img-container">
                                <img src="{{ asset('images/icon-itinerary.png') }}" alt="">
                            </div>
                            <h5>Complete convenience and peace of mind</h5>
                            <p>- Semealess travel planning and booking</p>
                            <p>- Service you can rely on from our network of tried and tested local suppliers</p>
                            <p>- Support and assistance before, during and after your trip</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection

@push('after_scripts')
    <script src="{{ asset('vendor/jquery-match-height-master/dist/jquery.matchHeight-min.js') }}"></script>
    <script>
        $(function() {
            $('.howItWorks-block').matchHeight({
                byRow: true,
                property: 'height',
                target: null,
                remove: false
            });
        });
    </script>

@endpush
