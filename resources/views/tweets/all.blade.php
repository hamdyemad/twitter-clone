<section class="tweets">
    <div class="all-tweets">
        @foreach ($tweets as $tweet)
            <div class="tweet d-flex">
                <a href="{{ route('profile', $tweet->user) }}">
                    <img class="avatar" src="/{{ $tweet->user->profile->image }}" alt="">
                </a>
                <div class="info">
                    <div class="first d-flex align-items-center">
                        <h5>{{ $tweet->user->name }}</h5>
                        <span class="ml-2">{{ $tweet->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="last">
                        <a href="{{ route('tweet', $tweet) }}">
                            <i class="fas fa-link"></i>
                        </a>
                    </div>
                    <p>{{ $tweet->body }}</p>
                    <div class="options">
                        <form method="POST" action="{{ route('like', $tweet) }}" class="d-flex align-items-center">
                            @csrf
                            <button name="like" class="option {{ auth()->user()->isLiked($tweet) ? 'btn-main' : '' }}">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                <span>{{ $tweet->countLiked(1) }}</span>
                            </button>
                            <button name="dislike" class="option {{ auth()->user()->isDisLiked($tweet) ? 'btn-main' : '' }}">   
                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                <span>{{$tweet->countLiked(0)}}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>