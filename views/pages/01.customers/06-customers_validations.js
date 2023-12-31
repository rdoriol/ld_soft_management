
 
    /* BLOQUE COMPROBACIÓN CAMPOS FORMULARIO EN TIEMPO REAL Y CON AJAX 
    -----------------------------------------------------------*/

/**
 * Comprobación de formatos y duplicidad del formulario Cliente
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
                                sentCustomerMessages(selector, request); // se lanza función para mostrar mensajes de errores de cada campo.                                
                            }
                }
            })    
        })
    }

        // Se lanza función ckeckFields(selector)
    checkFields("#customer_name", "name_customer_form");
    checkFields("#customer_nifcif", "name_nif_form");    

     /**
    * Función para mostrar mensajes personalizados de alerta en función del campo erroneo
    * @param string selector, request
    */
     function sentCustomerMessages(selector, request) {
        cleanCheck(selector); // se limpian los mensajes de errores previos.

            //Bloque para validar y lanzar mensajes de errores para campo nombre
        if(selector == "#customer_name") {
           
            if(request == "true") {
                checkKo(selector);
                $(".name_field_duplicate").css("display", "block");
                $("#btn_customer_submit").attr("type", "button");
            }
            else {
               // checkOk(selector);
                $(".name_field_duplicate").css("display", "none");
                $("#btn_customer_submit").attr("type", "submit");
            }
        }
            // Bloque para validar campo nif (formato y duplicidad en base de datos)
        else if(selector == "#customer_nifcif") {

            cleanCheck(selector); // se limpian los mensajes de error previos.
            var checkFormatNif = checkNif($("#customer_nifcif").val()); // se lanza función para comprobar formato de NIF
            
            if(checkFormatNif == true) {  // Si el formato es incorrecto
                checkKo(selector);
                $(".error_format_nif").css("display", "block"); 
                $("#btn_customer_submit").attr("type", "button");
            }
            else {  // Si el formato es correcto
               // checkOk(selector); 
                $(".error_format_nif").css("display", "none");
                $("#btn_customer_submit").attr("type", "submit");

                if(request == "true") { // Si el formato es correcto a continuación se comprueba que no exista nif duplicado
                    checkKo(selector);
                    $(".nif_field_duplicate").css("display", "block");
                    $("#btn_customer_submit").attr("type", "button");
                }
                else {
                   // checkOk(selector);
                    $(".nif_field_duplicate").css("display", "none");
                    $("#btn_customer_submit").attr("type", "submit");
                }
            }
        }
    } 

    /**
     * Se lanza función checkPostalCode() al detectar algún cambio en el campo del formulario "Código Postal"
     */
    $("#customer_postal_code").change(function(){
        var formatPostalCode = checkPostalCode($(this), $(this).val());
        if(formatPostalCode == true) {
            checkKo($(this));
            $(".error_format_postal_code").css("display", "block");
            $("#btn_customer_submit").attr("type", "button");
        }
        else {
           // checkOk($(this));
            $(".error_format_postal_code").css("display", "none");
            $("#btn_customer_submit").attr("type", "submit");
        }
    })

    /**
     * Se lanza función checkPhone() al detectar algún cambio en el campo del formulario "Teléfono"
     */
        $("#customer_phone").change(function(){
            var formatPhone = checkPhone($(this), $(this).val());
            if(formatPhone == true) {
                checkKo($(this));
                $(".error_format_phone").css("display", "block");
                $("#btn_customer_submit").attr("type", "button");
            }
            else {
                //checkOk($(this));
                $(".error_format_phone").css("display", "none");
                $("#btn_customer_submit").attr("type", "submit");
            }
        })
})

/* -- A partir de aquí Funciones fuera de "$(document).ready()" para poder utilizarlas en otros archivos .js -- */

    /* FUNCIONES PARA MODIFICAR DOM HTML Y CSS 
        ----------------------------------- */

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

/* FUNCIONES PARA VALIDAR FORMATOS
------------------------------ */

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
    $("#btn_customer_submit").attr("type", "button");

    if(!patternDni.test(nif) && !patternCif.test(nif) && !patternNifM.test(nif) && !patternNie.test(nif)) {
        $("#btn_customer_submit").attr("type", "submit");
        ckeck = true;                    
    }
    return ckeck;
}

/**
 * Método para comprobar formato campo "Código Postal"
 * @param string postalCode
 * @return string check
 */
function checkPostalCode(selector, postalCode) {
    var check = false;
    cleanCheck(selector);    // se limpian mensajes de errores previos
    $("#btn_customer_submit").attr("type", "button");
    
    if(isNaN(postalCode) || postalCode.length != 5) {
        $("#btn_customer_submit").attr("type", "submit");
        check = true;        
    }
    return check;
}

/**
 * Método para comprobar formato campo "Teléfono"
 * @param string phone
 * @return string check
 */
function checkPhone(selector, phone) {
    check = false;
    cleanCheck(selector);    // se limpian mensajes de errores previos
    $("#btn_customer_submit").attr("type", "button");

    if(phone.length > 13 || phone.length < 9) {
        $("#btn_customer_submit").attr("type", "submit");
        check = true;
    }
    return check;
}
