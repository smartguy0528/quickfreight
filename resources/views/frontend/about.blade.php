@extends('frontendlayouts.app')

@section('content')
    @include('frontendlayouts.navbar')

    <main>
        <!-- Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center pt-70">
                                <h2>About Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- About Area Start -->
        <section class="about-area section-padding30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <!-- about-img -->
                        <div class="about-img ">
                            <img src="{{asset('assets/frontend/img/gallery/about.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle3 mb-35">
                                <span>About Our Company</span>
                                <h2>A trucking company moving American for the last 10 years!</h2>
                            </div>
                            {{-- <p>
                                Quike Freight Enterprise Inc collaborate with customers to provide transport assistance,
                                shipping support and track services, and standardized loading management.
                            </p>
                            <p class="pera-bottom">
                                Our mission is to provide customized, scalable and progressive solutions to our customers.
                            </p> --}}
                            <p class="pera-top">
                                Quike Freight Enterprise Inc collaborate with customers to provide transport assistance,
                                shipping support and track services, and standardized loading management.
                            </p>
                            <p class="pera-top">
                                Quike Freight Enterprise Inc is committed to working closely with our customers to provide top-notch transport assistance, shipping support, and track services. We understand that every business has unique needs, which is why we offer customized solutions that are scalable and progressive.
                            </p>
                            <p class="pera-top">
                                At Quike Freight Enterprise Inc, we're passionate about logistics. We're constantly exploring new ways to improve our services and exceed our customers' expectations. Whether you need help with a one-time shipment or ongoing transport assistance, we're here to help.
                            </p>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="about-caption">
                            <div>
                                <h2 class="pt-30 pb-20">
                                    Our History
                                </h2>
                                <p class="pera-bottom">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                                <p class="pera-bottom">
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco. Lorem ipsum dolor
                                    sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                                </p>
                                <h2 class="pt-30 pb-20">
                                    Our Services
                                </h2>
                                <p class="pera-bottom">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                                <p class="pera-bottom">
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco. Lorem ipsum dolor
                                    sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <!-- About-2 Area End -->
        <!-- Team Ara Start -->
        <div class="team-area bg-white pt-50">
            <div class="container">
                <div class="row align-items-end justify-content-between pb-50">
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <div class="section-tittle">
                            <span>Company Members</span>
                            <h2>Our Company Members</h2>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <a href="{{route('frontend.contact')}}" class="btn wantToWork-btn f-right btn-danger" style="width: 220px">Contact Us Now</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend/img/gallery/team1.jpg') }}" alt="">
                                <div class="team-caption">
                                    <span>Company Manager</span>
                                    <h3><a href="{{ route('frontend.contact') }}">Fernando Bond</a></h3>
                                    <!-- Blog Social -->
                                    <div class="team-social">
                                        <ul>
                                            <li><a href="javascript:void(0);"><i class="fab fa-facebook-square"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fab fa-twitter-square"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fas fa-globe"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fab fa-instagram-square"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend/img/gallery/team2.jpg') }}" alt="">
                                <div class="team-caption">
                                    <span>Company SEO</span>
                                    <h3><a href="{{ route('frontend.contact') }}">James Robert</a></h3>
                                    <!-- Blog Social -->
                                    <div class="team-social">
                                        <ul>
                                            <li><a href="javascript:void(0);"><i class="fab fa-facebook-square"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fab fa-twitter-square"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fas fa-globe"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fab fa-instagram-square"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend/img/gallery/team3.jpg') }}" alt="">
                                <div class="team-caption">
                                    <span>Service Manager</span>
                                    <h3><a href="{{ route('frontend.contact') }}">Lucia Lovrica</a></h3>
                                    <!-- Blog Social -->
                                    <div class="team-social">
                                        <ul>
                                            <li><a href="javascript:void(0);"><i class="fab fa-facebook-square"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fab fa-twitter-square"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fas fa-globe"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="fab fa-instagram-square"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-5">
                    <p class="pera-top">
                        Quick Freight Enterprise Inc. is a reputable transport company with a decade of experience in the industry. Our team members are highly skilled and experienced professionals who are committed to providing exceptional service to our clients. We take pride in our team's ability to handle any transportation challenge that comes our way.
                    </p>
                    <p class="pera-top">
                        Our company members are carefully selected based on their experience, expertise, and dedication to customer service. We believe that our team is the backbone of our success, and we invest heavily in their training and development to ensure that they are equipped with the necessary skills to deliver top-notch service.
                    </p>
                    <p class="pera-top">
                        At Quick Freight Enterprise Inc., we understand the importance of timely and efficient delivery, which is why we have built a team that is reliable, trustworthy, and committed to meeting our clients' needs. We are confident that our team members will exceed your expectations and provide you with the best transport solutions available.
                    </p>
                </div>
            </div>
        </div>
        <!-- Team Ara End -->
        <!-- Blog Area Start -->
        <section class="home-blog-area section-padding30">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-9 col-sm-10">
                        <div class="section-tittle text-center mb-100">
                            <span>About Our Service</span>
                            <h2>Why Choose Us</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="{{asset('assets/frontend/img/gallery/blog1.jpg')}}" alt="">
                                    <!-- Blog date -->
                                    <a href="{{route('frontend.service')}}#services" class="btn blog-date text-center">
                                        <span>Apply</span>
                                        <p>Now</p>
                                    </a>
                                </div>
                                <div class="blog-cap">
                                    <span>With One click Option</span>
                                    <h3><a href="{{route('frontend.service')}}#services">Whenever, Wherever You Can Call the Service</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="{{asset('assets/frontend/img/gallery/blog2.jpg')}}" alt="">
                                    <!-- Blog date -->
                                    <a href="{{route('frontend.service')}}#services" class="btn blog-date text-center">
                                        <span>24/7</span>
                                        <p>READY</p>
                                    </a>
                                </div>
                                <div class="blog-cap">
                                    <span>Our Services Are</span>
                                    <h3><a href="{{route('frontend.service')}}#services">Always Ready for You 24/7 and Will give You Full Assist</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="{{asset('assets/frontend/img/gallery/blog3.jpg')}}" alt="">
                                    <!-- Blog date -->
                                    <a href="{{route('frontend.service')}}#request" class="btn blog-date text-center">
                                        <span>Track</span>
                                        <p>Now</p>
                                    </a>
                                </div>
                                <div class="blog-cap">
                                    <span>When You Want to Know</span>
                                    <h3><a href="{{route('frontend.service')}}#request">About Your Load Location and Status</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="{{asset('assets/frontend/img/gallery/blog4.jpg')}}" alt="">
                                    <!-- Blog date -->
                                    <a href="{{route('frontend.service')}}#request" class="btn blog-date text-center">
                                        <span>100 %</span>
                                        <p>Safe</p>
                                    </a>
                                </div>
                                <div class="blog-cap">
                                    <span>Our Company</span>
                                    <h3><a href="{{route('frontend.service')}}#request">Will Give You 100% Delivery Gurantee and Safe Loading</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p class="pera-top">
                        Our team is dedicated to providing reliable and efficient transportation services to our clients.
                    </p>
                    <p class="pera-top">
                        We understand that choosing a transportation company can be a difficult decision, which is why we want to highlight some of the reasons why you should choose us.
                    </p>
                    <p class="pera-top">
                        Firstly, we have a proven track record of delivering goods on time and in excellent condition. Our experienced drivers and modern fleet of vehicles ensure that your cargo is in safe hands.
                    </p>
                    <p class="pera-top">
                        Secondly, we offer competitive pricing without compromising on quality. We understand the importance of cost-effective transportation solutions, and we strive to provide our clients with the best possible value for their money.
                    </p>
                    <p class="pera-top">
                        Lastly, we pride ourselves on the exceptional customer service that we provide. Our team is always available to answer any questions or concerns that you may have, and we work closely with our clients to ensure that their transportation needs are met.
                    </p>
                    <p class="pera-top">
                        Thank you for considering Quick Freight Enterprise Inc. We look forward to the opportunity to work with you.
                    </p>
                </div>
            </div>
        </section>
        <!-- Blog Area End -->
    </main>

    @include('frontendlayouts.footer')

    @include('frontendlayouts.scrollup')

@endsection
