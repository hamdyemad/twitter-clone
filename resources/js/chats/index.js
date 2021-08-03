import { Helpers } from "../helpers";

if ($(".all-followings").children().length > 8) {
  $(".all-followings").css("overflow-y", "scroll");
} else {
  $(".all-followings").css("overflow-y", "hidden");
}

$(".all-followings li").each((index, li) => {
  $(li).on("click", function() {
    $(".no-selected").fadeOut();
    $(".chat form").remove();
    $(this)
      .addClass("active")
      .siblings()
      .removeClass("active");
    $(".chat").removeAttr("hidden");
    $(".chat").append(`
      <form id="send-message-form">
        <textarea class="form-control" id="typing-message"></textarea>
        <button class="btn-main add-message" disabled>
          <i class="fas fa-paper-plane"></i>
          <span>Send Message</span>
        </button>
      </form>
      `);
    $("#typing-message").on("keyup", function() {
      if ($("#typing-message").val() !== "") {
        $(".add-message").removeAttr("disabled");
      } else {
        $(".add-message").attr("disabled", "");
      }
    });
    let selectedId = $(this).data("id"),
      csrf_token = $("#csrf_token").attr("content");
    let getMessagesOption = {
      type: "POST",
      url: `/chats/${selectedId}`,
      data: {
        _token: csrf_token
      },
      success: function(res) {
        // empty all messages
        $(".chats .chat .messages").empty();
        if (res.data.chats.length == 0) {
          $(".chats .chat .messages").append(
            `<div class='alert alert-info no-messages'>there is no messages</div>`
          );
          $(".chats .chat").css("overflow-y", "hidden");
        } else {
          $(".chats .chat").css("overflow-y", "scroll");
        }

        // get all unreaded chats
        let unreadedMessages = res.data.chats.filter(
          message =>
            message.readed == 0 && message.messager_id == res.data.auth_id
        );
        let unreadedMessagesIds = unreadedMessages.map(message => message.id);
        if (unreadedMessages.length !== 0) {
          if (res.data.auth_id == unreadedMessages[0].messager_id) {
            if (unreadedMessagesIds.length !== 0) {
              // make patch request and update unreaded to readed
              let options = {
                type: "PATCH",
                url: `/chats/messages/${res.data.user.id}`,
                data: {
                  _token: csrf_token,
                  data: unreadedMessagesIds
                },
                success: function(data) {
                  console.log(data);
                },
                error: function(err) {}
              };
              $.ajax(options);
            }
          }
        }
        for (let chat of res.data.chats) {
          let user = "";
          chat.user_id !== res.data.auth_id ? (user = "user") : (user = "");
          // apped a new message
          $(".chats .chat").removeAttr("hidden");
          $(".chats .chat .messages").append(`
          <div class="message-maker ${user}">
                  <div class="maker d-flex align-items-center">
                  ${
                    res.data.auth_id !== chat.user_id
                      ? `<img class="avatar" src="/${res.data.user.image}" alt="">`
                      : ""
                  }
                    <div class="info ml-2">
                  ${
                    res.data.auth_id !== chat.user_id
                      ? `<span>${res.data.user.name}</span>`
                      : ""
                  }
                      <span class="time">${new Helpers().timeSince(
                        new Date(chat.created_at)
                      )}</span>
                      <div class="message">${chat.message}</div>
                    </div>
                  </div>
                </div>
          `);
        }
        $(".chat").animate({ scrollTop: $(".chat form")[0].offsetTop }, 200);
      },
      error: function(err) {
        console.log(err);
      }
    };
    $.ajax(getMessagesOption);

    $("#send-message-form").on("submit", function(e) {
      e.preventDefault();
      let value = $("#typing-message").val();
      var hasErrors = false;
      $("#typing-message").val() == "" ? (hasErrors = true) : "";
      if (!hasErrors) {
        let options = {
          type: "POST",
          data: {
            _token: csrf_token,
            message: value
          },
          url: `/chats/${selectedId}/send`,
          success: function(data) {
            console.log(data);
          },
          error: function(err) {
            console.log(err);
          }
        };
        $.ajax(options);
      }
    });
  });
});
