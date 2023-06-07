$('#dark-theme').click(function(){
    $('.main-container').addClass('dark');
    localStorage.setItem('darkMode', true);

    swal({
        title: "Tema Aplicado",
        text: "Tema oscuro aplicado con exito.",
        icon: "success",
        button: "¡Perfecto!",
      });
});

$('#light-theme').click(function(){
    $('.main-container').removeClass('dark');
    localStorage.removeItem('darkMode');

    swal({
        title: "Tema Aplicado",
        text: "Tema claro aplicado con exito.",
        icon: "success",
        button: "¡Perfecto!",
      });
});

$("#update_profile").click(function(){
  var dataForm = {
    name: jQuery("#user_name").val(),
    email: jQuery("#user_email").val(),
    phone: jQuery("#user_phone").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $(this).data("token"),
    },
  });
  jQuery
    .ajax({
      url: "/update-user/" + $('#user_id').val(),
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');

        swal({
          title: "Exitoso",
          text: "Información de usuario actualizada.",
          icon: "success",
          button: "¡Perfecto!",
        });

        $(".main-body").load("/settings");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      alert('Ocurrio un error inesperado. Intente mas tarde.');
      $('.loading').css('display', 'none');
    });
});

// * CURRENT PASSWORD VISIBILITY

$('#show_current_password').click(function(){
  $('#current_password').attr("type", "text");
  $(this).css('display', 'none');
  $('#hide_current_password').css('display', 'block');
});

$('#hide_current_password').click(function(){
  $('#current_password').attr("type", "password");
  $(this).css('display', 'none');
  $('#show_current_password').css('display', 'block');
});

// * NEW PASSWORD VISIBILITY

$('#show_new_password').click(function(){
  $('#new_password').attr("type", "text");
  $(this).css('display', 'none');
  $('#hide_new_password').css('display', 'block');
});

$('#hide_new_password').click(function(){
  $('#new_password').attr("type", "password");
  $(this).css('display', 'none');
  $('#show_new_password').css('display', 'block');
});

// * CONFIRM PASSWORD VISIBILITY

$('#show_confirm_password').click(function(){
  $('#confirm_password').attr("type", "text");
  $(this).css('display', 'none');
  $('#hide_confirm_password').css('display', 'block');
});

$('#hide_confirm_password').click(function(){
  $('#confirm_password').attr("type", "password");
  $(this).css('display', 'none');
  $('#show_confirm_password').css('display', 'block');
});

$("#update_password").click(function(){
  var dataForm = {
    old_password: jQuery("#current_password").val(),
    new_password: jQuery("#new_password").val(),
    new_password_confirmation: jQuery("#confirm_password").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $(this).data("token"),
    },
  });
  jQuery
    .ajax({
      url: "/update-password/" + $('#user_id').val(),
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');

        swal({
          title: "Exitoso",
          text: "Información de usuario actualizada.",
          icon: "success",
          button: "¡Perfecto!",
        });

        $(".main-body").load("/settings");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseJSON.message);
      swal({
        title: "Error",
        text: jqXHR.responseJSON.message,
        icon: "error",
        button: "Entendido",
      });
      $('.loading').css('display', 'none');
    });
});