<x-layout title="About Us">
	@section('navbar')
		<x-navbar />
	@endsection

	<section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>About Us</h2>
            </div>

            <div class="row content">
                <div class="col-lg-6">
                    <p>
                        This system allows you to manage financial transactions that takes place within <span style="color: blue">{{ env('APP_NAME') }}</span> and its associates...
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> We transact with atmost transparency and also make sure we record all transactions and financial dealings. A normal user might not need to know these information.</li>
                        <li><i class="ri-check-double-line"></i> </li>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>
                        We are here to make sure that all events booking is done in a way that there will be no
                        confussioon during the last minutes and also the customer will be well aware of the available
                        space and prices for the next events.
                    </p>
                    <a href="/about-us" class="btn-learn-more">Learn More</a>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->

</x-layout>