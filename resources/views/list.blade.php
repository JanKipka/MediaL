@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All your {{ $type }}s</h2>
        @include('components.listtable', ['type' => $type, 'mediaItems' => $mediaItems])
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/filter.js')}}"></script>
@endpush
