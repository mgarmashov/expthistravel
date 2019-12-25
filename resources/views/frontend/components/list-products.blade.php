<div id="product-list">
    <div class="col-md-12 hot-page2-alp-con-right">
        <div class="hot-page2-alp-con-right-1">
            <!--LISTINGS-->
            <div class="row">
                @if(count($products) > 0)
                    @foreach($products as $product)

                        @include('frontend.components.list-item-product-large', ['product' => $product])

                    @endforeach
                @else
                    <div class="container text-center">
                        <h6>Sorry, no experiences match your search. Edit your selections and try again.</h6>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
<div class="clearfix"></div>
