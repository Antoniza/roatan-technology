$("#newRepairButton").click(function () {
  $(".main-body").load("/new-repair");
});

// * SAVE REPAIR DATA

$("#submit-repair-button").click(function () {
  $('.loading').css('display', 'flex');
  let input = jQuery("#client_phone").val().replace(/[^0-9]/g, '');
  var dataForm = {
    repair_code: "R-" + Math.floor(Math.random() * 999999),
    client_name: jQuery("#client_name").val(),
    client_email: jQuery("#client_email").val(),
    client_phone: jQuery("#client_phone").val().replace(/[^0-9]/g, ''),
    device: jQuery("#client_device").val(),
    service_required: jQuery("#repair_service").find(":selected").val(),
    technical: jQuery("#repair_technical").find(":selected").val(),
    observations: jQuery("#observations").val(),
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val(),
    },
  });
  jQuery
    .ajax({
      url: "/new-repair",
      method: "post",
      data: dataForm,
      success: function (result) {
        jQuery("#client_name").val();
        jQuery("#email_speciality").val();
        jQuery("#client_phone").val();
        jQuery("#client_device").val();

        $('.loading').css('display', 'none');

        swal({
          title: result.message,
          text: "Codigo de reparación: " + dataForm.repair_code,
          icon: "success",
          button: "¡Perfecto!",
        });

        $(".main-body").load("/repairs");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      swal("" + jqXHR.responseJSON.message + "", {
        icon: "error",
        button: 'Entendido'
      });

      $('.loading').css('display', 'none');
    });

  $("#technical_name-error").html("");
  $("#technical_speciality-error").html("");
  $("#technical_email-error").html("");
  $("#technical_phone-error").html("");
});

// * CANCEL REPAIR BUTTON

$(".cancel_repair").click(function () {
  swal({
    title: "Precaución",
    text: "Se cancelara esta reparación. ¿Desea continuar?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $('.loading').css('display', 'flex');
      var id = $(this).data("id");
      var token = $(this).data("token");
      $.ajax({
        url: "/cancel-repair/" + id,
        type: "DELETE",
        dataType: "JSON",
        data: {
          id: id,
          _method: "DELETE",
          _token: token,
        },
        success: function (result) {
          $('.loading').css('display', 'none');
          swal("¡" + result.message + "!", {
            icon: "success",
          });
          $(".main-body").load("/repairs");
        },
      });
    } else {
      $('.loading').css('display', 'none');
      swal("Acción cancelada.");
    }
  });
});

// * GO TO COMPLETE REPAIR

$(".complete_repair").click(function () {
  var id = $(this).data("id");
  $(".main-body").load("/complete-repair/" + id);
});

// * FINISH REPAIR
$(".finish_repair").click(function () {
  $('.loading').css('display', 'flex');
  var id = $(this).data("id");
  var token = $(this).data("token");
  $.ajax({
    url: "/finish-repair/" + id,
    type: "patch",
    dataType: "JSON",
    data: {
      id: id,
      _method: "PATCH",
      _token: token,
    },
    success: function (result) {
      $('.loading').css('display', 'none');
      swal("¡" + result.message + "!", {
        icon: "success",
      });
      $(".main-body").load("/repairs");
    },
  });
});

// * SEARCH PRODUCT FOR REPAIR
// TODO: PREPARING ENVIROMENT
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

// * LIVE SEARCHING PRODUCTS
$("#product_search").autocomplete({
  source: function (request, response) {
    // Fetch data
    $.ajax({
      url: "/search-products",
      type: "post",
      dataType: "json",
      data: {
        _token: CSRF_TOKEN,
        search: request.term,
      },
      success: function (data) {
        response(data);
      },
    });
  },
  select: function (event, ui) {
    $("#product_search").val(ui.item.label);
    $("#item_id").val(ui.item.value);
    return false;
  },
});

