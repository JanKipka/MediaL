@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center">{{ $user->name }}</h1>
        <h5 class="text-center">{{ $user->email }}</h5>
        <form id="profileForm" method="POST" action="{{route('updateProfile')}}">
            @csrf
            <div class="row mt-4">
                <div class="col-sm-12">
            <textarea class="form-control" placeholder="Your biography here..." name="biography">
                {{ $user->profile->biography ?? ''}}
            </textarea>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-4">
                            <h4>Birthday:</h4>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="date" name="birthday"
                                   value="{{ $user->profile->birthday ?? ''}}" placeholder="Birthday"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <h4>City:</h4>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="city" value="{{ $user->profile->city ?? ''}}"
                                   placeholder="City"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Twitter:</h4>
                        </div>
                        <div class="col-sm-8 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input class="form-control" type="text" name="twitter" placeholder="Twitter"
                                   value="{{ $user->profile->twitter ?? ''}}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <h4>Website:</h4>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="website" placeholder="Website"
                                   value="{{ $user->profile->website ?? ''}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 row justify-content-center">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>

@endsection
