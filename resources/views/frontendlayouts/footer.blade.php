<!-- Footer Start-->
<footer>
    <div class="footer-area section-bg" data-background="{{ asset('assets/frontend/img/gallery/section_bg03.jpg') }}">
        <div class="container">
            @if(Auth::guard('customerguard')->guest())
            <div class="footer-top footer-padding">
                <!-- Footer Menu -->
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle mb-50">
                                <h4>Get In Touch</h4>
                                <ul>
                                    <li><a href="javascript:void(0);"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;15867 SW 147th LN Miami, FL 33196, US</a></li>
                                    <li><a href="javascript:void(0);"><i class="fas fa-phone"></i>&nbsp;&nbsp;&nbsp;+1 786-208-9900</a></li>
                                    <li><a href="javascript:void(0);"><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;quickfreightenterprise@gmail.com</a></li>
                                </ul>
                            </div>
                            <!-- Footer Social -->
                            <div class="footer-social">
                                <a href="javascript:void(0);"><i class="fab fa-facebook-square fa-2x"></i></a>
                                <a href="javascript:void(0);"><i class="fab fa-twitter-square fa-2x"></i></a>
                                <a href="javascript:void(0);"><i class="fas fa-globe fa-2x"></i></a>
                                <a href="javascript:void(0);"><i class="fab fa-instagram-square fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>COMPANY</h4>
                                <ul>
                                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                                    <li><a href="{{ route('frontend.service') }}">Services</a></li>
                                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                    <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                                    <li><a target="_blank" href="{{ route('frontend.privacy') }}"> Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                    <div class="col-sm-12">
                        <div class="single-footer-caption mb-50">
                            <!-- logo -->
                            <div class="footer-logo">
                                <a href="{{ route('frontend.home') }}">
                                    <img class="logo-img" src="{{ asset('assets/common/img/logo/logo.png')}}" alt="">
                                </a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p class="info1">
                                        The quick freight service has grown consider ably in recent years.
                                        Quike Freight Enterprise Inc collaborate with customers to provide transport assistance,
                                        shipping support and track services, and standardized loading management.
                                    </p>
                                    <p class="info1">We are always ready for you.</p>
                                    <h5>Quick Freight Enterprise INC.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12">
                        <div class="footer-copy-right text-center">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End-->
