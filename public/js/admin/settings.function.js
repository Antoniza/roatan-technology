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