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
                <card-component title="Your books" subheadline="{{ $countOfBooks ?? '0'}} books total"
                                :links="[{url: '{{route('list', ['type' => 'book'])}}', btn: 'btn btn-success', desc: 'View all'},
                                    {url: '{{route('add', ['type' => 'book'])}}', btn: 'btn btn-primary', desc: 'Add book'}]">
                </card-component>
            </div>
            <div class="col-sm-3">
                <card-component title="Your movies" subheadline="{{ $countOfMovies ?? '0' }} movies total"
                                :links="[{url: '{{route('list', ['type' => 'movie'])}}', btn: 'btn btn-success', desc: 'View all'},
                                    {url: '{{route('add', ['type' => 'movie'])}}', btn: 'btn btn-primary', desc: 'Add movie'}]">
                </card-component>
            </div>
            <div class="col-sm-3">
                <card-component title="Your genres" subheadline="{{ $countOfGenres ?? '0'}} genres total"
                                :links="[{url: '{{route('list', ['type' => 'movie'])}}', btn: 'btn btn-primary', desc: 'View all'}]">
                </card-component>
            </div>
            <div class="col-sm-3">
                <card-component title="Your profile" subheadline="{{$user->name}}"
                                :links="[{url: '{{route('profile')}}', btn: 'btn btn-primary', desc: 'View Profile'}]">
                </card-component>
            </div>
        </div>
    </div>
    </div>
@endsection
