/**
 *  Fichero para mostrar/ocultar calendario en barra buscador de las distintas opciones de la aplicación (Customers, Suppliers, Product...)
 */

$(document).ready(function() {
        
    $(".bar_search").change(function(){
        var valueDate = $(".bar_search").val();
        
        if( valueDate == "created_date_supplier_invoice") {
            $(".search_key").css("display", "none");
            $(".calendar").css("display", "block");
        }
        else {
            $(".calendar").css("display", "none");
            $(".search_key").css("display", "block");
        }
    })
})