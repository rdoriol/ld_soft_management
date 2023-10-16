    /* BLOQUE COMPROBACIÓN CAMPOS FORMULARIO EN TIEMPO REAL Y CON AJAX 
    -----------------------------------------------------------*/

/**
 * 
 */
$(document).ready(function(){

    /**
     * Función para modificar estilos-DOM del documento HTML. Estilos para validación incorrecta.
     */
    function checkKo(selector) {
        $(selector).addClass("alert-danger");
        $(selector).css("border", "2px solid red");
    }
    /**
     * Función para modificar estilos-DOM del documento HTML. Estilos para validación correcta.
     */
    function checkOk(selector) {
        $(selector).removeClass("alert-danger");
        $(selector).addClass("alert-success");
        //$("#customer_name").css("border", "2px solid green");
        $(selector).css("display", "block");
    }

    /**
     * Función para comprobar campos introducidos en el formulario coincidentes en base de datos en "01-Customer.template.php"
     */
    function checkFields(selector, nameForm) { 

        $(selector).change(function() {

            var nameFormValue = $(this).val();
                                                    console.log("Valor obtenido del form: " + nameFormValue);  // todo ELIMINAR
                // Se genera formulario para comunicarse con fichero php (name y su valor)
            var dataForm = new FormData(); 
                            // name       valor  (para php $_POST[])
            dataForm.append(nameForm, nameFormValue);
                                                      
            $.ajax({
                url: "./ajax/ajax_customers.php",
                method: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(request) { 
                                                console.log("Valor obtenido de base de datos: " + request); // todo ELIMINAR
                                if(request == "true") {                            
                                    checkKo(selector); // 
                                
                                }
                                else {                           
                                    checkOk(selector);    
                                }               
                }
            })    
        })
    }

    // Se lanza función ckeckFields(selector)
    checkFields("#customer_name", "name_customer_form");
    checkFields("#customer_nifcif", "name_nif_form");

})


    /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS
    -----------------------------------------*/
var ventana; // variable que almacenará subventana abierta

$(document).ready(function(){

    /**
     * Función que abrirá subventana (popUp) con buscador
     */   
    $("#search_customer").click(function(){
        var options = "width=500px, height=500px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
        ventana = window.open("index.php?emergent=06-popUpsearch", "Búsqueda", options); 
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
        dataForm.append("token", tokenValue);
                                                                console.log(tokenValue);
        
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
                                                
                            $("#customer_id").val(request[0].id_customer);
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
       
        window.opener.$("#tokenCustomer").val(respuesta);
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

