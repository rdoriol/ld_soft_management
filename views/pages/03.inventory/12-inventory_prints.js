/* BLOQUE PARA IMPRIMIR CONTENIDO DE PANTALLA 
---------------------------------------------*/

$(document).ready(function(){
   
    /**
     * Función para imprimir contenido de un div concreto
     */
    $("#print_product").click(function(){
        printDiv();                         // función ubicada en 07-customers_prints.js
    })

    /**
     * Función para imprimir contenido List
     */ 
    $("#print_product_inputs").click(function(){
        printDiv();       
    })  

    /**
     * Función para imprimir contenido List
     */ 
      $("#btn_print_inventory").click(function(){
        printDiv();       
    }) 

    /**
     * Función para imprimir contenido List
     */ 
    $("#btn_print_inventory_input_product").click(function(){
        printDiv();       
    }) 
})






