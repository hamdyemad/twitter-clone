@extends('layouts.master')


@section('content')
    <div class="profile">
        <header>
            <img class="cover" src="/images/head.jpg" alt="">
            <img class="avatar" src="/{{ $user->profile->image }}" alt="">
        </header>
        <div class="info-of-header d-flex align-items-center justify-content-between">
            <div class="first">
                <h3 class="m-0">{{ $user->name }}</h3>
            </div>
            <div class="last">
                @if($user->id !== auth()->id())
                    <form action="{{ route('toggle-follow', $user) }}" method="POST">
                        @csrf
                        <button class="btn-main">{{ auth()->user()->isFollowing($user) ? "Unfollow" : "Follow" }}</button>
                        <a class="btn-main" href="{{ route('chats') }}">Chat Him</a>
                    </form>
                @else
                    <a class="btn-main" href="{{ route('profile.edit', $user) }}">Edit Profile</a>
                @endif
            </div>
        </div>
    </div>
    @include('tweets.all', ['tweets' => $user->tweets])
@endsection
