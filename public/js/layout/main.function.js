$(document).ready(function () {
  $("li a").on("click", function (event) {
    event.preventDefault();

    $(".active").removeClass("active");

    $(this).addClass("active");

    $(".profile-menu").removeClass("show");

    $(".main-body").load($(this).attr("href"));
  });

  $(".profile").on("click", function (event) {
    event.preventDefault();

    $(".profile-menu").toggleClass("show");
  });

  $(document).on("contextmenu", "body", function (e) {
    e.preventDefault();
    $(".profile-menu").toggleClass("show");
    console.log("a");
  });

  $(".settings-button").on("click", function (event) {
    event.preventDefault();
    $(".main-body").load($(this).attr("href"));
    $(".active").removeClass("active");
    $(".profile-menu").toggleClass("show");
  });
});
