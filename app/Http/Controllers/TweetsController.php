<?php

namespace App\Http\Controllers;

use App\Events\MakeTweet;
use App\Events\ShowTweet;
use App\Tweet;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrFactory;

class TweetsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tweets = auth()->user()->timeline();
        return view('home', ['tweets' => $tweets]);
    }

    public function store(Request $request, ToastrFactory $flash) {
        $attributes = $request->validate([
            'body' => ['required', 'min:5', 'max:100']
        ]);
        $attributes['user_id'] = auth()->id();
        Tweet::create($attributes);
        $flash->addSuccess('the tweet has been created');
        event(new MakeTweet($attributes));
        return redirect()->back();
    }

    public function show(Tweet $tweet) {
        event(new ShowTweet($tweet,$tweet->tweetViewersCount()));
        return view('tweets.show', ['tweet' => $tweet]);
    }
}
