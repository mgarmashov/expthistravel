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
                            <a class="waves-effect waves-light tourz-sear-btn" href="{{ route('quiz-step0') }}"> Get started</a>
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
                    <h2>How it <span>works</span></h2>
                </div>
                <div class="howItWorks-container">
                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">1</div>
                            {{--<i class="fa fa-check"></i>--}}
                            <img src="{{ asset('images/icon-tick.png') }}" alt="">
                            <h5>Tell us your travel preferences</h5>
                            <p>Answer a few questions to help us find your ideal trip</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">2</div>
                            {{--<i class="fa fa-thumbs-up" aria-hidden="true"></i>--}}
                            <img src="{{ asset('images/icon-thumb-up.png') }}" alt="">
                            <h5>Get personalised travel recommendations</h5>
                            <p>Discover amazing travel experiences tailored to you and your interests</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">3</div>
                            {{--<i class="fa fa-map-signs" aria-hidden="true"></i>--}}
                            <img src="{{ asset('images/icon-trip.png') }}" alt="">
                            <h5>Create your bespoke travel plan </h5>
                            <p>Add experiences to your tailormade trip and submit your trip enquiry</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="howItWorks-block">
                            <div class="number">4</div>
                            {{--<i class="fa fa-ticket" aria-hidden="true"></i>--}}
                            <img src="{{ asset('images/icon-ticket.png') }}" alt="">
                            <h5>Your entire trip organised for you </h5>
                            <p>We’ll create your customised travel itinerary and book your entire trip for you</p>
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
                    <h2>Popular travel <span>experiences</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Discover our incredible range of travel experiences:</p>
                </div>
                @include('frontend.components.section-popularTravelExperiences')
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
                            <p>- Inspiring travel experiences to match your interests</p>
                            <p>- Tailormade, unique trips</p>
                            <p>- Satisfaction guaranteed - more rewarding, fulfilling travel experiences</p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="home-why-block">
                            <div class="img-container">
                                <img src="{{ asset('images/icon-expert.png') }}" alt="">
                            </div>
                            <h5>Trusted, tried and tested</h5>
                            <p>- Expert destination knowledge and insights</p>
                            <p>- A handpicked selection of highly-regarded, socially responsible suppliers</p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="home-why-block">
                            <div class="img-container">
                                <img src="{{ asset('images/icon-itinerary.png') }}" alt="">
                            </div>
                            <h5>Organised and booked for you</h5>
                            <p>- We do the legwork. Saving you valuable time researching and planning your trip.</p>
                            <p>- All your documents easily accessible, when you need them</p>
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
