<div class="hot-page2-alp-r-list">
    <div class="col-md-3 hot-page2-alp-r-list-re-sp">
        <a href="{{ route('product', ['id' => $product->slug]) }}">
{{--            <div class="hotel-list-score">4.5</div>--}}
            <div class="hot-page2-hli-1"> <img src="{{ asset(cropImage($product->image, 550, 353)) }}" alt=""> </div>
            <div class="hom-hot-av-tic hom-hot-av-tic-list">{{ $product->duration() }}</div>
        </a>
    </div>
    <div class="col-md-6">
        <div class="hot-page2-alp-ri-p2"> <a href="{{ route('product', ['id' => $product->slug]) }}"><h3>{{ $product->name }}</h3></a>
            <div class="description-short">{{ $product->description_short }}</div>
            <div class="place"><i class="fa fa-globe" aria-hidden="true"></i> {{ $product->place() }}</div>
            <div class="months"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{ $product->months() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="hot-page2-alp-ri-p3">
{{--            <div class="hot-page2-alp-r-hot-page-rat">25%Off</div>--}}
            @if($product->price)
                <span class="hot-list-p3-1">From:</span>
                <span class="hot-list-p3-2">&pound;{{ $product->price ?? '' }}</span>
            @endif
            <span class="hot-list-p3-4">
                <a href="{{ route('product', ['id' => $product->slug]) }}" class="hot-page2-alp-quot-btn">Find out more</a>
            </span>
        </div>
    </div>
</div>
