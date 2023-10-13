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
                            <div class="hero-cap hero-cap2 pt-70 text-center">
                                <h2>Contact Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- Contact Area start  -->
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-tittle">
                            <span>With Our Company</span>
                            <h2>Get In Touch</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form id="contactForm" class="form-order" method="GET" action="{{route('contact.message')}}" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" value="{{ old('name') }}">
                                        @if($errors->has('name'))
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                            <input type="hidden" class="errorMsg" value="{{$errors->first('name')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" value="{{ old('email') }}">
                                        @if($errors->has('email'))
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                            <input type="hidden" class="errorMsg" value="{{$errors->first('email')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject" value="{{ old('subject') }}">
                                        @if($errors->has('subject'))
                                            <small class="text-danger">{{ $errors->first('subject') }}</small>
                                            <input type="hidden" class="errorMsg" value="{{$errors->first('subject')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- Google reCaptcha v2 -->
                                    {!! htmlFormSnippet() !!}
                                    @if($errors->has('g-recaptcha-response'))
                                    <div>
                                        <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('g-recaptcha-response')}}">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button id="submitBtn" class="btn btn-danger">Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d184622.88153494135!2d-80.53355811987386!3d25.619955167063427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9c2016b0999cf%3A0x6ca34ce545a89dda!2s15867%20SW%20147th%20Ln%2C%20Miami%2C%20FL%2033196%2C%20USA!5e0!3m2!1sen!2sru!4v1680639002733!5m2!1sen!2sru" height="500" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width: 100%;"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End -->
    </main>

    @include('frontendlayouts.footer')

    @include('frontendlayouts.scrollup')
@endsection

@push('scripts')
    <script src="{{asset('assets/frontend/js/pages/contact.js')}}"></script>
@endpush
