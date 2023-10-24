/**
 * Fichero para validaciones de formulario Product vía .js y AJAX
 */

    // Se inicializan variables para chequear formatos y coincidencias de los campos del form
var checkOr = false;
var checkName = false; 
var checkDescription = false;
//var checkSalePrice  = false;

$(document).ready(function(){

    /**
     * Función que comprobará valores existentes en la base de datos
     * @param string selector 
     * @param string nameForm 
     */
    function checkProductFields(selector, nameForm) {       

        $(selector).bind("keyup", function() {
            var value = $(this).val();
                                            var tokenValue = $("#tokenProduct").val();
                                           
            var dataForm = new FormData();     

            dataForm.append(nameForm, value);
                                            dataForm.append("tokenProduct", tokenValue);                     

            $.ajax({                                  
                url: "./ajax/ajax_inventory.php",
                method: "POST",
                data: dataForm,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(request) {                     console.log("que llega de php por ajax: " + request);  
                            if(request) {  
                                sentProductMessages(selector, request); // Si hay respuesta AJAX se lanza función para mostrar mensajes de error
                            }
                        }
            })
        })
    }   

        // Se lanza función para comprobar coincidencias en base de datos del campo "Refencia Original"
    checkProductFields("#or_original_product", "ref_name_form");
           // Se lanza función para comprobar coincidencias en base de datos del campo "Nombre Producto"
    checkProductFields("#product_name", "product_name_form");
    

     /**
    * Función para mostrar mensajes personalizados de alerta en función del campo erroneo
    * @param string selector, request
    */
     function sentProductMessages(selector, request) {
            // se limpian los mensajes de errores previos.
        cleanCheck(selector);  

        switch (selector) {

                 //Bloque para validar y lanzar mensajes de errores para campo Refencia Original
            case "#or_original_product":
                if(request == "true") {
                    checkKo(selector);
                    $(".or_field_duplicate").css("display", "block");
                    checkOr = false;
                }
                else {
                    cleanCheck(selector);
                    $(".or_field_duplicate").css("display", "none");
                    checkOr = true;     // Se almacena como campo válido
                }
                break;

                //Bloque para validar y lanzar mensajes de errores para campo Nombre Producto
            case "#product_name":
                if(!isNaN($(selector).val())) {
                    checkKo(selector);
                    $(".error_format_name").css("display", "block");
                }
                else {
                        // Si el formato es correcto a continuación se comprueba que no exista nombre duplicado en la base de datos
                    cleanCheck(selector);
                    $(".error_format_name").css("display", "none");
    
                    if(request == "true") { 
                        checkKo(selector);
                        $(".name_field_duplicate").css("display", "block");
                        checkName = false; 
                    }
                    else {
                        cleanCheck(selector);
                        $(".name_field_duplicate").css("display", "none");
                        checkName = true;       // Se almacena como campo válido
                    }
                }
                break;

                default:
                    alert("No se han recibido datos");
        }
    }

    /**
     * Función para validar formato y valor vacío de campo Descripción Producto
     */
    $("#product_description").keyup(function(){
        if($(this).val() == "") {                           
            cleanCheck(this);
            $(".error_format_description").css("display", "none"); 
            checkDescription = true; // Se almacena como campo válido (no es obligatorio)
        }
        else {
            if(!isNaN($(this).val())) {              
                checkKo(this);
                $(".error_format_description").css("display", "block"); 
                checkDescription = false; // Se almacena como campo válido (no es obligatorio)
            }
            else {
                cleanCheck(this);
                $(".error_format_description").css("display", "none");                
                checkDescription = true;       // Se almacena como campo válido
            }
        }     
    })

    /**
     * Función para validar formato y valor vacío de campo Precio de Venta
     */
        $("#sale_price_product").keyup(function(){
            if($(this).val() == "") {                           
                cleanCheck(this);
                $(".error_format_sales_price").css("display", "none"); 
                checkSalePrice = true; // Se almacena como campo válido (no es obligatorio)
            }
            else {
                if(isNaN($(this).val())) {              
                    checkKo(this);
                    $(".error_format_sales_price").css("display", "block"); 
                    checkSalePrice = false; // Se almacena como campo válido (no es obligatorio)
                }
                else {
                    cleanCheck(this);
                    $(".error_format_sales_price").css("display", "none");                
                    checkSalePrice = true;       // Se almacena como campo válido
                }
            }     
        })
    
    /**
     * Función que comprobará los campos obligatorios que estén vacíos y mostrará mensajes de errores por campo específico
    * @var boolean  emptyCategory, emptyOr, emptyName, 
    * @return boolean checkAllFields
    */
    function checkEmptyFields() {
        var emptyCategory = false; var emptyOr = false; var emptyName = false; var checkAllFields = false;

            if($("#select_item_category").val() == "") {
                checkKo("#select_item_category");
                $(".require_fields").css("display", "block");           
            }
            else {
                cleanCheck("#select_item_category");
                $(".require_fields").css("display", "none");
                emptyCategory = true;
            }

            if($("#or_original_product").val() == "") {
                checkKo("#or_original_product");
                $(".require_fields").css("display", "block");           
            }
            else {
              //  cleanCheck("#or_original_product");
             //   $(".require_fields").css("display", "none");
                emptyOr = true;
            }

            if($("#product_name").val() == "") {
                checkKo("#product_name");
                $(".require_fields").css("display", "block");           
            }
            else {
               // cleanCheck("#product_name");
             //   $(".require_fields").css("display", "none");
                emptyName = true;
            }
            if(emptyCategory == true && emptyOr == true && emptyName == true) {
                checkAllFields = true;
            }
            return checkAllFields;
    }
    /**
     * Función que capturará evento submit del formulario y le permitirá enviar datos del formulario según resultado de las validaciones
     */
   // $("#btn_product_submit").click(function(){
    $("#new_product_form").submit(function(){
            // Se lanza función para comprobar valores vacíos en campos obligatorios"
        var emptyFields = checkEmptyFields();

            // Si todas las validaciones son correctas, se activa el submit
        if(emptyFields == true && checkOr == true && checkName == true && checkDescription == true && checkSalePrice == true) {        
            return true;
        }
        else {                                                                
            return false; 
        }
    })
})


