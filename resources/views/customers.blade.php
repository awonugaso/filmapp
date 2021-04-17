@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-3 mb-5" style="background: white">

            <form Method="POST" action="{{ route('customer-search') }}">
                @csrf
            <label>Name</label>
            <input type="text" class="d-inline form-control col-3"  name="name"/>
            <label class="ml-4">Age</label>
            <input type="text" class="d-inline  form-control col-3" name="age" placeholder="equals or below"/>
            <input type="submit"  class="btn btn-primary d-inline ml-2"  value="Search" name=""/>
        </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Customers') }}</div>

                <div class="card-body">

                    <table class="table table-hover">

                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Date</th>
                                <th scope="col">Movies Purchased</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users as $user )
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{$user->dob}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td> //FIX </td>
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
