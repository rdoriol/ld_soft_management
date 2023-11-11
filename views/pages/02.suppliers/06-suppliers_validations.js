  /* BLOQUE COMPROBACIÓN CAMPOS FORMULARIO EN TIEMPO REAL Y CON AJAX 
    -----------------------------------------------------------*/

/**
 * Comprobación de formatos y duplicidad del formulario Proveedores
 */
$(document).ready(function(){

    /**
     * Función para comprobar campos introducidos en el formulario coincidentes en base de datos en "01-newSupplier.template.php"
     */
    function checkSupplierFields(selector, nameForm) { 

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
                                sentSupplierMessages(selector, request); 
                            }
                }
            })    
        })
    }

        // Se lanza función checkSupplierFields(selector)
    checkSupplierFields("#supplier_name", "name_supplier_form");
    checkSupplierFields("#supplier_nif", "nif_supplier_form");

    /**
    * Función para mostrar mensajes personalizados de alerta en función del campo erroneo
    * @param string selector, request
    */
    function sentSupplierMessages(selector, request) {
        cleanCheck(selector); // se limpian los mensajes de errores previos.

            //Bloque para validar y lanzar mensajes de errores para campo nombre
        if(selector == "#supplier_name") {      
            
            if(request == "true") {
                checkKo(selector);
                $(".name_field_duplicate").css("display", "block");
                $("#btn_supplier_submit").attr("type", "button");
            }
            else {
                //checkOk(selector);
                $(".name_field_duplicate").css("display", "none");
                $("#btn_supplier_submit").attr("type", "submit");
            }
        }
            // Bloque para validar campo nif (formato y duplicidad en base de datos)
        else if(selector == "#supplier_nif") {     

            cleanCheck(selector); // se limpian los mensajes de error previos.
            var checkFormatNif = checkNif($("#supplier_nif").val()); // se lanza función para comprobar formato de NIF
            
            if(checkFormatNif == true) {  // Si el formato es incorrecto
                checkKo(selector);
                $(".error_format_nif").css("display", "block"); 
                $("#btn_supplier_submit").attr("type", "button");
            }
            else {  // Si el formato es correcto
              //  checkOk(selector); 
                $(".error_format_nif").css("display", "none");
                $("#btn_supplier_submit").attr("type", "submit");

                if(request == "true") { // Si el formato es correcto a continuación se comprueba que no exista nif duplicado
                    checkKo(selector);
                    $(".nif_field_duplicate").css("display", "block");
                    $("#btn_supplier_submit").attr("type", "button");
                }
                else {
                 //   checkOk(selector);
                    $(".nif_field_duplicate").css("display", "none");
                    $("#btn_supplier_submit").attr("type", "submit");
                }
            }
        }
    }

    /**
     * Se lanza función checkPostalCode() al detectar algún cambio en el campo del formulario "Código Postal"
     */
    $("#supplier_postal_code").change(function(){
        var formatPostalCode = checkPostalCode($(this), $(this).val());
        if(formatPostalCode == true) {
            checkKo($(this));
            $(".error_format_postal_code").css("display", "block");
            $("#btn_supplier_submit").attr("type", "button");
        }
        else {
          //  checkOk($(this));
            $(".error_format_postal_code").css("display", "none");
            $("#btn_supplier_submit").attr("type", "submit");
        }
    })

    /**
     * Se lanza función checkPhone() al detectar algún cambio en el campo del formulario "Teléfono"
     */
      $("#supplier_phone").change(function(){
        var formatPhone = checkPhone($(this), $(this).val());
        if(formatPhone == true) {
            checkKo($(this));
            $(".error_format_phone").css("display", "block");
            $("#btn_supplier_submit").attr("type", "button");
        }
        else {
          //  checkOk($(this));
            $(".error_format_phone").css("display", "none");
            $("#btn_supplier_submit").attr("type", "submit");
        }
    })




})