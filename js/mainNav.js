/**
 * Fichero javascript/JQuery para dotar de funcionalidad a la barra lateral de navegación principal.
 */

$(document).ready(function() {
                                                console.log(sessionStorage.getItem("submenuShow"));
                                                console.log(sessionStorage.getItem("test"));
    /**
     * Función que abrirá y cerrará los submenus al pulsar los botones del menú.
     */
    $("ul li button").click(function(e) {
        var display = $(this).next().css("display"); // se obtiene valor de la propiedad "display" del button.

        if(display == "block") {
            navBarReset();
                                                sessionStorage.setItem("submenuShow", "false");
        }
        else {
            navBarReset();
            $(this).next().slideDown(); // abre submenus.
            $(this).addClass("li_active"); // añade clase para que menú seleccionado aparezca con las propiedades css de botón activo.
            $(this).children().attr("class", "fa-solid fa-caret-down"); // se cambia a icono "submenú expandido".
                                                sessionStorage.setItem("submenuShow", "true");
                                                sessionStorage.setItem("test", $(this).next().value);
        }     
                                                
    })  

    /**
     * Función que marcará submenús seleccionados con propiedades css de boton activo.
     */
    $("ul li ul li a").click(function(e) {
        $(".link_subButton").removeClass("link_subButton");
        $(this).addClass("link_subButton");
    })

    /**
     * Función que reseteará a valores iniciales los menús desplegables.
     */
    function navBarReset() {
        $(".submenu").slideUp(); // cierra todos los submenus previamente abiertos.
        $(".link_button").removeClass("li_active");  // elimina clase con las propiedades css de botón activo de los menús seleccionados previamente.
        $(".fa-solid").attr("class", "fa-solid fa-caret-right"); // cambia todos los iconos al tipo "submenú contraido".
    }



})













/*
    // TODO        SCRIPT PARA UTILIZAR A TRAVÉS DE PHP
<script>
            $(this).next().slideDown(); // abre submenus
            $(this).addClass("li_active");
    </script>
    */