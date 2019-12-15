<div class="rows p2_2">
    <div class="col-md-6 col-sm-6 col-xs-12 p2_1">
        <a href="{{ route('product', ['id' => $product->slug]) }}">
            <img src="{{ asset(cropImage($product->image, 550, 353)) }}" alt="" />
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 p2">
        <a href="{{ route('product', ['id' => $product->slug]) }}"><h3>{{ $product->name }}</h3></a>
        <p>{{ $product->description_short }}</p>
        {{--<hr class="margin10">--}}
        {{--<div class="products-list-scores">--}}
            {{--<ul>--}}
                {{--@foreach($product->scores() as $category => $score)--}}
                    {{--<li title="{{$category}}: {{$score }}/10">--}}
                        {{--<div class="line" style="width: {{$score >= 3 ? ($score*10) : 30}}%">--}}
                            {{--<span class="name">{{ $category }}</span>--}}
                            {{--<span class="number">{{$score }} / 10</span>--}}
                        {{--</div>--}}
                    {{--</li>--}}

                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<hr class="margin10">--}}
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
            <a href="{{ route('product', ['id' => $product->slug]) }}" class="link-btn">Find out more</a>
        </div>
    </div>
</div>
