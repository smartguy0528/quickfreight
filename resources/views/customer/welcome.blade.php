@extends('frontendlayouts.app')

@section('content')
    @include('frontendlayouts.navbar')

    <main>
        <!-- Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-md-center align-items-end">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 pt-80 pb-20 text-center">
                                @if($quoteReq->status < 13)
                                <h2>Welcome to our service, {{ $customer->first_name }}</h2>
                                <h3 class="text-white">Quote ID: #{{ $quoteReq->id_alias }}</h3>
                                @else
                                <h2 class="text-warning">Congratulations!</h2>
                                <h3 class="text-white"> Your transport request is successfully completed.</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Customer Area start  -->
        <section>
            <div class="container bg-white p-3 p-sm-5">
                @if ($quoteReq->status < 9)
                    <!-- Common Information Start -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="section-tittle">
                                <span>My Order Content</span>
                                <h3 class="mb-4">Order ID: #{{ $quoteReq->id_alias }}</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="col-sm-6 text-center text-sm-start">
                                            <img src="{{ asset('assets/frontend/img/customer/customer_image.jpg') }}"
                                                class="img-thumbnail" alt="...">
                                        </div>
                                        <div class="col-sm-6 d-flex flex-column justify-content-between">
                                            <div class="text-center text-sm-start">
                                                @if ($quoteReq->status == 1)
                                                    <p class="badge bg-success my-3">Status: Order Requested</p>
                                                @elseif($quoteReq->status == 2)
                                                    <p class="badge bg-success my-3">Status: Order Accepted</p>
                                                @elseif($quoteReq->status == 3)
                                                    <p class="badge bg-success my-3">Status: Order Approved</p>
                                                @elseif($quoteReq->status == 4)
                                                    <p class="badge bg-danger my-3">Status: Order Rejected</p>
                                                @elseif($quoteReq->status == 5)
                                                    <p class="badge bg-success my-3">Status: Order Approved</p>
                                                @elseif($quoteReq->status == 6)
                                                    <p class="badge bg-success my-3">Status: Order Approved</p>
                                                @elseif($quoteReq->status == 7)
                                                    <p class="badge bg-success my-3">Status: Order Approved</p>
                                                @elseif($quoteReq->status == 8)
                                                    <p class="badge bg-primary my-3">Status: Order Approved</p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="mb-2"><small class="text-default text-uppercase">Name</small>:
                                                    <span
                                                        class="fw-bold">{{ $customer->first_name . ' ' . $customer->last_name }}</span>
                                                </p>
                                                <p class="mb-2"><small class="text-default text-uppercase">Email</small>:
                                                    <span class="fw-bold">{{ $customer->email }}</span></p>
                                                <p class="mb-2"><small class="text-default text-uppercase">Phone</small>:
                                                    <span class="fw-bold">{{ $customer->phone }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <p class="mb-2"><small class="text-default text-uppercase">Company/Home
                                                    Info</small>: <span class="fw-bold">
                                                    @if ($quoteApp)
                                                        {{ $quoteApp->company_name }}
                                                    @endif
                                                </span>
                                            </p>
                                            <p class="mb-2"><small class="text-default text-uppercase">Company/Home
                                                    Address</small>: <span class="fw-bold">
                                                    @if ($quoteApp)
                                                        {{ $quoteApp->company_address }}
                                                    @endif
                                                </span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">

                                    <p class="mb-2"><small class="text-default text-uppercase">Weight</small>: <span
                                            class="fw-bold">{{ $quoteReq->weight }}</span></p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Temperature
                                            Condition</small>: <span class="fw-bold">{{ $quoteReq->temperature }}</span>
                                    </p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Equipment</small>: <span
                                            class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Comment</small>: <span
                                            class="fw-bold">{{ $quoteReq->comment }}</span></p>
                                    <!-- <p class="mb-2"><small class="text-default text-uppercase">City / State</small>: <span
                                            class="fw-bold">{{ $quoteReq->pickup }}</span></p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Delivery City /
                                            State</small>: <span class="fw-bold">{{ $quoteReq->delivery }}</span></p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Date</small>: <span
                                            class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}</span>
                                    </p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Delivery Date</small>:
                                        <span
                                            class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span>
                                    </p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Commodity</small>: <span
                                            class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                    <p class="mb-2"><small class="text-default text-uppercase">Dimension</small>: <span
                                            class="fw-bold">{{ $quoteReq->dimension }}</span></p> -->
                                    <div class="row mt-2">
                                        <div class="col-sm-4" align="center">
                                            <small class="text-default text-uppercase">Location</small>
                                        </div>  
                                        <div class="col-sm-2" align="center">
                                            <small class="text-default text-uppercase">Commodity</small>
                                        </div>
                                        <div class="col-sm-2" align="center">
                                            <small class="text-default text-uppercase">Dimension</small>
                                        </div>
                                        <div class="col-sm-2" align="center">
                                            <small class="text-default text-uppercase">Date</small>
                                        </div>
                                        <div class="col-sm-2" align="center">
                                            <small class="text-default text-uppercase">Load/Unload</small>
                                        </div>
                                    </div>
                                    @for ($i = 0; $i < count($quoteService); $i ++)
                                        <div class="row mt-2">
                                            <div class="col-sm-4" align="center">
                                                <small class="text-default"> {{ $quoteService[$i]->location }} </small>
                                            </div>  
                                            <div class="col-sm-2" align="center">
                                                <small class="text-default"> {{ $quoteService[$i]->commodity }} </small>
                                            </div>
                                            <div class="col-sm-2" align="center">
                                                <small class="text-default"> {{ $quoteService[$i]->dimension }} </small>
                                            </div>
                                            <div class="col-sm-2" align="center">
                                                <small class="text-default"> {{ $quoteService[$i]->dateData }} </small>
                                            </div>
                                            <div class="col-sm-2" align="center">
                                                <small class="text-default"> {{ $quoteService[$i]->selectLoad }} </small>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Common Information End -->
                @endif

                <!-- Status 2 ~: Order Checked -->
                @if ($quoteReq->status > 1 && $quoteReq->status < 9)
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="section-tittle">
                                <span>Comapny Suggestion</span>
                                <h3 class="mb-4">Quick Freight Enterprise INC.</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row ps-3 ps-sm-5">
                                <div class="col-md-6">
                                    <p><small>Delivery Cost</small>: $ {{ $quoteApp->cost }}</p>
                                    <p class="pb-3 border-bottom"><small>Additional Fee</small>: $ {{ $quoteApp->fee }}</p>
                                    <p><small>Total Cost</small>: <span class="fw-bold">$
                                            {{ $quoteApp->total_cost }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><small>Company Comment</small></p>
                                    <p class="ps-4 fw-bold"><small>{{ $quoteApp->company_comment }}</small></p>
                                </div>
                            </div>
                        </div>
                        @if ($quoteReq->status == 2)
                            <div class="col-12 d-flex justify-content-center">
                                <div class="mt-3">
                                    <button class="btn btn-primary bg-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#approveModal">Approve</button>
                                    <button class="btn btn-danger me-3" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">Reject</button>
                                    @if ($quoteApp->old_reject_reason)
                                        <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">Delete</button>
                                    @endif
                                    {{-- <button class="btn btn-primary bg-primary me-5">Accept</button>
                                <button class="btn btn-danger">Reject</button> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <!-- Status 2 ~: Order Checked End -->

                <!-- Status 4: Order Rejected -->
                @if ($quoteReq->status == 4 && $quoteReq->status < 9)
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="section-tittle">
                                <span>Reject Reason</span>
                                <h3 class="mb-4">{{ $customer->first_name . ' ' . $customer->last_name }}</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row ps-3 ps-sm-5">
                                <p class="text-danger">{{ $quoteApp->reject_reason }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Status 4: Order Rejected End -->



                <!-- Status 8 ~ : Load Status -->
                @if ($quoteReq->status >= 9)
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="section-tittle">
                                <span>My Order Status</span>
                                <div>
                                    <h3 class="">Order ID: #{{ $quoteReq->id_alias }}</h3>
                                    @if ($quoteReq->status < 11)
                                        <small class="ms-4 badge bg-primary">Status: On Transport</small>
                                    @elseif($quoteReq->status == 11)
                                        <small class="ms-4 badge bg-success">Status: Arrived</small>
                                    @elseif($quoteReq->status > 11)
                                        <small class="ms-4 badge bg-success">Status: Completed</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="h-100 bg-white p-3 d-flex align-items-center">
                                <div>
                                    @if ($quoteReq->status < 11)
                                        @php
                                            $now = new DateTime();
                                            $pastTime = new DateTime($driver->updated_at); // replace with your past time

                                            $interval = $now->diff($pastTime);
                                            $timeDiff = $interval->format('%d days %h hours %i minutes');
                                        @endphp
                                        <p class="ms-1 ms-sm-5 mt-2"><small class="text-uppercase">Current Location</small>: <span
                                                class="fw-bold">{{ $location->location }}</span></p>
                                        <p class="ms-1 ms-sm-5 mt-2"><small class="text-uppercase">Latitude</small>: <span
                                                class="fw-bold">{{ $location->latitude }}</span></p>
                                        <p class="ms-1 ms-sm-5 mt-2"><small class="text-uppercase">Longitude</small>: <span
                                                class="fw-bold">{{ $location->longitude }}</span></p>
                                        <p class="ms-1 ms-sm-5 mt-2"><small class="text-uppercase">Transport Time</small>: <span
                                                class="fw-bold">{{ $timeDiff }}</span></p>
                                    @else
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">City /
                                                State</small>: <span class="fw-bold">{{ $quoteReq->pickup }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Delivery City /
                                                State</small>: <span class="fw-bold">{{ $quoteReq->delivery }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Date</small>:
                                            <span
                                                class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}</span>
                                        </p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Delivery
                                                Date</small>: <span
                                                class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span>
                                        </p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Commodity</small>:
                                            <span class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Dimension</small>:
                                            <span class="fw-bold">{{ $quoteReq->dimension }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Weight</small>:
                                            <span class="fw-bold">{{ $quoteReq->weight }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Temperature
                                                Condition</small>: <span
                                                class="fw-bold">{{ $quoteReq->temperature }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Equipment</small>:
                                            <span class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Comment</small>:
                                            <span class="fw-bold">{{ $quoteReq->comment }}</span></p>
                                        <p class="mb-2 ms-4"><small class="text-default text-uppercase">Cost</small>:
                                            <span class="fw-bold">$ {{ $quoteApp->total_cost }}</span></p>
                                        {{-- <div class="text-center mt-5">
                                    <button class="btn btn-danger">Check Details</button>
                                </div> --}}
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="h-100 bg-white text-center">
                                @if ($quoteReq->status >= 12)
                                    <p><span class="fw-bold">BOL Picture:</span> <a class="text-primary"
                                            href="{{ url('storage' . $quoteComp->bol_path) }}" target="_blank">Check
                                            Here</a></p>
                                    <img src="{{ url('storage' . $quoteComp->bol_path) }}" class="img-thumbnail"
                                        style="max-height: 400px" alt="BOL Picture">
                                @else
                                    {{-- <iframe class="position-relative rounded w-100"
                                        src="https://maps.google.com/maps?q={{ $quoteComp->lat }},{{ $quoteComp->long }}&t=&z=10&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" allowfullscreen="false" aria-hidden="false" tabindex="0"
                                        style="min-height: 400px"></iframe> --}}
                                    <div id="map" class="position-relative rounded w-100" style="min-height: 400px; height: 100%;"></div>

                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Status 8 ~ : Load Status End -->


                <!-- Status 12 ~ : Payment -->
                @if ($quoteReq->status >= 12)
                    <div class="row d-flex justify-content-center mb-5">
                        <div class="col-12">
                            <div class="section-tittle">
                                <span>Payment</span>
                                <h4 class="ms-5">$ {{ $quoteApp->total_cost }}</h4>
                            </div>
                        </div>
                        @if ($quoteReq->status == 12)
                            <div class="col-md-8 text-center">
                                <div class="row">
                                    <form method="GET" action="{{ route('customer.stripe') }}"
                                        class="col-lg-4 mb-2 text-center">
                                        <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">
                                        <button type="submit" class="btn btn-info bg-info w-100"><i
                                                class="fas fa-credit-card"></i> ACH STRIPE</button>
                                    </form>
                                    <form method="POST"
                                        action="{{ route('checkout.payment.paypal', ['order' => encrypt($quoteComp->quote_id)]) }}"
                                        class="col-lg-4 mb-2 text-center">
                                        @csrf
                                        <button type="submit" class="btn btn-primary bg-primary w-100"><i
                                                class="fab fa-paypal"></i> PAYPAL</button>
                                    </form>
                                    <div class="col-lg-4 mb-2 text-center">
                                        <button class="btn btn-success bg-success w-100"><i
                                                class="fab fa-cc-mastercard"></i> Mastercard</button>
                                    </div>
                                </div>
                            </div>
                            @if (session()->has('message'))
                                <p class="text-danger text-center"><i class="far fa-times-circle"></i>
                                    {{ session('message') }}</p>
                            @endif
                        @elseif ($quoteReq->status == 13)
                            <div class="col-12">
                                <!-- Payment Message -->
                                @if (session()->has('message'))
                                    <p class="text-success text-center"><i class="far fa-check-circle"></i> {{ session('message') }}</p>
                                @else
                                    <p class="text-success text-center"><i class="far fa-check-circle"></i> You recent payment is
                                        sucessful with reference code {{ $quoteReq->transaction_id }}</p>
                                @endif
                                <!-- Payment Message End -->

                                <!-- Invoice -->
                                <div class="text-center">
                                    <a target="_blank" href="{{route('customer.invoice.publish')}}" type="button" class="btn btn-danger">Publish Invoice</a>
                                    {{-- <a target="_blank" href="{{route('customer.invoice.view')}}" type="button" class="btn btn-danger">Publish Invoice</a> --}}
                                </div>
                                <!-- Invoice Field -->
                            </div>
                            <div class="col-12 mt-5">
                                <div class="section-tittle">
                                    <span>Review</span>
                                    @if (!$quoteComp->customer_review)
                                        <h4>Leave your Review</h4>
                                    @else
                                        <h4>Your Review</h4>
                                    @endif
                                </div>
                                <!-- Review Field -->
                                @if (!$quoteComp->customer_review)
                                    <form method="POST" action="{{ route('customer.quote.review') }}">
                                        @csrf
                                        <textarea name="review" style="height: 140px" class="form-control" required></textarea>
                                        @if($errors->has('review'))
                                            <small class="text-danger">{{$errors->first('review')}}</small>
                                            <input type="hidden" class="errorMsg" value="{{$errors->first('review')}}">
                                        @endif
                                        <div>
                                            <button type="submit" class="btn btn-success bg-success mt-3">Send</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="bg-light p-3">
                                        <p>{{ $quoteComp->customer_review }}</p>
                                        <p class="text-end mb-0"><small class="text-secondary">({{ $quoteComp->updated_at }})</small></p>
                                    </div>
                                @endif
                                <!-- Review field End -->
                            </div>
                        @endif
                    </div>
                @endif
                <!-- Status 12 ~: Payment End -->


                <!-- Current Status Start -->
                @if ($quoteReq->status < 12)
                    <div class="row">
                        <div class="col-12">
                            <div class="section-tittle">
                                <span>Current Request Status</span>
                                <div class="progress">
                                    @if ($quoteReq->status == 1)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:20%">Requested</div>
                                    @elseif($quoteReq->status == 2)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:30%">Accepted</div>
                                    @elseif($quoteReq->status == 3)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:40%">Approved</div>
                                    @elseif($quoteReq->status == 4)
                                        <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
                                            style="width:20%">Rejected</div>
                                    @elseif($quoteReq->status == 5)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:50%">Approved</div>
                                    @elseif($quoteReq->status == 6)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:60%">Approved</div>
                                    @elseif($quoteReq->status == 7)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:70%">Approved</div>
                                    @elseif($quoteReq->status == 8)
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                            style="width:80%">To Pickup</div>
                                    @elseif($quoteReq->status == 9)
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                            style="width:80%">On Loading</div>
                                    @elseif($quoteReq->status == 10)
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                            style="width:90%">On Transport</div>
                                    @elseif($quoteReq->status == 11)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:95%">Arrived</div>
                                    @elseif($quoteReq->status == 12)
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                            style="width:100%">Completed</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Current Status End -->
            </div>
        </section>
        <!-- Customer Area End -->
    </main>

    @include('frontendlayouts.footer')

    @include('frontendlayouts.scrollup')
@endsection

@push('modals')
    @if ($quoteReq->status == 2)
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <form method="POST" action="{{ route('customer.quote.approve') }}" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Are you agree with this quote?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>If so, please complete your information</p>
                        <div class="form-group mb-3">
                            <input class="form-control mt-3" name="company_name" placeholder="Company Name"
                                value="@if(old('company_name')){{ old('company_name') }}@else{{ $quoteApp->company_name }}@endif">
                            @if ($errors->has('company_name'))
                                <small class="text-danger">{{ $errors->first('company_name') }}</small>
                                <input type="hidden" class="errorMsg" value="{{ $errors->first('company_name') }}">
                            @endif
                            <input class="form-control mt-3" name="company_address" placeholder="Company Address"
                                value="@if(old('company_address')){{ old('company_address') }}@else{{ $quoteApp->company_address }}@endif">
                            @if ($errors->has('company_address'))
                                <small class="text-danger">{{ $errors->first('company_address') }}</small>
                                <input type="hidden" class="errorMsg" value="{{ $errors->first('company_address') }}">
                            @endif
                            <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bg-secondary me-3"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="approveBtn" class="btn btn-primary bg-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <form method="POST" action="{{ route('customer.quote.reject') }}" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Do you reject this quote?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Can you tell me the reason you reject this quote?</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="Too expensive." id="radio1" checked>
                                <label class="form-check-label" for="radio1">
                                    Too expensive.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="I'm not interested in." id="radio2">
                                <label class="form-check-label" for="radio2">
                                    I'm not interested in.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="Others." id="radio3">
                                <label class="form-check-label" for="radio3">
                                    Others.
                                </label>
                            </div>
                            <textarea class="form-control mt-3" style="height: 100px;" name="reject_reason"
                                placeholder="Please enter your opinion">@if(old('reject_reason')){{ old('reject_reason') }}@else{{ $quoteApp->reject_reason }}@endif</textarea>
                            @if ($errors->has('reject_reason'))
                                <small class="text-danger">{{ $errors->first('reject_reason') }}</small>
                                <input type="hidden" class="errorMsg" value="{{ $errors->first('reject_reason') }}">
                            @endif

                            <input class="form-control mt-3" name="company_name" placeholder="Company / Home"
                                value="@if(old('company_name')){{ old('company_name') }}@else{{ $quoteApp->company_name }}@endif" required>
                            @if ($errors->has('company_name'))
                                <small class="text-danger">{{ $errors->first('company_name') }}</small>
                            @endif
                            <input class="form-control mt-2" name="company_address" placeholder="Company / Home Address"
                                value="@if(old('company_address')){{ old('company_address') }}@else{{ $quoteApp->company_address }}@endif" required>
                            @if ($errors->has('company_address'))
                                <small class="text-danger">{{ $errors->first('company_address') }}</small>
                            @endif


                            <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-base me-3"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-base">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <form id="deleteForm" method="post" action="{{ route('customer.quote.delete') }}"
                    class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Are you sure delete this request?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Why do you gonna delete this order?</p>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="Too expensive." id="radio1_d" checked>
                                <label class="form-check-label" for="radio1_d">
                                    Too expensive.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="I'm not interested in." id="radio2_d">
                                <label class="form-check-label" for="radio2_d">
                                    I'm not interested in.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="Bad service." id="radio3_d">
                                <label class="form-check-label" for="radio3_d">
                                    Bad service.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason_option" value="Others." id="radio4_d">
                                <label class="form-check-label" for="radio4_d">
                                    Others.
                                </label>
                            </div>
                            <textarea class="form-control" style="height: 150px" name="delete_reason" placeholder="Please enter your opinion" required></textarea>
                            @if ($errors->has('delete_reason'))
                                <small class="text-danger">We are very thankful if you tell us why are you gonna delete
                                    this request.</small>
                                <input type="hidden" class="errorMsg" value="{{ $errors->first('delete_reason') }}">
                            @endif
                            <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-base me-3"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="deleteBtn" class="btn btn-danger btn-base">Delete</button>
                    </div>
                </form>
            </div>
        </div>

        @if (Session::has('show_modal'))
            <input id="show-modal" value="{{ session('show_modal') }}">
        @endif
    @endif
@endpush

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiZWS8nBscbzohPYAuyaPQx-ADDgt9ujI"></script>
    <script>
        function initMap() {
            console.log("init map");
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 0, lng: -180}
            });

            // Get the polyline data from the server
            fetch("{{ route('api.getpoints', Auth::guard('customerguard')->user()->quote_id) }}")
                .then(response => response.json())
                .then(polyline => {
                    // Create a new polyline object
                    var flightPath = new google.maps.Polyline({
                        path: polyline,
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });

                    // Add the polyline to the map
                    flightPath.setMap(map);

                    // Get the last point of the polyline
                    var lastPoint = polyline[polyline.length - 1];

                    // Center the map on the last point
                    map.setCenter(new google.maps.LatLng(lastPoint.lat, lastPoint.lng));

                    // Create a new marker at the last point
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(lastPoint.lat, lastPoint.lng),
                        map: map,
                        title: 'Current Position'
                    });
                });
        };

        $(window).on('load',function(){
            if ($('#show-modal').val() == 1) {
                $('#approveModal').modal('show');
            } else if ($('#show-modal').val() == 2) {
                $('#rejectModal').modal('show');
            } else if ($('#show-modal').val() == 3) {
                $('#deleteModal').modal('show');
            };
        @if ($quoteReq->status >= 8 && $quoteReq->status <= 11)
            initMap();
        @endif
        });

        @if ($quoteReq->status >= 8 && $quoteReq->status <= 11)
        // setInterval(initMap, 5000);
        @endif

    </script>
@endpush
