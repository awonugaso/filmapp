@extends('layouts.app')

@section('content')
<div class="container">
    @can("isAdmin")
        <div class="row justify-content-center  ">
            <div class="col-4 p-3" style="background: white">
                <h4>Current Month Sales</h4>
                <h2>{{ $last_month }}</h2>
            </div>
            <div class="col-4 p-3" style="background: white">
                <h4>Last Month Sales</h4>
                <h2>{{ $last_month }}</h2>
            </div>
           
            <div class="col-4 p-4" style="background: white" >
                <h4>Total Purchase</h4>
                <h2>{{ $total_purchase }}</h2>
            </div>
        </div>
    @endcan
    <div class="row justify-content-center">
        <div class="col-md-12 m-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
