/* BLOQUE PARA IMPRIMIR CONTENIDO DE PANTALLA 
---------------------------------------------*/

$(document).ready(function(){
   
    /**
     * Función para imprimir contenido de un div concreto
     */
    $("#print_invoice").click(function(){
        printDiv();                         // función ubicada en 07-customers_prints.js
    })
})
