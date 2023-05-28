$("#submit-technical-button").click(function () {
  var dataForm = {
    name: jQuery("#technical_name").val(),
    speciality: jQuery("#technical_speciality").find(":selected").val(),
    phone: jQuery("#technical_phone").val(),
    email: jQuery("#technical_email").val(),
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery
    .ajax({
      url: "/technicals",
      method: "post",
      data: dataForm,
      success: function (result) {
        jQuery("#technical_name").val("");
        jQuery("#technical_speciality").val("");
        jQuery("#technical_phone").val("");
        jQuery("#technical_email").val("");

        $("#technical-modal").removeClass("show");
        $(".modal-shadow").removeClass("show");

        swal({
          title: "Exitoso",
          text: result.message,
          icon: "success",
          button: "¡Perfecto!",
        });

        $(".main-body").load("/technicals");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      $("#technical_email-error").html(
        'Este correo ya existe'
      );
    });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

$("#newTechnicalButton").click(function () {

  $("#technical-modal").addClass("show");
  $(".modal-shadow").addClass("show");
  $("#technical-modal-title").html("Crear Nuevo Técnico");
  jQuery("#technical_name").val("");
  jQuery("#technical_speciality").val("");
  jQuery("#technical_phone").val("");
  jQuery("#technical_email").val("");
  $("#technical_email-error").html("");

  $('#update-technical-button').css('display', 'none');
  $('#submit-technical-button').css('display', 'block');
});

$("#technical_phone").inputmask("+(999) 9999-9999");

$(".deleteTechnical").click(function () {
  swal({
    title: "Eliminando",
    text: "Se borraran los datos de este técnico. ¿Desea continuar?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      var id = $(this).data("id");
      var token = $(this).data("token");
      $.ajax({
        url: "/technicals/" + id,
        type: "DELETE",
        dataType: "JSON",
        data: {
          id: id,
          _method: "DELETE",
          _token: token,
        },
        success: function () {
          $(".main-body").load("/technicals");
        },
      });
      swal("!Se eliminó el técnico correctamente!", {
        icon: "success",
      });
    } else {
      swal("Acción cancelada.");
    }
  });
});

$("#update-technical-button").click(function () {
  var dataForm = {
    name: jQuery("#technical_name").val(),
    speciality: jQuery("#technical_speciality").find(":selected").val(),
    phone: jQuery("#technical_phone").val(),
    email: jQuery("#technical_email").val(),
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery
    .ajax({
      url: "/technicals/" + jQuery("#technical_id").val(),
      method: "post",
      data: dataForm,
      success: function (result) {
        jQuery("#technical_name").val("");
        jQuery("#technical_speciality").val("");
        jQuery("#technical_phone").val("");
        jQuery("#technical_email").val("");

        $("#technical-modal").removeClass("show");
        $(".modal-shadow").removeClass("show");

        swal({
          title: "Exitoso",
          text: result.message,
          icon: "success",
          button: "¡Perfecto!",
        });

        $(".main-body").load("/technicals");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      $("#technical_email-error").html(
        'Este correo ya existe'
      );
    });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

$(".edit-technical").click(function (e) {
  e.preventDefault();
  $('#update-technical-button').css('display', 'block');
  $('#submit-technical-button').css('display', 'none');
  jQuery.ajax({
    url: $(this).attr("href"),
    method: "get",
    success: function (result) {
      jQuery("#technical_id").val(result.technicals.id);
      jQuery("#technical_name").val(result.technicals.name);
      jQuery("#technical_speciality").val(result.technicals.speciality);
      jQuery("#technical_phone").val(result.technicals.phone);
      jQuery("#technical_email").val(result.technicals.email);

      $("#technical-modal-title").html("Editar Técnico");

      $("#technical_email-error").html("");
      $("#technical-modal").addClass("show");
      $(".modal-shadow").addClass("show");
    },
  });
});
