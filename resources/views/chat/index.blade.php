@extends('layouts.app')

@section('content')
  <div class="chats">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-3 order-last order-md-first">
          <ul class="all-followings">
            @forelse ($followings as $following)
              <li class="d-flex align-items-center" data-id="{{ $following->id }}">
                <div class="ball{{ $following->id }} {{ ($following->online == 1) ? 'online' : 'offline' }}"></div>
                <img class="avatar" src="/{{ $following->profile->image }}" alt="">
                <h6>{{ $following->name }}</h6>
                <span class="unread-messages unreaded-{{ $following->id }}">{{ $following->getUnreadedMessages() }}</span>
              </li>
            @empty
                <div class="alert alert-info">No Followings.</div>
            @endforelse
          </ul>
        </div>
        <div class="col-12 col-md-9 order-first order-md-last">
          <div class="alert alert-info no-selected">select one of your following to show messages</div>
          <div class="chat" hidden>
            <div class="messages"></div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script>
    let sendMessageChannel = pusher.subscribe("send-message");
    sendMessageChannel.bind("message", function(data) {
      let current_user = parseInt("{{ auth()->id() }}");
          $(".chats .chat .messages").append(`
          <div class="message-maker ${(current_user !== data.user_id) ? 'user' : ''}">
              <div class="maker d-flex align-items-center">
                ${
                    current_user !== data.user_id
                      ? `<img class="avatar" src="/${data.image}" alt="">`
                      : ""
                  }
                <div class="info ml-2">
                  ${(current_user == data.user_id) ? '' : `
                    <span>${data.name}</span>
                  `}
                  <span class="time">${data.time}</span>
                  <div class="message">${data.message}</div>
                </div>
              </div>
          </div>
          `);
          $(".no-messages").fadeOut();
          $("#typing-message").val("");
    });
    let readMessagesChannel = pusher.subscribe("read-messages");
    readMessagesChannel.bind("read-messages", function(data) {
      if(data.unreaded_messages == 0) {
        $(`.unreaded-${data.user_id}`).remove();
      } else {
        $(`.unreaded-${data.user_id}`).text(data.unreaded_messages);
      }
    });
  </script>
@endsection
