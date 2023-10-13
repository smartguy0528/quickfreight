@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            @if($status == 1)
                Requested Quotes
            @elseif($status == 2)
                Checked Quotes
            @elseif($status == 3)
                Approved Quotes
            @elseif($status == 4)
                Rejected Quotes
            @elseif($status == 5)
                Confirmed Quotes
            @elseif($status == 6)
                Submitted Quotes
            @elseif($status == 7)
                Published Quotes
            @elseif($status > 7 && $status < 12)
                On going Quotes
            @elseif($status == 12)
                Completed Quotes
            @endif
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('manager.all.quotes')}}">Quotes</a></li>
            @if($status == 1)
            <li class="breadcrumb-item active">Requested Quotes</a></li>
            @elseif($status == 2)
            <li class="breadcrumb-item active">Checked Quotes</a></li>
            @elseif($status == 3)
            <li class="breadcrumb-item active">Approved Quotes</a></li>
            @elseif($status == 4)
            <li class="breadcrumb-item active">Rejected Quotes</a></li>
            @elseif($status == 5)
            <li class="breadcrumb-item active">Confirmed Quotes</a></li>
            @elseif($status == 6)
            <li class="breadcrumb-item active">Submitted Quotes</a></li>
            @elseif($status == 7)
            <li class="breadcrumb-item active">Published Quotes</a></li>
            @elseif($status > 7 && $status < 12)
            <li class="breadcrumb-item active">On going Quotes</a></li>
            @elseif($status == 12)
            <li class="breadcrumb-item active">Completed Quotes</a></li>
            @endif
        </ol>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pt-3 pb-0">
                <a href="{{route('manager.quotes.requested')}}" class="btn text-uppercase
                    @if($status == 1)
                    btn-info
                    @elseif($status_count['quote_requested'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Requested ({{ $status_count['quote_requested'] }})</a>
                <a href="{{route('manager.quotes.checked')}}" class="btn text-uppercase
                    @if($status == 2)
                    btn-info
                    @elseif($status_count['quote_checked'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Checked ({{ $status_count['quote_checked'] }})</a>
                <a href="{{route('manager.quotes.approved')}}" class="btn text-uppercase
                    @if($status == 3)
                    btn-info
                    @elseif($status_count['quote_approved'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Approved ({{ $status_count['quote_approved'] }})</a>
                <a href="{{route('manager.quotes.rejected')}}" class="btn text-uppercase
                    @if($status == 4)
                    btn-info
                    @elseif($status_count['quote_rejected'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Rejected ({{ $status_count['quote_rejected'] }})</a>
                <a href="{{route('manager.quotes.confirmed')}}" class="btn text-uppercase
                    @if($status == 5)
                    btn-info
                    @elseif($status_count['quote_confirmed'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Confirmed ({{ $status_count['quote_confirmed'] }})</a>
                <a href="{{route('manager.quotes.submitted')}}" class="btn text-uppercase
                    @if($status == 6)
                    btn-info
                    @elseif($status_count['quote_submitted'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Submitted ({{ $status_count['quote_submitted'] }})</a>
                <a href="{{route('manager.quotes.published')}}" class="btn text-uppercase
                    @if($status == 7)
                    btn-info
                    @elseif($status_count['quote_published'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Published ({{ $status_count['quote_published'] }})</a>
                <a href="{{route('manager.quotes.ongoing')}}" class="btn text-uppercase
                    @if($status > 7 && $status < 12)
                    btn-info
                    @elseif($status_count['quote_ongoing'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">On Going ({{ $status_count['quote_ongoing'] }})</a>
                <a href="{{route('manager.quotes.completed')}}" class="btn text-uppercase
                    @if($status == 12)
                    btn-info
                    @elseif($status_count['quote_completed'])
                    btn-light fw-bold
                    @else
                    disabled text-muted
                    @endif">Completed ({{ $status_count['quote_completed'] }})</a>
            </div>
            <div class="card-body table-responsive">
                <table id="quoteTable" class="table-centered display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Quote ID</th>
                            <th>Requested Time</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$quote->id_alias}}</td>
                            <td>{{$quote->updated_at}}</td>
                            <td>{{$quote->first_name . ' ' . $quote->last_name}}</td>
                            <td>{{$quote->email}}</td>
                            <td>{{$quote->phone}}</td>
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

@push('styles')
    <link href="{{asset('assets/backend/plugins/datatable@1.13.2/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('assets/backend/plugins/datatable@1.13.2/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/manager/quotes.js')}}"></script>
@endpush
