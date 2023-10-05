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
                            // name       valor  (para php [$_POST])
            dataForm.append(nameForm, nameFormValue);
                                                      
            $.ajax({
            url: "ajax/ajax_customers.php",
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

    /**
     * 
     */






    
})