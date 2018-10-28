@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="form form-spac rows con-page">
            <div class="container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2><span>Contact us</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-duration="1s">
                    <div class="pg-contact">
                        <div class="new-con new-con1">
                            <h2 class="m-t-0">The <span>Travel</span></h2>
                            <p>We Provide Outsourced Software Development Services To Over 50 Clients From 21 Countries.</p>
                        </div>
                        {{--<div class="new-con new-con1">--}}
                        {{--<h4>Address</h4>--}}
                        {{--<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.--}}
                        {{--<br>Landmark : Next To Airport</p>--}}
                        {{--</div>--}}
                        <div class="new-con new-con3">
                            <h4>CONTACT INFO:</h4>
                            <p>
                                {{--<a href="tel://0099999999" class="contact-icon">Phone: 01 234874 965478</a>--}}
                                {{--<br> <a href="tel://0099999999" class="contact-icon">Mobile: 01 654874 965478</a>--}}
                                <br> <a href="mailto:mytestmail@gmail.com" class="contact-icon">Email: info@company.com</a>
                            </p>
                        </div>
                        <div class="new-con new-con4">
                            <h4>Website</h4>
                            <p> <a href="#">Website: www.mycompany.com</a>
                                <br> <a href="#">Facebook: www.facebook/my</a>
                                <br> <a href="#">Blog: www.blog.mycompany.com</a> </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form_1 wow fadeInRight" data-wow-duration="1s">
                    <!--====== THANK YOU MESSAGE ==========-->
                    <div class="succ_mess">Thank you for contacting us we will get back to you soon.</div>
                    <form id="home_form" name="home_form" action="" method="post">
                        <ul>
                            <li>
                                <input type="text" name="ename" value="" id="ename" placeholder="Name" required> </li>
                            <li>
                                <input type="tel" name="emobile" value="" id="emobile" placeholder="Mobile" required> </li>
                            <li>
                                <input type="email" name="eemail" value="" id="eemail" placeholder="Email" required> </li>
                            <li>
                                <input type="text" name="esubject" value="" id="esubject" placeholder="Subject" required> </li>
                            <li>
                                <input type="text" name="ecity" value="" id="ecity" placeholder="City" required> </li>
                            <li>
                                <input type="text" name="ecount" value="" id="ecount" placeholder="Country" required> </li>
                            <li>
                                <textarea name="emess" cols="40" rows="3" id="text-comment" placeholder="Enter your message"></textarea>
                            </li>
                            <li>
                                <input type="submit" value="Submit" id="send_button"> </li>
                        </ul>
                    </form>
                </div>


            </div>
        </div>
    </section>
@endsection