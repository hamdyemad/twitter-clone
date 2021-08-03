@extends('layouts.master')


@section('content')
    <div class="edit-profile">
        <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Edit Information</h3>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bio">bio</label>
                        <input type="text" class="form-control" name="bio" value="{{ $user->profile->bio }}">
                        @error('bio')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>  
                </div>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="file-of-btn" type="file" hidden class="form-control" name="image">
                @error('image')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <button type="button" class="btn btn-info btn-block btn-file">Select File</button>
                <img class="img" src="/{{$user->profile->image}}" alt="">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection