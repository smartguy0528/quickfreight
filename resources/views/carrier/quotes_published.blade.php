@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Published Quotes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Published Quotes</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <table id="quoteTable" class="table-centered display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Quote ID</th>
                            <th>Requested Time</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$quote->id_alias}}</td>
                            <td>{{$quote->requested_time}}</td>
                            <td>{{$quote->name}}</td>
                            <td class="text-info">{{$quote->status_description}}</td>
                            <td><a href="{{route('carrier.quote.details', $quote->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-clipboard-check"></i> Check Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
    <link href="{{asset('assets/backend/plugins/datatable@1.13.2/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('assets/backend/plugins/datatable@1.13.2/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/carrier/quotes_published.js')}}"></script>
@endpush