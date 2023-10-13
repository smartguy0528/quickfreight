<!-- Header Start -->
<header>
    <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    @if (Auth::guard('customerguard')->guest())
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo my-3">
                            <a href="{{ route('frontend.home') }}"><img class="logo-img" src="{{ asset('assets/common/img/logo/logo.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="menu-main d-flex align-items-center justify-content-end">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                                        <li><a href="{{ route('frontend.service') }}">Services</a></li>
                                        <li><a href="{{ route('login.carrier') }}">Carrier Get Setup</a></li>
                                        <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                        <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                                        <li class="wide-hide"><a href="{{ route('login.show') }}">Login</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right-btn f-right d-none d-lg-block ml-30" id="button-navigation">
                                <li><a href="{{ route('login.show') }}" class="btn btn-danger header-btn">Log in</a></li>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                    @else
                    <div class="col-12 px-md-5 d-flex align-items-center justify-content-between">
                        <div class="logo my-3">
                            <a href="{{ route('frontend.home') }}"><img class="logo-img" src="{{ asset('assets/common/img/logo/logo.png') }}" alt=""></a>
                        </div>
                        <div class="header-right-btn f-right ml-30">
                            <li><a href="{{ route('logout.perform') }}" class="btn btn-danger header-btn">Log Out</a></li>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
