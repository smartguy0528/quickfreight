@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Carrier Invoice Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('manager.quote.invoices')}}">Completed Quotes</a></li>
            <li class="breadcrumb-item active">Carrier Invoice Details</li>
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

                <h5 class="mt-5">Quote to Carrier</h5>
                <p class="ps-5">Delivery Cost: ($) {{$quote->deliver_cost}}</p>
                <p class="ps-5">Comment from company: {{$quote->company_carrier_comment}}</p>
                
                <h5 class="mt-5">Completed Status</h5>
                <p class="ps-5">Completed Time: {{$quote->updated_at}}</p>
            </div>
        </div>
    </div>
</main>
@endsection