@extends('frontend.layouts.main')

@php
    $title = !empty($itinerary->seo_title) ? $itinerary->seo_title : $itinerary->name;
    $description = !empty($itinerary->seo_description) ? $itinerary->seo_description : (!empty($itinerary->description_short) ? $itinerary->description_short : mb_substr(strip_tags($itinerary->description_long), 0, 160));
    $h1 = !empty($itinerary->seo_h1) ? $itinerary->seo_h1 : $itinerary->name;
@endphp

@section('title')
    {{ $title }} | {{ env('APP_NAME') }}
@endsection

@push('seo')
    <meta name="description" content="{!!  $description !!}">
    <meta property="og:description" content="{!! $description !!}"/>

    @if(!empty($itinerary->keywords))
        <meta name="keywords" content="{{ $itinerary->keywords }}">
    @endif
@endpush


@if(!empty($itinerary->image))
    @section('og-image'){{ asset($itinerary->image) }}@endsection
@endif


@push('after_styles')
    <link rel="stylesheet" href="{{ asset('/vendor/lightslider/css/lightslider.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/lightgallery/css/lightgallery.css') }}">
@endpush

@section('content')
<!--====== BANNER ==========-->
<section>
    @if($itinerary->image_background)
    <div class="rows inner_banner inner_banner_4" style="background-image: url({{ asset($itinerary->image_background) }}); background-size: cover; background-position: center;">
    @else
    <div class="rows inner_banner inner_banner_4" @include('frontend.components.randomBgStyle')>
    @endif
        <div class="container">
            <h1 class="red-text">| {{ $h1 }}</h1>
            <ul>
                <li><a href="#inner-page-title">Home</a>
                </li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                <li><a href="{{ route('itineraries') }}" class="bread-acti">Itineraries</a>
                </li>
            </ul>
            <p>| {{ $itinerary->description_short ?? '' }}</p>
        </div>
    </div>
</section>
<!--====== TOUR DETAILS - BOOKING ==========-->
<section>
    <div class="rows banner_book" id="inner-page-title">
        <div class="container">
            <div class="banner_book_1">
                <ul>
                    <li class="dl1">Destination : {{ $itinerary->place() }}</li>
                    <li class="dl2">{!! $itinerary->price ? 'From: £'.$itinerary->price : '&nbsp;' !!}</li>
                    <li class="dl3">Duration : {{ $itinerary->duration() }}</li>
                    <li class="dl4"><a class="btn-book-product" href="#">Book Now</a> </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--====== TOUR DETAILS ==========-->
<section>
    <div class="rows inn-page-bg com-colo">
        <div class="container-fluid inn-page-con-bg">
            <div class="col-md-9">

                <div class="tour_head1">
                    <h3>About your trip</h3>
                    <div class="long-description-block">
                        {!! $itinerary->description_long !!}
                    </div>
                </div>

                @if($itinerary->image_map)
                <div class="tour_head1">
                    <div class="long-description-block">
                        <img class="materialboxed" src="{{ asset(cropImage($itinerary->image_map, 960, 720)) }}" alt="">
                    </div>
                </div>
                @endif

                @if($itinerary->map_url)
                <div class="tour_head1">
                    <h3>Map</h3>
                    <div class="long-description-block">
                        <iframe src="{{ $itinerary->map_url }}"  width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
                @endif

                <div class="tour_head1 hotel-book-room">
                    <div class="gallery-container">
                        <ul id="imageGallery">
                            @if($itinerary->image_main)
                                <li data-thumb="{{ asset(cropImage($itinerary->image_main, 160, 90)) }}" data-src="{{ asset($itinerary->image_main) }}">
                                    <img src="{{ asset(cropImage($itinerary->image_main, 960, 720)) }}" />
                                </li>
                            @endif
                            @if($itinerary->gallery)
                            @foreach($itinerary->gallery as $path)
                                <li data-thumb="{{ asset(cropImage($path, 160, 90)) }}" data-src="{{ asset($path) }}">
                                    <img src="{{ asset(cropImage($path, 960, 720)) }}" />
                                </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                @if(count($itinerary->products()->get()) >0 )
                    <div class="tour_head1 l-info-pack-days days">
                        <h3>Your Experiences</h3>
                        <ul>
                            @foreach($itinerary->products()->get() as $product)
                                <li class="l-info-pack-plac"> <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                    <h4><a href="{{ route('product', ['id' => $product->slug]) }}">{{ $product->name }}</a></h4>
                                    <a class="experience-image" href="{{ route('product', ['id' => $product->slug]) }}">
                                        <img src="{{ asset(cropImage($product->image, 550, 353)) }}" alt="" />
                                    </a>
                                    <p> {{ $product->description_short }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($itinerary->highlightsArray())
                <div class="tour_head1 hot-ameni">
                    <h3>What’s Included?</h3>
                    <ul>
                        @foreach($itinerary->highlightsArray() as $highlight)
                            <li><i class="fa fa-check" aria-hidden="true"></i> {{ $highlight }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($itinerary->transport)
                    <div class="">
                        <h3>Your Transport</h3>
                        <div class="long-description-block">
                            <div class="table-section">
                                {!! $itinerary->transport !!}
                            </div>
                        </div>
                    </div>
                @endif

                {{--Country description--}}
                @if( count($itinerary->countries()->get()) )
                    @php
                        $country = $itinerary->countries()->first()
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

            <div class="col-md-3 tour_r  margin50">
                <!--====== TRIP INFORMATION ==========-->
                <div class="tour_right tour_incl tour-ri-com">
                    <h3>Trip Information</h3>
                    <ul>
                        <li>Destination : {{ $itinerary->place() }}</li>
                        <li>Duration: {{ $itinerary->duration() }}</li>
                        @if($itinerary->price)
                            <li>From: £{{$itinerary->price}}</li>
                        @endif
                        <li>Time of year: {{ $itinerary->months() }}</li>
                        @if($itinerary->travel_styles && count($itinerary->travel_styles) == 1)
                            <li>Style: {{ config('questions.q_travel_style')[$itinerary->travel_styles[0]] }}</li>
                        @endif
                        @if($itinerary->travel_styles && count($itinerary->travel_styles) > 1)
                            <li>Styles: @foreach($itinerary->travel_styles as $style) {{ config('questions.q_travel_style')[$style] ?? '' }}; @endforeach</li>
                        @endif
                        @if($itinerary->sights && count($itinerary->sights) == 1)
                            <li>Sights: {{ config('questions.q_preferred_sight')[$itinerary->sights[0]] }}</li>
                        @endif
                        @if($itinerary->sights && count($itinerary->sights) > 1)
                            <li>Sights: @foreach($itinerary->sights as $sight) {{ config('questions.q_preferred_sight')[$sight] ?? '' }}; @endforeach</li>
                        @endif
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
                    url: '{{ route('productToOrder', ['id' => $itinerary->id]) }}',

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
