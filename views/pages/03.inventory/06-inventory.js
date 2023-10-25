 /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS
    -----------------------------------------*/
    
var productWindow; // variable que almacenará subventana abierta

$(document).ready(function(){

    /**
     * Función que abrirá subventana (popUp) con buscador
     */   
    $("#search_product").click(function(){             
        var options = "width=550px, height=500px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
        productWindow = window.open("index.php?pages=05-inventoryPopUpSearch", "Búsqueda", options); 
    })

    /**
     * Función que abrirá modal para preguntar a usario si desea eliminar registro seleccionado
     */
    $("#btn_product_delete").click(function(){
        if($("#select_item_category").val() != "" && $("#or_original_product").val() != "" && $("#product_name").val() != "") {
            $("#delete_modal").modal("show");
            $("#btn_ok").click(function(){
                $("#delete_modal").modal("hide");
                deleteProductsAjax();
                window.sessionStorage.setItem('modalAlert', 'true');
                window.location.replace('index.php?pages=01-newProduct');
            })                                        
        }
       return false;
    })
})

/**
 * Función que cerrará la subventana
 */
function closeSubwindow() {       
    if(productWindow != "") {
        window.close();
    }       
}

 /**
 * Función que conectará con fichero php "ajax/ajax_search_subwindow"
 */
function getRegisterProductAjax() {             

    var tokenValue = $("#tokenProduct").val(); // Se obtiene valor a buscar en la base de datos
   
    var dataForm = new FormData(); 
    //                    name         value   // Se generan datos de form para enviarlos en formato PHP ($_POST[])
    dataForm.append("tokenProduct", tokenValue);                                      
   
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
                                            
                        $("#product_id").val(request[0].id_product);
                        $("#select_item_category").val(request[0].id_product_category);
                        $("#select_item_category").text(request[0].name_product_category); 
                        $("#product_created_date").val(request[0].created_date_product);
                        $("#or_original_product").val(request[0].or_product);
                        $("#product_name").val(request[0].name_product);
                        $("#product_description").val(request[0].description_product);
                        $("#product_unit").val(request[0].units_product);
                        $("#last_cost_product").val(request[0].last_unit_cost_product);
                        $("#sale_price_product").val(request[0].sale_price_product);                             
                    }
        }
    })
} 

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("06-popUpsearch.template.php")
 * @return string respuesta
*/
function getSubwindowProduct(respuesta) {  

    window.opener.$("#tokenProduct").val(respuesta);
    window.opener.getRegisterProductAjax();
    closeSubwindow();        
}

/**
 * Función que conectará vía AJAX con PHP para eliminar registro de la base de datos
 */
function deleteProductsAjax() {
    var tokenDelete = $("#tokenProduct").val();  

    var dataForm = new FormData();

    dataForm.append("token_product_form", tokenDelete);
                                                                           
    $.ajax({
        url: "./ajax/ajax_inventory.php",
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

    