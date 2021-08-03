<?php

namespace App\Http\Controllers;

use App\Events\Notify;
use App\Tweet;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrFactory;

class LikeController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


    public function store(Tweet $tweet, ToastrFactory $flasher) {
        if(array_key_exists('like', request()->all())) {
            auth()->user()->toggleLike($tweet);
        }
        else if(array_key_exists('dislike', request()->all())) {
            auth()->user()->toggleDisLike($tweet);
        }
        if(auth()->user()->isLiked($tweet)) {
            $flasher->addSuccess('has liked');
        } else if(auth()->user()->isDisLiked($tweet)) {
            $flasher->addError('has disliked');
        } else {
            $flasher->addInfo('removed');
        }
        $data = [
            'name' => auth()->user()->name,
            // 'liked' => $tweet->likes()->latest()->get()
        ];
        if($tweet->user->id !== auth()->id()) {
            event(new Notify($data));
        }
        return redirect()->back();
    }
    //
}
