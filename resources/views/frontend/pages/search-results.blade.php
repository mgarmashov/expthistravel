@extends('frontend.layouts.main')

@section('title')Search | {{env('APP_NAME')}}@endsection

@push('after_styles')

@endpush

@section('content')
    <div class="background-image" style="background-image: url({{ asset('images/bg-images/v1/beach4.jpg') }}); background-size: cover; background-position: center; background-attachment: fixed">
        <div class="dark-layout">
            @include('frontend.components.filter-section')

            <section class="search-results-section">
                <div class="book-tab-inn container search-tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#itineraries-list-container" aria-expanded="true"><i class="fab fa-fly"></i> Itineraries</a></li>
                            <li class=""><a data-toggle="tab" href="#experiences-list-container" aria-expanded="false">Experiences</a></li>
                        </ul>

                        <div class="tab-content book-tab-body">
                            <div id="itineraries-list-container" class="tab-pane fade active in">
                                <div class="book-tab-tit">
                                    @if(isset($filter['applyScores']) && $filter['applyScores'] == 'yes')
                                        <h3>Your itineraries</h3>
                                        <p>Based on your interests and preferences. Handpicked for you</p>
                                    @else
                                        <h3>All itineraries</h3>

                                        @if(!Auth::check() || !Auth::user()->totalScores)
                                            <p>Discover our incredible range of travel experiences.</p>
                                            <p>Get personalised travel inspiration here - <a class="link-large" href="{{ route('quiz-step0') }}">Get Started</a></p>
                                        @endif
                                    @endif

                                </div>
                                @include('frontend.components.list-itineraries')

                            </div>
                            <div id="experiences-list-container" class="tab-pane fade">
                                <div class="book-tab-tit">
                                    @if(isset($filter['applyScores']) && $filter['applyScores'] == 'yes')
                                        <h3>Your experiences</h3>
                                        <p>Based on your interests and preferences. Handpicked for you</p>
                                    @else
                                        <h3>All experiences</h3>

                                        @if(!Auth::check() || !Auth::user()->totalScores)
                                            <p>Discover our incredible range of travel experiences.</p>
                                            <p>Get personalised travel inspiration here - <a class="link-large" href="{{ route('quiz-step0') }}">Get Started</a></p>
                                        @endif
                                    @endif
                                </div>

                                @include('frontend.components.list-products')
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>

    @include('frontend.components.popup-googleForm')

@endsection

@push('after_scripts')

@endpush
