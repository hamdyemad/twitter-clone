<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Traits\File;
use App\User;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrFactory;
class ProfileController extends Controller
{
    //
    use File;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user) {
        return view('profile.show', ['user' => $user]);
    }

    public function edit(User $user) {
        return view('profile.edit', ['user' => $user]);
    }

    public function update(User $user, ToastrFactory $flasher) {
        $path = "images/profiles/$user->id/";
        $attributes = request()->validate([
            'name' => ['required', 'min:5'],
            'bio' => ['required', 'min:5'],
            'image' => ['image', 'max:5000', 'mimes:jpg,png,jpeg']
        ]);
        $userName = $attributes['name'];
        unset($attributes['name']);
        if(array_key_exists('image', $attributes)) {
            $attributes['image'] = $this->uploadFile(request(), "images/profiles/$user->id/", 'image');
            if($user->profile->image !== 'images/default.png') {
                if(file_exists($user->profile->image)) {
                    unlink($user->profile->image);
                }
            }
        } else {
            unset($attributes['image']);
        }
        $user->profile->update($attributes);
        $user->update(['name' => $userName]);
        $flasher->addInfo("Updated Succefully");
        return redirect()->back();
    }
}
