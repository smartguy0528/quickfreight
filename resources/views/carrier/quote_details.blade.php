@extends('backendlayouts.app')

@section('content')
<main>
    <div class="d-none" id="alert">
        @if (Session::has('success'))
        {{Session('success')}}
        @endif
    </div>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Quote Details</h1>
        <ol class="breadcrumb mb-4">
            @if($quoteReq->status == 6)
            <li class="breadcrumb-item"><a href="{{route('carrier.quotes')}}">Requested Quotes</a></li>
            @elseif($quoteReq->status >= 7 && $quoteReq->status < 12)
            <li class="breadcrumb-item"><a href="{{route('carrier.quotes.published')}}">Published Quotes</a></li>
            @endif
            <li class="breadcrumb-item active">Quote Details</li>
        </ol>
        <div class="card mb-4">
            {{--***********************        Common Content     ****************************--}}
            <div class="card-body table-responsive p-5">
                <h5>Customer Quote Information</h5>
                <table class="table mb-0">
                    <tr>
                        <td>Quote ID: {{$quoteReq->id_alias}}</td>
                        <td>Customer Name: {{$quoteReq->customer_name}}</td>
                        <td>Deliver Cost: ${{$quoteComp->deliver_cost}}</td>
                    </tr>
                    <tr>
                        <td>Pickup City / State: {{$quoteReq->pickup}}</td>
                        <td>Delivery City / State: {{$quoteReq->delivery}}</td>
                        <td>Commodity: {{$quoteReq->commodity}}</td>
                    </tr>
                    <tr>
                        <td>Pickup Date: {{$quoteReq->pickupDate}}</td>
                        <td>Delivery Date: {{$quoteReq->deliveryDate}}</td>
                        <td>Demension: {{$quoteReq->dimension}}</td>
                    </tr>
                    <tr>
                        <td>Weight: {{$quoteReq->weight}}</td>
                        <td>Temperature Condition: {{$quoteReq->temperature}}</td>
                        <td>Equipment: {{$quoteReq->equipment_name}}</td>
                    </tr>
                </table>
                <table class="table mb-5">
                    <tr>
                        <td style="vertical-align: top; width: 100px">Comment:</td>
                        <td id="cComment">
                            {{$quoteComp->company_carrier_comment}}
                        </td>
                    </tr>
                </table>

                {{--**********************     Status: Requested (status-6)   ***************************--}}
                @if ($quoteReq->status == 6)
                <form id="quoteForm" method="POST" action="{{route('carrier.quote.publish')}}">
                    @csrf
                    <input type="hidden" name="quoteID" id="quoteID" value="{{$quoteApp->quote_id}}">
                    <input type="hidden" name="carrierSign" id="carrierSign">
                    <h5 class="mt-5">Arranged Driver</h5>
                    <div class="row">
                        <div class="col-xl-2 col-md-3 text-end pt-2">Driver Name:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="driverName" id="driverName">
                        </div>
                        <div class="col-xl-2 col-md-3 text-end pt-2">Truck Type:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="truckType" id="truckType">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-3 text-end pt-2">Truck Capacity:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="truckCapacity" id="truckCapacity">
                        </div>
                        <div class="col-xl-2 col-md-3 text-end pt-2">Truck Number:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="truckNumber" id="truckNumber">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-3 text-end pt-2">Driver Email:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="driverEmail" id="driverEmail">
                        </div>
                        <div class="col-xl-2 col-md-3 text-end pt-2">Driver Phone:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="driverPhone" id="driverPhone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-3 text-end pt-2">Distace (Miles):</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <input class="form-control" name="miles" id="miles">
                        </div>
                        <div class="col-xl-2 col-md-3 text-end pt-2">Comment:</div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                </form>
                <div class="row text-end mt-5">
                    <div class="col-xl-10">
                        <button onclick="fn.createConf()" class="btn btn-info"><i class="far fa-calendar-check"></i> Create Rate Conf</button>
                    </div>
                </div>
                @endif

                {{--**********************     Status: Published (status-7 ~ 11)   ***************************--}}
                @if ($quoteReq->status >= 7 && $quoteReq->status <= 12)
                <h5>Assigned Driver</h5>
                <div class="row">
                    <div class="col-md-4 col-sm-6 pt-2 pb-2 border-bottom">Driver Name: {{$driver->name}}</div>
                    <div class="col-md-4 col-sm-6 pt-2 pb-2 border-bottom">Driver Phone: {{$driver->phone}}</div>
                    <div class="col-md-4 col-sm-6 pt-2 pb-2 border-bottom">Driver Email: {{$driver->email}}</div>
                    <div class="col-md-4 col-sm-6 pt-2 pb-2 border-bottom">Truck Type: {{$quoteComp->truck_type}}</div>
                    <div class="col-md-4 col-sm-6 pt-2 pb-2 border-bottom">Truck Number: {{$quoteComp->truck_num}}</div>
                    <div class="col-md-4 col-sm-6 pt-2 pb-2 border-bottom">Truck Capacity: {{$quoteComp->truck_capacity}}</div>
                </div>
                <div class="row">
                    <div class="col-12 pt-3 text-end">
                        <button onclick="fn.checkConf()" class="btn btn-success"><i class="far fa-calendar-check"></i> Check Rate Conf</button>
                    </div>
                </div>
                @endif

                {{--**********************     Status: Published (status-7 ~ 11)   ***************************--}}
                @if($quoteReq->status >= 7 && $quoteReq->status < 12)
                <h5 class="mt-5">Status</h5>
                @endif
                <div class="row">
                @if ($quoteReq->status == 7)
                <p class="col-sm-2 col-xl-1"></p>
                <p class="col-sm-10 col-xl-11 text-success"><i class="fas fa-calendar-check"></i> Approved the rate conf. Request sent to Driver. ({{$quoteReq->updated_at}})</p>
                @elseif ($quoteReq->status == 8)
                <p class="col-sm-2 col-xl-1"></p>
                <p class="col-sm-10 col-xl-11 text-success"><i class="fas fa-truck"></i> Driver going to pickup. ({{$quoteReq->updated_at}})</p>
                @elseif ($quoteReq->status == 9)
                <p class="col-sm-2 col-xl-1"></p>
                <p class="col-sm-10 col-xl-11 text-success"><i class="fas fa-truck"></i> Loading Staff. ({{$quoteReq->updated_at}})</p>
                @elseif ($quoteReq->status == 10)
                <p class="col-sm-2 col-xl-1"></p>
                <p class="col-sm-10 col-xl-11 text-success"><i class="fas fa-truck"></i> Carrying the load. ({{$quoteReq->updated_at}})</p>
                @elseif ($quoteReq->status == 11)
                <p class="col-sm-2 col-xl-1"></p>
                <p class="col-sm-10 col-xl-11 text-success"><i class="fas fa-truck"></i> Load arrived to delivery position. ({{$quoteReq->updated_at}})</p>

                {{--**********************     Status: Completed (status-12)   ***************************--}}
                @elseif ($quoteReq->status == 12)
                <p class="col-sm-2 col-xl-1"></p>
                <p class="col-sm-10 col-xl-11 text-success"><i class="fas fa-truck"></i> Delivery completed. ({{$quoteReq->updated_at}})</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('modals')
