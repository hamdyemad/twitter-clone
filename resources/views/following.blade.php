<div class="following">
    <h4>Following</h4>
    <ul>
        @forelse (auth()->user()->followings as $following)                                
            <li>
                <a href="{{ route('profile', $following) }}">
                    <img class="avatar" src="/{{ $following->profile->image }}" alt="">
                    <span>{{ $following->name }}</span>
                </a>
            </li>
        @empty
        <div class="alert alert-danger">There is not followings</div>
        @endforelse
    </ul>
</div>