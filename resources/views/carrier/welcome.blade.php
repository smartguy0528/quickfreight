@extends('frontendlayouts.app')

@section('content')
    <main style="min-height: 100vh">
        <!--  Carrier Login start  -->
        <section class="slider-area h-100" style="min-height: 100vh">
            <div class="container pt-3 pb-5 bg-dark bg-opacity-50">
                <h1 class="text-white text-end pe-1 pe-md-5"><a href="{{ route('logout.perform') }}"><small>Exit</small> <i
                            class="fas fa-sign-out-alt"></i></a></h1>
                <div class="row progresses">
                    <div class="steps bg-success">
                        <span><i class="fas fa-check"></i></span>
                    </div>

                    @if ((!Session::has('state') || session('state') == 1) && $quoteReq->status < 6)
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

                    @if ((Session::has('state') && session('state') > 2) || $quoteReq->status > 5)
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @else
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>3</span>
                        </div>
                    @endif

                    @if ($quoteReq->status > 6)
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @else
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>4</span>
                        </div>
                    @endif

                    @if ($quoteReq->status > 7)
                        <span class="line bg-success"></span>
                        <div class="steps bg-success">
                            <span><i class="fas fa-check"></i></span>
                        </div>
                    @else
                        <span class="line bg-secondary"></span>
                        <div class="steps bg-secondary">
                            <span>5</span>
                        </div>
                    @endif
                </div>

                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-lg-8 col-md-10 p-4 bg-light">
                        <div class="text-center mb-4">
                            <h1 class="text-uppercase text-danger"><img class="login-logo me-3"
                                    src="{{ asset('assets/common/img/logo/loder.png') }}" alt=""> Quick Freight
                                Enterprise INC</h1>
                        </div>

                        @if ($quoteReq->status == 5)
                            @if (!Session::has('state') || session('state') == 1)
                                <!-- State 1 -->
                                <h3>To {{ Auth::guard('carrierguard')->user()->legal_name }}</h3>
                                <div class="row mt-3 bg-white p-3">
                                    <p>In order to proceed with the Agreement, we kindly request your agreement with the
                                        following
                                        terms:</p>
                                    <p class="ps-4">1. We will need for you to send us the information of the driver dedicated to this
                                        request. This is
                                        necessary to ensure a smooth and efficient service.</p>
                                    <p class="ps-4">2. We require your agreement to receive real-time updates on the driver and luggage
                                        status.
                                        This will allow us to provide the best possible service.</p>
                                    <p class="ps-4">3. For Condition 2, you agree that we may send our website link to the driver via
                                        SMS. <span class="fw-bold">And the driver must remain connected to the link via web
                                            browser at all
                                            times during transport, and you should inform the driver of this
                                            requirement.</span></p>
                                    <p>We appreciate your cooperation and look forward to providing a reliable and efficient
                                        service
                                        with you.</p>
                                    <p>Quick Freight Enterprise INC.</p>
                                </div>

                                <div class="mt-5">
                                    <p class="ms-3 mb-5">Are you agree with this request?</p>
                                    <form method="GET" action="{{ route('carrier.step.2') }}" class="text-center">
                                        <button type="submit" class="btn btn-success bg-success me-3">I Agree</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#rejectModal">Disagree</button>
                                    </form>
                                </div>
                                <!-- State 1 End -->
                            @elseif(session('state') == 2)
                                <!-- State 2 -->
                                <h3>Request Information <small class="text-secondary">(To
                                    {{ Auth::guard('carrierguard')->user()->legal_name }})</small></h3>
                                <div class="ps-1 ps-sm-5 bg-white">
                                    <p class="mb-1"><small class="text-uppercase">City / State</small>: <span
                                            class="fw-bold">{{ $quoteReq->pickup }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Delivery City / State</small>: <span
                                            class="fw-bold">{{ $quoteReq->delivery }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Date</small>: <span
                                            class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Delivery Date</small>: <span
                                            class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span>
                                    </p>
                                    <p class="mb-1"><small class="text-uppercase">Commodity</small>: <span
                                            class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Dimension</small>: <span
                                            class="fw-bold">{{ $quoteReq->dimension }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Weight</small>: <span
                                            class="fw-bold">{{ $quoteReq->weight }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Temperature Condition</small>: <span
                                            class="fw-bold">{{ $quoteReq->temperature }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Equipment</small>: <span
                                            class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Requested Cost</small>: <span
                                            class="fw-bold">$
                                            {{ $quoteComp->deliver_cost }}</span></p>
                                    <p class="mb-1"><small class="text-uppercase">Comment</small>: <span
                                            class="fw-bold">{{ $quoteComp->company_carrier_comment }}</span></p>
                                </div>
                                <form method="GET" action="{{ route('carrier.step.3') }}" class="mt-5 text-center">
                                    <button type="submit" class="btn btn-success bg-success me-3">I Agree</button>
                                    <a href="{{ route('carrier.step.back', 1) }}"
                                                class="btn btn-danger">Back</a>
                                </form>

                                <!-- State 2 End -->
                            @elseif(session('state') == 3)
                                <!-- State 3 -->
                                <h3>Required Documents</h3>
                                <form method="POST" action="{{ route('carrier.step.4') }}"
                                    enctype="multipart/form-data" class="row bg-white p-3">
                                    @csrf
                                    <div class="col-12 mb-4">
                                        <p>Please attach the following dowuments.</p>
                                        <p>You must attach all documents to complete this application.</p>
                                        <p>When all required documents are attached, Click Finish.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-0">Carrier Packet</h5>
                                        <small class="text-muted">(Required, Max size 5MB, File Type: pdf)</small>
                                        <input type="file" id="doc_carrier_packet" name="doc_carrier_packet" required>
                                        @if ($errors->has('doc_carrier_packet'))
                                            <small class="text-danger">{{ $errors->first('doc_carrier_packet') }}</small>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('doc_carrier_packet') }}">
                                        @endif

                                        <h5 class="mb-0">Certificate of Insurance</h5>
                                        <small class="text-muted">(Required, Max size 5MB, File Type: pdf)</small>
                                        <input type="file" id="doc_cert_ins" name="doc_cert_ins" required>
                                        @if ($errors->has('doc_cert_ins'))
                                            <small class="text-danger">{{ $errors->first('doc_cert_ins') }}</small>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('doc_cert_ins') }}">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-0">Completed W9 Tax Form</h5>
                                        <small class="text-muted">(Required, Max size 5MB, File Type: pdf)</small>
                                        <input type="file" id="doc_w9_form" name="doc_w9_form" required>
                                        @if ($errors->has('doc_w9_form'))
                                            <small class="text-danger">{{ $errors->first('doc_w9_form') }}</small>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('doc_w9_form') }}">
                                        @endif

                                        <h5 class="mb-0">Operating Authority</h5>
                                        <small class="text-muted">(Required, Max size 5MB, File Type: pdf)</small>
                                        <input type="file" id="doc_operating_auth" name="doc_operating_auth" required>
                                        @if ($errors->has('doc_operating_auth'))
                                            <small class="text-danger">{{ $errors->first('doc_operating_auth') }}</small>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('doc_operating_auth') }}">
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mt-3">
                                            <textarea class="form-control" style="height: 132px" name="carrier_comment" placeholder="Leave a comment here"
                                                id="driverInfo">@if (old('carrier_comment')){{ old('carrier_comment') }}@else{{ $quoteComp->carrier_comment }}@endif</textarea>
                                            <label for="driverInfo">Carrier Comment (Optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <p class="text-uppercase mb-1">Signature</p>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="carrierSign" name="carrier_sign"
                                                placeholder="Carrier Signature"
                                                value="@if(old('carrier_sign')){{ old('carrier_sign') }}@else{{ $quoteComp->carrier_sign }}@endif"
                                                required>
                                            <label for="carrierSign">Carrier Signature</label>
                                        </div>
                                        @if ($errors->has('carrier_sign'))
                                            <small class="text-danger">{{ $errors->first('carrier_sign') }}</small>
                                            <input type="hidden" class="errorMsg"
                                                value="{{ $errors->first('carrier_sign') }}">
                                        @endif
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn btn-success bg-success me-3">Submit</button>
                                        <a href="{{ route('carrier.step.back', 2) }}" class="btn btn-danger">Back</a>
                                    </div>
                                </form>
                                <!-- State 3 End -->
                            @endif
                        @elseif ($quoteReq->status == 6)
                            <h2>Request Information</h2>
                            <div class="ps-1 ps-sm-5 bg-white">
                                
                                <p class="mb-1"><small class="text-uppercase">Weight</small>: <span
                                        class="fw-bold">{{ $quoteReq->weight }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Temperature Condition</small>: <span
                                        class="fw-bold">{{ $quoteReq->temperature }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Equipment</small>: <span
                                        class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Requested Cost</small>: <span
                                        class="fw-bold">$
                                        {{ $quoteComp->deliver_cost }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Comment</small>: <span
                                        class="fw-bold">{{ $quoteComp->company_carrier_comment }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">City / State</small>: <span
                                        class="fw-bold">{{ $quoteReq->pickup }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Delivery City / State</small>: <span
                                        class="fw-bold">{{ $quoteReq->delivery }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Date</small>: <span
                                        class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Delivery Date</small>: <span
                                        class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span>
                                </p>
                                <p class="mb-1"><small class="text-uppercase">Commodity</small>: <span
                                        class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Dimension</small>: <span
                                        class="fw-bold">{{ $quoteReq->dimension }}</span></p>
                                        
                            </div>
                            <h3 class="mt-4">Attached Documents</h3>
                            <div class="ps-1 ps-sm-5 bg-white">
                                <p class="mb-1"><small class="text-uppercase">Carrier Packet</small>: <small
                                        class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                        Attached</small></p>
                                <p class="mb-1"><small class="text-uppercase">Certificate of Insurance</small>:
                                    <small class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                        Attached</small></p>
                                <p class="mb-1"><small class="text-uppercase">Completed W9 Tax Form</small>:
                                    <small class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                        Attached</small></p>
                                <p class="mb-1"><small class="text-uppercase">Operating Authority</small>:
                                    <small class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                        Attached</small></p>
                            </div>
                            <h5 class="text-info mt-4">Waiting for Company's Confirmation...</h5>
                            @elseif ($quoteReq->status == 7)
                            <form method="POST" action="{{ route('carrier.step.5') }}"
                                class="row bg-white p-3 pb-0 mt-3">
                                <h3 class="mt-5">Dedicated Driver Information</h3>
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-floating mt-3">
                                        <input class="form-control" id="driverName" name="driver_name"
                                            placeholder="Driver Name"
                                            value="@if (old('driver_name')) {{ old('driver_name') }}@elseif($driver){{ $driver->name }} @endif"
                                            required>
                                        <label for="driverName">Driver Name</label>
                                    </div>
                                    @if ($errors->has('driver_name'))
                                        <small class="text-danger">{{ $errors->first('driver_name') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('driver_name') }}">
                                    @endif
                                    <div class="form-floating mt-3">
                                        <input class="form-control" id="driverPhone" name="driver_phone"
                                            placeholder="Driver Mobile Phone ( --- --- ---- )"
                                            value="@if (old('driver_phone')) {{ old('driver_phone') }}@elseif($driver){{ $driver->phone }} @endif"
                                            required>
                                        <label for="driverPhone">Driver Mobile Phone (Type: 123-456-7890)</label>
                                    </div>
                                    @if ($errors->has('driver_phone'))
                                        <small class="text-danger">{{ $errors->first('driver_phone') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('driver_phone') }}">
                                    @endif
                                    <div class="form-floating mt-3">
                                        <input type="email" class="form-control" id="driverEmail"
                                            name="driver_email" placeholder="name@example.com"
                                            value="@if (old('driver_email')) {{ old('driver_email') }}@elseif($driver){{ $driver->email }} @endif"
                                            required>
                                        <label for="driverEmail">Email address</label>
                                    </div>
                                    @if ($errors->has('driver_email'))
                                        <small class="text-danger">{{ $errors->first('driver_email') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('driver_email') }}">
                                    @endif
                                    <div class="form-floating mt-3">
                                        <input class="form-control" id="miles" name="miles"
                                            placeholder="Miles"
                                            value="@if (old('miles')) {{ old('miles') }}@elseif($driver){{ $driver->miles }} @endif"
                                            required>
                                        <label for="miles">Miles</label>
                                    </div>
                                    @if ($errors->has('miles'))
                                        <small class="text-danger">{{ $errors->first('miles') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('miles') }}">
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mt-3">
                                        <input class="form-control" id="truckNum" name="truck_num"
                                            placeholder="Truck Number"
                                            value="@if (old('truck_num')) {{ old('truck_num') }}@elseif($driver){{ $driver->truck_num }} @endif"
                                            required>
                                        <label for="truckNum">Truck Number</label>
                                    </div>
                                    @if ($errors->has('truck_num'))
                                        <small class="text-danger">{{ $errors->first('truck_num') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('truck_num') }}">
                                    @endif
                                    <div class="form-floating mt-3">
                                        <input class="form-control" id="truckType" name="truck_type"
                                            placeholder="Truck Type"
                                            value="@if (old('truck_type')) {{ old('truck_type') }}@elseif($driver){{ $driver->truck_type }} @endif"
                                            required>
                                        <label for="truckType">Truck Type</label>
                                    </div>
                                    @if ($errors->has('truck_type'))
                                        <small class="text-danger">{{ $errors->first('truck_type') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('truck_type') }}">
                                    @endif
                                    <div class="form-floating mt-3">
                                        <input class="form-control" id="truckCapacity" name="truck_capacity"
                                            placeholder="Truck Capacity"
                                            value="@if (old('truck_capacity')) {{ old('truck_capacity') }}@elseif($driver){{ $driver->truck_capacity }} @endif"
                                            required>
                                        <label for="truckCapacity">Truck Capacity</label>
                                    </div>
                                    @if ($errors->has('truck_capacity'))
                                        <small class="text-danger">{{ $errors->first('truck_capacity') }}</small>
                                        <input type="hidden" class="errorMsg"
                                            value="{{ $errors->first('truck_capacity') }}">
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control" style="height: 132px" name="driver_info" placeholder="Leave a comment here"
                                            id="driverInfo">@if (old('driver_info')){{ old('driver_info') }}@elseif($driver){{ $driver->driver_info }}@endif</textarea>
                                        <label for="driverInfo">Driver Information (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-12 my-5">
                                    <p class="ms-3">Are you agree with this term?</p>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success bg-success me-3">I
                                            Agree</button>
                                        <a href="{{ route('carrier.step.back', 1) }}"
                                            class="btn btn-danger">Disagree</a>
                                    </div>
                                </div>
                            </form>
                        @elseif ($quoteReq->status > 7)
                            <h3 class="text-success text-center">Quote Confirmation Finished!</h3>
                            <h5>Request Information <small class="text-secondary">(To
                                    {{ Auth::guard('carrierguard')->user()->legal_name }})</small></h5>
                            <div class="ps-1 ps-sm-5 bg-white">
                                <p class="mb-1"><small class="text-uppercase">City / State</small>: <span
                                        class="fw-bold">{{ $quoteReq->pickup }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Delivery City / State</small>: <span
                                        class="fw-bold">{{ $quoteReq->delivery }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Date</small>: <span
                                        class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Delivery Date</small>: <span
                                        class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span>
                                </p>
                                <p class="mb-1"><small class="text-uppercase">Commodity</small>: <span
                                        class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Dimension</small>: <span
                                        class="fw-bold">{{ $quoteReq->dimension }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Weight</small>: <span
                                        class="fw-bold">{{ $quoteReq->weight }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Temperature Condition</small>: <span
                                        class="fw-bold">{{ $quoteReq->temperature }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Equipment</small>: <span
                                        class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Requested Cost</small>: <span
                                        class="fw-bold">$
                                        {{ $quoteComp->deliver_cost }}</span></p>
                                <p class="mb-1"><small class="text-uppercase">Comment</small>: <span
                                        class="fw-bold">{{ $quoteComp->company_carrier_comment }}</span></p>
                            </div>
                            <h5 class="mt-4">Driver Information</h5>
                            <div class="ps-1 ps-sm-5 bg-white">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><small class="text-uppercase">Driver Name</small>: <span
                                                class="fw-bold">{{ $driver->name }}</span></p>
                                        <p class="mb-1"><small class="text-uppercase">Driver Phone</small>: <span
                                                class="fw-bold">{{ $driver->phone }}</span></p>
                                        <p class="mb-1"><small class="text-uppercase">Driver Email</small>: <span
                                                class="fw-bold">{{ $driver->email }}</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><small class="text-uppercase">Truck Number</small>: <span
                                                class="fw-bold">{{ $driver->truck_num }}</span></p>
                                        <p class="mb-1"><small class="text-uppercase">Truck Type</small>: <span
                                                class="fw-bold">{{ $driver->truck_type }}</span></p>
                                        <p class="mb-1"><small class="text-uppercase">Truck Capacity</small>: <span
                                                class="fw-bold">{{ $driver->truck_capacity }}</span></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="mb-1"><small class="text-uppercase">Miles</small>: <span
                                                class="fw-bold">{{ $driver->miles }}</span></p>
                                        <p class="mb-1"><small class="text-uppercase">Driver Information</small>: <span
                                                class="fw-bold">{{ $driver->info }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-4">Contract Details</h5>
                            <div class="ps-1 ps-sm-5 bg-white">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <p class="mb-1"><small class="text-uppercase">Carrier Packet</small>: <small
                                                class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                                Attached</small></p>
                                        <p class="mb-1"><small class="text-uppercase">Certificate of Insurance</small>:
                                            <small class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                                Attached</small></p>
                                        <p class="mb-1"><small class="text-uppercase">Completed W9 Tax Form</small>:
                                            <small class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                                Attached</small></p>
                                        <p class="mb-1"><small class="text-uppercase">Operating Authority</small>:
                                            <small class="fw-bold text-success"><i class="fas fa-check-circle"></i>
                                                Attached</small></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><small class="text-uppercase">Broker Signature</small>: <span
                                                class="fw-bold text-primary">{{ $quoteComp->company_sign }}</span></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-1"><small class="text-uppercase">Carrier Signature</small>: <span
                                                class="fw-bold text-primary">{{ $quoteComp->carrier_sign }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a target="_blank" href="{{route('carrier.rateconf.publish', $quoteReq->id)}}" type="button" class="btn btn-primary bg-primary">Publish Quote PDF</a>
                            </div>
                            <div>
                                <h1 class="text-secondary ps-1 ps-md-5"><a
                                        href="{{ route('logout.perform') }}" onmouseover="this.style.color='#28a745';" onmouseout="this.style.color='#635c5c';"><small>Exit</small> <i
                                            class="fas fa-sign-out-alt"></i></a></h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Carrier Login End -->
    </main>

    @if (Session::has('modal'))
        <input type="hidden" id="show_modal" value="{{ session('modal') }}">
    @endif
@endsection

@push('modals')
    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <form id="rejectForm" method="POST" action="{{ route('carrier.quote.reject') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title">Do you really reject this request?</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-floating mt-3">
                            <textarea class="form-control" style="height: 132px" name="reject_reason" placeholder="Leave a comment here"
                                id="driverInfo">{{ old('reject_reason') }}</textarea>
                            <label for="driverInfo">Please leave us your opinion here.</label>
                        </div>
                        @if ($errors->has('reject_reason'))
                            <small class="text-danger">{{ $errors->first('reject_reason') }}</small>
                            <input type="hidden" class="errorMsg" value="{{ $errors->first('reject_reason') }}">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-base me-3" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="rejectBtn" class="btn btn-danger btn-base">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Filepond PDF -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>

    <script src="{{ asset('assets/backend/js/carrier/welcome.js') }}"></script>
    <script>
        $('.filepond--credits').addClass('d-none');
        $('.filepond--drop-label').addClass('border').addClass('border-secondary');
    </script>
@endpush
