@extends('frontend.layouts.main')

@php
    $title = !empty($product->seo_title) ? $product->seo_title : $product->name;
    $description = !empty($product->seo_description) ? $product->seo_description : (!empty($product->description_short) ? $product->description_short : mb_substr(strip_tags($product->description_long), 0, 160));
    $h1 = !empty($product->seo_h1) ? $product->seo_h1 : $product->name;
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
    <link rel="stylesheet" href="{{ asset('/vendor/lightslider/css/lightslider.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/lightgallery/css/lightgallery.css') }}">
@endpush

@section('content')
<!--====== BANNER ==========-->
<section>
    @if($product->image_background)
    <div class="rows inner_banner inner_banner_4" style="background-image: url({{ asset($product->image_background) }}); background-size: cover; background-position: center;">
    @else
    <div class="rows inner_banner inner_banner_4" @include('frontend.components.randomBgStyle')>
    @endif
        <div class="container">
            <h1 class="red-text">| {{ $h1 }}</h1>
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
                    <li class="dl1">Destination : {{ $product->place() }}</li>
                    <li class="dl2">{!! $product->price ? 'From: £'.$product->price : '&nbsp;' !!}</li>
                    <li class="dl3">Duration : {{ $product->duration() }}</li>
                    <li class="dl4"><a class="btn-book-product" href="#">Book Now</a> </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--====== TOUR DETAILS ==========-->
<section>
    <div class="rows inn-page-bg com-colo">
        <div class="container-fluid inn-page-con-bg tb-space">
            <div class="col-md-9">

                <div class="tour_head1">
                    <h3>Description</h3>
                    <div class="long-description-block">
                        {!! $product->description_long !!}
                    </div>

                </div>
                <div class="tour_head1 hotel-book-room">
                    <h3>Photo Gallery</h3>
                    <div class="gallery-container">
                        <ul id="imageGallery">
                            @if($product->image)
                                <li data-thumb="{{ asset(cropImage($product->image, 160, 90)) }}" data-src="{{ asset($product->image) }}">
                                    <img src="{{ asset(cropImage($product->image, 800, 600)) }}" />
                                </li>
                            @endif
                            @if($product->gallery)
                            @foreach($product->gallery as $path)
                                <li data-thumb="{{ asset(cropImage($path, 160, 90)) }}" data-src="{{ asset($path) }}">
                                    <img src="{{ asset(cropImage($path, 800, 600)) }}" />
                                </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                @if($product->highlightsArray())
                <div class="tour_head1 hot-ameni">
                    <h3>Highlights</h3>
                    <ul>
                        @foreach($product->highlightsArray() as $highlight)
                            <li><i class="fa fa-check" aria-hidden="true"></i> {{ $highlight }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{--Country description--}}
                @if( count($product->countries()->get()) )
                    @php
                        $country = $product->countries()->first()
                    @endphp
                    <div class="tour_head1">
                        <h3>About {{ $country->name }}</h3>
                        <div class="row">
                            <div class="col m6">
                                @if($country->image)
                                    <img class="materialboxed image-full-width" src="{{ asset($country->image) }}" alt="">
                                @endif
                            </div>
                            <div class="col m6">
                                {!! $country->description_long !!}
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-md-3 tour_r">
                <!--====== TRIP INFORMATION ==========-->
                <div class="tour_right tour_incl tour-ri-com">
                    <h3>Trip Information</h3>
                    <ul>
                        <li>Destination : {{ $product->place() }}</li>
                        <li>Duration: {{ $product->duration() }}</li>
                        <li>Time of year: {{ $product->months() }}</li>
                    </ul>
                </div>

                <!--====== PUPULAR TOUR PACKAGES ==========-->
                <div class="tour_right tour_rela tour-ri-com">
                    <h3>View similar itineraries</h3>
                    @foreach($popularPackages as $pp)
                        <div class="tour_rela_1">
                            <img src="{{ asset(cropImage($pp->image, 424, 340)) }}" alt="" />
                            <h4>{{ $pp->place() }} : {{ $pp->name }}</h4>
                            <p> {!! $pp->description_short !!}</p>
                            <a href="{{ route('product', ['id' => $pp->slug]) }}" class="link-btn">Find out more</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('after_scripts')
    <script src="{{ asset('vendor/lightslider/js/lightslider.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/js/lightgallery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:9,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: 'li'
                    });
                },
                speed:700,
                pause: 7000,
                auto:true,
                responsive: [
                    {
                        breakpoint:400,
                        settings: {
                            enableDrag: true,
                        }
                    },
                ]
            });
        });
    </script>
    <script>
        var buttons = document.getElementsByClassName('btn-book-product');
        for ( var button of buttons ) {
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


    <script>
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>
@endpush
