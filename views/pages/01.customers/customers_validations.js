  /* BLOQUE COMPROBACIÓN CAMPOS FORMULARIO EN TIEMPO REAL Y CON AJAX 
    -----------------------------------------------------------*/

/**
 * 
 */
$(document).ready(function(){

    /**
     * Función para comprobar campos introducidos en el formulario coincidentes en base de datos en "01-Customer.template.php"
     */
    function checkFields(selector, nameForm) { 

        $(selector).change(function() {

            var nameFormValue = $(this).val();
                                                   
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
                                    
                            if(request) {
                                lanzarMensaje(selector, request); // se lanza función para mostrar mensajes de errores de cada campo.
                            }
                }
            })    
        })
    }

        // Se lanza función ckeckFields(selector)
    checkFields("#customer_name", "name_customer_form");
    checkFields("#customer_nifcif", "name_nif_form");

    
     

        /* BLOQUE PARA MOSTRAR MENSAJES DE ERROR MODIFICANDO DOM HTML Y CSS
        ------------------------------------------------------------------ */
    /**
     * Función para modificar estilos-DOM del documento HTML. Estilos para validación incorrecta.
     */
    function checkKo(selector) {
        $(selector).removeClass("alert-success");
        $(selector).addClass("alert-danger");
        $(selector).css("border", "2px solid red");
    }

    /**
     * Función para modificar estilos-DOM del documento HTML. Estilos para validación correcta.
     */
    function checkOk(selector) {
        $(selector).removeClass("alert-danger");
        $(selector).addClass("alert-success");
        $(selector).css("border", "2px solid green");
        //$(selector).css("display", "block");
    }

    /**
    * Función para mostrar mensajes de alerta en función del campo erroneo
    * @param string selector, request
    */
    function lanzarMensaje(selector, request, ) {
                                                               
        if(selector == "#customer_name") {
            if(request == "true") {
                checkKo(selector);
                $(".name_field_duplicate").css("display", "block");
            }
            else {
                checkOk(selector);
                $(".name_field_duplicate").css("display", "none");
            }
        }
        else if(selector == "#customer_nifcif") {
            if(request == "true") {
                checkKo(selector);
                $(".nif_field_duplicate").css("display", "block");
            }
            else {
                checkOk(selector);
                $(".nif_field_duplicate").css("display", "none");
            }
        }
    } 



    
     





    

})