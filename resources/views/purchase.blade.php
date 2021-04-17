@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-3 mb-5" style="background: white">

            <form Method="POST" action="{{ route('purchase-search') }}">
                @csrf
            <label>Genre</label>
            <select name="genre" class="d-inline form-control col-3 mr-3">
                <option value=""> ---- Select Genre ---- </option>
                @foreach ( $genres as $genre)
                <option value="{{ $genre->id }} "> {{ $genre->name }} </option>
                @endforeach
            </select>
            <label>Title</label>
            <input type="text" class="d-inline form-control col-3" name="title"/>

            <input type="submit"  class="btn btn-primary d-inline"  value="Search" name=""/>
        </form>
        </div>
    </div>

    @if (session('success'))
        <div class="row">
            <div class="col-12 p-3 mb-5 alert alert-success" role="alert" >
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="row ">

        @foreach ($films as $film )
        <div class="col-sm-3">
            <div class="card" >
                <img src="/images/{{ $film->image }}" class="card-img-top" style="height: 300px;" alt="{{ $film->title }}">
                <div class="card-body">
                <form method="POST" action="{{ route('purchase.store') }}">
                    @csrf
                <h5 class="card-title">{{ $film->title }}</h5>
                <p class="card-text">{{ $film->description }}</p>
                <input type="hidden" name="movie_id" value="{{ $film->id }}" />
                <input type="hidden" name="title" value="{{ $film->title }}" />
                <input type="submit" class="btn btn-primary" value="Purchase">
                </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
