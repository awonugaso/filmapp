@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-3 mb-5" style="background: white">
            <a href="/film/create" class="btn btn-primary" >Create Film</a>
        </div>
    </div>

    @if (session('success'))
        <div class="row">
            <div class="col-12 p-3 mb-5 alert alert-success" role="alert" >
                {{ session('success') }}
            </div>
        </div>
    @endif

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
                                <th scope="col">Rating</th>
                                <th scope="col">Year</th>
                                <th scope="col">FIlm Image</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ( $films as $film )
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $film->title}} - {{ $film->description}}</td>
                                    <td>{{$film->genre->name}}</td>
                                    <td>{{$film->rating}}</td>
                                    <td>{{$film->year}}</td>
                                    <td><img src="/images/{{$film->image}}"  style="max-width: 100px"/> </td>
                                    <td>{{$film->cost}}</td>
                                    <td>{{$film->created_at}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('film.destroy', $film->id ) }}">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger mb-3">
                                        </form>

                                        <a href="{{ route('film.edit', $film->id ) }}" class="btn btn-success">Edit</a>

                                    </td>
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
