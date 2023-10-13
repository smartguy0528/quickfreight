@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Quote Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('manager.all.quotes')}}">Quotes</a></li>
            <li class="breadcrumb-item"><a href="{{route('manager.quotes.checked')}}">Checked Quotes</a></li>
            <li class="breadcrumb-item active">Quote Details</li>
        </ol>


        <div class="card mb-4">
            <div class="card-body d-flex flex-column justify-content-between p-5" style="min-height: calc(100vh - 350px)">
                <div>
                    <h5 class="text-center mt-5">No exist quote</h5>
                </div>

                <div>
                    <h5 class="mt-5">Current Status</h5>
                    <div class="col-md-11 offset-md-1 text-danger">
                        <p class="mt-3"><i class="fas fa-times"></i> There is no exist quote.</p>
                        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:1%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
