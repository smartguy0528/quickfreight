@extends('frontendlayouts.app')

@section('content')
    <main>
        <!--  Carrier Login start  -->
        <section class="slider-area pt-0 pt-sm-5" style="min-height: 100vh">
            <div class="container py-5 bg-dark bg-opacity-50">
                <div class="row progresses">
                    @if (!Auth::guard('driverguard')->user()->active)
                        <div class="steps bg-secondary">
                            <span>1</span>
                        </div>
                    @else
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @endif

                    @if ($quoteReq->status < 8)
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>2</span>
                        </div>
                    @else
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @endif

                    @if ($quoteReq->status < 9)
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>3</span>
                        </div>
                    @else
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @endif

                    @if ($quoteReq->status < 10)
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>4</span>
                        </div>
                    @else
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @endif

                    @if ($quoteReq->status < 11)
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>5</span>
                        </div>
                    @else
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @endif
                </div>
                <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-8 col-md-8 bg-dark bg-opacity-50 p-4">
                        <div class="text-center">
                            <img class="login-logo" src="{{ asset('assets/common/img/logo/loder.png') }}" alt="">
                            <h1 class="text-uppercase text-danger"> Quick Freight Enterprise INC.</h1>
                        </div>

                        <!-- Driver Inactive -->
                        @if (!Auth::guard('driverguard')->user()->active)
                            <div>
                                <p class="text-white mb-1">Dear {{ Auth::guard('driverguard')->user()->name }},</p>
                                <p class="text-white mb-1">We strive to provide the most efficient service possible and to
                                    achieve this, we would like to keep in touch with you during the entire transport
                                    process. In order to do so, we kindly request your agreement to keep this link active
                                    throughout the entire period of transport and to send us updated transport events in
                                    real-time.</p>
                                <p class="text-white mb-1">By keeping us informed of any updates in real-time, we can ensure
                                    that your shipment is delivered on time and with the utmost care.</p>
                                <p class="text-white mb-1">We understand the importance of timely and accurate service, and
                                    we are committed to providing customers with the best possible service.</p>
                                <p class="text-white">Thank you for your cooperation and we look forward to making best
                                    service with you.</p>
                                <p class="text-white mb-1">Best regards,</p>
                                <p class="text-white mb-1">Quick Freight Enterprise INC.</p>
                                <form method="GET" action="{{ route('driver.status.active') }}" class="text-center mt-4">
                                    <button class="btn mb-3 btn-danger">I agree</button>
                                </form>
                            </div>
                            <!-- Driver Inactive End -->
                        @elseif($quoteReq->status == 7)
                            <!-- Driver Active -->
                            <div class="mt-5 mb-100">
                                <p class="h3 text-white text-center mt-130">Are you going to pick up load now?</p>
                                <form method="GET" action="{{ route('driver.status.8') }}" class="text-center my-5">
                                    <button type="submit" class="btn mb-3 btn-success bg-success me-3">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp; </button>
                                    <button type="button" class="btn mb-3 btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">Not Yet</button>
                                </form>
                            </div>
                            <!-- Driver Active End -->
                        @elseif($quoteReq->status == 8)
                            <!-- Status 8: Going Pick Up -->
                            <div class="mt-5 mb-100">
                                <p class="h3 text-white text-center mt-130">Are you loading now?</p>
                                <form method="GET" action="{{ route('driver.status.9') }}" class="text-center my-5">
                                    <button type="submit" class="btn mb-3 btn-success bg-success me-3">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp; </button>
                                    <button type="button" class="btn mb-3 btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">Not Yet</button>
                                </form>
                            </div>
                            <!-- Status 8: Going Pick Up End -->
                        @elseif($quoteReq->status == 9)
                            <!-- Status 9: Loading Up -->
                            <div class="mt-5 mb-100">
                                <p class="h3 text-white text-center mt-130">You start delivery?</p>
                                <form method="GET" action="{{ route('driver.status.10') }}" class="text-center my-5">
                                    <button type="submit" class="btn mb-3 btn-success bg-success me-3">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp; </button>
                                    <button type="button" class="btn mb-3 btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">Not Yet</button>
                                </form>
                            </div>
                            <!-- Status 9: Loading Up End -->
                        @elseif($quoteReq->status == 10)
                            <!-- Status 10: On Delivery -->
                            <div class="mt-5 mb-100">
                                <p class="h3 text-white text-center mt-130">Have you reached the destination?</p>
                                <form method="GET" action="{{ route('driver.status.11') }}" class="text-center my-5">
                                    <button type="submit" class="btn mb-3 btn-success bg-success me-3">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp; </button>
                                    <button type="button" class="btn mb-3 btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">Not Yet</button>
                                </form>
                            </div>
                            <!-- Status 10: On Delivery End -->
                        @elseif($quoteReq->status == 11)
                            <!-- Status 11: Arrived -->
                            <div class="mt-2 mb-5">
                                <p class="h3 text-white text-center mt-5">Well done,
                                    {{ Auth::guard('driverguard')->user()->name }}!</p>
                                <p class="text-white">To confirm the delivery, please upload BOL picture.</p>
                                <form method="POST" action="{{ route('driver.status.12') }}" enctype="multipart/form-data"
                                    class="text-center">
                                    @csrf
                                    <small class="text-white">(Required, Max size 5MB, File Type: png, jpg, jpeg)</small>
                                    <input type="file" id="bol_file" name="bol_file" required>
                                    @if ($errors->has('bol_file'))
                                        <small class="text-danger">{{ $errors->first('bol_file') }}</small>
                                        <input type="hidden" class="errorMsg" value="{{ $errors->first('bol_file') }}">
                                    @endif
                                    <div>
                                        <button type="submit" class="btn mb-3 btn-success bg-success me-3">
                                            Submit</button>
                                        <a href="{{ route('driver.status.back') }}" class="btn mb-3 btn-danger">
                                            &nbsp;&nbsp;Back&nbsp;&nbsp; </a>
                                        <div>
                                </form>
                            </div>
                            <!-- Status 11: Arrived End -->
                        @elseif($quoteReq->status >= 12)
                            <!-- Status 12: Arrived -->
                            <div>
                                <p class="h3 text-white text-center mt-5">Conguratulations!</p>
                                <p class="text-white mb-1">Dear {{ Auth::guard('driverguard')->user()->name }},</p>
                                <p class="text-white mb-1">We would like to extend our heartfelt congratulations on
                                    successfully completing your transport.</p>
                                <p class="text-white mb-1">We appreciate your hard work and dedication towards ensuring
                                    timely and efficient deliveries.</p>
                                <p class="text-white mb-1">Your commitment to excellence is a vital part of our business,
                                    and we are honored to have you on our service.</p>
                                <p class="text-white mb-1">Best regards,</p>
                                <p class="text-white mb-1">Quick Freight Enterprise INC.</p>
                                <form method="GET" action="{{ route('logout.perform') }}" class="text-center mt-4">
                                    <button class="btn mb-3 btn-danger">Exit</button>
                                </form>
                            </div>
                            <!-- Status 12: Arrived End -->
                        @endif

                        <div class="text-center mt-5">
                            <a href="{{ route('frontend.home') }}">Quick Freight Enterprise INC @ {{ date('Y') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Carrier Login End -->
    </main>
@endsection

@push('modals')
    <!-- Back Modal -->
    <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Not yet?</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($quoteReq->status == 7)
                        <p class="text-center">No problem. Take your time.</p>
                    @else
                        <p>Would you like to return to your previous state?</p>
                    @endif
                </div>
                <form method="GET" action="{{ route('driver.status.back') }}" class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-base me-3" data-bs-dismiss="modal">Close</button>
                    @if ($quoteReq->status > 7)
                        <button type="submit" class="btn btn-danger btn-base"> &nbsp;&nbsp;Back&nbsp;&nbsp; </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endpush

@push('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Filepond PDF -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    {{-- <script src="{{ asset('assets/backend/js/driver/welcome.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $('.filepond--credits').addClass('d-none');

            // File Upload
            FilePond.registerPlugin(
                // validates the size of the file...
                FilePondPluginFileValidateSize,
                // validates the file type...
                FilePondPluginFileValidateType,
                // preview the image file type...
                FilePondPluginImagePreview,
            );

            FilePond.create(document.getElementById('bol_file'), {
                acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
                allowImagePreview: true,
                allowFileTypeValidation: true,
                allowFileSizeValidation: true,
                maxFileSize: '5MB',
                labelIdle: '<span class="filepond--label-action">Browse</span> BOL picture.',
                server: {
                    url: '/uploads',
                    process: {
                        url: '/process',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    },
                    revert: {
                        url: '/revert',
                        method: 'DELETE',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                }
            });



            /**
             * Geolocation API
             *
             */
             const options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0,
            };

            function getLocation() {
                @if($quoteReq->status > 7 && $quoteReq->status < 12)
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError, options);
                } else {
                    alert("Sorry, Use latest version of Google Chrome.");
                }
                @endif
            };

            function showPosition(position) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("api.driver.location") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: position.coords,
                    success: function (data) {
                        console.log(data);
                    }
                });
            };

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        if ({{ Auth::guard('driverguard')->user()->active }}) {
                            alert("You denied the request to access your location. Please click allow button to connect server.");
                            location.reload();
                        };
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        alert("The request to get user location timed out.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("An unknown error occurred.");
                        break;
                    default:
                        alert("Error.");
                        break;
                }
            };

            getLocation();

            setInterval(getLocation, 5 * 60000);
        });
    </script>
@endpush
