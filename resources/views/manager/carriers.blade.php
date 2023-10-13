@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Registered Carriers</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Carriers</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <table class="table-centered display" id="carriersTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>US DOT Number</th>
                            <th>Carrier Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carriers as $carrier)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $carrier->dot_number }}</td>
                            <td>{{ $carrier->legal_name }}</td>
                            <td>{{ $carrier->email_address }}</td>
                            <td>{{ $carrier->telephone }}</td>
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
    <script src="{{asset('assets/backend/js/manager/carriers.js')}}"></script>
@endpush
