/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var _require = __webpack_require__(/*! ./helpers */ "./resources/js/helpers.js"),
    Helpers = _require.Helpers;

__webpack_require__(/*! ./chats/index */ "./resources/js/chats/index.js");

__webpack_require__(/*! ./chats/toggleOnline */ "./resources/js/chats/toggleOnline.js");

(function () {
  $(".btn-file").on("click", function () {
    var inputFile = $(this).prev()[0];
    inputFile.click();
    var img = $(inputFile).next(".btn-file").next("img");
    inputFile.addEventListener("change", function () {
      var file = inputFile.files[0];
      var fileReader = new FileReader();

      fileReader.onload = function (e) {
        var fileResult = e.target.result;
        img.removeAttr("hidden");
        img.attr("src", fileResult);
        $(inputFile).next(".btn-file").text(file.name);
      };

      fileReader.readAsDataURL(file);
    });
  });
})();

/***/ }),

/***/ "./resources/js/chats/index.js":
/*!*************************************!*\
  !*** ./resources/js/chats/index.js ***!
  \*************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../helpers */ "./resources/js/helpers.js");
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



if ($(".all-followings").children().length > 8) {
  $(".all-followings").css("overflow-y", "scroll");
} else {
  $(".all-followings").css("overflow-y", "hidden");
}

$(".all-followings li").each(function (index, li) {
  $(li).on("click", function () {
    $(".no-selected").fadeOut();
    $(".chat form").remove();
    $(this).addClass("active").siblings().removeClass("active");
    $(".chat").removeAttr("hidden");
    $(".chat").append("\n      <form id=\"send-message-form\">\n        <textarea class=\"form-control\" id=\"typing-message\"></textarea>\n        <button class=\"btn-main add-message\" disabled>\n          <i class=\"fas fa-paper-plane\"></i>\n          <span>Send Message</span>\n        </button>\n      </form>\n      ");
    $("#typing-message").on("keyup", function () {
      if ($("#typing-message").val() !== "") {
        $(".add-message").removeAttr("disabled");
      } else {
        $(".add-message").attr("disabled", "");
      }
    });
    var selectedId = $(this).data("id"),
        csrf_token = $("#csrf_token").attr("content");
    var getMessagesOption = {
      type: "POST",
      url: "/chats/".concat(selectedId),
      data: {
        _token: csrf_token
      },
      success: function success(res) {
        // empty all messages
        $(".chats .chat .messages").empty();

        if (res.data.chats.length == 0) {
          $(".chats .chat .messages").append("<div class='alert alert-info no-messages'>there is no messages</div>");
          $(".chats .chat").css("overflow-y", "hidden");
        } else {
          $(".chats .chat").css("overflow-y", "scroll");
        } // get all unreaded chats


        var unreadedMessages = res.data.chats.filter(function (message) {
          return message.readed == 0 && message.messager_id == res.data.auth_id;
        });
        var unreadedMessagesIds = unreadedMessages.map(function (message) {
          return message.id;
        });

        if (unreadedMessages.length !== 0) {
          if (res.data.auth_id == unreadedMessages[0].messager_id) {
            if (unreadedMessagesIds.length !== 0) {
              // make patch request and update unreaded to readed
              var options = {
                type: "PATCH",
                url: "/chats/messages/".concat(res.data.user.id),
                data: {
                  _token: csrf_token,
                  data: unreadedMessagesIds
                },
                success: function success(data) {
                  console.log(data);
                },
                error: function error(err) {}
              };
              $.ajax(options);
            }
          }
        }

        var _iterator = _createForOfIteratorHelper(res.data.chats),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var chat = _step.value;
            var user = "";
            chat.user_id !== res.data.auth_id ? user = "user" : user = ""; // apped a new message

            $(".chats .chat").removeAttr("hidden");
            $(".chats .chat .messages").append("\n          <div class=\"message-maker ".concat(user, "\">\n                  <div class=\"maker d-flex align-items-center\">\n                  ").concat(res.data.auth_id !== chat.user_id ? "<img class=\"avatar\" src=\"/".concat(res.data.user.image, "\" alt=\"\">") : "", "\n                    <div class=\"info ml-2\">\n                  ").concat(res.data.auth_id !== chat.user_id ? "<span>".concat(res.data.user.name, "</span>") : "", "\n                      <span class=\"time\">").concat(new _helpers__WEBPACK_IMPORTED_MODULE_0__["Helpers"]().timeSince(new Date(chat.created_at)), "</span>\n                      <div class=\"message\">").concat(chat.message, "</div>\n                    </div>\n                  </div>\n                </div>\n          "));
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }

        $(".chat").animate({
          scrollTop: $(".chat form")[0].offsetTop
        }, 200);
      },
      error: function error(err) {
        console.log(err);
      }
    };
    $.ajax(getMessagesOption);
    $("#send-message-form").on("submit", function (e) {
      e.preventDefault();
      var value = $("#typing-message").val();
      var hasErrors = false;
      $("#typing-message").val() == "" ? hasErrors = true : "";

      if (!hasErrors) {
        var options = {
          type: "POST",
          data: {
            _token: csrf_token,
            message: value
          },
          url: "/chats/".concat(selectedId, "/send"),
          success: function success(data) {
            console.log(data);
          },
          error: function error(err) {
            console.log(err);
          }
        };
        $.ajax(options);
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/chats/toggleOnline.js":
/*!********************************************!*\
  !*** ./resources/js/chats/toggleOnline.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var toggleOnlineChannel = pusher.subscribe("toggle-online");
toggleOnlineChannel.bind("toggle-online", function (data) {
  if (data.online == 1) {
    $(".chats .ball".concat(data.id)).removeClass("offline").addClass("online");
  } else {
    $(".chats .ball".concat(data.id)).removeClass("online").addClass("offline");
  }
});

/***/ }),

/***/ "./resources/js/helpers.js":
/*!*********************************!*\
  !*** ./resources/js/helpers.js ***!
  \*********************************/
/*! exports provided: Helpers */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Helpers", function() { return Helpers; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Helpers = /*#__PURE__*/function () {
  function Helpers() {
    _classCallCheck(this, Helpers);
  }

  _createClass(Helpers, [{
    key: "timeSince",
    value: // time since
    function timeSince(date) {
      var seconds = Math.floor((new Date() - date) / 1000);
      var interval = seconds / 31536000;

      if (interval > 1) {
        return Math.floor(interval) + " years";
      }

      interval = seconds / 2592000;

      if (interval > 1) {
        return Math.floor(interval) + " months";
      }

      interval = seconds / 86400;

      if (interval > 1) {
        return Math.floor(interval) + " days";
      }

      interval = seconds / 3600;

      if (interval > 1) {
        return Math.floor(interval) + " hours";
      }

      interval = seconds / 60;

      if (interval > 1) {
        return Math.floor(interval) + " minutes";
      }

      return Math.floor(seconds) + " seconds";
    }
  }]);

  return Helpers;
}();

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\test\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\test\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });