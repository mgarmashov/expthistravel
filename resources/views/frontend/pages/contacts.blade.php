@extends('frontend.layouts.main')

@section('title')Contacts | {{env('APP_NAME')}}@endsection

@section('content')
    <section>
        <div class="form form-spac rows con-page">
            <div class="container">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2><span>Get in touch</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>Looking for us to plan you trip? Tell us a few details about your travel plans and we’ll create your customised travel itinerary – <a class="link-large" href="{{ route('bookingPage') }}">Plan my trip</a>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-duration="1s">
                    <div class="pg-contact">
                        <div class="new-con new-con1">
                            <h2 class="m-t-0"> <span>Experience</span> This Travel</h2>
                            <p>Travel Experiences Made For You</p>
                        </div>
                        <div class="new-con new-con3 margin20">
                            <h4>CONTACT INFO:</h4>
                            Email:  <a href="mailto:{{ config('socials.emails.info') }}" class="contact-icon">{{ config('socials.emails.info') }}</a>

                        </div>
                        <div class="margin20">
                            <h4>Website</h4>
                            <p> <a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a></p>
                        </div>
                        <div class="margin20">
                            <h4 >Social</h4>
                            <p><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook: <a href="{{ config('socials.facebook.url') }}" target="_blank">@ExperienceThisTravel</a></p>
                            <p><i class="fa fa-instagram" aria-hidden="true"></i> Instagram: <a href="{{ config('socials.instagram.url') }}" target="_blank">@experience_this_travel</a></p>
                            <p><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter: <a href="{{ config('socials.twitter.url') }}" target="_blank">@expthistravel</a></p>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form_1 wow fadeInRight" data-wow-duration="1s">
                    <p>If you have any questions, feedback or any enquiries we’d love to hear from you.</p>
                    <p>Just complete the contact form and we’ll be in touch.</p>
                    <!--====== THANK YOU MESSAGE ==========-->
                    <div class="succ_mess" id="thanks">Thank you for contacting us we will get back to you soon.</div>
                    <form id="contact_form" name="home_form" action="{{ route('contacts.send') }}" method="post">
                        <ul>
                            <li></li>
                            <li></li>
                            <li>
                                <input type="text" name="name" value="" id="name" placeholder="Name"> </li>
                            <li>
                                <input type="text" name="subject" value="" id="subject" placeholder="Subject"> </li>

                            <li>
                                <input type="email" name="email" value="" id="email" placeholder="Email" required> </li>
                            <li>
                                <input type="tel" name="phone" value="" id="phone" placeholder="Phone number"> </li>
                            <li>
                                <textarea name="message" cols="40" rows="5" id="message" placeholder="Enter your message"></textarea>
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


@push('after_scripts')
    <script>
        var form = document.getElementById('contact_form');
        var button = document.getElementById('send_button');
        button.onclick = function() {
            event.preventDefault();
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(form).serialize(),
                url: '{{ route('contacts.send') }}',
                beforeSend : function() {
                   button.disabled = true;
                },
                success: function () {
                    form.style.display = 'none';
                    document.getElementById('thanks').style.display = 'block';
                }
            });
        }
</script>
@endpush