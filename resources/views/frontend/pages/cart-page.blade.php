@extends('frontend.layouts.main')

@section('title')
    | Cart
@endsection

@section('content')

<section>
    <div class="db">
    <div class="container">

        <div class="db-2">
            @include('frontend.components.profile-cart-list')
        </div>
    </div>
    </div>

</section>


@endsection


@push('after_scripts')
    <script>

    </script>
@endpush