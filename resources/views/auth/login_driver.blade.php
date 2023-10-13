@extends('frontendlayouts.app')

@section('content')
    <main>
        <!--  Carrier Login start  -->
        <section class="slider-area full-height pt-80">
            <div class="container py-5 bg-dark bg-opacity-50">
                <div class="row progresses">
                    <div class="steps bg-secondary">
                        <span>1</span>
                    </div>
                    <span class="line bg-secondary"></span>
                    <div class="steps bg-secondary">
                        <span>2</span>
                    </div>
                    <span class="line bg-secondary"></span>
                    <div class="steps bg-secondary">
                        <span>3</span>
                    </div>
                    <span class="line bg-secondary"></span>
                    <div class="steps bg-secondary">
                        <span>4</span>
                    </div>
                    <span class="line bg-secondary"></span>
                    <div class="steps bg-secondary">
                        <span>5</span>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-xl-4 col-lg-6 col-md-8">
                        <div class="login-title text-center">
                            <h1><a href="{{ route('frontend.home') }}"><img class="login-logo"
                                        src="{{ asset('assets/common/img/logo/loder.png') }}" alt=""></a>Driver Log
                                In
                            </h1>
                        </div>
                        <div class="pt-10">
                            <h5 class="text-danger text-center">Enter your Email Address and Verify Code *</h5>
                        </div>
                        <form class="form-login contact_form" method="post" action="{{ route('login.driver.perform') }}">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-8 col-md-12 mb-3">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Email Address'"
                                            placeholder="Enter Email Address" required>
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('email') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8 col-md-12 mb-4">
                                    <div class="form-group">
                                        <input class="form-control" name="verify_code" value="{{ old('verify_code') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Verify Code'"
                                            placeholder="Enter Verify Code" required>
                                        @if ($errors->has('verify_code'))
                                            <span class="text-danger text-left">{{ $errors->first('verify_code') }}</span>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('verify_code') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8 col-md-12">
                                    <button type="submit" class="btn full-width mb-3 btn-danger">Submit</button>
                                    <p class="mb-0"><a href="{{ route('frontend.home') }}"><i class="fa fa-arrow-circle-left"></i> Back to Main
                                        Page</a></p>
                                    <p class="mb-0"><a href="{{ route('login.carrier') }}"><i class="fa fa-arrow-circle-left"></i> To Carrier Login Page</a></p>
                                </div>
                            </div>
                            <div class="login-link text-center mt-5">
                                <a href="{{ route('frontend.home') }}">Quick Freight Enterprise INC @ {{ date('Y') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Carrier Login End -->
    </main>
@endsection
