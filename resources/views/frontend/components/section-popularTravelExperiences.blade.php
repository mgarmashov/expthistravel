<div class="popu-places-home">
    @foreach(\App\Models\Product::query()->inRandomOrder()->limit(6)->with('countries')->get() as $product)
        @php
            $countries = array_pluck($product->countries->toArray(), 'name');
            $countries = implode(', ', $countries);
        @endphp

        <div class="col-md-4 col-sm-6 col-xs-12 b_packages">
            <div class="v_place_img"><img src="{{ asset(cropImage($product->image, 250, 230)) }}" alt="{{ $product->name }}" title="{{ $product->name }}"> </div>
            <div class="b_pack rows">
                <div class="col-md-8 col-sm-8">
                    <h4><a href="{{ route('product', ['id' => $product->slug]) }}">{{ $product->name }}<span class="v_pl_name">({{ $product->countries()->first()->name ?? '' }})</span></a></h4> </div>
                <div class="col-md-4 col-sm-4 pack_icon">
                    <ul>
                        <li>
                            <a href="{{ route('product', ['id' => $product->slug]) }}"><img src="{{ asset('images/clock.png') }}" alt="{{ $product->duration() }}" title="{{ $product->duration() }}"> </a>
                        </li>
                        <li>
                            <a href="{{ route('product', ['id' => $product->slug]) }}"><img src="{{ asset('images/info.png') }}" alt="{{ $product->description_short }}" title="{{ $product->description_short }}"> </a>
                        </li>
                        @if($product->price)
                        <li>
                            <a href="{{ route('product', ['id' => $product->slug]) }}"><img src="{{ asset('images/price.png') }}" alt="From: {{ $product->price }}" title="From: {{ $product->price }}"> </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('product', ['id' => $product->slug]) }}"><img src="{{ asset('images/map.png') }}" alt="{{ $product->countries()->first()->name ?? '' }}" title="{{ $product->countries()->first()->name ?? '' }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
