const { Helpers } = require("./helpers");

require("./chats/index");
require("./chats/toggleOnline");

(function() {
  $(".btn-file").on("click", function() {
    let inputFile = $(this).prev()[0];
    inputFile.click();
    let img = $(inputFile)
      .next(".btn-file")
      .next("img");
    inputFile.addEventListener("change", function() {
      let file = inputFile.files[0];
      let fileReader = new FileReader();
      fileReader.onload = function(e) {
        let fileResult = e.target.result;
        img.removeAttr("hidden");
        img.attr("src", fileResult);
        $(inputFile)
          .next(".btn-file")
          .text(file.name);
      };
      fileReader.readAsDataURL(file);
    });
  });
})();
