<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ReadMessages;
use App\Events\SendMessage;
use App\Traits\Res;
use App\User;

class ChatController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
    use Res;

    public function index() {
      $chats = Chat::where('user_id', auth()->id())->get();
      $followings = auth()->user()->followings;
      return view('chat.index', ['chats' => $chats, 'followings' => $followings]);
    }

    public function update($id) {
      $user = User::find($id);
      Chat::whereIn('id', request()->all()['data'])->update(['readed' => 1]);
      $data['unreaded_messages'] = $user->getUnreadedMessages();
      $data['user_id'] = $user->id;
      event(new ReadMessages($data));
      return $this->sendRes('done ya man :D', true);
    }


    public function show($id) {
      $user = User::find($id);
      $user['image'] = $user->profile->image;
      $user['name'] = $user->name;
      $chats = Chat::where('user_id', auth()->id())
      ->where('messager_id', $user->id)
      ->orWhere('messager_id', auth()->id())
      ->where('user_id', $user->id)->get();
      return $this->sendRes('done', true, ['user' => $user, 'chats' => $chats, 'auth_id' => auth()->id()]);
    }

    public function store($id) {
      if(strlen(request()['message']) == 0) {
        return response()->json([
          'status' => true,
          'message' => "Please Write a message plesae !"
        ]);
      } else {
        $user = User::find($id);
        $message = [
          'user_id' => auth()->id(),
          'messager_id' => $user->id,
          'message' => request()['message']
        ];
        $newMessage = Chat::create($message);
        $message['name'] = auth()->user()->name;
        $message['image'] = auth()->user()->profile->image;
        $message['time'] = $newMessage->created_at->diffForHumans();
        $data['unreaded_messages'] = auth()->user()->getUnreadedMessages();
        $data['user_id'] = auth()->id();
        event(new SendMessage($message));
        event(new ReadMessages($data));

        return response()->json([
          'status' => true,
          'message' => "Inserted Successfully !"
        ]);
      }
    }
}
