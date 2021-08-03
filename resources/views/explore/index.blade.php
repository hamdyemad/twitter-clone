@extends('layouts.master')


@section('content')
    <section class="explore">
        <ul>
            @forelse ($users as $user)
                <li class="d-flex align-items-center justify-content-between">
                    <a class="d-flex align-items-center" href="{{ route('profile', $user) }}">
                        <img class="avatar" src="/{{ $user->profile->image }}" alt="">
                        <h6 class="m-0 pl-2">{{ $user->name }}</h6>
                    </a>
                    <form action="{{route('toggle-follow', $user)}}" method="POST">
                        @csrf
                        <button class="btn-main">{{ auth()->user()->isFollowing($user) ? 'unfollow' : 'follow' }}</button>
                    </form>
                </li>
                @empty
                <div class="alert alert-info">There is no users yet</div>
                @endforelse
                {{$users->links()}}
        </ul>
    </section>
@endsection
