@php
    $countries = array_pluck($product->countries->toArray(), 'name');
    $countries = implode(', ', $countries);
@endphp
<div class="col-md-4 col-sm-6 col-xs-12 b_packages">
    {{--                            <div class="band"><img src="{{ asset('images/band.png') }}" alt="" /> </div>--}}
    <div class="v_place_img">
        <a href="{{ route('product', ['id' => $product->slug]) }}"><img src="{{ asset(cropImage($product->image, 377, 218)) }}" alt="{{ $product->name }}" title="{{ $product->name }}" /></a>
    </div>
    <div class="b_pack rows">
        <div class="col-md-12 col-sm-12 product-small-tile" data-product="{{$product->id}}">
            <h4 class="product-list-name">
                <a href="{{ route('product', ['id' => $product->slug]) }}">{{ $product->name }} <br />
                    <span class="v_pl_name">{!! $countries !!}</span>
                </a>
            </h4>
            <div class="p2_book text-right">
                <ul>
                    <li><a href="#" class="link-btn btn-book-product" data-product="{{$product->id}}">Add to my trip</a> </li>
                    <li><a href="{{ route('product', ['id' => $product->slug]) }}" class="link-btn">Find out more</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>