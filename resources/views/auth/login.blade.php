@extends('frontendlayouts.app')

@section('content')
    <main>
        <!--  Manager/Developer Login Area Start  -->
        <section class="contact-section slider-area full-height">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
                        <div class="login-title text-center mb-5">
                            <h1><a href="{{ route('frontend.home') }}"><img class="login-logo"
                                        src="{{ asset('assets/common/img/logo/loder.png') }}" alt=""></a>Log In</h1>
                        </div>
                        <form class="form-login contact_form" method="post" action="{{ route('login.perform') }}"
                            id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email"
                                            value="{{ old('email') }}" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Email Address'"
                                            placeholder="Enter Email Address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="password" type="password"
                                            value="{{ old('password') }}" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Password'" placeholder="Enter Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <button type="submit" class="btn full-width mb-3 btn-danger">Submit</button>
                                <a href="{{ route('frontend.home') }}"><i class="fa fa-arrow-circle-left"></i> Back to Main
                                    Page</a>
                            </div>
                            <div class="login-link text-center mt-5">
                                <a href="{{ route('frontend.home') }}">Quick Freight Enterprise INC @ 2023</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Manager/Developer Login Area End -->
    </main>
@endsection
