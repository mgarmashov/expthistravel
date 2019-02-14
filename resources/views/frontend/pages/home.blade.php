@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="tourz-search" @include('frontend.components.randomBgStyle')>
            <div class="dark-layout">
                <div class="container">
                    <div class="row">
                        <div class="tourz-search-1">
                            <h1>Travel experiences made for you</h1>
                            {{--<p>Discover amazing travel experiences suited to you <br>--}}
                                {{--–<br>--}}
                                {{--Design your tailormade trip--}}
                                {{--<br>– <br />--}}
                                {{--Your personalised travel itinerary, organised and booked for you<br>--}}
                                {{--–--}}
                                {{--<br>Create incredible travel memories</p>--}}
                            <a class="waves-effect waves-light tourz-sear-btn" href="{{ route('quiz-part1') }}"> Get started</a>
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
                            <h5>Take our travel profiler test </h5>
                            <p>You tell us what you’re looking for from your trip with our quick and easy quiz</p>
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
                                <a href="{{ route('product', ['id' => $product->id]) }}"><h3>{{ $product->name }}</h3></a>
                                <p>{{ $product->description_short }}</p>
                                <div class="featur">
                                        <h4>{{ $product->countries()->first()->name }}</h4>
                                    <ul>
                                        <li>{{ $product->duration() }}</li>
                                    </ul>
                                </div>
                                <div class="p2_book">
                                    <ul>
                                        <li><a href="#" class="link-btn btn-book-product" data-product="{{$product->id}}">Add to my trip</a> </li>
                                        <li><a href="{{ route('product', ['id' => $product->id]) }}" class="link-btn">Find out more</a> </li>
                                    </ul>
                                </div>
                            </div>
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

    {{--<script>--}}
        {{--let buttons = document.getElementsByClassName('btn-book-product');--}}
        {{--for ( let button of buttons ) {--}}
            {{--button.onclick = function() {--}}
                {{--event.preventDefault();--}}
                {{--var currentBtn = this;--}}
                {{--$.ajax({--}}
                    {{--type: "get",--}}
                    {{--url: '{{ route('productToOrder') }}/'+currentBtn.dataset.product,--}}

                    {{--success: function () {--}}
                    {{--},--}}
                {{--});--}}
                {{--var newEl = document.createElement('p');--}}
                {{--newEl.classList.add('added-to-order');--}}
                {{--newEl.innerHTML = 'Added to <a class="" href="{{ route('orderPage') }}">order</a>';--}}

                {{--currentBtn.parentNode.replaceChild(newEl, currentBtn);--}}



                {{--let orderCounter = document.getElementById('order-counter');--}}

                {{--let newTotal = Number(orderCounter.dataset.total) + 1;--}}
                {{--console.log(newTotal);--}}
                {{--orderCounter.dataset.total = newTotal;--}}
                {{--orderCounter.innerHTML = newTotal;--}}


            {{--}--}}
        {{--}--}}
    {{--</script>--}}
@endpush