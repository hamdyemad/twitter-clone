@extends('layouts.master')


@section('content')
    <div class="alert alert-info">
        Tweet_id: <div class="alert alert-warning">{{ $tweet->id }}</div>
        Tweet_body: <div class="alert alert-danger">{{ $tweet->body }}</div>
        name of the making tweet: <div class="alert alert-danger">{{ $tweet->user->name }}</div>
        Views: <div class="alert alert-danger viewers">{{ $tweet->tweetViewersCount() }}</div>
    </div>

@endsection