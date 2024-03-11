<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="fa fa-angle-right"></i> <a href="/">Home</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="/about-us">About us</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="/services">Services</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="/terms-of-service">Terms of service</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="/privacy-policy">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contact Us</h4>
                    <p>
                        {{-- get the email from the project --}}
                        <strong>Email:</strong>&nbsp{{ env('MAIL_FROM_ADDRESS') }}<br>
                    </p>

                    <div class="social-links">
                        <a href="https://www.twitter.com/{{ env('TWITTER_HANDLE', '#') }}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.facebook.com/{{ env('FACEBOOK_HANDLE', '#') }}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/{{ env('INSTAGRAM_HANDLE', '#') }}" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.google-plus.com/{{ env('GOOGLE_PLUS_HANDLE', '#') }}" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="https://www.linkedin.com/{{ env('LINKEDIN_HANDLE', '#') }}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!-- #footer -->
