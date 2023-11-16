/**
 * Script que dotará de funcionalidad al menú para pantallas pequeñas (mobile menu)
 */
$(document).ready(function() {

    $(".mobile_menu").click(function() {
        var iconMenu = $(".mobile_menu");                    // Selector del icono menu mobile        
        var menuMaiNav = $("#main_nav").css("display");      // Se almacena valor de la propiedad css display       

        if(menuMaiNav == "none") {
            iconMenu.attr("src", "./images/menu/menu_close.png");
            $("#main_nav").css("display", "block"); 
        }
        else if(menuMaiNav == "block") {
            $("#main_nav").css("display", "none");   
            iconMenu.attr("src", "./images/menu/menu_open.png");
        }
    })

    $(window).resize(function() {
        var screenWidth = $(window).width();                // Se almacena ancho de pantalla al cambiar de tamaño
        var iconMenu = $(".mobile_menu");                   // Selector del icono menu mobile 

        if(screenWidth > 1050) {
            $("#main_nav").css("display", "block"); 
            iconMenu.attr("src", "./images/menu/menu_open.png");
        }
        else {
            $("#main_nav").css("display", "none"); 
            iconMenu.attr("src", "./images/menu/menu_open.png");
        }
                    console.log("widht: " + screenWidth);
      });



})