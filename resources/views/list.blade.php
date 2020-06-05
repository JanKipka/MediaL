@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All your {{ $type }}s</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">{{ $type === 'book' ? 'Author' : 'Director' }}</th>
                <th scope="col">Format</th>
                <th scope="col">Genre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mediaItems as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->title}}</td>
                    @if($type === 'book')
                        <td>
                            @foreach($item->author as $author)
                                {{$author->firstName}} {{$author->lastName}}
                            @endforeach
                        </td>
                    @else
                        <td>
                            @foreach($item->directors as $director)
                                {{$director->firstName}} {{$director->lastName}}
                            @endforeach
                        </td>
                    @endif
                    <td>{{$item->format->name}}</td>
                    <td>{{$item->genre->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