<!-- Modal -->
<div class="modal fade" id="rateConfModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog  modal-xl modal-dialog-scrollable">
        <div class="modal-content doc-modal container">
            <div class="modal-header row">
                <div class="col-md-2">
                    <p class="mb-5">Quick Fright INC</p>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="modal-title text-success mx-auto">Rate Confirmation</h4>
                </div>
                <div class="col-md-2 text-info">
                    <p>{{$quoteReq->id_alias}}</p>
                    <p><span id="createdDate">{{explode(' ', $quoteComp->created_at)[0]}}</span></p>
                    <p><span id="createdTime">{{explode(' ', $quoteComp->created_at)[1]}}</span></p>
                </div>
            </div>
            <div class="modal-body">
                <div class="rate-header row border-bottom text-uppercase bg-light text-secondary">
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
                    <div class="col-lg-7 bg-light text-secondary">
                        <div class="row">
                            <div class="col-2">To</div>
                            <div class="col-10">: {{Auth::guard('carrierguard')->user()->name}}</div>
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
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-4">Truck #</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mTruckNum"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$quoteComp->truck_num}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">Driver</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mDriverName"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$driver->name}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">Driver Cell</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mDriverPhone"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$driver->phone}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">Type</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mTruckType"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$quoteComp->truck_type}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">Weight</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mTruckCapacity"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$quoteComp->truck_capacity}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">Miles</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mMiles"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$quoteComp->miles}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">Description</div>
                            <div class="col-8">:
                                @if($quoteReq->status == 6)
                                    <span id="mDescription"></span>
                                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                                    {{$quoteComp->carrier_comment}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border-bottom bg-light text-secondary">
                    <div class="col-sm-4 offset-sm-8">[Dispach Notes]</div>
                </div>
                <div class="row text-uppercase border-bottom bg-light text-secondary">
                    <div class="col-md-4 border-end">
                        <div class="row mt-3">
                            <div class="col-6">Total Rate</div>
                            <div class="col-6">${{$quoteComp->deliver_cost}}</div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <p>Company: {{$quoteApp->company_name}}, {{$quoteReq->company_address}}</p>
                        <p>Commodity: {{$quoteReq->commodity}}, {{$quoteReq->dimension}}, {{$quoteReq->weight}}</p>
                        <p>Temperature: {{$quoteReq->temperature}}</p>
                        <p>Comment: {{$quoteComp->company_carrier_comment}}</p>
                    </div>
                </div>

                <div class="doc-terms mt-3">
                    <p>* Terms are Net 30 from postmark or date emailed to billing@tototaltransport.us</p>
                </div>

                <div class="text-uppercase border-bottom">
                    <ul>
                        <li>Driver Name <input class="doc-input" id="iDriverName" type="text" value="@if($quoteReq->status >= 7 && $quoteReq->status <= 12) {{$driver->name}} @endif" disabled> <span class="text-danger">*</span>required</li>
                        <li>Driver Phone Number <input class="doc-input" id="iDriverPhone" type="text" value="@if($quoteReq->status >= 7 && $quoteReq->status <= 12) {{$driver->phone}} @endif" disabled> <span class="text-danger">*</span>required</li>
                        <li><input class="doc-input iCarrierName" type="text" value="{{Auth::guard('carrierguard')->user()->name}}" disabled> Initial Driver is familiar with construction
                            equipment and may be required to load and unload themselves.</li>
                        <li><input class="doc-input iCarrierName" type="text" value="{{Auth::guard('carrierguard')->user()->name}}" disabled> Initial Driver must measure and safely secure load to
                            ensure legal dimensions before leaving pickup location.</li>
                        <li><input class="doc-input iCarrierName" type="text" value="{{Auth::guard('carrierguard')->user()->name}}" disabled> Initial our load will be driven onto and off of the trailer.</li>
                    </ul>
                    <p> So, nothing can be blocking our load at pickup or delivery. if driver arrives at pickup
                        or delivery with something blocking our load, the driver will be 100% responsible
                        for arrangement and cost to move that item</p>
                </div>

                <div class="row mt-4">
                    <div class="col-4">
                        <h4 class="text-end">Company Sign: <span class="text-primary">{{$quoteComp->company_sign}}</span></h4>
                    </div>
                    @if($quoteReq->status == 6)
                        <div class="col-3">
                            <h3 class="text-end"><label for="signature" class="col-form-label">Carrier Sign:</label></h3>
                        </div>
                        <div class="col-5 pt-2">
                            <input style="font-size: 20px" id="signature" class="form-control border-danger">
                        </div>
                    @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                        <div class="col-4">
                            <h4 class="text-end">Carrier Sign: <span class="text-primary">{{$quoteComp->carrier_sign}}</span></h4>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-175p btn-base me-3" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                @if($quoteReq->status == 6)
                <button id="submitBtn" onclick="fn.submitForm()" class="btn btn-success w-175p"><i class="fas fa-paper-plane"></i> Submit to Carrier</button>
                @elseif($quoteReq->status >= 7 && $quoteReq->status <= 12)
                <a target="_blank" href="{{route('carrier.rateconf.publish', $quoteReq->id)}}" type="button" class="btn btn-primary w-175p me-3"><i class="fas fa-file-pdf"></i> Export to PDF</a>
                {{-- <a target="_blank" href="{{route('carrier.rateconf.view', $quoteReq->id)}}" type="button" class="btn btn-warning w-175p me-3"><i class="fas fa-file-pdf"></i> View PDF</a> --}}
                @endif
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script src="{{asset('assets/backend/js/carrier/quote_details.js')}}"></script>
@endpush
