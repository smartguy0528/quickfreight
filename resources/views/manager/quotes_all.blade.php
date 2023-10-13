@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Quotes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Quotes</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <table class="table-centered display" id="quoteTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Quote ID</th>
                            <th>Status</th>
                            <th>Requested Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$quote->id_alias}}</td>
                            <td>
                                @if ($quote->status == 1)
                                <span class="opacity-0">1</span><a href="{{route('manager.quotes.requested')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-red)">New Requested</a>
                                @elseif ($quote->status == 2)
                                <span class="opacity-0">2</span><a href="{{route('manager.quotes.checked')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-orange)">Checked</a>
                                @elseif ($quote->status == 3)
                                <span class="opacity-0">3</span><a href="{{route('manager.quotes.approved')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-green)">Approved</a>
                                @elseif ($quote->status == 4)
                                <span class="opacity-0">4</span><a href="{{route('manager.quotes.rejected')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-pink)">Rejected</a>
                                @elseif ($quote->status == 5)
                                <span class="opacity-0">5</span><a href="{{route('manager.quotes.confirmed')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-blue)">Confirmed</a>
                                @elseif ($quote->status == 6)
                                <span class="opacity-0">6</span><a href="{{route('manager.quotes.submitted')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-indigo)">Submitted</a>
                                @elseif ($quote->status == 7)
                                <span class="opacity-0">7</span><a href="{{route('manager.quotes.published')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-teal)">Published</a>
                                @elseif ($quote->status > 7 && $quote->status < 12)
                                <span class="opacity-0">8</span><a href="{{route('manager.quotes.ongoing')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-yellow)">On Going</a>
                                @elseif ($quote->status == 12)
                                <span class="opacity-0">9</span><a href="{{route('manager.quotes.completed')}}" class="badge w-100p hover-white text-decoration-none" style="background-color: var(--bs-gray)">Completed</a>
                                @endif
                            </td>
                            <td>{{$quote->created_at}}</td>
                            <td><a href="{{route('manager.quote.details', $quote->id)}}" class="btn btn-info w-125p btn-sm"><i class="far fa-calendar-check"></i> Check Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@push('modals')
<!-- Quote Detail Modal -->
<div class="modal fade" id="quoteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin: 0 auto">Requested Quote</h5>
            </div>
            <div class="modal-body p-5">
                <h5>Customer Request Information</h5>
                <table class="table mb-0">
                    <tr>
                        <td>Company Name: <span id="cCompany"></span></td>
                        <td>Company Address: <span id="cAddress"></span></td>
                    </tr>
                </table>
                <table class="table mb-0">
                    <tr>
                        <td>Customer Name: <span id="cName"></span></td>
                        <td>Email Address: <span id="cEmail"></span></td>
                        <td>Phone Number: <span id="cPhone"></span></td>
                    </tr>
                    <tr>
                        <td>Pickup City / State: <span id="cPickup"></span></td>
                        <td>Delivery City / State: <span id="cDelivery"></span></td>
                        <td>Commodity: <span id="cCommodity"></span></td>
                    </tr>
                    <tr>
                        <td>Pickup Date: <span id="cPDate"></span></td>
                        <td>Delivery Date: <span id="cDDate"></span></td>
                        <td>Demension: <span id="cDimension"></span></td>
                    </tr>
                    <tr>
                        <td>Weight: <span id="cWeight"></span></td>
                        <td>Temperature Condition: <span id="cTemperature"></span></td>
                        <td>Equipment: <span id="cEquipment"></span></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td style="vertical-align: top; width: 100px">Comment:</td>
                        <td id="cComment">
                        </td>
                    </tr>
                </table>

                <h5 class="mt-5">Quote From Company</h5>
                <table class="table mb-0">
                    <tr>
                        <td>Delivery Cost: $<span id="rCost"></span></td>
                        <td>Additional Fee: $<span id="rFee"></span></td>
                        <td>Total Cost: $<span id="rTotalCost"></span></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td style="width: 200px">Company Comment:</td>
                        <td><span id="rComment"></span></td>
                    </tr>
                </table>

                <input type="hidden" id="cID">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-base me-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('styles')
    <link href="{{asset('assets/backend/plugins/datatable@1.13.2/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('assets/backend/plugins/datatable@1.13.2/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/manager/quotes_all.js')}}"></script>
@endpush
