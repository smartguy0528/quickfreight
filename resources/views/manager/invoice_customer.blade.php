@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Customer Invoice Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('manager.quote.invoices')}}">Completed Quotes</a></li>
            <li class="breadcrumb-item active">Customer Invoice Details</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body table-responsive p-5">
                <button class="btn btn-info float-end">Export to PDF</button>
                <h5 class="mt-3">Request Information</h5>
                <table class="table mb-0">
                    <tr>
                        <td>Quote ID: {{$quote->id_alias}}</td>
                        <td>Customer Name: {{$quote->customer_name}}</td>
                        <td>Email Address: {{$quote->customer_email}}</td>
                    </tr>
                    <tr>
                        <td>Company Name: {{$quote->company_name}}</td>
                        <td>Company Address: {{$quote->company_address}}</td>
                        <td>Phone Number: {{$quote->customer_phone}}</td>
                    </tr>
                    <tr>
                        <td>Pickup City / State: {{$quote->pickup}}</td>
                        <td>Delivery City / State: {{$quote->delivery}}</td>
                        <td>Delivery Date: {{$quote->deliveryDate}}</td>
                    </tr>
                    <tr>
                        <td>Commodity: {{$quote->commodity}}</td>
                        <td>Demension: {{$quote->dimension}}</td>
                        <td>Weight: {{$quote->weight}}</td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td>Comment:</td>
                        <td>{{$quote->comment}}</td>
                    </tr>
                </table>

                <h5 class="mt-5">Driver Information</h5>
                <table class="table mb-0">
                    <tr>
                        <td colspan="2">Carrier Company: {{$quote->carrier_name}}</td>
                        <td>Driver Name: {{$quote->driver_name}}</td>
                    </tr>
                    <tr>
                        <td>Truck Type: {{$quote->truck_type}}</td>
                        <td>Truck Number: {{$quote->truck_num}}</td>
                        <td>Truck Capacity: {{$quote->truck_capacity}}</td>
                    </tr>
                </table>

                <h5 class="mt-5">Quote to Customer</h5>
                <table class="table mb-4">
                    <tr>
                        <td>Delivery Cost: ($) {{$quote->cost}}</td>
                        <td>Distance: {{$quote->miles}}</td>
                    </tr>
                    <tr>
                        <td style="border-right-width: 1px">Additional Cost: ($) {{$quote->fee}}</td>
                        <td style="border-bottom: none; vertical-align: bottom">Comment from Company:</td>
                    </tr>
                    <tr>
                        <td style="border-right-width: 1px">Total Cost: ($) {{$quote->total_cost}}</td>
                        <td>{{$quote->company_comment}}</td>
                    </tr>
                </table>

                <h5 class="mt-5">Completed Status</h5>
                <div class="row">
                    <div class="col-md-3 border-bottom pt-3">Completed Time:</div>
                    <div class="col-md-9 border-bottom pt-3">{{$quote->updated_at}}</div>
                    <div class="col-md-3 border-bottom pt-3">Feedback:</div>
                    <div class="col-md-9 border-bottom pt-3">{{$quote->customer_review}}</div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection