$(document).ready(function () {

  swal({
    title: "Bienvenido",
    text: "Sea bienvenido " + $('#username').html() + " al sistema.",
    icon: "success",
    button: "¡Perfecto!",
  });

  $("li a").on("click", function (event) {
    event.preventDefault();

    $(".active").removeClass("active");

    $(this).addClass("active");

    $(".profile-menu").removeClass("show");

    $(".main-body").load($(this).attr("href"));
  });

  let darkMode = localStorage.getItem('darkMode');
  if(darkMode){
    $('.main-container').addClass('dark');
  }else{
    $('.main-container').removeClass('dark');
  }

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

  $('.cancel-button').click(function(){
    $('.modal').removeClass('show');
    $('.modal-shadow').removeClass('show');
  });

  $('.modal-shadow').click(function () {
    $('.modal').removeClass('show');
    $(this).removeClass('show');
  })
});

// * SHORTCUTS SETTINGS

$(document).bind('keydown', 'F1', function (e) {
  e.preventDefault();
  $(".main-body").load('/repairs');
  $(".active").removeClass("active");
});

$(document).bind('keydown', 'F2', function (e) {
  e.preventDefault();
  $(".main-body").load('/technicals');
  $(".active").removeClass("active");
});

$(document).bind('keydown', 'F3', function (e) {
  e.preventDefault();
  $(".main-body").load('/services-products');
  $(".active").removeClass("active");
});

$(document).bind('keydown', 'esc', function () {
  $(".main-body").load($(location).attr('href', 'dashboard'));
});