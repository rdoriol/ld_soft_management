 /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS
    -----------------------------------------*/
    
    var supplierWindow; // variable que almacenará subventana abierta

    $(document).ready(function(){
    
        /**
         * Función que abrirá subventana (popUp) con buscador
         */   
        $("#search_supplier").click(function(){
            var options = "width=500px, height=500px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
            supplierWindow = window.open("index.php?pages=04-supplierPopUpSearch", "Búsqueda", options); 
        })

        /**
         * Función que cerrará ventana de subventana buscador
         */
        $("#btn_suppliers_close").click(function(){
            closeSubwindow();
        })

         /**
         * Función que abrirá modal para preguntar a usario si desea eliminar registro seleccionado
         */
        $("#btn_supplier_delete").click(function(){
            if($("#supplier_id").val() != "" && $("#supplier_name").val() != "" && $("#supplier_nif").val() != "") {
                $("#delete_modal").modal("show");
                $("#btn_ok").click(function(){
                    $("#delete_modal").modal("hide");    
                    deleteSuppliersAjax();
                    window.sessionStorage.setItem('modalAlert', 'true');
                    window.location.replace('index.php?pages=01-newSupplier');
                })                                        
            }
            return false;
        })
    })
    
/**
 * Función que cerrará la subventana
 */
function closeSubwindow() {       
    if(supplierWindow != "") {
        window.close();
    }       
}

/**
 * Función que conectará con fichero php "ajax/ajax_search_subwindow"
 */
function getRegisterSupplierAjax(token=null) {               

    var tokenValue = $("#tokenSupplier").val(); // Se obtiene valor a buscar en la base de datos

    var dataForm = new FormData();
    //                   name          value   // Se generan datos de form para enviarlos en formato PHP ($_POST[])
    dataForm.append("tokenSupplier", tokenValue);                                                               
    
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
                                            
                        $("#supplier_id").val(request[0].id);
                        $("#supplier_created_date").val(request[0].created_date);
                        $("#supplier_name").val(request[0].name_supplier);
                        $("#supplier_nif").val(request[0].nif);
                        $("#supplier_address").val(request[0].address);
                        $("#supplier_postal_code").val(request[0].postal_code);
                        $("#supplier_town").val(request[0].town);
                        $("#supplier_province").val(request[0].province);
                        $("#supplier_country").val(request[0].country);
                        $("#supplier_phone").val(request[0].phone);
                        $("#supplier_email").val(request[0].email);
                        $("#supplier_web").val(request[0].web);
                        $("#supplier_contact_person").val(request[0].contact_person);      
                    }
        }
    })
} 

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("06-popUpsearch.template.php")
 * @return string respuesta
*/
function getSubwindowSupplier(respuesta) {  
    
    window.opener.$("#tokenSupplier").val(respuesta);
    window.opener.getRegisterSupplierAjax();
    closeSubwindow();        
}

/**
 * Función que conectará vía AJAX con PHP para eliminar registro de la base de datos
 */
function deleteSuppliersAjax() {
    var tokenDelete = $("#tokenSupplier").val();          

    var dataForm = new FormData();

    dataForm.append("token_supplier_form", tokenDelete);
                                                                           
    $.ajax({
        url: "./ajax/ajax_supplier.php",
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
    