@extends('frontend.layouts.main')

@php
    $title = !empty($product->seo_title) ? $product->seo_title : $product->name;
    $description = !empty($product->seo_description) ? $product->seo_description : (!empty($product->description_short) ? $product->description_short : mb_substr(strip_tags($product->description_long), 0, 160));
    $title = !empty($product->seo_h1) ? $product->seo_h1 : $product->name;
@endphp

@section('title')
    {{ $title }} | {{ env('APP_NAME') }}
@endsection

@push('seo')
    <meta name="description" content="{!!  $description !!}">
    <meta property="og:description" content="{!! $description !!}"/>

    @if(!empty($product->keywords))
        <meta name="keywords" content="{{ $product->keywords }}">
    @endif
@endpush


@if(!empty($product->image))
    @section('og-image'){{ asset($product->image) }}@endsection
@endif


@push('after_styles')

@endpush

@section('content')
<!--====== BANNER ==========-->
<section>
    <div class="rows inner_banner inner_banner_4" @include('frontend.components.randomBgStyle')>
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
                <div class="tour_head1 hotel-book-room">
                    <h3>Photo Gallery</h3>
                    <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators carousel-indicators-1">
                            <li data-target="#myCarousel1" data-slide-to="0"><img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            </li>
                            {{--<li data-target="#myCarousel1" data-slide-to="1"><img src="images/gallery/t2.jpg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="2"><img src="images/gallery/t3.jpg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="3"><img src="images/gallery/t4.jpg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="4"><img src="images/gallery/t5.jpg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="5"><img src="images/gallery/s6.jpeg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="6"><img src="images/gallery/s7.jpeg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="7"><img src="images/gallery/s8.jpg" alt="Chania">--}}
                            {{--</li>--}}
                            {{--<li data-target="#myCarousel1" data-slide-to="8"><img src="images/gallery/s9.jpg" alt="Chania">--}}
                            {{--</li>--}}
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner carousel-inner1" role="listbox">
                            <div class="item active"> <img src="{{ asset($product->image) }}" alt="Chania" width="460" height="345"> </div>
                            {{--<div class="item"> <img src="images/gallery/t2.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t3.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t4.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t5.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t6.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t7.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t8.jpg" alt="Chania" width="460" height="345"> </div>--}}
                            {{--<div class="item"> <img src="images/gallery/t9.jpg" alt="Chania" width="460" height="345"> </div>--}}
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"> <span><i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true"></i></span> </a>
                        <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next"> <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true"></i></span> </a>
                    </div>
                </div>

                {{--Country description--}}
                @if( count($product->countries()->get()) )
                    @php
                        $country = $product->countries()->first()
                    @endphp
                    <div class="tour_head1">
                        <h3>About {{ $country->name }}</h3>
                        <div class="row">
                            <p>
                                @if($country->image)
                                    <img class="col m6" src="{{ asset($country->image) }}" alt="">
                                @endif
                                {!! $country->description_long !!}
                            </p>
                        </div>
                    </div>
                @endif

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