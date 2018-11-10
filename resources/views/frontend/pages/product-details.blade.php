@extends('frontend.layouts.main')

@section('title')
    | {{ $product->name }}
@endsection

@push('after_styles')

@endpush

@section('content')
<!--====== BANNER ==========-->
<section>
    <div class="rows inner_banner inner_banner_4" style="background-image: url(
{{--    {{ asset(cropImage($product->image, 1350, 500)) }}--}}
            {{ asset('images/home-large-image/'.randomBgImage()) }}
            )">
        <div class="container">
            <h2>| {{ $product->name }}</h2>
            <ul>
                <li><a href="#inner-page-title">Home</a>
                </li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                <li><a href="{{ route('experiences') }}" class="bread-acti">Experiences</a>
                </li>
            </ul>
            <p>| {{ $product->description_short ?? '' }}</p>
        </div>
    </div>
</section>
<!--====== TOUR DETAILS - BOOKING ==========-->
<section>
    <div class="rows banner_book" id="inner-page-title">
        <div class="container">
            <div class="banner_book_1">
                <ul>
                    <li class="dl1">Location : {{ $product->place() }}</li>
                    <li class="dl2">Duration : {{ $product->duration() }}</li>
                    <li class="dl3">&nbsp;</li>
                    <li class="dl4"><a class="btn-book-product" href="#">Book Now</a> </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--====== TOUR DETAILS ==========-->
<section>
    <div class="rows inn-page-bg com-colo">
        <div class="container inn-page-con-bg tb-space">
            <div class="col-md-9">
                <!--====== TOUR TITLE ==========-->
                <div class="tour_head">
                    <h2>{{ $product->name }}</h2> </div>

                <div class="tour_head1">
                    <h3>Type of Experience</h3>
                    <div class="product-scores">
                        <ul>
                            @foreach($product->scores() as $category => $score)
                                <li>
                                    <span class="name">{{ $category }}:</span>
                                    <span class="line" style="width: {{$score/10*50}}%"></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tour_head1">
                    <h3>Description</h3>
                    <p>
                        {!! $product->description_long !!}
                    </p>
                </div>
            </div>
            <div class="col-md-3 tour_r">
                <!--====== TRIP INFORMATION ==========-->
                <div class="tour_right tour_incl tour-ri-com">
                    <h3>Trip Information</h3>
                    <ul>
                        <li>Location : {{ $product->place() }}</li>
                        <li>Duration: {{ $product->duration() }}</li>
                        <li>Time of year: {{ $product->months() }}</li>
                    </ul>
                </div>

                <!--====== PUPULAR TOUR PACKAGES ==========-->
                <div class="tour_right tour_rela tour-ri-com">
                    <h3>Add Other Experiences</h3>
                    @foreach($popularPackages as $pp)
                        <div class="tour_rela_1">
                            <img src="{{ asset(cropImage($pp->image, 250, 200)) }}" alt="" />
                            <h4>{{ $pp->place() }} : {{ $pp->name }}</h4>
                            <p> {!! $pp->description_short !!}</p>
                            <a href="{{ route('product', ['id' => $pp->id]) }}" class="link-btn">Find out more</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('after_scripts')
    <script>
        let buttons = document.getElementsByClassName('btn-book-product');
        for ( let button of buttons ) {
            button.onclick = function() {
                event.preventDefault();
                var currentBtn = this;
                $.ajax({
                    type: "get",
                    url: '{{ route('productToOrder', ['id' => $product->id]) }}',

                    success: function () {
                        window.location.href = '{{ route('orderPage') }}';
                    },
                });            }
        }
    </script>
@endpush