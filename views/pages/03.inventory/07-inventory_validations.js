/**
 * Fichero para validaciones de formulario Product vía .js y AJAX
 */

    // Se inicializan variables para chequear formatos y coincidencias de los campos del form
var ckeckCategory, checkOr, checkName, checkDescription  = false;


$(document).ready(function(){

    //todo empezar validadiones de cada campo por aquí .change (vacíos, formatos, coincidencias, y activar botón submit)


    function checkProductFields(selector, nameForm) {
        $(selector).change(function() {
            var value = $(this).val();
                                           
            var dataForm = new FormData();     

            dataForm.append(nameForm, value);                         console.log("Ref.Original: " + value);

            $.ajax({                                  
                url: "./ajax/ajax_inventory.php",
                method: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(request) {                    console.log("respuesta: " + request);
                            if(request) { 
                                sentProductMessages(selector, request);
                            }
                        }
            })
        })
    }   

    PRIMERO COMPROBAR CAMPOS VACÍOS

    SEGUNDO COMPROBAR FORMATOS

    TERCERO COINCIDENCIAS EN BASE DE DATOS

    CUARTO SI TODO OK, ACTIVAR BOTON SUBMIT
        // Se lanza función para comprobar coincidencias en base de datos del campo "Refencia Original"
    // checkProductFields("#or_original_product", "ref_name_form");

     /**
    * Función para mostrar mensajes personalizados de alerta en función del campo erroneo
    * @param string selector, request
    */
     function sentProductMessages(selector, request) {
        cleanCheck(selector); // se limpian los mensajes de errores previos.

            //Bloque para validar y lanzar mensajes de errores para campo Refencia Original
        if(selector == "#or_original_product") {      
            
            if(request == "true") {
                checkKo(selector);
                $(".name_field_duplicate").css("display", "block");
            }
            else {
                checkOk(selector);
                $(".name_field_duplicate").css("display", "none");
            }
        }
        /*    // Bloque para validar campo Nombre (formato y duplicidad en base de datos)
        else if(selector == "#product_name") {     

            cleanCheck(selector); // se limpian los mensajes de error previos.
            var checkFormatNif = checkNif($("#supplier_nif").val()); // se lanza función para comprobar formato de NIF
            
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
        }   */
    }
    

})


//todo Función que activará botón grabar

