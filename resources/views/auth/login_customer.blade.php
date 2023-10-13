@extends('frontendlayouts.app')

@section('content')
    <main>
        <!--  Customer Login Area start  -->
        <section class="contact-section slider-area full-height">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
                        <div class="login-title text-center">
                            <h1><a href="{{ route('frontend.home') }}"><img class="login-logo"
                                        src="{{ asset('assets/common/img/logo/loder.png') }}" alt=""></a>Customer Log
                                In</h1>
                        </div>
                        <div class="pt-10 pb-20">
                            <h3 class="text-danger text-center text-md-start">Enter your Email and Verify Code *</h3>
                        </div>
                        <form class="form-login contact_form" method="post" action="{{ route('login.customer.perform') }}"
                            id="customerLoginForm" novalidate="novalidate">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-8 col-md-12 mb-4">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email"
                                            value="{{ old('email') }}" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Your Email Address'"
                                            placeholder="Enter Your Email Address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            <input type="hidden" class="errorMsg" value="{{ $errors->first('email') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8 col-md-12 mb-3">
                                    <div class="form-group">
                                        <input class="form-control" name="verify_code" id="verify_code" type="text"
                                            value="{{ old('verify_code') }}" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Verify Code'" placeholder="Enter Verify Code">
                                        @if ($errors->has('verify_code'))
                                            <span class="text-danger text-left">{{ $errors->first('verify_code') }}</span>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('verify_code') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8 col-md-12 mt-5">
                                    <div class="form-group">
                                        <button type="submit" class="btn full-width mb-3 btn-danger">Submit</button>
                                        <a href="{{ route('frontend.home') }}"><i class="fa fa-arrow-circle-left"></i> Back to Main
                                            Page</a>
                                    </div>
                                </div>
                            </div>
                            <div class="login-link text-center mt-5">
                                <a href="{{ route('frontend.home') }}">Quick Freight Enterprise INC @ 2023</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Customer Login Area End -->
    </main>
@endsection
