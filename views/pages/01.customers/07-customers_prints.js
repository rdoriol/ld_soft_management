/* BLOQUE PARA IMPRIMIR CONTENIDO DE PANTALLA 
---------------------------------------------*/

$(document).ready(function(){
   
    /**
     * Función para imprimir contenido de un div concreto
     */
    $("#print").click(function(){
        printDiv();    
    })

    /**
     * Función para imprimir contenido 02-customerList
     */ 
    $("#btn_print_customer").click(function(){
        printDiv();       
    })  
})

/**
 * Función que se lanzará para imprimir contenido de 01-newCustomer
 */ 
function printDiv() {
        // Se oculta contenido que no se desea imprimir
    $("header").hide();
    $("#main_nav").hide();
    $("footer").hide();
    $(".btn-group").hide();

        // Se imprime contenido visible
    window.print();

        // Se vuelve a mostrar el contenido completo del documento html
    $("header").show();
    $("#main_nav").show();
    $("footer").show(); 
    $(".btn-group").show();  
} 