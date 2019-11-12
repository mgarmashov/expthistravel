<div class="popu-places-home">
    @foreach(\App\Models\Product::query()->inRandomOrder()->limit(4)->with('countries')->get() as $product)
        @php
            $countries = array_pluck($product->countries->toArray(), 'name');
            $countries = implode(', ', $countries);
        @endphp

        <div class="col-md-6 col-sm-6 col-xs-12 place">
            <div class="col-md-6 col-sm-12 col-xs-12"> <img src="{{ asset(cropImage($product->image, 250, 230)) }}" alt="" /> </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <a href="{{ route('product', ['id' => $product->slug]) }}"><h3>{{ $product->name }}</h3></a>
                <p>{{ $product->description_short }}</p>
                <div class="featur">
                    <h4>{{ $product->countries()->first()->name ?? '' }}</h4>
                    <ul>
                        <li>{{ $product->duration() }}</li>
                    </ul>
                </div>
                <div class="p2_book">
                    <ul>
                        <li><a href="#" class="link-btn btn-book-product" data-product="{{$product->id}}">Add to my trip</a> </li>
                        <li><a href="{{ route('product', ['id' => $product->slug]) }}" class="link-btn">Find out more</a> </li>
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