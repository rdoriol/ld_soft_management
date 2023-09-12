/**
 * Fichero javascript con JQuery para dotar de funcionalidad a la barra lateral de navegación principal
 */

$(document).ready(function() {

    /**
     * Función que abrirá y cerrará los submenus al pulsar los botones
     */
    $("ul li button").click(function(e) {
        var display = $(this).next().css("display"); // se obtiene valor de la propiedad "display" del button

        if(display == "block") {
            $(this).next().slideUp(); 
            $(".link_item").removeClass("li_active");  // elimina el fondo azul de los menús seleccionados previamente.
            $(".fa-solid").attr("class", "fa-solid fa-caret-down"); // cambia todos los iconos al tipo "expandir menú"
        }
        else {
            $(".submenu").slideUp();  // cierra todos los submenus previamente abiertos
            $(".link_item").removeClass("li_active"); 
            $(".fa-solid").attr("class", "fa-solid fa-caret-down"); // cambia todos los iconos al tipo "expandir menú"
            $(this).next().slideDown(); // abre submenus
            $(this).addClass("li_active"); // se añade clase para que menú seleccionado tenga fondo en azul
            $(this).children().attr("class", "fa-solid fa-caret-up"); // se cambia a icono "contraer menú"
        }     
    })  

    $("ul li ul li a").click(function(e) {
        $(".link_subitem").removeClass("link_subitem");
        $(this).addClass("link_subitem");        
    })
})


/*
    // TODO        SCRIPT PARA UTILIZAR A TRAVÉS DE PHP
<script>
            $(this).next().slideDown(); // abre submenus
            $(this).addClass("li_active");
    </script>
    */