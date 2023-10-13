@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <input type="hidden" id="num_total_quotes" value="{{ $num_total_quotes }}">
            <input type="hidden" id="num_ongoing_quotes" value="{{ $num_ongoing_quotes }}">
            <input type="hidden" id="num_deleted_quotes" value="{{ $num_deleted_quotes }}">

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p>Total Completed Quotes</p>
                        <h1 class="text-white text-center">{{ $num_total_quotes }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('manager.quote.invoices') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p>Orders of this Month</p>
                        <h1 class="text-white text-center">{{ $num_month_quotes }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('manager.quote.invoices') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <p>On Going Orders</p>
                        <h1 class="text-white text-center">{{ $num_ongoing_quotes }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('manager.quotes.requested') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p>Complete Rate</p>
                        <h1 class="text-white text-center">{{ $rate_completed }}%</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('manager.quote.invoices') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                This dashboard provides a comprehensive overview of all the statistics related to your business. By utilizing this tool, you can easily track and analyze your business performance, identify areas for improvement, and make informed decisions to drive growth.
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Monthly Quote Statistics ({{ date('m/d/Y', strtotime('30 days ago'))." ~ ".date('m/d/Y') }})
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
            <div class="card-footer small text-muted">Updated at {{ date('Y-m-d H:i:s') }}</div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Yearly Statistics ({{ date('Y') }})
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="46"></canvas></div>
                    <div class="card-footer small text-muted">Updated at {{ date('Y-m-d H:i:s') }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Complete Rate ({{ date('Y') }})
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="99"></canvas></div>
                    <div class="card-footer small text-muted">Updated at {{ date('Y-m-d H:i:s') }}</div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Recent Quotes
            </div>
            <div class="card-body table-responsive">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quote ID</th>
                            <th>Customer Name</th>
                            <th>Deliver Cost</th>
                            <th>Carrier</th>
                            <th>Carrier Cost</th>
                            <th>Complete Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Quote ID</th>
                            <th>Customer Name</th>
                            <th>Deliver Cost</th>
                            <th>Carrier</th>
                            <th>Carrier Cost</th>
                            <th>Complete Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($quotes as $quote)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $quote->id_alias }}</td>
                            <td>{{ $quote->customer_fname }} {{ $quote->customer_lname }}</td>
                            <td>{{ $quote->total_cost }}</td>
                            <td>{{ $quote->legal_name }}</td>
                            <td>{{ $quote->deliver_cost }}</td>
                            <td>{{ $quote->updated_at }}</td>
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
    <script src="{{asset('assets/backend/plugins/chart@2.8.0/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/manager/dashboard.js')}}"></script>
@endpush
