@extends('frontend.layouts.main')

@section('title')
    | Profile
@endsection

@section('content')

<section>
    <div class="db">
        <div class="db-l">
            @include('frontend.components.profile-left-part')
        </div>

        <div class="db-2">
            @include('frontend.components.profile-cart-list')
        </div>
    </div>
</section>


@endsection


@push('after_scripts')
    <script>

    </script>
@endpush