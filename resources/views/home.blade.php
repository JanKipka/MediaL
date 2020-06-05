@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Your media</h2>
                        <h5>{{ $totalCount ?? '0' }} media items total</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Your books</h2>
                        <h5>{{ $countOfBooks ?? '0'}} books total</h5>
                        <a href="{{route('list', ['type' => 'book'])}}" class="btn btn-success">View all</a>
                        <a href="{{route('add', ['type' => 'book'])}}" class="btn btn-primary">Add book</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Your movies</h2>
                        <h5> {{ $countOfMovies ?? '0' }} movies total</h5>
                        <a href="{{route('list', ['type' => 'movie'])}}" class="btn btn-success">View all</a>
                        <a href="{{route('add', ['type' => 'movie'])}}" class="btn btn-primary">Add movie</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Your genres</h2>
                        <h5>{{ $countOfGenres ?? '0'}} genres total</h5>
                        <a href="{{route('add', ['type' => 'book'])}}" class="btn btn-primary">Add genre</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Your profile</h2>
                        <h5>{{$user->name}}</h5>
                        <a href="{{route('add', ['type' => 'book'])}}" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
