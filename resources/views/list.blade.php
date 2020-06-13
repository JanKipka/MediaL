@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All your {{ $type }}s</h2>
        <list-table-component type="{{ $type }}" :mediaItems="{{json_encode($mediaItems)}}">
        </list-table-component>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/filter.js')}}"></script>
@endpush