$("#service_search").autocomplete({
  source: function (request, response) {
    // Fetch data
    $.ajax({
      url: "/search-service",
      type: "post",
      dataType: "json",
      data: {
        _token: CSRF_TOKEN,
        search: request.term,
      },
      success: function (data) {
        response(data);
      },
    });
  },
  select: function (event, ui) {
    $("#service_search").val(ui.item.label);
    $("#item_id_service").val(ui.item.value);
    return false;
  },
});

$("#quantity").keypress(function (event) {
  var keycode = event.keyCode ? event.keyCode : event.which;
  if (keycode == "13") {
    var dataForm = {
      item: jQuery("#item_id").val(),
      quantity: jQuery("#quantity").val(),
    };
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": CSRF_TOKEN,
      },
    });
    jQuery.ajax({
      url: "/get-product",
      method: "get",
      data: dataForm,
      success: function (result) {
        if (result.data.quantity <= 0) {
          swal(
            "Elemento acabado",
            "Este elemento se ha acabado. Actualice el inventario.",
            "error",
            {
              button: "Entendido",
            }
          );
        } else if (result.data.quantity < jQuery("#quantity").val()) {
          swal(
            "Elemento insuficiente",
            "No hay suficiente cantidad de este elemento en inventario.",
            "warning",
            {
              button: "Entendido",
            }
          );
        } else {
          jQuery("#item_id").val("");
          jQuery("#product_search").val("");
          jQuery("#quantity").val(1);
          jQuery("#product_search").focus();

          let data = result.data;

          let table = $("#product-list tbody");

          let markup = "";

          markup =
            `
            <tr id='item' data-product_id=${data.id} data-type='product'>
              <td>${result.quantity}</td>
              <td>${data.name}</td>
              <td>${data.price.toFixed(2)}</td>
              <td>${(data.price * result.quantity).toFixed(2)}</td>
            </tr>
          `;

          table.append(markup);

          var subtotalt = parseFloat($("#subtotal").html());
          $("#subtotal").html(
            (subtotalt + data.price * result.quantity).toFixed(2) +
            " Lps"
          );

          subtotalt = parseFloat($("#subtotal").html());

          let isv = subtotalt * 0.15;
          $("#isv").html((isv).toFixed(2) + " Lps");

          let totalt = parseFloat($("#total").html());
          $("#total").html((subtotalt + isv).toFixed(2) + " Lps");

          // TODO: DOUBLE CLICK IN ROW TO DELETE RECORD
          $("#product-list tbody tr").dblclick(function (e) {
            let item = this;

            swal({
              title: "Eliminando elemento",
              text: "Se eliminara el elemento seleccionado",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                swal("¡Se eliminó con exito de la lista!", {
                  icon: "success",
                });
                // * GETTING QUANTITY OF THE PRODUCT IN ROW
                let stringQuantity = String(item.innerHTML.split("\n")[1]);
                let stringQuantityContent = stringQuantity.trim();
                let quantity = stringQuantityContent.substring(
                  4,
                  stringQuantityContent.length - 5
                );

                // * GETTING NAME OF THE PRODUCT IN ROW
                let stringName = String(item.innerHTML.split("\n")[2]);
                let stringNameContent = stringName.trim();
                let name = stringNameContent.substring(
                  4,
                  stringNameContent.length - 5
                );

                // * GETTING PRICES OF THE PRODUCT IN ROW
                let stringPrice = String(item.innerHTML.split("\n")[3]);
                let stringPriceContent = stringPrice.trim();
                let price = stringPriceContent.substring(
                  4,
                  stringPriceContent.length - 5
                );

                // * GETTING TOTAL OF PRODUCT IN ROW
                let stringTotal = String(item.innerHTML.split("\n")[4]);
                let stringTotalContent = stringTotal.trim();
                let total = stringTotalContent.substring(
                  4,
                  stringTotalContent.length - 5
                );

                let subtotalt = parseFloat($("#subtotal").html());
                $("#subtotal").html((subtotalt - quantity * price).toFixed(2) + " Lps");

                subtotalt = parseFloat($("#subtotal").html());
                let isv = subtotalt * 0.15;
                $("#isv").html((isv).toFixed(2) + " Lps");

                let totalt = parseFloat($("#total").html());
                $("#total").html((subtotalt + isv).toFixed(2) + " Lps");

                $(this).remove();
              } else {
                swal("Se cancelo la acción");
              }
            });
          });
        }
      },
    });
  }
});

