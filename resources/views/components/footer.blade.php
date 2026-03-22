<div class="footer bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-col first">
                        <h6>@lang('messages.about_website')</h6>
                        <p class="p-small">@lang('messages.footer_description')</p>
                    </div> <!-- end of footer-col -->
                    <div class="footer-col second">
                        <h6>@lang('messages.address')</h6>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li> <a style="font-size: 15px;" href="">@lang('messages.address_details')</a></li>
                        </ul>
                    </div> <!-- end of footer-col -->
                    <div class="footer-col third">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-telegram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <p class="p-small">@lang('messages.follow_us') <a
                                href="mailto:contact@site.com"><strong>ITECH@site.com</strong></a></p>
                    </div> <!-- end of footer-col -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">@lang('messages.copyright', ['year' => date('Y')]) <a href="#your-link">ITECH</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->

            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">@lang('messages.design_by') <a href="https://themewagon.com/">Themewagon</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <img src="{{ asset('images/up-arrow.png') }}" alt="alternative">
    </button>