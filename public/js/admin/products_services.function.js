$("#summary-btn_p").on("click", function () {
  $(this).find(".drop-icon").toggleClass("rotate");
  $("#summary_p").toggleClass("show");
});

$("#summary-btn_s").on("click", function () {
  $(this).find(".drop-icon").toggleClass("rotate");
  $("#summary_s").toggleClass("show");
});

$('#newProductButton').click(function () {
  jQuery("#product_name-error").html('');
  jQuery("#product_quantity-error").html('');
  jQuery("#product_price-error").html('');

  jQuery("#product_name").val('');
  jQuery("#product_quantity").val('');
  jQuery("#product_price").val('');
  jQuery("#product_id").val('');

  $('#product-modal').addClass('show');
  $('.modal-shadow').addClass('show');

  $("#product-modal-title").html("Crear Nuevo Producto");
  $('#update-product-button').css('display', 'none');
  $('#submit-product-button').css('display', 'block');
})

$('#newServiceButton').click(function () {
  jQuery("#service_name-error").html('');
  jQuery("#service_price-error").html('');

  $('#service-modal').addClass('show');
  $('.modal-shadow').addClass('show');

  jQuery("#service_name").val('');
  jQuery("#service_price").val('');
  jQuery("#service_id").val('');

  $("#service-modal-title").html("Crear Nuevo Servicio");
  $('#update-service-button').css('display', 'none');
  $('#submit-service-button').css('display', 'block');
})

// * PRODUCTS SUBMIT

$('#submit-product-button').click(function () {
  $('.loading').css('display', 'flex');
  var dataForm = {
    name: jQuery("#product_name").val(),
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

      $('.loading').css('display', 'none');

      swal({
        title: "Exitoso",
        text: result.message,
        icon: "success",
        button: "¡Perfecto!",
      });

      jQuery("#product_name").val('');
      jQuery("#product_quantity").val('');
      jQuery("#product_price").val('');

      $('.main-body').load('/services-products');

    },
  }).fail(function (jqXHR, textStatus, errorThrown) {
    if (jqXHR.responseJSON.errors.name) {
      $("#product_name-error").html(jqXHR.responseJSON.errors.name);
    }

    if (jqXHR.responseJSON.errors.quantity) {
      $("#product_quantity-error").html(jqXHR.responseJSON.errors.quantity);
    }

    if (jqXHR.responseJSON.errors.price) {
      $("#product_price-error").html(jqXHR.responseJSON.errors.price);
    }

    $('.loading').css('display', 'none');
  });

  jQuery("#product_name-error").html('');
  jQuery("#product_quantity-error").html('');
  jQuery("#product_price-error").html('');
});


// * SERVICE SUBMIT

$('#submit-service-button').click(function () {
  $('.loading').css('display', 'flex');
  var dataForm = {
    name: jQuery("#service_name").val(),
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

      $('.loading').css('display', 'none');

      swal({
        title: "Exitoso",
        text: result.message,
        icon: "success",
        button: "¡Perfecto!",
      });

      jQuery("#service_name").val('');
      jQuery("#service_price").val('');

      $('.main-body').load('/services-products');

    },
  }).fail(function (jqXHR, textStatus, errorThrown) {
    if (jqXHR.responseJSON.errors.name) {
      $("#service_name-error").html(jqXHR.responseJSON.errors.name);
    }

    if (jqXHR.responseJSON.errors.price) {
      $("#service_price-error").html(jqXHR.responseJSON.errors.price);
    }

    $('.loading').css('display', 'none');
  });

  $("#service_name-error").html("");
  $("#service_price-error").html("");
});

// * UPDATE SECTION

// PRODUCTS

$(".edit-product").click(function (e) {
  $('.loading').css('display', 'flex');
  e.preventDefault();
  $('#update-product-button').css('display', 'block');
  $('#submit-product-button').css('display', 'none');
  jQuery.ajax({
    url: $(this).attr("href"),
    method: "get",
    success: function (result) {
      $('.loading').css('display', 'none');
      jQuery("#product_name").val(result.product.name);
      jQuery("#product_quantity_text").html(result.product.quantity);
      jQuery("#product_price").val(result.product.price);
      jQuery("#product_id").val(result.product.id);

      $("#product-modal-title").html("Editar Producto");

      $("#product-modal").addClass("show");
      $(".modal-shadow").addClass("show");
    },
  });
});

$("#update-product-button").click(function () {
  $('.loading').css('display', 'flex');
  var dataForm = {
    name: jQuery("#product_name").val(),
    quantity: parseFloat(jQuery("#product_quantity_text").html()) + parseFloat(jQuery("#product_quantity").val()),
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

        $('.loading').css('display', 'none');

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

      $('.loading').css('display', 'none');
    });

  jQuery("#product_name-error").html('');
  jQuery("#product_quantity-error").html('');
  jQuery("#product_price-error").html('');
});

// * SERVICES

$(".edit-service").click(function (e) {
  $('.loading').css('display', 'flex');
  e.preventDefault();
  $('#update-service-button').css('display', 'block');
  $('#submit-service-button').css('display', 'none');
  jQuery.ajax({
    url: $(this).attr("href"),
    method: "get",
    success: function (result) {
      $('.loading').css('display', 'none');
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
  $('.loading').css('display', 'flex');
  var dataForm = {
    name: jQuery("#service_name").val(),
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

        $('.loading').css('display', 'none');

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

      $('.loading').css('display', 'none');
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
      $('.loading').css('display', 'flex');
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
          $('.loading').css('display', 'none');
          $(".main-body").load("/services-products");
        },
      });
      swal("¡Se eliminó el producto correctamente!", {
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
      $('.loading').css('display', 'flex');
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
          $('.loading').css('display', 'none');
          $(".main-body").load("/services-products");
        },
      });
      swal("¡Se eliminó el servicio correctamente!", {
        icon: "success",
      });
    } else {
      swal("Acción cancelada.");
    }
  });
});