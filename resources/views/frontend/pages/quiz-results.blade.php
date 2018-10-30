@extends('frontend.layouts.main')

@section('content')

    <!--====== PLACES ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Top <span>Sight Seeings</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <div>
                    <!--====== PACKAGE ==========-->
                    <div class="col-md-4 col-sm-6 col-xs-12 b_packages">
                        <div class="band"><img src="images/band.png" alt="" /> </div>
                        <div class="v_place_img"><img src="images/t5.png" alt="Tour Booking" title="Tour Booking" /> </div>
                        <div class="b_pack rows">
                            <div class="col-md-8 col-sm-8">
                                <h4><a href="tour-details.html">RIO DE JANEIRO<span class="v_pl_name">(Brazil)</span></a></h4> </div>
                            <div class="col-md-4 col-sm-4 pack_icon">
                                <ul>
                                    <li>
                                        <a href="#"><img src="images/clock.png" alt="Date" title="Tour Timing" /> </a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="images/info.png" alt="Details" title="View more details" /> </a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="images/price.png" alt="Price" title="Price" /> </a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="images/map.png" alt="Location" title="Location" /> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--====== TIPS BEFORE TRAVEL
@endsection


@push('after_scripts')
    <script>
        document.getElementById('submit-btn').onclick = function() {
            let form = document.getElementById('register-form');
            let fields = [];
            fields.push(form.querySelector('input[name="email"]'));
            fields.push(form.querySelector('input[name="password"]'));
            fields.push(form.querySelector('input[name="password_confirmation"]'));
            for ( let input of fields ) {
                if (input.value == null || input.value == '' || input.value == 'NaN' || input.value == 'undefined') {
                    break;
                }
                form.submit();
            }
        }
    </script>
@endpush