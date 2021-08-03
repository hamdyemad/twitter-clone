let toggleOnlineChannel = pusher.subscribe("toggle-online");
toggleOnlineChannel.bind("toggle-online", function(data) {
  if (data.online == 1) {
    $(`.chats .ball${data.id}`)
      .removeClass("offline")
      .addClass("online");
  } else {
    $(`.chats .ball${data.id}`)
      .removeClass("online")
      .addClass("offline");
  }
});
