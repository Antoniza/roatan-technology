$("#submit-technical-button").click(function () {
  $('.loading').css('display', 'flex');
  let phone = jQuery("#technical_phone").val().replace(/[^0-9]/g, '');
  var dataForm = {
    name: jQuery("#technical_name").val(),
    speciality: jQuery("#technical_speciality").find(":selected").val(),
    phone,
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

        $('.loading').css('display', 'none');
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
      if (jqXHR.responseJSON.errors.name) {
        $("#technical_name-error").html(jqXHR.responseJSON.errors.name);
      }

      if (jqXHR.responseJSON.errors.speciality) {
        $("#technical_speciality-error").html(
          jqXHR.responseJSON.errors.speciality
        );
      }

      if (jqXHR.responseJSON.errors.email) {
        $("#technical_email-error").html(
          jqXHR.responseJSON.errors.email
        );
      }

      if (jqXHR.responseJSON.errors.phone) {
        $("#technical_phone-error").html(
          jqXHR.responseJSON.errors.phone
        );
      }

      $('.loading').css('display', 'none');
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

  $('#update-technical-button').css('display', 'none');
  $('#submit-technical-button').css('display', 'block');
});

$(".deleteTechnical").click(function () {
  swal({
    title: "Eliminando",
    text: "Se borraran los datos de este técnico. ¿Desea continuar?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $('.loading').css('display', 'flex');
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
          $('.loading').css('display', 'none');
          $(".main-body").load("/technicals");
        },
      });
      swal("¡Se eliminó el técnico correctamente!", {
        icon: "success",
      });
    } else {
      $('.loading').css('display', 'none');
      swal("Acción cancelada.");
    }
  });
});

$("#update-technical-button").click(function () {
  $('.loading').css('display', 'flex');
  var dataForm = {
    name: jQuery("#technical_name").val(),
    speciality: jQuery("#technical_speciality").find(":selected").val(),
    phone: jQuery("#technical_phone").val().replace(/[^0-9]/g, ''),
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

        $('.loading').css('display', 'none');

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
      if (jqXHR.responseJSON.errors.name) {
        $("#technical_name-error").html(jqXHR.responseJSON.errors.name);
      }

      if (jqXHR.responseJSON.errors.speciality) {
        $("#technical_speciality-error").html(
          jqXHR.responseJSON.errors.speciality
        );
      }

      if (jqXHR.responseJSON.errors.email) {
        $("#technical_email-error").html(
          jqXHR.responseJSON.errors.email
        );
      }

      if (jqXHR.responseJSON.errors.phone) {
        $("#technical_phone-error").html(
          jqXHR.responseJSON.errors.phone
        );
      }

      $('.loading').css('display', 'none');
    });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

$(".edit-technical").click(function (e) {
  $('.loading').css('display', 'flex');
  e.preventDefault();
  $('#update-technical-button').css('display', 'block');
  $('#submit-technical-button').css('display', 'none');
  jQuery.ajax({
    url: $(this).attr("href"),
    method: "get",
    success: function (result) {
      $('.loading').css('display', 'none');
      jQuery("#technical_id").val(result.technicals.id);
      jQuery("#technical_name").val(result.technicals.name);
      jQuery("#technical_speciality").val(result.technicals.speciality);
      jQuery("#technical_phone").val(result.technicals.phone);
      jQuery("#technical_email").val(result.technicals.email);

      $("#technical-modal-title").html("Editar Técnico");

      $("#technical-modal").addClass("show");
      $(".modal-shadow").addClass("show");
    },
  });
});
