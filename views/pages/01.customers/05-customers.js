    /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS
    -----------------------------------------*/
    
var ventana; // variable que almacenará subventana abierta

$(document).ready(function(){

    /**
     * Función que abrirá subventana (popUp) con buscador
     */   
    $("#search_customer").click(function(){
        var options = "width=500px, height=500px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
        ventana = window.open("index.php?pages=04-customerPopUpSearch", "Búsqueda", options); 
    })

      /**
         * Función que cerrará ventana de subventana buscador
         */
      $("#btn_customers_close").click(function(){
        closeSubwindow();
    })

     /**
     * Función que abrirá modal para preguntar a usario si desea eliminar registro seleccionado
     */
     $("#btn_delete_customer").click(function(){
        if($("#customer_id").val() != "" && $("#customer_name").val() != "" && $("#customer_nifcif").val() != "") {
            $("#delete_modal").modal("show");
            $("#btn_ok").click(function(){
                $("#delete_modal").modal("hide");    
                deleteCustomerAjax();
                window.sessionStorage.setItem('modalAlert', 'true');
                window.location.replace('index.php?pages=01-newCustomer');
            })                                        
        }
        return false;
    })

})

/**
 * Función que cerrará la subventana
 */
function closeSubwindow() {       
    if(ventana != "") {
        window.close();
    }       
}

/**
 * Función que conectará con fichero php "ajax/ajax_search_subwindow"
 */
function getRegisterAjax() {

    var tokenValue = $("#tokenCustomer").val(); // Se obtiene valor a buscar en la base de datos
    
    var dataForm = new FormData();
    //                name      value   // Se generan datos de form para enviarlos en formato PHP ($_POST[])
    dataForm.append("tokenCustomer", tokenValue);
                                                            
    
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
                                            
                        $("#customer_id").val(request[0].id);
                        getValueType(request[0].customer_type); // se lanza función para seleccionar "tipo de cliente"
                        $("#created_date").val(request[0].created_date);
                        $("#customer_name").val(request[0].name_customer);
                        $("#customer_nifcif").val(request[0].nif_cif);
                        $("#customer_address").val(request[0].address_customer);
                        $("#customer_postal_code").val(request[0].postal_code);
                        $("#customer_town").val(request[0].town);
                        $("#customer_province").val(request[0].province);
                        $("#customer_country").val(request[0].country);
                        $("#customer_phone").val(request[0].phone);
                        $("#customer_email").val(request[0].email);
                        $("#customer_contact_person").val(request[0].contact_person);      
                    }
        }
    })
} 

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("06-popUpsearch.template.php")
 * @return string respuesta
*/
function getSubwindowValues(respuesta) {  
    
    window.opener.$("#tokenCustomer").val(respuesta);       // Para almacenar token en 01-newCustomer (01.Customers)
    window.opener.getRegisterAjax();
    closeSubwindow();        
}

/**
 * Función para utilizar en getRegisterAjax(), para seleccionar el valor del "tipo de cliente"
 */
function getValueType(value) {
    if(value == "Particular") {
        $("#private_customer").prop("checked", true);
        $("#company").prop("checked", false);
    }
    else {
        $("#private_customer").prop("checked", false);
        $("#company").prop("checked", true);
    }
}

/**
 * Función que conectará vía AJAX con PHP para eliminar registro de la base de datos
 */
function deleteCustomerAjax() {
    var tokenDelete = $("#tokenCustomer").val();          

    var dataForm = new FormData();

    dataForm.append("token_customer_form", tokenDelete);
                                                                           
    $.ajax({
        url: "./ajax/ajax_customers.php",
        method: "POST",
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){          
                    if(request == "true") {                                                                                 
                       return true;                                                      
                    }
        }
    })
}

