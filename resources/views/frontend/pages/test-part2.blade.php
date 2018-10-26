@extends('frontend.layouts.main')

@php
    $totalCounter = count(\App\Models\Activity::all());
@endphp

@section('content')
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Answer few questions</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Press if you like things on picture</p>
                    <p id="counter" data-number=1 >1/{{ $totalCounter }}</p>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    <select>
                        <option value="" disabled selected>Who is travelling</option>
                        <option value="1">•	I’m going solo</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="1">4</option>
                        <option value="1">5</option>
                        <option value="1">6</option>
                    </select>

                </div>
            </div>
        </div>





    </section>
@endsection


@push('after_scripts')

@endpush