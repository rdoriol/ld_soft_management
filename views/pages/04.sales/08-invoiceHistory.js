$(document).ready(function(){

    var subwindowInvoiceHistory;

    /**
     * Función que abrirá subventana (popUp) con buscador de clientes
     */   
    $("#search_invoice_history").click(function(){
        var options = "width=500px, height=500px, top=100px, left=200px, resizable=no, scrollbars=no, location=no, directories=no";
        subwindowInvoiceHistory = window.open("index.php?pages=06-invoiceHistoryPopUp", "Búsqueda", options); 
    })

    /**
     * Función que lanzará fichero php para generar un documento pdf (copias de facturas)
     */
    $("#btn_invoice_copy_pdf").click(function() {                  

        if($("#id_customer_item").attr("readonly")) {
            window.open('./pdf_invoice_copy.php');                  
        }
    })  

})

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("06-outputProductPopUp.template.php")
*/
function getSubwindowOutputProduct(respuesta) {    
    window.opener.$("#tokenOutputs").val(respuesta);
    window.opener.getRegisterOutputProductsAjax();     
    closeSubwindow();        
}

/**
 * Función que conectará con fichero php "ajax/ajax_search_subwindow"
 */
function getRegisterOutputProductsAjax() {  
   
    var tokenOutputsValue = $("#tokenOutputs").val();            // Se obtiene valor del token de inputsProduct a buscar en base de datos

    var dataForm = new FormData(); 
    //                    name         value                     // Se generan datos de form para enviarlos en formato PHP ($_POST[])   
    dataForm.append("tokenOutputs", tokenOutputsValue);          // Se utilizará para mostrar datos de movimientos de entradas en 02-productsInputs.template.php  
   
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
                                // Se crea cookie con token para utilizar en copia de facturas pdf 
                        document.cookie = "token_customer_invoice="+request[0][0].token_customer_invoice;

                                /* Bloque para mostrar datos de una factura concreta en 01-newInvoice.template.php (consulta recibida de la tabla sql customer_invoices)
                                    -------------------------------------------------------------------------------------*/ 
                        
                        $("#customer_number_inv").text(request[0][0].id_customer_ci);
                        $("#customer_name_inv").text(request[0][0].name_customer);
                        $("#customer_nif_inv").text(request[0][0].nif_cif);
                        $("#customer_address_inv").text(request[0][0].address_customer);
                        $("#customer_postal_code_inv").text(request[0][0].postal_code);
                        $("#customer_town_inv").text(request[0][0].town);
                        $("#customer_province_inv").text(request[0][0].province);
                        $("#output_number").text(request[0][0].output_number);
                        $("#output_invoice_created_date").text(request[0][0].created_date_customer_invoice);
                        
                        $("#subtotal_input").val(request[0][0].subtotal_invoice);
                        $("#discount_input").val(request[0][0].discount_invoice);
                        $("#subtotal_discount_input").val(request[0][0].subtotal_with_discount_invoice);
                        $("#tax_input").val(request[0][0].tax_invoice);
                        $("#total_input").val(request[0][0].total_invoice); 

                                /* Bloque para mostrar datos de filas de productos de una factura concreta en 01-newInvoice.template.php (consulta recibida de la tabla sql outputs_product)
                                    -------------------------------------------------------------------------------------*/ 
                        for(var i = 0; i < request[1].length; i++) {
                        
                            $("#id_product_item" + (i+1)).val(request[1][i].id_product_op  );
                            $("#product_name_item" + (i+1)).val(request[1][i].product_concept);
                            $("#amount_item" + (i+1)).val(request[1][i].output_units);
                            $("#price_item" + (i+1)).val(request[1][i].unit_sales_price);
                            $("#discount_item" + (i+1)).val(request[1][i].unit_discount_product_op);
                            $("#total_item"+ (i+1)).val(request[1][i].total_row_output);
                        } 

                                // Se bloquean todos los campos para que no se puedan realizar modificaciones. Los movimientos de entradas no se pueden modificar ni eliminar
                        $("#discount_input").prop("readonly", "true");
                        $("#id_customer_item").prop("readonly", "true"); 
                        $("#searchCustomerInvoiceIcon").remove();
                        $(".search_icon").remove();  
                        for(var x = 0; x < 10; x++) {
                            $("#id_product_item" + (x+1)).prop("readonly", "true");
                            $("#product_name_item" + (x+1)).prop("readonly", "true");
                            $("#amount_item" + (x+1)).prop("readonly", "true");
                            $("#price_item" + (x+1)).prop("readonly", "true");
                            $("#discount_item" + (x+1)).prop("readonly", "true");                            
                        }  
                                // Se bloquea botón submit para desactivar envíos al backend
                        $("#btn_invoice_product_submit").prop("type", "button");
                        $("#btn_invoice_product_submit").click(function() {
                            $(".submit_disabled").css("display", "block");
                        })
                        
                    }
        }
    })    
}