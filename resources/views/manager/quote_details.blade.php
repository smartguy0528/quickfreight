@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Quote Details</h1>
        <ol class="breadcrumb mb-4">
            @if($quoteReq->status <= 12)
            <li class="breadcrumb-item"><a href="{{route('manager.all.quotes')}}">Quotes</a></li>
            @elseif($quoteReq->status == 13)
            <li class="breadcrumb-item"><a href="{{route('manager.quote.invoices')}}">Completed Quotes</a></li>
            @endif

            @if($quoteReq->status == 1)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.requested')}}">Requested Quotes</a></li>
            @elseif($quoteReq->status == 2)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.checked')}}">Checked Quotes</a></li>
            @elseif($quoteReq->status == 3)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.approved')}}">Approved Quotes</a></li>
            @elseif($quoteReq->status == 4)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.rejected')}}">Rejected Quotes</a></li>
            @elseif($quoteReq->status == 5)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.confirmed')}}">Confirmed Quotes</a></li>
            @elseif($quoteReq->status == 6)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.submitted')}}">Submitted Quotes</a></li>
            @elseif($quoteReq->status == 7)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.published')}}">Published Quotes</a></li>
            @elseif($quoteReq->status > 7 && $quoteReq->status < 12)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.ongoing')}}">On going Quotes</a></li>
            @elseif($quoteReq->status == 12)
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.completed')}}">Completed Quotes</a></li>
            @endif
            <li class="breadcrumb-item active">Quote Details</li>
        </ol>


        <div class="card mb-4">
            <div class="card-body table-responsive p-5">
                {{--
                ******************* Common Info ******************
                --}}
                <div class="d-flex">
                    <h3 class="text-primary my-2">
                        Quote ID: #{{ $quoteReq->id_alias }}
                    </h3>
                    <div class="ms-2 mb-3">
                        @if($quoteReq->status == 1)
                        <p class="badge bg-success">Status: Order Requested</p>
                        @elseif($quoteReq->status == 2)
                        <p class="badge bg-success">Status: Order Accepted</p>
                        @elseif($quoteReq->status == 3)
                        <p class="badge bg-success">Status: Order Approved</p>
                        @elseif($quoteReq->status == 4)
                        <p class="badge bg-danger">Status: Order Rejected</p>
                        @elseif($quoteReq->status == 5)
                        <p class="badge bg-success">Status: Carrier Selected</p>
                        @elseif($quoteReq->status == 6)
                        <p class="badge bg-success">Status: Quote Sent to Carrier</p>
                        @elseif($quoteReq->status == 7)
                        <p class="badge bg-success">Status: Quote Published</p>
                        @elseif($quoteReq->status == 8)
                        <p class="badge bg-primary">Status: Driver Accepted</p>
                        @elseif($quoteReq->status == 9)
                        <p class="badge bg-primary">Status: Driver Loading</p>
                        @elseif($quoteReq->status == 10)
                        <p class="badge bg-primary">Status: Driver Carrying</p>
                        @elseif($quoteReq->status == 11)
                        <p class="badge bg-success">Status: Load Arrived</p>
                        @elseif($quoteReq->status == 12)
                        <p class="badge bg-success">Status: Completed</p>
                        @endif
                    </div>
                </div>

                @if ($quoteReq->status <= 8)
                <div class="row mb-5">
                    <div class="col-md-4">
                        <div class="bg-light p-3 h-100 d-flex flex-column justify-content-between">
                            <h5>Customer Information</h5>
                            <div class="ps-3">
                                <p class="mt-3"><small class="text-default text-uppercase">Customer Name</small>: <span class="fw-bold">{{ $user->first_name.' '.$user->last_name }}</span></p>
                                <p class="mt-3"><small class="text-default text-uppercase">Customer Email</small>: <span class="fw-bold">{{ $user->email }}</span></p>
                                <p class="mt-3"><small class="text-default text-uppercase">Customer Phone</small>: <span class="fw-bold">{{ $user->phone }}</span></p>
                                <p class="mt-3"><small class="text-default text-uppercase">Company/Home Information</small>: <span class="fw-bold"> @if($quoteApp) {{ $quoteApp->company_info }} @endif</span></p>
                                <p class="mt-3"><small class="text-default text-uppercase">Company/Home Address</small>: <span class="fw-bold"> @if($quoteApp) {{ $quoteApp->company_address }} @endif</span></p>
                            </div>
                            <div class="text-end">
                                <p class="badge bg-secondary mb-0">Requested at: <span class="fw-bold">{{ $quoteReq->created_at }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="bg-light p-3 h-100">
                            <h5>
                                Request Information
                                @if ($quoteReq->status == 1 || $quoteReq->status == 4)
                                    <a href="{{ route('manager.quote.edit', $quoteReq->id) }}" class="fw-light ms-3 text-primary"><i class="far fa-edit"></i> Edit</a>
                                @endif
                            </h5>
                            <!-- <div class="ps-3 pt-3">
                                <p class="col-4"><small class="text-default text-uppercase">City / State</small>: <span class="fw-bold">{{ $quoteReq->pickup }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Delivery City / State</small>: <span class="fw-bold">{{ $quoteReq->delivery }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Date</small>: <span class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Delivery Date</small>: <span class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Commodity</small>: <span class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Dimension</small>: <span class="fw-bold">{{ $quoteReq->dimension }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Weight</small>: <span class="fw-bold">{{ $quoteReq->weight }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Temperature Condition</small>: <span class="fw-bold">{{ $quoteReq->temperature }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Equipment</small>: <span class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                                <p class="mb-2"><small class="text-default text-uppercase">Comment</small>: <span class="fw-bold">{{ $quoteReq->comment }}</span></p>
                            </div> -->
                            
                            <p class="mb-2"><small class="text-default text-uppercase">Weight</small>: <span class="fw-bold">{{ $quoteReq->weight }}</span></p>
                            <p class="mb-2"><small class="text-default text-uppercase">Temperature Condition</small>: <span class="fw-bold">{{ $quoteReq->temperature }}</span></p>
                            <p class="mb-2"><small class="text-default text-uppercase">Equipment</small>: <span class="fw-bold">{{ $quoteReq->equipment_name }}</span></p>
                            <p class="mb-2"><small class="text-default text-uppercase">Comment</small>: <span class="fw-bold">{{ $quoteReq->comment }}</span></p>
                            <hr>
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
                @endif


                {{--
                ******************* Status 1: Requested Quote Information ******************
                --}}
                @if ($quoteReq->status == 1)
                <h5 class="mt-5">Quote Request</h5>
                <form method="POST" action="{{route('manager.quote.approve')}}" class="container-fluid bg-light py-4">
                    @csrf
                    <input type="hidden" name="quote_id" value="{{$quoteReq->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-6 text-end pt-2"><small class="text-uppercase">Delivery Cost</small><span class="text-danger">*</span> ($): </div>
                                <div class="col-sm-6">
                                    <input class="form-control" name="cost" value="{{old('cost')}}" required>
                                </div>
                                <div class="col-12 text-end">
                                    @if($errors->has('cost'))
                                        <small class="text-danger">{{$errors->first('cost')}}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('cost')}}">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 text-end pt-2"><small class="text-uppercase">Additional Fee</small> ($): </div>
                                <div class="col-sm-6">
                                    <input class="form-control" name="fee" value="{{old('fee')}}" required>
                                </div>
                                <div class="col-12 text-end">
                                    @if($errors->has('fee'))
                                        <small class="text-danger">{{$errors->first('fee')}}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('fee')}}">
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-6 text-end text-uppercase pt-2">Total Cost<span class="text-danger">*</span> ($): </div>
                                <div class="col-sm-6">
                                    <input class="form-control" name="total_cost" value="{{old('total_cost')}}" required>
                                </div>
                                <div class="col-12 text-end">
                                    @if($errors->has('total_cost'))
                                        <small class="text-danger">{{$errors->first('total_cost')}}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('total_cost')}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><small class="text-uppercase">Comment:</small></p>
                            <textarea class="form-control" style="height: 122px" name="company_comment">{{ old("company_comment") }}</textarea>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-primary w-125p"><i class="fas fa-paper-plane"></i> Send Quote</button>
                        </div>
                    </div>
                </form>
                @endif


                {{--
                ******************* Status 2 ~: Company Quote Information ******************
                --}}
                @if ($quoteReq->status > 1 && $quoteReq->status < 8)
                <h5 class="mt-5">Quote of Company</h5>
                <div class="row p-3 bg-light">
                    <div class="col-md-6">
                        <p><small class="text-uppercase">Delivery Cost</small>: $ {{$quoteApp->cost}}</p>
                        <p class="pb-3 border-bottom"><small class="text-uppercase">Additional Fee</small>: $ {{$quoteApp->fee}}</p>
                        <p><small class="text-uppercase">Total Cost</small>: <span class="fw-bold">$ {{ $quoteApp->total_cost }}</span></p>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-between">
                        <div>
                            <p><small class="text-uppercase">Company Comment</small></p>
                            <p class="ps-4 fw-bold"><small>{{$quoteApp->company_comment}}</small></p>
                        </div>
                        <div class="text-end">
                            <p class="badge bg-secondary mb-0">Accepted at: <span class="fw-bold">{{ $quoteApp->created_at }}</span></p>
                        </div>
                    </div>
                </div>
                @endif


                {{--
                ******************* Status 3: Customer approved quote. Waiting for RMIS ******************
                --}}
                @if ($quoteReq->status == 3)
                <h5 class="mt-5">Select Carrier</h5>
                <div class="row mb-4 bg-light py-3">
                    <div class="col-md-6">
                        <form method="GET" action="{{route("manager.carrier.mc")}}" class="row">
                            <div class="col-sm-4 pt-2 text-end">MC Number:</div>
                            <div class="col-sm-4">
                                <input class="form-control" name="mc_number" value="{{old("mc_number")}}" required disabled>
                                @if($errors->has('mc_number'))
                                    <small class="text-danger">{{$errors->first('mc_number')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('mc_number')}}">
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary w-100" disabled><i class="fas fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{route("manager.carrier.dot")}}" class="row">
                            <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">
                            <div class="col-sm-4 pt-2 text-end">US DOT Number:</div>
                            <div class="col-sm-4">
                                <input class="form-control" name="dot_number" value="{{old('dot_number')}}" required>
                                @if($errors->has('dot_number'))
                                    <small class="text-danger">{{$errors->first('dot_number')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('dot_number')}}">
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4 bg-light p-5">
                    @if (Session::has('carrier_selected'))
                    <p class="text-center fw-bold my-4 bg-secondary text-white py-2">Company Snapshot for {{ session('carrier_selected.legal_name') }} USDOT: {{ session('carrier_selected.dot_number') }}</p>
                    <div class="col-md-6">
                        <p><small class="text-uppercase">Legal Name</small>: <span class="fw-bold">{{ session('carrier_selected.legal_name') }}</span></p>
                        <p><small class="text-uppercase">DBA Name</small>: <span class="fw-bold">{{ session('carrier_selected.dba_name') }}</span></p>
                        <p><small class="text-uppercase">Carrier Operation</small>: <span class="fw-bold">{{ session('carrier_selected.carrier_operation') }}</span></p>
                        <p><small class="text-uppercase">Street</small>: <span class="fw-bold">{{ session('carrier_selected.phy_street') }}</span></p>
                        <p><small class="text-uppercase">City</small>:  <span class="fw-bold"> {{ session('carrier_selected.phy_city') }}</span></p>
                        <p><small class="text-uppercase">Street</small>: <span class="fw-bold">{{ session('carrier_selected.phy_street') }}</span></p>
                        <p><small class="text-uppercase">Zip Code</small>: <span class="fw-bold">{{ session('carrier_selected.phy_zip') }}</span></p>
                        <p><small class="text-uppercase">Country</small>: <span class="fw-bold">{{ session('carrier_selected.phy_country') }}</span></p>
                    </div>

                    <div class="col-md-6">
                        <p><small class="text-uppercase">Telephone</small>: <span class="fw-bold">{{ session('carrier_selected.telephone') }}</span></p>
                        <p><small class="text-uppercase">Fax</small>: <span class="fw-bold">{{ session('carrier_selected.fax') }}</span></p>
                        <p><small class="text-uppercase">Email Address</small>: <span class="fw-bold">{{ session('carrier_selected.email_address') }}</span></p>
                        <p><small class="text-uppercase">MCS150 Date</small>: <span class="fw-bold">{{ session('carrier_selected.mcs150_date') }}</span></p>
                        <p><small class="text-uppercase">MCS150 Mileage</small>: <span class="fw-bold">{{ session('carrier_selected.mcs150_mileage') }}</span></p>
                        <p><small class="text-uppercase">MCS150 Mileage Year</small>: <span class="fw-bold">{{ session('carrier_selected.mcs150_mileage_year') }}</span></p>
                        <p><small class="text-uppercase">Add Date</small>: <span class="fw-bold">{{ session('carrier_selected.add_date') }}</span></p>
                        <p><small class="text-uppercase">Others</small>: <span class="fw-bold">{{ session('carrier_selected.op_other') }}</span></p>
                    </div>

                    <p class="text-center fw-bold my-4 bg-secondary text-white py-2">Request Information to Carrier Company</p>
                    <form method="POST" action="{{ route('manager.quote.confirm') }}" class="col-md-12 mt-3 text-center">
                        @csrf
                        <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">

                        <div class="row">
                            <p>
                                @if(!$carrier->email_address)
                                <small class="text-uppercase">Email</small>: <span class="fw-bold text-danger">* Email field is required for request.</span>
                                @endif
                            </p>
                            <div class="col-sm-4 text-end pt-2"><small class="text-uppercase">Receiptor Email Address</small>: </div>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" value="{{$carrier->email_address}}" @if($carrier->email_address) {{ 'readonly' }} @endif required>
                            </div>
                            <div class="col-12 text-end">
                                @if($errors->has('email'))
                                    <small class="text-danger">{{$errors->first('email')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('email')}}">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 text-end pt-2"><small class="text-uppercase">Suggested Cost ($)</small>: </div>
                            <div class="col-sm-8">
                                <input class="form-control" name="deliver_cost" value="{{old("deliver_cost")}}" required>
                            </div>
                            <div class="col-12 text-end">
                                @if($errors->has('deliver_cost'))
                                    <small class="text-danger">{{$errors->first('deliver_cost')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('deliver_cost')}}">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 pt-2 text-end">
                                <p><small class="text-uppercase">Comment to Carrier</small>:</p>
                            </div>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name="company_carrier_comment">{{old("company_carrier_comment")}}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3 mb-4">
                            <div class="col-sm-4 text-end pt-2"><small class="text-uppercase">Company Sign</small>: </div>
                            <div class="col-sm-8">
                                <input class="form-control" name="company_sign" value="{{old('company_sign')}}" required>
                            </div>
                            <div class="col-12 text-end">
                                @if($errors->has('company_sign'))
                                    <small class="text-danger">{{$errors->first('company_sign')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('company_sign')}}">
                                @endif
                            </div>
                        </div>

                        <a href="" class="btn btn-danger me-3 w-125p"><i class="fas fa-times"></i> Reset</a>
                        <button type="submit" class="btn btn-primary w-125p"><i class="fas fa-check-circle"></i> Send</button>
                    </form>
                    @else
                    <p class="m-0 text-center">There is no carrier information</p>
                    @endif
                </div>
                @endif


                {{--
                ******************* Status 4: Rejected ******************
                --}}
                @if ($quoteReq->status == 4)
                <h5 class="mt-5">Reject reason from Customer</h5>
                <div class="row d-flex flex-column p-3" style="background: #ffeaea">
                    <p class="ms-3 text-danger">{{$quoteApp->reject_reason}}</p>
                    <div class="text-end">
                        <p class="badge bg-danger mb-0">Rejected at: <span class="fw-bold">{{ $quoteReq->updated_at }}</span></p>
                    </div>
                </div>

                <h5 class="mt-5">New Quote Request</h5>
                <form method="POST" action="{{route('manager.quote.reapprove')}}" class="container-fluid bg-light py-4">
                    @csrf
                    <input type="hidden" name="quote_id" value="{{$quoteReq->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-6 text-end pt-2"><small>Delivery Cost</small><span class="text-danger">*</span> ($): </div>
                                <div class="col-sm-6">
                                    <input class="form-control" name="cost" value="{{old("cost")}}" required>
                                </div>
                                <div class="col-12 text-end">
                                    @if($errors->has('cost'))
                                        <small class="text-danger">{{$errors->first('cost')}}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('cost')}}">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 text-end pt-2"><small>Additional Fee</small> ($): </div>
                                <div class="col-sm-6">
                                    <input class="form-control" name="fee" value="{{old("fee")}}" required>
                                </div>
                                <div class="col-12 text-end">
                                    @if($errors->has('fee'))
                                        <small class="text-danger">{{$errors->first('fee')}}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('fee')}}">
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-6 text-end pt-2">Total Cost<span class="text-danger">*</span> ($): </div>
                                <div class="col-sm-6">
                                    <input class="form-control" name="total_cost" value="{{old("total_cost")}}" required>
                                </div>
                                <div class="col-12 text-end">
                                    @if($errors->has('total_cost'))
                                        <small class="text-danger">{{$errors->first('total_cost')}}</small>
                                        <input type="hidden" class="errorMsg" value="{{$errors->first('total_cost')}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><small>Comment:</small></p>
                            <textarea class="form-control" style="height: 122px" name="company_comment">{{ old("company_comment") }}</textarea>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Resend Quote</button>
                        </div>
                    </div>
                </form>
                @endif


                {{--
                ******************* Status 5: Carrier selected, Send quote to Carrier ******************
                --}}
                {{-- @if ($quoteReq->status == 5)
                <h5 class="mt-5">Carrier Selected</h5>
                <form action="{{route('manager.quote.submit')}}" method="POST" class="row bg-light py-4">
                    @csrf
                    <p class="text-secondary ps-5">(&#8251; To reset carrier, click <a href="{{ route('manager.quote.confirm.cancel', $quoteReq->id) }}">here</a>)</p>
                    <input type="hidden" name="quote_id" value="{{ $quoteReq->id }}">
                    <div class="col-md-5 ps-5">
                        <p><small class="text-uppercase">Carrier Name</small>: <span class="fw-bold">{{ $carrier->legal_name }}</span></p>
                        <p><small class="text-uppercase">US DOT Number</small>: <span class="fw-bold">{{ $carrier->dot_number }}</span></p>
                        <p><small class="text-uppercase">Telephone</small>: <span class="fw-bold">{{ $carrier->telephone }}</span></p>
                        <p><small class="text-uppercase">Fax</small>: <span class="fw-bold">{{ $carrier->fax }}</span></p>
                        <p><small class="text-uppercase">Email</small>:
                            @if($carrier->email_address)
                            <span class="fw-bold">{{ $carrier->email_address }}</span>
                            @else
                            <span class="fw-bold text-danger">* Email field is required for request.</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-sm-4 text-end pt-2"><small class="text-uppercase">Receiptor Email Address</small>: </div>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" value="{{$carrier->email_address}}" @if($carrier->email_address) {{ 'readonly' }} @endif required>
                            </div>
                            <div class="col-12 text-end">
                                @if($errors->has('email'))
                                    <small class="text-danger">{{$errors->first('email')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('email')}}">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 text-end pt-2"><small class="text-uppercase">Suggested Cost ($)</small>: </div>
                            <div class="col-sm-8">
                                <input class="form-control" name="deliver_cost" value="{{old("deliver_cost")}}" required>
                            </div>
                            <div class="col-12 text-end">
                                @if($errors->has('deliver_cost'))
                                    <small class="text-danger">{{$errors->first('deliver_cost')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('deliver_cost')}}">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 pt-2 text-end">
                                <p><small class="text-uppercase">Comment to Carrier</small>:</p>
                            </div>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name="company_carrier_comment">{{old("company_carrier_comment")}}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 text-end pt-2"><small class="text-uppercase">Company Sign</small>: </div>
                            <div class="col-sm-8">
                                <input class="form-control" name="company_sign" value="{{old('company_sign')}}" required>
                            </div>
                            <div class="col-12 text-end">
                                @if($errors->has('company_sign'))
                                    <small class="text-danger">{{$errors->first('company_sign')}}</small>
                                    <input type="hidden" class="errorMsg" value="{{$errors->first('company_sign')}}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 text-center">
                        <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Submit to Carrier</button>
                        <button class="btn btn-success w-200p" onclick="fn.createConf()"><i class="far fa-calendar-check"></i> Create Rate Conf</button>
                    </div>
                </form>
                @endif --}}


                {{--
                ******************* Status 5 ~ : Dedicated Carrier, Rate Conf sent to Carrier  ******************
                --}}
                @if ($quoteReq->status >= 5 && $quoteReq->status < 8)
                <h5 class="mt-5">Quote Information sent to Carrier</h5>
                <div class="row bg-light p-3">
                    <div class="col-md-6 ps-5">
                        <p class="mt-2"><small class="text-uppercase">Carrier Name</small>: <span class="fw-bold">{{ $carrier->legal_name }}</span></p>
                        <p class="mt-2"><small class="text-uppercase">US DOT Number</small>: <span class="fw-bold">{{ $carrier->dot_number }}</span></p>
                        <p class="mt-2"><small class="text-uppercase">Telephone</small>: <span class="fw-bold">{{ $carrier->telephone }}</span></p>
                        <p class="mt-2"><small class="text-uppercase">Fax</small>: <span class="fw-bold">{{ $carrier->fax }}</span></p>
                        <p class="mt-2"><small class="text-uppercase">Email</small>: <span class="fw-bold">{{ $carrier->email_address }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mt-3 ps-3"><small class="text-uppercase">Requested Cost</small>: <span class="fw-bold">${{$quoteComp->deliver_cost}}</span></p>
                        <p class="ps-3"><small class="text-uppercase">Company Comment</small>: <small class="fw-bold">{{$quoteComp->company_carrier_comment}}</small></p>
                        <p class="ps-3"><small class="text-uppercase">Company Signature</small>: <span class="fw-bold text-primary">{{$quoteComp->company_sign}}</span></p>
                        <p class="ps-3"><small class="text-uppercase">Carrier Signature</small>: <span class="fw-bold text-primary">{{$quoteComp->carrier_sign}}</span></p>
                    </div>

                    <div class="col-12 text-end">
                        <p class="badge bg-secondary mb-0">Suggested at: <span class="fw-bold">{{ $quoteComp->created_at }}</span></p>
                    </div>
                </div>
                @endif

                {{--
                ******************* Status 6 ~: Carrier Documents ******************
                --}}
                @if ($quoteReq->status >= 6)
                <h5 class="mt-5">Carrier Documents</h5>
                <div class="row bg-light p-3 mb-3">
                    <div class="col-xl-3 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Carrier Packet</small>:</p>
                        <a href="{{ url('storage'.$quoteComp->doc_carrier_packet) }}" target="_blank">Check here</a>
                        <iframe src="{{ url('storage'.$quoteComp->doc_carrier_packet) }}" style="width: 100%; height: 200px;overflow: hidden"></iframe>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Certificate of Insurance</small>:</p>
                        <a href="{{ url('storage'.$quoteComp->doc_cert_ins) }}" target="_blank">Check here</a>
                        <iframe src="{{ url('storage'.$quoteComp->doc_cert_ins) }}" style="width: 100%; height: 200px;overflow: hidden"></iframe>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Completed W9 Tax Form</small>:</p>
                        <a href="{{ url('storage'.$quoteComp->doc_w9_form) }}" target="_blank">Check here</a>
                        <iframe src="{{ url('storage'.$quoteComp->doc_w9_form) }}" style="width: 100%; height: 200px;overflow: hidden"></iframe>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Operating Authority</small>:</p>
                        <a href="{{ url('storage'.$quoteComp->doc_operating_auth) }}" target="_blank">Check here</a>
                        <iframe src="{{ url('storage'.$quoteComp->doc_operating_auth) }}" style="width: 100%; height: 200px;overflow: hidden"></iframe>
                    </div>

                    <div class="col-12 mt-3">
                        @if ($quoteReq->status == 6)
                            <p class="text-danger">Carrier sent confirmation documents. Please check and confirm them.</p>
                        @else
                            <p class="text-success">Document Confirmed.</p>
                        @endif
                    </div>

                    <div class="col-xl-12 mb-3 text-center">
                        <a href="javascript:void(0);" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#rateConfModal">Check Rate Conf</a>
                        @if ($quoteReq->status == 6)
                        <a href="{{ route('manager.carrier.confirm', $quoteReq->id) }}" class="ms-4 btn btn-info w-150p">Confirm</a>
                        @endif
                    </div>
                </div>
                @endif

                {{--
                ******************* Status 8 ~: Carrier approved Rate Conf ******************
                --}}
                @if ($quoteReq->status == 8)
                <h5 class="mt-5">Arranged Driver</h5>
                <div class="row bg-light p-3 ps-5 mb-5">
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Driver Name</small>: <span class="fw-bold">{{$driver->name}}</span></p>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Driver Email</small>: <span class="fw-bold">{{$driver->email}}</span></p>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Driver Phone</small>: <span class="fw-bold">{{$driver->phone}}</span></p>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Truck Number</small>: <span class="fw-bold">{{$driver->truck_num}}</span></p>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Truck Type</small>: <span class="fw-bold">{{$driver->truck_type}}</span></p>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Truck Capacity</small>: <span class="fw-bold">{{$driver->truck_capacity}}</span></p>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <p class="my-1"><small class="text-uppercase">Miles</small>: <span class="fw-bold">{{$driver->miles}}</span></p>
                    </div>
                    <div class="col-12">
                        <p class="my-1"><small class="text-uppercase">Carrier Commment</small>: <span class="fw-bold">{{$quoteComp->carrier_comment}}</span></p>
                    </div>
                    <div class="col-12 text-end">
                        <p class="badge bg-secondary mb-0">Assigned at: <span class="fw-bold">{{ $driver->updated_at }}</span></p>
                    </div>
                </div>
                @endif


                {{--
                ******************* Status 7 ~: Check Rate Conf ******************
                --}}
                {{-- @if ($quoteReq->status >= 7 && $quoteReq->status < 8)
                <div class="col-12 text-center">
                    <a href="javascript:void(0);" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#rateConfModal">Check Rate Conf</a>
                </div>
                @endif --}}


                {{--
                ******************* Status 8 ~: Start Track ******************
                --}}
                @if ($quoteReq->status > 8)
                <h5 class="mt-5">Load Status</h5>
                <div class="row bg-light p-3 py-4 mb-5">
                    @php
                        $now = new DateTime();
                        $pastTime = new DateTime($driver->updated_at); // replace with your past time

                        $interval = $now->diff($pastTime);
                        $timeDiff = $interval->format('%d days %h hours %i minutes');
                    @endphp
                    <div class="col-md-6">
                        <div class="h-100 bg-white p-3 d-flex align-items-center">
                            <div class="row">
                                @if($quoteReq->status < 12)
                                <p class="ms-2 mt-4"><small class="text-uppercase">Current Location</small>: <span class="fw-bold">{{ $location->location }}</span></p>
                                <p class="ms-2 mt-4"><small class="text-uppercase">Latitude</small>: <span class="fw-bold">{{ $location->latitude }}</span></p>
                                <p class="ms-2 mt-4"><small class="text-uppercase">Longitude</small>: <span class="fw-bold">{{ $location->longitude }}</span></p>
                                <p class="ms-2 mt-4"><small class="text-uppercase">Transport Time</small>: <span class="fw-bold">{{ $timeDiff }}</span></p>
                                @elseif($quoteReq->status >= 12)
                                <p class="ms-2"><small class="text-uppercase">Customer Name</small>: <span class="fw-bold">{{ $user->first_name.' '.$user->last_name }}</span></p>
                                <p class="ms-2"><small class="text-uppercase">Commodity</small>: <span class="fw-bold">{{ $quoteReq->commodity }}</span></p>
                                <p class="ms-2"><small class="text-uppercase">Delivery Date</small>: <span class="fw-bold">{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}</span></p>
                                <p class="ms-2"><small class="text-uppercase">Carrier</small>: <span class="fw-bold">{{ $carrier->legal_name }}</span></p>
                                <p class="ms-2"><small class="text-uppercase">Customer Request Cost</small>: <span class="fw-bold">{{ $quoteApp->total_cost }}</span></p>
                                <p class="ms-2"><small class="text-uppercase">Carrier Request Cost</small>: <span class="fw-bold">{{ $quoteComp->deliver_cost }}</span></p>
                                @endif
                                <div class="col-12 text-center mt-5">
                                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateConfModal">Check Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="h-100 bg-white p-3 text-center">
                            @if ($quoteReq->status >= 12)
                                <p><span class="fw-bold">BOL Picture:</span> <a href="{{ url('storage'.$quoteComp->bol_path) }}" target="_blank">Check Here</a></p>
                                <img src="{{ url('storage'.$quoteComp->bol_path) }}" class="img-thumbnail" style="max-height: 400px" alt="...">
                            @else
                            {{-- <iframe class="position-relative rounded w-100"
                                src="https://maps.google.com/maps?q={{$quoteComp->lat}},{{$quoteComp->long}}&t=&z=10&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" allowfullscreen="false" aria-hidden="false" tabindex="0" style="min-height: 400px"
                            ></iframe> --}}
                            <div id="map" class="position-relative rounded w-100" style="min-height: 400px; height: 100%;"></div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif


                {{--
                ******************* Status 12 ~ : Payment Status ******************
                --}}
                @if($quoteReq->status >= 12)
                <div class="row">
                    <div class="col-md-6">
                        <div class="row bg-light p-3 py-4 mb-5 h-100">
                            <h5>Customer Payment Status</h5>
                            <div class="bg-white d-flex flex-column justify-content-center align-items-center">
                                @if($quoteReq->status == 12)
                                <p class="m-2 text-danger text-center">Not paid yet.</p>
                                @elseif($quoteReq->status == 13)
                                <p class="text-success text-center m-2"><i class="far fa-check-circle"></i> Payment is
                                    progressed with reference code {{ $quoteReq->transaction_id }}</p>
                                <p class="text-center">
                                    @if ($quoteReq->payment_status == 1)
                                        (Via Paypal)
                                    @elseif ($quoteReq->payment_status == 2)
                                        (Via ACH Stripe)
                                    @endif
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row bg-light p-3 py-4 mb-5 h-100">
                            <h5>Customer Review</h5>
                            <div>
                                @if($quoteComp->customer_review)
                                <p class="m-2">{{ $quoteComp->customer_review }}</p>
                                @else
                                <p class="m-2 text-muted text-center">No exist review</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                {{--
                ******************* Status 1 ~ 12: Status display ******************
                --}}
                <h5 class="mt-5">Current Status</h5>

                <div class="row mt-2">
                    @if ($quoteReq->status == 1)
                    <div class="col-md-11 offset-md-1 text-danger">
                        <p class="mt-3"><i class="fas fa-marker"></i> Customer requested the transport order. ({{$quoteReq->created_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:20%">Requested</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 2)
                    <div class="col-md-11 offset-md-1 text-info">
                        <p class="mt-3"><i class="fas fa-clipboard-check"></i> Company checked the request and sent quote to customer. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width:30%">Checked</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 3)
                    <div class="col-md-11 offset-md-1 text-primary">
                        <p class="mt-3"><i class="fas fa-user-check"></i> Customer approved the quote from company. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width:40%">Checked</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 4)
                    <div class="col-md-11 offset-md-1 text-danger">
                        <p class="mt-3"><i class="fas fa-remove-format"></i> Customer rejected the quote from our company. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:20%">Rejected</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 5)
                    <div class="col-md-11 offset-md-1 text-info">
                        <p class="mt-3"><i class="fas fa-user-check"></i> Carrier selected. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width:50%">Carrier Selected</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 6)
                    <div class="col-md-11 offset-md-1 text-info">
                        <p class="mt-3"><i class="fas fa-paper-plane"></i> Company submitted the rate conf to Carrier. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width:60%">Quote sent to Carrier</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 7)
                    <div class="col-md-11 offset-md-1 text-success">
                        <p class="mt-3"><i class="fas fa-calendar-check"></i> Carrier approved the rate conf. Request sent to Driver. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:70%">Quote Published with Carrier</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 8)
                    <div class="col-md-11 offset-md-1 text-primary">
                        <p class="mt-3"><i class="fas fa-truck"></i> Driver going to pickup. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width:80%">Driver going to pick up.</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 9)
                    <div class="col-md-11 offset-md-1 text-primary">
                        <p class="mt-3"><i class="fas fa-truck"></i> Loading Staff. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width:80%">Driver Loading...</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 10)
                    <div class="col-md-11 offset-md-1 text-primary">
                        <p class="mt-3"><i class="fas fa-truck"></i> Carrying the load. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width:90%">Carrying Load...</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 11)
                    <div class="col-md-11 offset-md-1 text-success">
                        <p class="mt-3"><i class="fas fa-truck"></i> Load arrived to delivery position. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:97%">Arrived</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 12)
                    <div class="col-md-11 offset-md-1 text-success">
                        <p class="mt-3"><i class="fas fa-truck"></i> Delivery completed. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:100%">Completed</div>
                        </div>
                    </div>
                    @elseif ($quoteReq->status == 13)
                    <div class="col-md-11 offset-md-1 text-success">
                        <p class="mt-3"><i class="fas fa-check-circle"></i> Transport request completed. ({{$quoteReq->updated_at}})</p>
                        <div class="progress">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width:100%">Completed</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('modals')
<!-- Rate Conf Modal -->
@if($quoteReq->status > 5)
<div class="modal fade" id="rateConfModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog  modal-xl modal-dialog-scrollable text-dark">
        <form action="{{route('manager.quote.submit')}}" method="GET" class="modal-content doc-modal container">
            <div class="modal-header row">
                <div class="col-md-2">
                    <p class="mb-5">Quick Fright INC</p>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="modal-title text-success mx-auto">Rate Confirmation</h4>
                </div>
                <div class="col-md-2 text-info">
                    <p>{{$quoteReq->id_alias}}</p>
                    <p><span id="createdDate"></span></p>
                    <p><span id="createdTime"></span></p>
                </div>
            </div>
            <div class="modal-body">
                <div class="rate-header row border-bottom text-uppercase">
                    <div class="col-lg-9 col-sm-8 d-flex">
                        <img class="doc-logo" src="{{asset('assets/common/img/logo/loder.png')}}" alt="">
                        <h2 class="d-inline-block">QUICK FRIGHT NIC</h2>
                    </div>
                    <div class="col-lg-3 col-sm-4">
                        <p>From: QUICK FRIGHT ENTERPRISE INC</p>
                        <p>(912) 233-2935</p>
                        <p>(912) 233-9925 Fax</p>
                    </div>
                </div>
                <div class="row text-uppercase border-bottom">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-2">To</div>
                            <div class="col-10">: {{ $carrier->legal_name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-2">Att</div>
                            <div class="col-10">: Fernando</div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-4">Pickup</div>
                            <div class="col-8">: {{$quoteReq->pickup}}</div>
                        </div>

                        <div class="row border-bottom">
                            <div class="col-4">Pickup Date/Time</div>
                            <div class="col-8">: {{$quoteReq->pickupDate}}@</div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-4">Final Destination</div>
                            <div class="col-8">: {{$quoteReq->delivery}}</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Del Appt Date/Time</div>
                            <div class="col-8">: {{$quoteReq->deliveryDate}}@</div>
                        </div>
                    </div>
                    <div class="col-lg-5 bg-light text-secondary">
                        <div class="row">
                            <div class="col-4">Truck #</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$driver->truck_num}}@endif</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Driver</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$driver->name}}@endif</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Driver Cell</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$driver->phone}}@endif</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Truck Type</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$driver->truck_type}}@endif</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Truck Size</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$driver->truck_capacity}}@endif</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Miles</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$driver->miles}}@endif</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Description</div>
                            <div class="col-8">: @if($quoteReq->status >= 8){{$quoteComp->carrier_comment}}@endif</div>
                        </div>
                    </div>
                </div>

                <div class="row border-bottom">
                    <div class="col-sm-4 offset-sm-8">[Dispach Notes]</div>
                </div>
                <div class="row text-uppercase border-bottom">
                    <div class="col-md-4 border-end">
                        <div class="row mt-3">
                            <div class="col-6">Total Rate</div>
                            <div class="col-6">$ {{ $quoteComp->deliver_cost }}</div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <p>Company: {{$quoteApp->company_name}}, {{$quoteApp->company_address}}</p>
                        <p>Commodity: {{$quoteReq->commodity}}, {{$quoteReq->dimension}}, {{$quoteReq->weight}}</p>
                        <p>Temperature: {{$quoteReq->temperature}}</p>
                        <p>Recommended Truck: {{$quoteReq->equipment_name}}</p>
                        <p>Comment: {{ $quoteComp->company_carrier_comment }}</p>
                    </div>
                </div>

                <div class="doc-terms mt-3 bg-light text-secondary">
                    <p>* Terms are Net 30 from postmark or date emailed to billing@tototaltransport.us</p>
                </div>

                <div class="text-uppercase bg-light text-secondary">
                    <ul>
                        <li>Driver Name <span class="fw-bold text-dark border-bottom border-danger">@if($quoteReq->status >= 8) {{$driver->name}} @else ? @endif</span> <span class="text-danger">*</span>required</li>
                        <li>Driver Phone Number <span class="fw-bold text-dark border-bottom border-danger">@if($quoteReq->status >= 8) {{$driver->phone}} @else ? @endif</span> <span class="text-danger">*</span>required</li>
                        <li><span class="fw-bold text-dark border-bottom border-danger">@if($quoteReq->status >= 8) {{$carrier->legal_name}} @else ? @endif</span> Initial Driver is familiar with construction
                            equipment and may be required to load and unload themselves.</li>
                        <li><span class="fw-bold text-dark border-bottom border-danger">@if($quoteReq->status >= 8) {{$carrier->legal_name}} @else ? @endif</span> Initial Driver must measure and safely secure load to
                            ensure legal dimensions before leaving pickup location.</li>
                        <li><span class="fw-bold text-dark border-bottom border-danger">@if($quoteReq->status >= 8) {{$carrier->legal_name}} @else ? @endif</span> Initial our load will be driven onto and off of the trailer.</li>
                    </ul>
                    <p> So, nothing can be blocking our load at pickup or delivery. if driver arrives at pickup
                        or delivery with something blocking our load, the driver will be 100% responsible
                        for arrangement and cost to move that item</p>
                </div>

                @if ($quoteReq->status == 5)
                <div class="row mt-4">
                    <div class="col-7">
                        <h3 class="text-end"><label for="signature" class="col-form-label">Signature</label></h3>
                    </div>
                    <div class="col-5 pt-2">
                        <input style="font-size: 20px" id="signature" name="sign" class="form-control border-danger">
                    </div>
                </div>
                @endif

                @if ($quoteReq->status >= 6)
                <div class="row mt-4">
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <h4>Company Sign: <span class="text-primary">{{$quoteComp->company_sign}}<span></h4>
                    </div>
                    <div class="col-4">
                        <h4>Carrier Sign: <span class="text-primary">{{$quoteComp->carrier_sign}}<span></h4>
                    </div>
                </div>
                @endif

                <input type="hidden" name="id" value="{{$quoteReq->id}}">
            </div>

            <div class="modal-footer">
                @if ($quoteReq->status == 5)
                    <button type="button" class="btn btn-danger w-150p me-3" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Cancel</button>
                    <button type="submit" id="submitBtn" class="btn btn-info"><i class="fas fa-share-square"></i> Submit to Carrier</button>
                @else
                    <button type="button" class="btn btn-secondary w-175p me-3" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    @if ($quoteReq->status > 6)
                    <a target="_blank" href="{{route('carrier.rateconf.publish', $quoteReq->id)}}" type="button" class="btn btn-primary w-175p me-3"><i class="fas fa-file-pdf"></i> Export to PDF</a>
                    {{-- <a target="_blank" href="{{route('carrier.rateconf.view', $quoteReq->id)}}" type="button" class="btn btn-warning w-175p me-3"><i class="fas fa-file-pdf"></i> View PDF</a> --}}
                    @endif
                @endif
            </div>
        </form>
    </div>
</div>
@endif
@endpush

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiZWS8nBscbzohPYAuyaPQx-ADDgt9ujI"></script>
    <script>
        function validate_sign (sign) {
            return sign.match(
                /^[a-zA-Z]*\.?[a-zA-Z]*$/
            );
        }

        function signValidate () {
            if ($('#signature').val() == '') {
                $('#signature').focus();
                App.setToasterError("Signature field is required.");
                return false;
            } else if (!this.validate_sign($('#signature').val().replace(/ /g,''))) {
                $('#signature').focus();
                App.setToasterError("Sign field should be contained only string and dot.");
                return false;
            };

            return true;
        }

        function createConf () {
            if ($('#suggestedCost').val()) {
                let data = {
                    quote_id: $('#quoteID').val(),
                    carrier_id: $('#carrier').val(),
                    deliver_cost: $('#suggestedCost').val(),
                    company_carrier_comment: $('#comment').val()
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/quote/comp/create',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        $('#rateConfModal').modal('show');
                        $('#createdDate').text(data.updated_at.split(' ')[0]);
                        $('#createdTime').text(data.updated_at.split(' ')[1]);
                        $('#deliverCost').text(data.deliver_cost);
                        $('#companyCarrierComment').text(data.company_carrier_comment);
                        $('#carrierName').text(data.carrier_name);
                    }
                });
            } else {
                App.setToasterError("Please enter cost value.");
                $('#suggestedCost').focus();
            }
        }

        function checkConf () {
            $('#rateConfModal').modal('show');
        }

        $('#submitBtn').click(function(e) {
            e.preventDefault();
            if (fn.signValidate()) {
                $('#submitBtn').parents('form:first').submit();
            };
        })


        function initMap() {
            console.log("init map");
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 0, lng: -180}
            });

            // Get the polyline data from the server
            fetch("{{ route('api.getpoints', $quoteReq->id) }}")
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

        @if ($quoteReq->status >= 8 && $quoteReq->status <= 11)
        $(window).on('load',function(){
            initMap();
        });

        // setInterval(initMap, 5000);
        @endif

    </script>
@endpush
