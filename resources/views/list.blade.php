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
                                @if ($loop->remaining > 0)
                                    {{$author->firstName}} {{$author->lastName}},
                                @else
                                    {{$author->firstName}} {{$author->lastName}}
                                @endif
                            @endforeach
                        </td>
                    @else
                        <td>
                            @foreach($item->directors as $director)
                                @if ($loop->remaining > 0)
                                    {{$director->firstName}} {{$director->lastName}},
                                @else
                                    {{$director->firstName}} {{$director->lastName}}
                                @endif
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
