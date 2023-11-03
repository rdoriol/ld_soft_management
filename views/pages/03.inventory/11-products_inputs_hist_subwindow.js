/* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS DE INPUTS PRODUCTS
    -----------------------------------------*/
    
var inputsProductsWindow; // variable que almacenará subventana abierta

/**
 * Script js para subventana "Historial de entradas" (02-productsInputs.template.php)
 */
$(document).ready(function(){

    /**
     * Función que abrirá subventana (popUp) con buscador
     */   
    $("#search_inputs_products").click(function(){             
        var options = "width=800px, height=700px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
        inputsProductsWindow = window.open("index.php?pages=07-inputProductPopUpSearch", "Búsqueda", options);                                                   
    })

})

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("07-inputProductPopUpSearch.template.php")
*/
function getSubwindowInputProduct(respuesta) {    
    window.opener.$("#tokenInputs").val(respuesta);
    window.opener.getRegisterInputsProductsAjax();     // En fichero 08-inventory.js
    closeSubwindow();        
}

/**
 * Función que conectará con fichero php "ajax/ajax_search_subwindow"
 */
function getRegisterInputsProductsAjax() {  
   
    var tokenInputsValue = $("#tokenInputs").val();             // Se obtiene valor del token de inputsProduct a buscar en base de datos

    var dataForm = new FormData(); 
    //                    name         value                    // Se generan datos de form para enviarlos en formato PHP ($_POST[])   
    dataForm.append("tokenInputs", tokenInputsValue);          // Se utilizará para mostrar datos de movimientos de entradas en 02-productsInputs.template.php  
   
    $.ajax({
        url: "./ajax/ajax_search_subwindow.php",
        method: "POST",
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){           
                    if(request) {   
                        
                        /* Bloque para mostrar datos de movimientos de entradas en 02-productsInputs.template.php
                            -------------------------------------------------------------------------------------*/ 
                        $("#input_number").val(request[0].input_number);
                        $("#select_supplier").val(request[0].id_supplier);
                        $("#select_supplier").text(request[0].name_supplier);
                        $("#input_product_created_date").val(request[0].created_date_supplier_invoice);
                        $("#subtotal_input").val(request[0].subtotal_input);
                        $("#discount_input").val(request[0].discount_input);
                        $("#subtotal_discount_input").val(request[0].subtotal_with_discount);
                        $("#tax_input").val(request[0].tax_input);
                        $("#total_input").val(request[0].total_input);
                    }
        }
    })    
}