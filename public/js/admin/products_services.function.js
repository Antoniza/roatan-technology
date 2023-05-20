$("#summary-btn_p").on("click", function () {
  $(this).find(".drop-icon").toggleClass("rotate");
  $("#summary_p").toggleClass("show");
});

$("#summary-btn_s").on("click", function () {
  $(this).find(".drop-icon").toggleClass("rotate");
  $("#summary_s").toggleClass("show");
});
