<div id="itineraries-list">
    @if(count($itineraries) > 0)
        @foreach($itineraries as $itinerary)

            <div class="rows p2_2">
                <div class="col-md-6 col-sm-6 col-xs-12 p2_1">
                    <a href="{{ route('itinerary', ['id' => $itinerary->slug]) }}">
                        <img src="{{ asset(cropImage($itinerary->image_main, 550, 353)) }}" alt="" />
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 p2">
                    <a href="{{ route('itinerary', ['id' => $itinerary->slug]) }}"><h3>{{ $itinerary->name }}</h3></a>
                    <p>{{ $itinerary->description_short }}</p>
                    <div class="featur">

                        <h4>{{ $itinerary->place() }}</h4>

                        <ul>
                            <li>{{ $itinerary->duration() }}</li>highlightsArray
                        </ul>
                        <ul>
                            <li>{{ $itinerary->months() }}</li>
                        </ul>
                    </div>
                    <div class="p2_book">
                        <a href="{{ route('product', ['id' => $itinerary->slug]) }}" class="link-btn">Find out more</a>
                    </div>
                </div>
            </div>

        @endforeach
    @else
        <div class="container text-center">
            <h6>Sorry, no trips match your search. Edit your selections and try again.</h6>
        </div>
    @endif

</div>
