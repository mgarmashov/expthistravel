<div class="popu-places-home">
    @foreach(\App\Models\Itinerary::query()->inRandomOrder()->limit(4)->with('countries')->get() as $itinerary)
        @php
            $countries = array_pluck($itinerary->countries->toArray(), 'name');
            $countries = implode(', ', $countries);
        @endphp

        <div class="col-md-6 col-sm-6 col-xs-12 place">
            <div class="col-md-6 col-sm-12 col-xs-12"> <img src="{{ asset(cropImage($itinerary->image_main, 250, 230)) }}" alt="" /> </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <a href="{{ route('itinerary', ['id' => $itinerary->slug]) }}"><h3>{{ $itinerary->name }}</h3></a>
                <p>{{ $itinerary->description_short }}</p>
                <div class="featur">
                    <h4>{{ $itinerary->countries()->first()->name ?? '' }}</h4>
                    <ul>
                        <li>{{ $itinerary->duration() }}</li>
                    </ul>
                </div>
                <div class="p2_book">
                    <ul>
                        {{--<li><a href="#" class="link-btn btn-book-product" data-product="{{$itinerary->id}}">Add to my trip</a> </li>--}}
                        <li><a href="{{ route('itinerary', ['id' => $itinerary->slug]) }}" class="link-btn">Find out more</a> </li>
                    </ul>
                </div>
            </div>
        </div>
@if($loop->index %2 == 1)
    </div>
    <div class="popu-places-home">
@endif
    @endforeach
</div>
