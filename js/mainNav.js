/**
 * Fichero javascript con JQuery para dotar de funcionalidad a la barra lateral de navegación principal
 */

$(document).ready(function() {

    /**
     * Función que abrirá y cerrará los submenus al pulsar los botones
     */
    $("ul li button").click(function(e) {
        var display = $(this).next().css("display"); // se obtiene valor de la propiedad "display"

        if(display == "block") {
            $(this).next().slideUp(); 
            $(".link_item").removeClass("li_active");  // resetea el fondo azul de los menús seleccionados previamente
        }
        else {
            $(".submenu").slideUp();  // cierra todos los submenus previamente abiertos
            $(".link_item").removeClass("li_active");
            $(this).next().slideDown(); // abre submenus
            $(this).addClass("li_active"); // se añade clase para que menú seleccionado tenga fondo en azul
        }     
    })  

    $("ul li ul li a").click(function(e) {
        $(".link_subitem").removeClass("link_subitem");
        $(this).addClass("link_subitem");
        
    })
})

