/**
 * Fichero javascript/JQuery para dotar de funcionalidad a la barra lateral de navegación principal.
 */

$(document).ready(function() {                                  
                                 
    /**
     * Función que abrirá y cerrará los submenus al pulsar los botones del menú.
     */
    $("ul li button").click(function(e) {
        var buttonId = $(this).attr("id");
        var submenuId = $(this).next().attr("id");            

        if($(this).next().css("display") == "block") {
            $(this).next().slideUp();
            navBarReset();
            sessionStorage.setItem("submenuShowStore", "false");     // almacena en sesión de navegador el estado del menú.
        }
        else {
            navBarReset();
            $(this).next().slideDown();                                     // abre submenus.
            $(this).addClass("li_active");                                  // añade clase para que menú seleccionado aparezca con las propiedades css de botón activo.
            $(this).children().attr("class", "fa-solid fa-caret-down");     // se cambia a icono "submenú expandido".
               
                // bloque para almacenar los "id" y estado del menú en sesión del navegador.
            sessionStorage.setItem("submenuShowStore", "true");
            sessionStorage.setItem("submenuIdStore", submenuId);
            sessionStorage.setItem("buttonIdStore", buttonId);
        }                                         
    })    

    /**
     * Función que marcará opciones de los submenús seleccionados con propiedades css de boton activo.
     */
    $("ul li ul li a").click(function(e) {
        $(".link_subButton").removeClass("link_subButton");
       // $(this).addClass("link_subButton_active"); de momento no utilizar

        sessionStorage.setItem("aIdStore", $(this).attr("id"));
    })

    /**
     * Función que reseteará a valores iniciales los menús desplegables.
     */
    function navBarReset() {
        $(".submenu").slideUp();                                    // cierra todos los submenus previamente abiertos.
        $(".link_button").removeClass("li_active");                 // elimina clase con las propiedades css de botón activo de los menús seleccionados previamente.
        $(".fa-solid").attr("class", "fa-solid fa-caret-right");    // cambia todos los iconos al tipo "submenú contraido".
    }

    /**
     * Función que devolverá al estado en el que se encuentraba el menú lateral antes de refrescar página (abierto-cerrado, marcado-no marcado).
     */
    function reloadNavBar(e) {
        var reloadSubmenuShow = sessionStorage.getItem("submenuShowStore");
        var reloadSubmenuIdStore = sessionStorage.getItem("submenuIdStore");
        var reloadButtonIdStore = sessionStorage.getItem("buttonIdStore");
        var reloadAIdStore = sessionStorage.getItem("aIdStore");

        if(reloadSubmenuShow != "undefined" && reloadSubmenuShow != null) {
            if(reloadSubmenuShow == "true") {
                $("#" + reloadSubmenuIdStore).show();
                $("#" + reloadButtonIdStore).addClass("li_active");
                $("#" + reloadButtonIdStore).children().attr("class", "fa-solid fa-caret-down");
                $("#" + reloadAIdStore).addClass("link_subButton_active");
            }
        }
    }

    reloadNavBar();

    

 


})













/*
    // TODO        SCRIPT PARA UTILIZAR A TRAVÉS DE PHP
<script>
            $(this).next().slideDown(); // abre submenus
            $(this).addClass("li_active");
    </script>
    */