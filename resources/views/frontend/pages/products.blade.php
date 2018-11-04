@extends('frontend.layouts.main')

@section('title')
    | Search
@endsection

@push('after_styles')

@endpush

@section('content')

    @include('frontend.components.filter-section')

    {{--<section>--}}
        {{--<div class="rows inner_banner inner_banner_2">--}}
            {{--<div class="container">--}}
                {{--<h2><span>Regular Package -</span> Top Regular Packages In The World</h2>--}}
                {{--<ul>--}}
                    {{--<li><a href="#inner-page-title">Home</a>--}}
                    {{--</li>--}}
                    {{--<li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>--}}
                    {{--<li><a href="#inner-page-title" class="bread-acti">Regular Package</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<p>Book travel packages and enjoy your holidays with distinctive experience</p>--}}
                {{--<div class="application-layout">--}}

                    {{--@auth--}}
                        {{--<h4>Your top interests</h4>--}}
                        {{--<div class="charts-block">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--@php--}}
                                    {{--$i = 1;--}}
                                {{--@endphp--}}
                                {{--@foreach($scores as $id => $score)--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-4 label-column"><span class="chart-label">{{ $score['name'] }}</span></div>--}}
                                        {{--<div class="col-sm-8 chart-column"><div class="chart-line" style="width: {{$score['percent']}}%;">{{ $score['percent'] }}%</div></div>--}}
                                    {{--</div>--}}
                                    {{--@if($i%2 == 0)--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6">--}}
                                {{--@endif--}}
                                {{--@php--}}
                                    {{--$i++;--}}
                                {{--@endphp--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                    {{--@endauth--}}

                    {{--@include('frontend.components.filter')--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>All <span>experience</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>As you filtered, sure. @auth It's sorted according your interests @endauth</p>
                </div>
                @foreach($products as $product)
                    @include('frontend.components.list-item-product-large', ['product' => $product])
                @endforeach
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
                    url: '{{ route('productToOrder') }}/'+currentBtn.dataset.product,

                    success: function () {
                    },
                });
                var newEl = document.createElement('p');
                newEl.classList.add('added-to-order');
                newEl.innerHTML = 'Added to <a class="" href="{{ route('orderPage') }}">order</a>';

                currentBtn.parentNode.replaceChild(newEl, currentBtn);
            }
        }
    </script>
@endpush