@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Add a {{ $type }}</h2>
                <form action="{{route('persistMedia')}}" method="POST" id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="media_title">Title:</label>
                        <input type="text" class="form-control" id="media_title" name="title"
                               placeholder="Enter the title of the {{ $type }}"/>
                    </div>
                    <ul class="nav nav-tabs" id="artistTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ count($authors) > 0 ? 'active' : '' }}" id="existing-tab" data-toggle="tab" href="#existing" role="tab"
                               aria-controls="existing" aria-selected="true">Choose
                                existing {{ $type === 'book' ? 'author' : 'director' }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ count($authors) === 0 ? 'active' : '' }}" id="new-tab" data-toggle="tab" href="#new" role="tab"
                               aria-controls="new" aria-selected="false">Enter
                                new {{ $type === 'book' ? 'author' : 'director' }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="artistTabContent">
                        <div class="tab-pane form-group fade show {{ count($authors) > 0 ? 'active' : '' }}" id="existing" role="tabpanel"
                             aria-labelledby="existing-tab">
                            <label for="format">{{ $type === 'book' ? 'Author' : 'Director' }}:</label>
                            <select class="form-control" name="artist" id="artistSelect">
                                @foreach($authors as $author)
                                    <option
                                        value="{{$author->id}}">{{$author->firstName}} {{$author->lastName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="tab-pane {{ count($authors) === 0 ? 'active' : '' }}" id="new" role="tabpanel" aria-labelledby="new-tab">
                            <div class="form-group">
                                <label for="artist_name">First
                                    name:</label>
                                <input type="text" class="form-control" id="artist_name" name="artist_first"
                                       placeholder="Enter the name of the {{ $type === 'book' ? 'author' : 'director' }}"/>
                            </div>
                            <div class="form-group">
                                <label for="artist_lastname">Last
                                    name:</label>
                                <input type="text" class="form-control" id="artist_lastname" name="artist_last"
                                       placeholder="Enter the name of the {{ $type === 'book' ? 'author' : 'director' }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="format">Format:</label>
                        <select class="form-control" name="format" id="format">
                            @foreach($formats as $format)
                                <option value="{{$format->id}}">{{$format->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <select class="form-control" name="genre" id="genre">
                            @foreach($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" value="{{$type}}" name="type"/>
                    <input type="hidden" id="artistTabChoice" name="artistTabChoice">
                    <button type="submit" class="btn btn-primary">Add {{ $type }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
