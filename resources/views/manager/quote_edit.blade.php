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
            <li class="breadcrumb-item"><a href="{{route('manager.quote.details', $quoteReq->id)}}">Quote Details</a></li>
            <li class="breadcrumb-item active">Quote Details Edit</li>
        </ol>


        <div class="card mb-4">
            <div class="card-body table-responsive p-5 pt-3">
                {{--
                ******************* Common Info ******************
                --}}
                <div class="text-end">
                    <a href="{{ route('manager.quote.details', $quoteReq->id) }}" class="btn btn-danger" title="Close"><i class="fas fa-times"></i></a>
                </div>
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
                @if ($quoteReq->status < 8)
                <div class="row mb-5">
                    <div class="col-lg-6">
                        <div class="bg-light p-3 m-3 d-flex flex-column justify-content-between">
                            <h5>Customer Information</h5>
                            <div class="row ps-3 mt-3">
                                <div class="col-lg-4">
                                    <p><small class="text-default text-uppercase">Customer Name</small>: <span class="fw-bold">{{ $user->first_name.' '.$user->last_name }}</span></p>
                                </div>
                                <div class="col-lg-4">
                                    <p><small class="text-default text-uppercase">Customer Email</small>: <span class="fw-bold">{{ $user->email }}</span></p>
                                </div>
                                <div class="col-lg-4">
                                    <p><small class="text-default text-uppercase">Customer Phone</small>: <span class="fw-bold">{{ $user->phone }}</span></p>
                                </div>
                                <div class="col-lg-12">
                                    <p><small class="text-default text-uppercase">Customer Comment</small>: <span class="fw-bold">{{ $quoteReq->comment }}</span></p>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="badge bg-secondary mb-0">Requested at: <span class="fw-bold">{{ $quoteReq->created_at }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form method="POST" action="{{ route('manager.quote.update') }}" class="bg-light p-3 m-3">
                            @csrf
                            <input type="hidden" name="quoteId" value="{{ $quoteReq->id }}">
                            <h5>Request Information</h5>
                            <div class="row px-3 mb-3">
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="pickupCity">Pickup City / State <span class="text-danger">*</span> :</label></small>
                                    <input type="text" id="pickupCity" name="pickupCity" class="form-control" value="{{ $quoteReq->pickup }}" required>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="deliveryCity">Delivery City / State <span class="text-danger">*</span> :</label></small>
                                    <input type="text" id="deliveryCity" name="deliveryCity" class="form-control" value="{{ $quoteReq->delivery }}" required>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="pickupDate">Pickup Date <span class="text-danger">*</span> :</label></small>
                                    <input type="date" id="pickupDate" name="pickupDate" class="form-control" value="{{ date('Y-m-d', strtotime($quoteReq->pickupDate)) }}" required>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="deliveryDate">Delivery Date <span class="text-danger">*</span> :</label></small>
                                    <input type="date" id="deliveryDate" name="deliveryDate" class="form-control" value="{{ date('Y-m-d', strtotime($quoteReq->deliveryDate)) }}" required>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="commodity">Commodity <span class="text-danger">*</span> :</label></small>
                                    <input type="text" id="commodity" name="commodity" class="form-control" value="{{ $quoteReq->commodity }}" required>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="dimension">Dimension :</label></small>
                                    <input type="text" id="dimension" name="dimension" class="form-control" value="{{ $quoteReq->dimension }}">
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="weight">Weight :</label></small>
                                    <input type="text" id="weight" name="weight" class="form-control" value="{{ $quoteReq->weight }}">
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="temperature">Temperature Condition :</label></small>
                                    <input type="text" id="temperature" name="temperature" class="form-control" value="{{ $quoteReq->temperature }}">
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="equipment">Equipment :</label></small>
                                    <select id="equipment" name="equipment" class="form-control">
                                        @foreach ($equipments as $equipment)
                                            <option value="{{ $equipment->equipmentId }}" @if($equipment->equipmentId == $quoteReq->equipment) {{ 'selected' }} @endif>{{ $equipment->equipmentName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <small><label class="text-default text-uppercase" for="trailerSize">TrailerSize :</label></small>
                                    <select id="trailerSize" name="trailerSize" class="form-control">
                                        @foreach ($trailerSizes as $trailerSize)
                                            <option value="{{ $trailerSize->trailerSizeId }}" @if($trailerSize->trailerSizeId == $quoteReq->trailerSize) {{ 'selected' }} @endif>{{ $trailerSize->trailerSizeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="text-center my-4">
                                <button class="btn btn-success w-100p">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
