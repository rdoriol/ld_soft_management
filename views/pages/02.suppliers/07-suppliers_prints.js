/* BLOQUE PARA IMPRIMIR CONTENIDO DE PANTALLA 
---------------------------------------------*/

$(document).ready(function(){
   
    /**
     * Función para imprimir contenido de un div concreto
     */
    $("#print_supplier").click(function(){
        printDiv();                         // función ubicada en 07-customers_prints.js
    })

    /**
     * Función para imprimir contenido List
     */ 
    $("#btn_print_supplier_lists").click(function(){
        printDiv();       
    })  
})