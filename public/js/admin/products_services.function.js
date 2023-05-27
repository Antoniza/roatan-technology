$("#summary-btn_p").on("click", function () {
  $(this).find(".drop-icon").toggleClass("rotate");
  $("#summary_p").toggleClass("show");
});

$("#summary-btn_s").on("click", function () {
  $(this).find(".drop-icon").toggleClass("rotate");
  $("#summary_s").toggleClass("show");
});

$('#newProductButton').click(function () {
  $('#product-modal').addClass('show');
  $('.modal-shadow').addClass('show');
  $("#technical-modal-title").html("Crear Nuevo Producto");
  $('#update-product-button').css('display', 'none');
  $('#submit-product-button').css('display', 'block');
})

$('#newServiceButton').click(function () {
  $('#service-modal').addClass('show');
  $('.modal-shadow').addClass('show');
  jQuery("#service_name").val('');
  jQuery("#service_price").val('');
  jQuery("#service_id").val('');
  $("#service-modal-title").html("Crear Nuevo Servicio");
  $('#update-service-button').css('display', 'none');
  $('#submit-service-button').css('display', 'block');
})

// * PRODUCTS SECTION

$('#submit-product-button').click(function () {
  var dataForm = {
    name: jQuery("#product_name").val(),
    type: 'product',
    quantity: jQuery("#product_quantity").val(),
    price: jQuery("#product_price").val(),
    user_id: jQuery("#user_id").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery.ajax({
    url: "/products",
    method: "post",
    data: dataForm,
    success: function (result) {

      $('#product-modal').removeClass('show');
      $('.modal-shadow').removeClass('show');

      swal({
        title: "Exitoso",
        text: result.message,
        icon: "success",
        button: "¡Perfecto!",
      });

      $('.main-body').load('/services-products');

    },
  }).fail(function (jqXHR, textStatus, errorThrown) {
    if (jqXHR.responseJSON.errors.name) {
      $("#technical_name-error").html(jqXHR.responseJSON.errors.name);
    }

    if (jqXHR.responseJSON.errors.speciality) {
      $("#technical_speciality-error").html(jqXHR.responseJSON.errors.speciality);
    }

    if (jqXHR.responseJSON.errors.email) {
      $("#technical_email-error").html(jqXHR.responseJSON.errors.email);
    }

    if (jqXHR.responseJSON.errors.phone) {
      $("#technical_phone-error").html(jqXHR.responseJSON.errors.phone);
    }
  });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});


// * SERVICE SECTION

$('#submit-service-button').click(function () {
  var dataForm = {
    name: jQuery("#service_name").val(),
    type: 'service',
    quantity: 0,
    price: jQuery("#service_price").val(),
    user_id: jQuery("#user_id").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery.ajax({
    url: "/services",
    method: "post",
    data: dataForm,
    success: function (result) {

      $('#service-modal').removeClass('show');
      $('.modal-shadow').removeClass('show');

      swal({
        title: "Exitoso",
        text: result.message,
        icon: "success",
        button: "¡Perfecto!",
      });

      $('.main-body').load('/services-products');

    },
  }).fail(function (jqXHR, textStatus, errorThrown) {
    if (jqXHR.responseJSON.errors.name) {
      $("#technical_name-error").html(jqXHR.responseJSON.errors.name);
    }

    if (jqXHR.responseJSON.errors.speciality) {
      $("#technical_speciality-error").html(jqXHR.responseJSON.errors.speciality);
    }

    if (jqXHR.responseJSON.errors.email) {
      $("#technical_email-error").html(jqXHR.responseJSON.errors.email);
    }

    if (jqXHR.responseJSON.errors.phone) {
      $("#technical_phone-error").html(jqXHR.responseJSON.errors.phone);
    }
  });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

// * UPDATE SECTION

// PRODUCTS

$(".edit-product").click(function (e) {
  e.preventDefault();
  $('#update-product-button').css('display', 'block');
  $('#submit-product-button').css('display', 'none');
  jQuery.ajax({
    url: $(this).attr("href"),
    method: "get",
    success: function (result) {
      jQuery("#product_name").val(result.product.name);
      jQuery("#product_quantity").val(result.product.quantity);
      jQuery("#product_price").val(result.product.price);
      jQuery("#product_id").val(result.product.id);

      $("#product-modal-title").html("Editar Técnico");

      $("#product-modal").addClass("show");
      $(".modal-shadow").addClass("show");
    },
  });
});

$("#update-product-button").click(function () {
  var dataForm = {
    name: jQuery("#product_name").val(),
    type: 'product',
    quantity: jQuery("#product_quantity").val(),
    price: jQuery("#product_price").val(),
    user_id: jQuery("#user_id").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery
    .ajax({
      url: "/products/" + jQuery("#product_id").val(),
      method: "post",
      data: dataForm,
      success: function (result) {
        jQuery("#product_name").val('');
        jQuery("#product_quantity").val('');
        jQuery("#product_price").val('');
        jQuery("#product_id").val('');

        $("#product-modal").removeClass("show");
        $(".modal-shadow").removeClass("show");

        swal({
          title: "Exitoso",
          text: result.message,
          icon: "success",
          button: "¡Perfecto!",
        });

        $('.main-body').load('/services-products');
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
    });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

// * SERVICES

$(".edit-service").click(function (e) {
  e.preventDefault();
  $('#update-service-button').css('display', 'block');
  $('#submit-service-button').css('display', 'none');
  jQuery.ajax({
    url: $(this).attr("href"),
    method: "get",
    success: function (result) {
      jQuery("#service_name").val(result.service.name);
      jQuery("#service_price").val(result.service.price);
      jQuery("#service_id").val(result.service.id);

      $("#service-modal-title").html("Editar Servicio");

      $("#service-modal").addClass("show");
      $(".modal-shadow").addClass("show");
    },
  });
});

$("#update-service-button").click(function () {
  var dataForm = {
    name: jQuery("#service_name").val(),
    type: 'service',
    quantity: 0,
    price: jQuery("#service_price").val(),
    user_id: jQuery("#user_id").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery
    .ajax({
      url: "/services/" + jQuery("#service_id").val(),
      method: "post",
      data: dataForm,
      success: function (result) {
        jQuery("#service_name").val('');
        jQuery("#service_price").val('');
        jQuery("#service_id").val('');

        $("#service-modal").removeClass("show");
        $(".modal-shadow").removeClass("show");

        swal({
          title: "Exitoso",
          text: result.message,
          icon: "success",
          button: "¡Perfecto!",
        });

        $('.main-body').load('/services-products');
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
    });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

// * DELETE FUNCTIONS

$(".deleteProduct").click(function () {
  swal({
    title: "Eliminando",
    text: "Se borraran los datos de este producto. ¿Desea continuar?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      var id = $(this).data("id");
      var token = $(this).data("token");
      $.ajax({
        url: "/products/" + id,
        type: "DELETE",
        dataType: "JSON",
        data: {
          id: id,
          _method: "DELETE",
          _token: token,
        },
        success: function () {
          $(".main-body").load("/services-products");
        },
      });
      swal("!Se eliminó el producto correctamente!", {
        icon: "success",
      });
    } else {
      swal("Acción cancelada.");
    }
  });
});

$(".deleteService").click(function () {
  swal({
    title: "Eliminando",
    text: "Se borraran los datos de este servicio. ¿Desea continuar?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      var id = $(this).data("id");
      var token = $(this).data("token");
      $.ajax({
        url: "/services/" + id,
        type: "DELETE",
        dataType: "JSON",
        data: {
          id: id,
          _method: "DELETE",
          _token: token,
        },
        success: function () {
          $(".main-body").load("/services-products");
        },
      });
      swal("!Se eliminó el servicio correctamente!", {
        icon: "success",
      });
    } else {
      swal("Acción cancelada.");
    }
  });
});