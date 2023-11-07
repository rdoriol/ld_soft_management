$(document).ready(function(){

    var subwindowInvoice;

    /**
     * Función que abrirá subventana (popUp) con buscador de clientes
     */   
    $(".search_icon_customer").click(function(){
        var options = "width=500px, height=500px, top=100px, left=200px, resizable=no, scrollbars=no, location=no, directories=no";
        subwindowInvoice = window.open("index.php?pages=04-invoicePopUpSearch", "Búsqueda", options); 
    })

    /**
     * Función que al introducir número de cliente mostrará sus datos en factura
     */
    $("#id_customer_item").change(function(){
        getRegisterCustomerAjax(); 
    })



})

    /**
     * Función que conectará con fichero php "ajax/ajax_search_subwindow"
     */
function getRegisterCustomerAjax() {

    var token_customer = $("#token_customer").val();        // Se obtiene valor a buscar en la base de datos
    var idCustomer = $("#id_customer_item").val();          // Se obtiene id de cliente a buscar de input "Cliente a facturar" de 01.newInvoice
                                                                         
    var dataForm = new FormData();
    //                      name      value               
    dataForm.append("tokenCustomer", token_customer);      // Para obtener datos solicitados de la subventana buscado customers en 01.newInvoice
    dataForm.append("idCustomer", idCustomer);             // Para obtener datos solicitados desde input "Cliente a facturar" en 01.newInvoice                                                   
   
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
                                            
                        $("#customer_number_inv").text(request[0].id);
                        $("#customer_name_inv").text(request[0].name_customer);
                        $("#customer_nif_inv").text(request[0].nif_cif);
                        $("#customer_address_inv").text(request[0].address_customer);
                        $("#customer_postal_code_inv").text(request[0].postal_code);
                        $("#customer_town_inv").text(request[0].town);
                        $("#customer_province_inv").text(request[0].province);
                        //$("#customer_country_inv").text(request[0].country);                        
                    }
        }
    })
} 

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("06-popUpsearch.template.php")
 * @return string respuesta
*/
function getSubwindowInvoiceValues(respuesta) {  
   
    window.opener.$("#token_customer").val(respuesta);
    window.opener.getRegisterCustomerAjax();
    closeSubwindow();
}

/** 
 * Función para comprobar campos vacíos de 01-newInvoice y no permitir el envío de la factura al backend
*/
$("#btn_invoice_product_submit").click(function(){
    var idCustomer = $("#customer_number_inv").text();
    var idProduct = $(".id_product_item_c1").val();      
    var concept = $(".product_name_item_c1").val();   
    var amount = $(".amount_item_c1").val();   
    var price = $(".price_item_inv1").val();  console.log(idCustomer + "\n"+ idProduct + "\n"+ concept + "\n"+ amount + "\n"+ price);

    if(idCustomer == "" || idProduct == "" || concept == "" || amount == "" || price == "" || concept == 0 || amount == 0 || price == 0) {
        $(".require_fields").css("display", "block");
        return false;
    }
    else {
        $(".require_fields").css("display", "none");
    } 
})