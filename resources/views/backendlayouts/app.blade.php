<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quick Freight Enterprise | Administrator</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('favicon.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
    <link href="{{asset('assets/common/plugins/toastify/toastify.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/css/styles.css')}}" rel="stylesheet">
</head>
<body class="sb-nav-fixed">

    @include('backendlayouts.navbar')

    <div id="layoutSidenav">
        @include('backendlayouts.sidebar')

        <div id="layoutSidenav_content">
            @yield('content')
            @include('backendlayouts.footer')
        </div>
    </div>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center bg-opacity-50">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{asset('assets/common/img/logo/loder.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    @stack('modals')
    @include('backendlayouts.toaster')

    <!-- User Password Modal Start -->
    <div class="modal fade" id="passwordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success align-items-center justify-content-center">
                    <h2 class="modal-title text-white"><i class="bi bi-key h2 text-white"></i> Change Password</h2>
                </div>
                <form method="POST" action="{{route('user.password')}}" id="passwordForm">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <label class="col-sm-4 pt-2 fw-bold text-success">New Password: </label>
                            <div class="col-sm-8 form-group">
                                <input type="password" id="passwordNew" name="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label class="col-sm-4 pt-2 fw-bold text-success">Password Confirm: </label>
                            <div class="col-sm-8 form-group">
                                <input type="password" id="passwordConfirmInput" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" id="passwordId" name="id" value="{{Auth::user()->id}}">
                        @if($errors->has('password'))
                            <input type="hidden" class="errorMsg" value="{{ $errors->first('password') }}">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="App.resetPassModal()" class="btn btn-danger w-100p btn-sm" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Close
                        </button>
                        <button type="button" onclick="App.changePassword()" class="btn btn-success w-100p btn-sm ml-1">
                            <i class="bi bi-save-fill"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- User Password Modal End -->

    <script src="{{asset('assets/common/plugins/jquery@3.5.1/jquery.min.js')}}"></script>
    <script src="{{asset('assets/common/plugins/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/common/plugins/font-awesome@5.15.3/js/all.min.js')}}"></script>
    <script src="{{asset('assets/common/plugins/toastify/toastify.js')}}"></script>
    <script src="{{asset('assets/backend/js/scripts.js')}}"></script>

    @stack('scripts')
</body>
</html>
