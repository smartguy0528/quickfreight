@extends('frontendlayouts.app')

@section('content')
    @include('frontendlayouts.navbar')

    <main>
        <!-- slider Area Start-->
        <div class="slider-area position-relative">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay="0.1s">Delivery Unlimited</span>
                                    <h1 data-animation="fadeInLeft" data-delay="0.4s">Fast & Safe Transport</h1>
                                    <h2 data-animation="fadeInLeft" data-delay="0.8s">Quick Freight Enterprise Inc.</h2>
                                    <a href="{{ route('frontend.service') }}" class="btn hero-btn mb-2 me-5 btn-danger" data-animation="fadeInLeft" data-delay="0.8s">Transport Now</a>
                                    <a href="{{ route('login.customer') }}" class="btn hero-btn mb-2 btn-danger" data-animation="fadeInLeft" data-delay="1.6s">Request Service Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay="0.1s">Who we are</span>
                                    <h1 data-animation="fadeInLeft" data-delay="0.4s">We are</h1>
                                    <h2 data-animation="fadeInLeft" data-delay="0.4s">A trucking company moving American for the last 10 years, leader in the industrie with top technology.</h2>
                                    <a href="{{ route('frontend.service') }}" class="btn hero-btn mb-2 me-5 btn-danger" data-animation="fadeInLeft" data-delay="1.6s">Transport Now</a>
                                    <a href="{{ route('login.customer') }}" class="btn hero-btn mb-2 btn-danger" data-animation="fadeInLeft" data-delay="0.8s">Request Service Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video icon -->
            {{-- <div class="video-icon">
                <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=xxxxxxxx"><i class="fa fa-play fa-2x" aria-hidden="true"></i></a>
            </div> --}}
        </div>
        <!-- slider Area End-->
        <!-- About Area Start -->
        <section class="about-area section-padding30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <!-- about-img -->
                        <div class="about-img ">
                            <img src="{{ asset('assets/frontend/img/gallery/about.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle3 mb-35">
                                <span>About Our Company</span>
                                <h2>A trucking company moving American for the last 10 years!</h2>
                            </div>
                            <p class="pera-top">
                                Quike Freight Enterprise Inc collaborate with customers to provide transport assistance,
                                shipping support and track services, and standardized loading management.
                            </p>
                            <p class="mb-65 pera-bottom">
                                Our mission is to provide customized, scalable and progressive solutions to our customers.
                            </p>
                            <a href="{{ route('frontend.about') }}" class="btn btn-danger">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
        <!-- Services Area Start -->
        <section class="services-area pt-100 pb-150 section-bg" data-background="{{ asset('assets/frontend/img/gallery/section_bg01.jpg') }}">
            <section class="wantToWork-area w-padding">
                <div class="container">
                    <div class="row align-items-end justify-content-between">
                        <div class="col-lg-12">
                            <div class="section-tittle section-tittle2">
                                <span>Our Services For You</span>
                                <h2>Push Your Limits Forward We Offer to You</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <i class="fas fa-truck fa-2x"></i>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="{{ route('frontend.service') }}">Fast Transport</a></h5>
                                <p>
                                    It can be integrated easily with your loading channels and standard
                                    ordering-carrying system thanks to its digital capabilities so you
                                    can start shipping right away.
                                </p>
                            </div>
                            <div class="img-cap">
                                <a href="{{ route('frontend.about') }}" class="">Discover More About Us <i class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <i class="far fa-clock fa-2x"></i>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="{{ route('frontend.service') }}">Timely Delivery</a></h5>
                                <p>
                                    Quick Freight Enterprise's geo-independent load delivery system ensure
                                    that all your parcel delivery timely and affordable needs are met.
                                </p>
                            </div>
                            <div class="img-cap">
                                <a href="{{ route('frontend.about') }}" class="">Discover More About Us <i class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="{{ route('frontend.service') }}">Safe Tracking</a></h5>
                                <p>
                                    We provide easily accessable tracking service to all customers to make shipping
                                    more safe and easier with free. You can enter into our service at any time and
                                    anywhere and see your load real time.
                                </p>
                            </div>
                            <div class="img-cap">
                                <a href="{{ route('frontend.about') }}" class="">Discover More About Us <i class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Area End -->
        <!-- Testimonial Area Start -->
        @if(count($reviews))
        <section class="about-area2 testimonial-area section-padding30 fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-11 col-sm-11">
                        <!-- about-img -->
                        <div class="about-img2">
                            <img src="assets/frontend/img/gallery/about2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <div class="about-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle mb-55">
                                <span>Client Feedback</span>
                                <h2>What Our Client think about our service</h2>
                            </div>
                            <!-- Testimonial Start -->
                            <div class="h1-testimonial-active" style="max-height: 300px">
                                @foreach ($reviews as $review)
                                <!-- Single Testimonial -->
                                <div class="single-testimonial">
                                    <div class="testimonial-caption">
                                        <p>{{$review->customer_review}}</p>
                                        <div class="rattiong-caption">
                                            <span>{{$review->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Testimonial End -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- Testimonial Area End -->
        <!-- Gallery Area Start -->
        <div class="gallery-area pb-100">
            <div class="container-fluid p-0 m-0 fix">
                <div class="row">
                    <div class="col-lg-6 p-0 m-0">
                        <div class="box snake">
                            <div class="gallery-img big-img" style="background-image: url(assets/frontend/img/gallery/gallery1.jpg);"></div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <h3>Quick Freight Enterprise</h3>
                                    <p>More details</p>
                                    <a href="{{ route('frontend.about') }}"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-0 m-0">
                        <div class="row p-0 m-0">
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0 m-0">
                                    <div class="box snake">
                                        <div class="gallery-img small-img" style="background-image: url(assets/frontend/img/gallery/gallery2.jpg);"></div>
                                        <div class="overlay">
                                            <div class="overlay-content">
                                                <h3>Quick Freight Enterprise</h3>
                                                <p>More details</p>
                                                <a href="{{ route('frontend.about') }}"><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0 m-0">
                                    <div class="box snake">
                                        <div class="gallery-img small-img" style="background-image: url(assets/frontend/img/gallery/gallery3.jpg);"></div>
                                        <div class="overlay">
                                            <div class="overlay-content">
                                                <h3>Quick Freight Enterprise</h3>
                                                <p>More details</p>
                                                <a href="{{ route('frontend.about') }}"><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0 m-0">
                                    <div class="box snake">
                                        <div class="gallery-img small-img" style="background-image: url(assets/frontend/img/gallery/gallery4.jpg);"></div>
                                        <div class="overlay">
                                            <div class="overlay-content">
                                                <h3>Quick Freight Enterprise</h3>
                                                <p>More details</p>
                                                <a href="{{ route('frontend.about') }}"><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0 m-0">
                                    <div class="box snake">
                                        <div class="gallery-img small-img" style="background-image: url(assets/frontend/img/gallery/gallery5.jpg);"></div>
                                        <div class="overlay">
                                            <div class="overlay-content">
                                                <h3>Quick Freight Enterprise</h3>
                                                <p>More details</p>
                                                <a href="{{ route('frontend.about') }}"><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
        <!-- Team Area Start -->
        <div class="team-area pb-150">
            <div class="container">
                <div class="row align-items-end justify-content-between w-padding">
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <div class="section-tittle">
                            <span>Company Members</span>
                            <h2>Our Company Members</h2>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <a href="{{ route('frontend.contact') }}" class="btn btn-danger" style="width: 220px">Contact Us Now</a>
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
            </div>
        </div>
        <!-- Team Area End -->
    </main>

    @include('frontendlayouts.footer')

    @include('frontendlayouts.scrollup')
@endsection

@push('scripts')
    <script src="{{asset('assets/frontend/js/pages/home.js')}}"></script>
@endpush
