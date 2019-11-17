@extends('frontend.layouts.main')

@section('title')Optimal tours | {{env('APP_NAME')}}@endsection

@push('after_styles')
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />--}}
@endpush

@section('content')

    @include('frontend.components.filter-section')

    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg container--products-list" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Your <span>experiences</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Based on your interests and preferences. Handpicked for you</p>
                </div>
                @include('frontend.components.list-products')
            </div>
        </div>
    </section>
    @include('frontend.components.popup-googleForm')
@endsection



@push('after_scripts')
    {{--<script>--}}
        {{--let buttons = document.getElementsByClassName('btn-book-product');--}}
        {{--for ( let button of buttons ) {--}}
            {{--button.onclick = function() {--}}
                {{--event.preventDefault();--}}
                {{--var currentBtn = this;--}}
                {{--$.ajax({--}}
                    {{--type: "get",--}}
                    {{--url: '{{ route('productToOrder') }}/'+currentBtn.dataset.product,--}}

                    {{--success: function () {--}}
                    {{--},--}}
                {{--});--}}
                {{--var newEl = document.createElement('p');--}}
                {{--newEl.classList.add('added-to-order');--}}
                {{--newEl.innerHTML = 'Added to <a class="" href="{{ route('orderPage') }}">order</a>';--}}

                {{--currentBtn.parentNode.replaceChild(newEl, currentBtn);--}}
            {{--}--}}
        {{--}--}}
    {{--</script>--}}
@endpush
