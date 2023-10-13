<!Doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Quick Freight Enterprise Inc </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}


    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<!-- Common CSS -->
	<!-- Bootstrap, Fontawesome -->
	<link rel="stylesheet" href="{{ asset('assets/common/plugins/bootstrap@5.1.3/dist/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/common/plugins/font-awesome@5.15.3/css/all.min.css') }}"> --}}

	<!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/common/plugins/toastify/toastify.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slicknav/slicknav.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/frontend/plugins/nice-select/nice-select.css') }}">

    @stack('styles')

	<!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">

</head>
<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('assets/common/img/logo/loder.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Toaster Alert -->
    @if(session('errors') && session('errors')->first('message'))
    <input type="hidden" class="errorMsg" value="{{session('errors')->first('message')}}">
    @endif

    @if (Session::has('success'))
    <div class="d-none" id="successMsg">
        {{Session('success')}}
    </div>
    @endif
    <!-- Toaster Alert End -->

    @yield('content')

    @stack('modals')

    <!-- JS here -->
    <!-- Jquery, Bootstrap, Fontawesome -->
    <script src="{{ asset('assets/common/plugins/jquery@3.5.1/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/common/plugins/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/common/plugins/font-awesome@5.15.3/js/all.min.js') }}"></script>

    <!-- Toster Alert -->
    <script src="{{ asset('assets/common/plugins/toastify/toastify.js') }}"></script>

    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('assets/frontend/plugins/slicknav/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick -->
    <script src="{{ asset('assets/frontend/plugins/slick/slick.min.js') }}"></script>

    <!-- Nice-select -->
    <script src="{{ asset('assets/frontend/plugins/nice-select/jquery.nice-select.min.js') }}"></script>

    <!-- Hover Direction -->
    <script src="{{ asset('assets/frontend/plugins/hover-direction-snake/hover-direction-snake.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    <!-- Google Recaptcha -->
    {!! htmlScriptTagJsApi() !!}

    @stack('scripts')

</body>
</html>
