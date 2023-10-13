@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Completed Quotes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Completed Quotes</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <table class="table-centered display" id="invoiceTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Quote ID</th>
                            <th>Requested Time</th>
                            <th>Completed Time</th>
                            <th>View Details</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$quote->id_alias}}</td>
                            <td>{{$quote->created_at}}</td>
                            <td>{{$quote->updated_at}}</td>
                            <td>
                                <a href="{{route('manager.quote.details', $quote->id)}}">Details</a>
                            </td>
                            <td>
                                @if($quote->customer_review)
                                <a class="text-danger" href="javascript:void(0);" onclick="fn.review_modal({{$quote->id}})"><i class="fas fa-receipt"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('manager.invoice.customer', $quote->id)}}" class="btn btn-primary w-150p btn-sm"><i class="fas fa-file-alt"></i> Customer Invoice</a>
                                <a href="{{route('manager.invoice.carrier', $quote->id)}}" class="btn btn-success w-150p btn-sm"><i class="far fa-file-alt"></i> Carrier Invoice</a>
                            </td>
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
<!-- Review Detail Modal -->
<div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="margin: 0 auto">Customer Review</h4>
            </div>
            <div class="modal-body p-3">
                <p id="customerRiview"></p>
                <h6 class="text-end" id="customerName"></h6>
                <p class="text-end"><small id="reviewDate"></small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-125p me-3" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
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
    <script src="{{asset('assets/backend/js/manager/invoices.js')}}"></script>
@endpush
