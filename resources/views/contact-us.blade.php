<x-layout title="Contact">
	@section("navbar")
		<x-navbar />
	@endsection

	<section id="contact" class="contact">
    <div class="container">

        <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Contact Us</p>
        </div>

        <div class="row">

            <div class="col-lg-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                <div class="info" style="background: #fff0;">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>{{ env('LOCATION_STREET', 'Kenyatta Avenue') }} Street</p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>{{ env('MESSAGE_EMAIL', 'info@mail.com') }}</p>
                    </div>

                    <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>{{ env('ORG_PHONE', '0790909090') }}</p>
                    </div>

                </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">

                <form action="/messages/message/create" method="post" role="form" class="php-email-form"
                    style="background: #fff0">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="sender-id" class="form-control" id="sender-id" value="0"
                                hidden>
                            @guest
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required>
                            @else
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required
                                    value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" disabled>
                            @endguest
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            @guest
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required="">
                            @else
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required value="{{ auth()->user()->email }}" disabled>
                            @endguest
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                            required="">
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message" required=""></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button class="btn btn-primary bg-secondary" type="submit">Send Message</button></div>
                </form>

            </div>

        </div>

    </div>
</section>

</x-layout>