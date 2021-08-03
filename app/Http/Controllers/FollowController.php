<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrFactory;
class FollowController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    public function store(User $user, ToastrFactory $flasher) {
        auth()->user()->toggleFollow($user);
        if(auth()->user()->isFollowing($user)) {
            $flasher->addInfo("$user->name unfollowed");
        } else {
            $flasher->addSuccess("$user->name followed");
        }
        return redirect()->back();
    }
}