$('#add-servicer_table').click(function(){
  var dataForm = {
    item: jQuery("#item_id_service").val(),
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": CSRF_TOKEN,
    },
  });
  jQuery.ajax({
    url: "/get-service",
    method: "get",
    data: dataForm,
    success: function (result) {
      jQuery("#item_id_service").val("");
        jQuery("#services_search").val("");
        jQuery("#product_search").focus();

        let data = result.data;

        let table = $("#product-list tbody");

        let markup = "";

        markup =
          `
          <tr id='item' data-product_id=${data.id} data-type='service'>
            <td>1</td>
            <td>${data.name}</td>
            <td>${data.price.toFixed(2)}</td>
            <td>${(data.price).toFixed(2)}</td>
          </tr>
        `;

        table.append(markup);

        var subtotalt = parseFloat($("#subtotal").html());
        $("#subtotal").html(
          (subtotalt + data.price).toFixed(2) +
          " Lps"
        );

        subtotalt = parseFloat($("#subtotal").html());

        let isv = subtotalt * 0.15;
        $("#isv").html((isv).toFixed(2) + " Lps");

        let totalt = parseFloat($("#total").html());
        $("#total").html((subtotalt + isv).toFixed(2) + " Lps");

        // TODO: DOUBLE CLICK IN ROW TO DELETE RECORD
        $("#product-list tbody tr").dblclick(function (e) {
          let item = this;

          swal({
            title: "Eliminando elemento",
            text: "Se eliminara el elemento seleccionado",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
              swal("¡Se eliminó con exito de la lista!", {
                icon: "success",
              });
              // * GETTING QUANTITY OF THE PRODUCT IN ROW
              let stringQuantity = String(item.innerHTML.split("\n")[1]);
              let stringQuantityContent = stringQuantity.trim();
              let quantity = stringQuantityContent.substring(
                4,
                stringQuantityContent.length - 5
              );

              // * GETTING NAME OF THE PRODUCT IN ROW
              let stringName = String(item.innerHTML.split("\n")[2]);
              let stringNameContent = stringName.trim();
              let name = stringNameContent.substring(
                4,
                stringNameContent.length - 5
              );

              // * GETTING PRICES OF THE PRODUCT IN ROW
              let stringPrice = String(item.innerHTML.split("\n")[3]);
              let stringPriceContent = stringPrice.trim();
              let price = stringPriceContent.substring(
                4,
                stringPriceContent.length - 5
              );

              // * GETTING TOTAL OF PRODUCT IN ROW
              let stringTotal = String(item.innerHTML.split("\n")[4]);
              let stringTotalContent = stringTotal.trim();
              let total = stringTotalContent.substring(
                4,
                stringTotalContent.length - 5
              );

              let subtotalt = parseFloat($("#subtotal").html());
              $("#subtotal").html((subtotalt - quantity * price).toFixed(2) + " Lps");

              subtotalt = parseFloat($("#subtotal").html());
              let isv = subtotalt * 0.15;
              $("#isv").html((isv).toFixed(2) + " Lps");

              let totalt = parseFloat($("#total").html());
              $("#total").html((subtotalt + isv).toFixed(2) + " Lps");

              $(this).remove();
            } else {
              swal("Se cancelo la acción");
            }
          });
        });
    },
  });
});

