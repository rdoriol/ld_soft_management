/**
 *  Fichero para mostrar/ocultar calendario en barra buscador de las distintas opciones de la aplicación (supplier_invoices, customer_invoices)
 */

$(document).ready(function() {
        
    $(".bar_search").change(function(){
        var valueDate = $(".bar_search").val();
        
            // Condición para evaluar en que opción del select entra
        if( valueDate == "created_date_supplier_invoice" || valueDate == "created_date_customer_invoice") {
            $(".search_key").css("display", "none");
            $(".calendar").css("display", "block");
        }
        else {
            $(".calendar").css("display", "none");
            $(".search_key").css("display", "block");
        }
    })
})