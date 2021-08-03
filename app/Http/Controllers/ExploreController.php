<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
        $users = User::where('id', '!=', auth()->id())->paginate(10);
        return view('explore.index', compact('users'));
    }
}
