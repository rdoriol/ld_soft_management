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
                                sentMessages(selector, request); // se lanza función para mostrar mensajes de errores de cada campo.
                            }
                }
            })    
        })
    }

        // Se lanza función ckeckFields(selector)
    checkFields("#customer_name", "name_customer_form");
    checkFields("#customer_nifcif", "name_nif_form");

    /**
     * Método para validar formatos de NIF
     * @param string nif
     * @return string check
     */
    function checkNif(nif) {
        var patternDni = /^[0-9]{8}[A-Za-z]{1}$/;        
        var patternCif = /^[A-Za-z]{1}[0-9]{8}$/;
        var patternNifM = /^[Mm]{1}[0-9]{7}[A-Za-z]{1}$/;
        var patternNie = /^[XYZzyz]{1}[0-9]{7}[A-Za-z]{1}$/;
        var ckeck = false;

        if(!patternDni.test(nif) && !patternCif.test(nif) && !patternNifM.test(nif) && !patternNie.test(nif)) {
            ckeck = true;                    
        }
        return ckeck;
    }

    /**
     * Método para comprobar formato campo "Código Postal"
     * @param string postalCode
     * @return string check
     */
    function checkPostalCode(postalCode) {
        var check = false;
        cleanCheck("#customer_postal_code");    // se limpian mensajes de errores previos
        
        if(isNaN(postalCode) || postalCode.length != 5) {
            check = true;        
        }
        return check;
    } 
    /**
     * Se lanza función checkPostalCode() al detectar algún cambio en el campo "Código Postal"
     */
    $("#customer_postal_code").change(function(){
        var formatPostalCode = checkPostalCode($(this).val());
        if(formatPostalCode == true) {
            checkKo($(this));
            $(".error_format_postal_code").css("display", "block");
        }
        else {
            checkOk($(this));
            $(".error_format_postal_code").css("display", "none");
        }
    })


   
     

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
    }

     /**
     * Función para modificar estilos-DOM del documento HTML. Estilos para limpiar mensajes previos.
     */
    function cleanCheck(selector) {
        $(selector).removeClass("alert-success");
        $(selector).removeClass("alert-danger");
        $(selector).css("border", "none");
    }

    /**
    * Función para mostrar mensajes personalizados de alerta en función del campo erroneo
    * @param string selector, request
    */
    function sentMessages(selector, request) {
        cleanCheck(selector); // se limpian los mensajes de errores previos.

            //Bloque para validar y lanzar mensajes de errores para campo nombre
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
            // Bloque para validar campo nif (formato y duplicidad en base de datos)
        else if(selector == "#customer_nifcif") {

            cleanCheck(selector); // se limpian los mensajes de error previos.
            var checkFormatNif = checkNif($("#customer_nifcif").val()); // se lanza función para comprobar formato de NIF
            
            if(checkFormatNif == true) {  // Si el formato es incorrecto
                checkKo(selector);
                $(".error_format_nif").css("display", "block"); 
            }
            else {  // Si el formato es correcto
                checkOk(selector); 
                $(".error_format_nif").css("display", "none");

                if(request == "true") { // Si el formato es correcto a continuación se comprueba que no exista nif duplicado
                    checkKo(selector);
                    $(".nif_field_duplicate").css("display", "block");
                }
                else {
                    checkOk(selector);
                    $(".nif_field_duplicate").css("display", "none");
                }
            }
        }
    } 



    
     





    

})