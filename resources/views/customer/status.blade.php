@extends('backendlayouts.app')

@section('content')
<main>
    <div class="d-none" id="alert">
        @if (Session::has('success'))
        {{Session('success')}}
        @endif
    </div>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Load Status</h1>
        <div class="card col-lg-12 mb-4">
            <div class="card-body container table-responsive p-5">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Request Information</h5>
                        <table class="table mb-4">
                            <tr>
                                <td>Quote ID: {{$quoteReq->id_alias}}</td>
                                <td><a href="{{route('customer.quotecheck', $quoteReq->id)}}">Details</a></td>
                            </tr>
                        </table>

                        <h5 class="mt-5">Current Status</h5>
                        <table class="table mb-4">
                            <tr>
                                @if ($quoteReq->status == 6)
                                <td class="bg-success text-white" style="width: 10%"><small>On Checking</small></td>
                                <td class="bg-light"></td>
                                @elseif ($quoteReq->status == 7)
                                <td class="bg-success text-white" style="width: 12%"><small>Driver Assigned</small></td>
                                <td class="bg-light"></td>
                                @elseif ($quoteReq->status == 8)
                                <td class="bg-success text-white" style="width: 15%"><small>To Pickup</small></td>
                                <td class="bg-light"></td>
                                @elseif ($quoteReq->status == 9)
                                <td class="bg-success text-white" style="width: 30%"><small>Loading</small></td>
                                <td class="bg-light"></td>
                                @elseif ($quoteReq->status == 10)
                                <td class="bg-success text-white" style="width: 55%"><small>On Delivery</small></td>
                                <td class="bg-light"></td>
                                @elseif ($quoteReq->status == 11)
                                <td class="bg-success text-white" style="width: 100%"><small>Arrived</small></td>
                                <td class="bg-light"></td>
                                @elseif ($quoteReq->status == 12)
                                <span class="text-success"><i class="fas fa-check-circle"></i><small> Completed</small></span>
                                @endif
                            </tr>
                        </table>

                        @if ($quoteReq->status > 5 && $quoteReq->status < 12)
                        <h5 class="mt-5">Current Location</h5>
                        <table class="table mb-4">
                            <tr>
                                <td>Location: {{$quoteComp->location}}</td>
                            </tr>
                        </table>
                        @elseif ($quoteReq->status == 12)
                        <h5 class="mt-5">Payment</h5>
                        <p>Total Cost: ${{$quoteApp->total_cost}}</p>
                        <div class="row">
                            <form method="POST" action="{{ route('checkout.payment.paypal', ['order' => encrypt($quoteComp->quote_id)]) }}" class="col-lg-4 text-center">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fab fa-paypal"></i> PAYPAL</button>
                                {{-- <a href=""><img class="payment-link border border-info" src="/img/payment/logo-paypal.jpg"></a> --}}
                            </form>
                            <form method="GET" action="{{route('customer.stripe')}}" class="col-lg-4 text-center">
                                <input type="hidden" name="quote_id" value="{{$quoteReq->id}}">
                                <button type="submit" class="btn btn-info btn-lg w-100"><i class="fas fa-credit-card"></i> STRIPE</button>
                                {{-- <a href="#"><img class="payment-link border border-success" src="/img/payment/logo-visa.jpg"></a> --}}
                            </form>
                            <div class="col-lg-4 text-center">
                                <button class="btn btn-warning btn-lg w-100"><i class="fab fa-cc-visa"></i> VISA</button>
                                {{-- <a href="#"><img class="payment-link border border-danger img-disabled" src="/img/payment/logo-payoneer.jpg"></a> --}}
                            </div>
                        </div>
                            @if(session()->has('message'))
                            <p class="text-danger"><i class="far fa-times-circle"></i> {{ session('message') }}</p>
                            @endif

                        @elseif ($quoteReq->status == 13)
                            @if(session()->has('message'))
                            <p class="text-success"><i class="far fa-check-circle"></i> {{ session('message') }}</p>
                            @else
                            <p class="text-success"><i class="far fa-check-circle"></i>  You recent payment is sucessful with reference code {{$quoteReq->transaction_id}}</p>
                            @endif

                            <a href="{{route('customer.quotecheck', $quoteReq->id)}}" class="btn btn-primary"><i class="fas fa-file-invoice"></i> View Invoice</a>

                            @if(!$quoteComp->customer_review)
                            <form method="POST" action="{{route('customer.quote.review')}}">
                                @csrf
                                <h5 class="mt-5">Leave your Review</h5>
                                <textarea name="review" rows="4" class="form-control"></textarea>
                                <input type="hidden" name="quoteID" value="{{$quoteReq->id}}">
                                <button type="submit" class="btn btn-success btn-base mt-3"><i class="fas fa-paper-plane"></i> Send</button>
                                {{-- <a href="#" class="btn btn-success btn-base mt-3">Send</a> --}}
                            </form>
                            @else
                            <h5 class="mt-5">Your Review</h5>
                            <p>{{$quoteComp->customer_review}}</p>
                            <small class="text-secondary">({{$quoteComp->updated_at}})</small>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if ($quoteReq->status > 5 && $quoteReq->status < 12)
                        <div>
                            <iframe class="position-relative rounded w-100"
                                src="https://maps.google.com/maps?q={{$quoteComp->lat}},{{$quoteComp->long}}&t=&z=10&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" allowfullscreen="false" aria-hidden="false" tabindex="0" style="height: 400px"
                            ></iframe>
                        </div>
                        {{-- <div>
                            <div id="map" class="position-relative rounded w-100" style="height: 500px"></div>
                        </div> --}}
                        @elseif ($quoteReq->status >= 12)
                        <div>
                            <a target="blank" href="{{Storage::url($quoteComp->bol_path)}}">
                                <img class="img-thumbnail" src="{{Storage::url($quoteComp->bol_path)}}" style="width:100%;">
                                <div class="caption">
                                    <p>Uploaded Time: {{$quoteComp->updated_at}}</p>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
@endpush

@push('scripts')
    {{-- <script src="{{asset('assets/backend/js/customer/status.js')}}"></script> --}}
    {{-- @if ($quoteReq->status > 5 && $quoteReq->status < 12)
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiZWS8nBscbzohPYAuyaPQx-ADDgt9ujI&callback=initMap" defer></script>
    @endif --}}
@endpush
