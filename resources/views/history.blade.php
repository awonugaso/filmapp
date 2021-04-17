@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Purchase History') }}</div>

                <div class="card-body">

                    <table class="table table-hover">

                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">FIlm Title</th>
                                <th scope="col">FIlm Genre</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ( $transactions as $transaction )
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $transaction->film->title}}</td>
                                    <td>{{$transaction->film->genre->name}}</td>
                                    <td>{{$transaction->film->cost}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                  </tr>
                                @endforeach
                            </tbody>

                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
