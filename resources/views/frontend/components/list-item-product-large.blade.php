<div class="rows p2_2">
    <div class="col-md-6 col-sm-6 col-xs-12 p2_1">
        <a href="{{ route('product', ['id' => $product->slug]) }}">
            <img src="{{ asset(cropImage($product->image, 550, 353)) }}" alt="" />
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 p2">
        <a href="{{ route('product', ['id' => $product->slug]) }}"><h3>{{ $product->name }}</h3></a>
        <p>{{ $product->description_short }}</p>
        <div class="featur">

            <h4>{{ $product->place() }}</h4>

            <ul>
                <li>{{ $product->duration() }}</li>
            </ul>
            <ul>
                <li>{{ $product->months() }}</li>
            </ul>
        </div>
        {{--<div class="product-scores">--}}
            {{--<ul>--}}
            {{--@foreach($product->scores() as $category => $score)--}}
                {{--<li>--}}
                    {{--<span class="name">{{ $category }}:</span>--}}
                    {{--<span class="line" style="width: {{$score/10*50}}%"></span>--}}
                {{--</li>--}}
            {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
        <div class="p2_book">
            <ul>
                <li><a href="#" class="link-btn btn-book-product" data-product="{{$product->id}}">Add to my trip</a> </li>
                <li><a href="{{ route('product', ['id' => $product->slug]) }}" class="link-btn">Find out more</a> </li>
            </ul>
        </div>
    </div>
</div>