// TODO: DOUBLE CLICK IN ROW TO DELETE RECORD
$("#product-list tbody tr").dblclick(function (e) {
  let item = this;

  swal({
    title: "Eliminando elemento",
    text: "Se eliminara el elemento seleccionado",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      swal("¡Se eliminó con exito de la lista!", {
        icon: "success",
      });
      // * GETTING QUANTITY OF THE PRODUCT IN ROW
      let stringQuantity = String(item.innerHTML.split("\n")[1]);
      let stringQuantityContent = stringQuantity.trim();
      let quantity = stringQuantityContent.substring(
        4,
        stringQuantityContent.length - 5
      );

      // * GETTING NAME OF THE PRODUCT IN ROW
      let stringName = String(item.innerHTML.split("\n")[2]);
      let stringNameContent = stringName.trim();
      let name = stringNameContent.substring(
        4,
        stringNameContent.length - 5
      );

      // * GETTING PRICES OF THE PRODUCT IN ROW
      let stringPrice = String(item.innerHTML.split("\n")[3]);
      let stringPriceContent = stringPrice.trim();
      let price = stringPriceContent.substring(
        4,
        stringPriceContent.length - 5
      );

      // * GETTING TOTAL OF PRODUCT IN ROW
      let stringTotal = String(item.innerHTML.split("\n")[4]);
      let stringTotalContent = stringTotal.trim();
      let total = stringTotalContent.substring(
        4,
        stringTotalContent.length - 5
      );

      let subtotalt = parseFloat($("#subtotal").html());
      $("#subtotal").html((subtotalt - quantity * price).toFixed(2) + " Lps");

      subtotalt = parseFloat($("#subtotal").html());
      let isv = subtotalt * 0.15;
      $("#isv").html((isv).toFixed(2) + " Lps");

      let totalt = parseFloat($("#total").html());
      $("#total").html((subtotalt + isv).toFixed(2) + " Lps");

      $(this).remove();
    } else {
      swal("Se cancelo la acción");
    }
  });
});

// * REPAIR DETAILS ARRAY
var details = [];

// * CONTINUE REPAIR BUTTON
$('#complete_repair').click(function () {
  $('.loading').css('display', 'flex');
  let list = $('#product-list tbody tr');
  let totalRepair = 0;

  for (let i = 0; i < list.length; i++) {

    let id = $(list[i]).data('product_id');
    console.log(id);

    // * GETTING QUANTITY OF THE PRODUCT IN ROW
    let stringQuantity = String(list[i].innerHTML.split('\n')[1]);
    let stringQuantityContent = stringQuantity.trim();
    let quantity = stringQuantityContent.substring(4, stringQuantityContent.length - 5);

    // * GETTING NAME OF THE PRODUCT IN ROW
    let stringName = String(list[i].innerHTML.split('\n')[2]);
    let stringNameContent = stringName.trim();
    let name = stringNameContent.substring(4, stringNameContent.length - 5);

    // * GETTING PRICES OF THE PRODUCT IN ROW
    let stringPrice = String(list[i].innerHTML.split('\n')[3]);
    let stringPriceContent = stringPrice.trim();
    let price = stringPriceContent.substring(4, stringPriceContent.length - 5);

    // * GETTING TOTAL OF PRODUCT IN ROW
    let stringTotal = String(list[i].innerHTML.split('\n')[4]);
    let stringTotalContent = stringTotal.trim();
    let total = stringTotalContent.substring(4, stringTotalContent.length - 5);

    // * ADDING ROW TO SALE DETAIL
    details.push({
      id,
      quantity,
      name,
      type: $(list[i]).data('type'),
      price: price + ' Lps',
      total: total + ' Lps'
    })
  }

  console.log(parseFloat($('#total').html()));

  $.ajax({
    url: "/complete-repair/" + $('#repair_id').val(),
    type: "patch",
    dataType: "JSON",
    data: {
      repair_details: details,
      total: parseFloat($('#subtotal').html()),
      _method: "PATCH",
      _token: CSRF_TOKEN,
    },
    success: function (result) {
      $('.loading').css('display', 'none');
      swal("¡" + result.message + "!", {
        icon: "success",
      });
      $(".main-body").load("/repairs");
    },
  });

});

// * CANCEL COMPLETE REPAIR

$('#cancel_complete_repair').click(function () {
  $(".main-body").load("/repairs");
});

$("#add_service").click(function () {

  $("#add-service").addClass("show");
});