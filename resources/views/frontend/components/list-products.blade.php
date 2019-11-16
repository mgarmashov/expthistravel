<div id="product-list">
    @if(count($products) > 0)
        @foreach($products as $product)

            @include('frontend.components.list-item-product-large', ['product' => $product])

        @endforeach
    @else
        <div class="container text-center">
            <h3>Sorry, no experiences match your search. Edit your selections and try again.</h3>
        </div>
    @endif

</div>