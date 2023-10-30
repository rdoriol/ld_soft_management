 /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS
    -----------------------------------------*/
    
    var productWindow; // variable que almacenará subventana abierta
    
    $(document).ready(function(){
    
        /**
         * Función que abrirá subventana (popUp) con buscador
         */   
        $("#products_inputs_form .search_icon").click(function(){             
            var options = "width=550px, height=500px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
            productWindow = window.open("index.php?pages=05-inventoryPopUpSearch", "Búsqueda", options); 
          
            $("#row_number_selected").val($(this).parent().parent().attr("class"));   // se captura y almacena en input oculto número de fila seleccionada                                               
        })

        /**
         * Función que mostrará datos de productos en fila de entradas al introducir en campo "Ref." id de un producto de la base de datos
         */
        $("#products_inputs_form .input_id").change(function() { 
            var rowNumber = $(this).parent().parent().attr("class");     // Se obtiene número de fila
            $("#row_number_selected").val(rowNumber);                    // Se almacena número de fila en input oculto número de fila seleccionada  
                // Se limpian unidades e importes calculados previamente
            $("#amount_item" + rowNumber).val("");  
            $("#total_item" + rowNumber).val("");
            $("#request_ajax").val("false"); 
           
            
            idValue = $(this).val();  // Se obtiene "id" de producto a buscar en base de datos (vía AJAX)
            
            getRegisterProductAjax(); // Se lanza función ubicada en 03.inventory/06-inventory.js   
                                                                    
            if($("#request_ajax").val() == "false") {  
                $("#id_product_item" + rowNumber).val("");  
                $("#product_name_item" + rowNumber).val("");  
                $("#price_item" + rowNumber).val("");
                $("#amount_item" + rowNumber).val("");  
                $("#total_item" + rowNumber).val("");

                cleanCheck("#amount_item" + rowNumber);
                cleanCheck("#price_item" + rowNumber);
                cleanCheck("#discount_item" + rowNumber);
                $(".error_amount_field").css("display", "none");
                $(".error_field").css("display", "none"); 
            }
               
        })

        /**
         * Función que limpiará campos de una fila seleccionada
         */
        $("#products_inputs_form .delete_row_input").click(function(){
           
             var rowNumberDelete = $(this).parent().parent().attr("class");
             cleanRow(rowNumberDelete);
           
        })

        /**
         * Función que mostrará el resultado del cálculo de los productos de una fila
         */
        $("#products_inputs_form .amounts, #products_inputs_form .price, #products_inputs_form .discount, #products_inputs_form #discount_input").change(function(){
              
            calcRow();              // Se lanza función para calcular y mostrar importe total de fila seleccionada
            calcSubtotalRows();     // Se lanza función para calcular y mostrar importe subtotal de todas las filas
            calcTotalInputsProducts();
        }) 

    })


/**
 * Función que limpiará todos los campos de la fila seleccionada
 */
function cleanAllRow(rowNumber) {
    $("#id_product_item" + rowNumber).val("");
    $("#product_name_item" + rowNumber).val("");
    $("#amount_item" + rowNumber).val("");
    $("#price_item" + rowNumber).val("");
    $("#discount_item" + rowNumber).val("");
    $("#total_item" + rowNumber).val("");
    $("#row_number_selected").val(""); 
    $("#request_ajax").val("false"); 
        
        // Limpieza de mensajes de errores y advertencias
    cleanCheck("#amount_item" + rowNumber);
    cleanCheck("#price_item" + rowNumber);
    cleanCheck("#discount_item" + rowNumber);
    $(".error_amount_field").css("display", "none");
    $(".error_field").css("display", "none");
}

 /**
  * Función que calculará el importe total de una fila producto.
 */
function calcRow() {               
    // var checkCalcRow = false;
    var result = 0;
    var rowNumberValue =  $("#row_number_selected").val();          // Se obtiene y almacena en variable número de fila  
    var amount = $("#amount_item" + rowNumberValue).val();          // Se obtine y almacena en variable número de unidades de producto
    var priceItem = $("#price_item" + rowNumberValue).val();        // Se obtine y almacena en variable precio unitario de producto
    var discount = $("#discount_item" + rowNumberValue).val();      // Se obtine y almacena en variable porcentaje de descuento de producto

        // Bloque para validaciones de los valores obtenidos
    var checkAmount = validateFieldsInputs($("#amount_item" + rowNumberValue), amount); 
    var checkPriceItem = validateFieldsInputs($("#price_item" + rowNumberValue), priceItem);
    var checkDiscount = validateFieldsInputs($("#discount_item" + rowNumberValue), discount);
                                                                                                                    console.log(checkAmount, checkPriceItem, checkDiscount);
    if(checkAmount == true && checkPriceItem == true && checkDiscount == true) {
       // checkCalcRow = true;

            // Se calcula el importe total de la fila 
        result += amount * priceItem / (1 + discount/100);                                          

            // Se muestra por pantalla resultado total del cálculo
        $("#total_item" + rowNumberValue).val(result);
    }
    else {
        $("#total_item" + rowNumberValue).val("");
    }

    return result;
}
   
var arrayResult = new Array(); // Se declara array para almacenar de forma asociativa los resultados de cada fila en función calcSubtotalRows()

function calcSubtotalRows() {
    var rowNumber = $("#row_number_selected").val();        // Se obtiene y almacena número de fila
    var totalResult = 0;

    arrayResult[rowNumber - 1] = parseFloat($("#total_item" + rowNumber).val());
                                                                                        console.log(arrayResult);
   for(var i = 0; i < arrayResult.length; i++) {
        totalResult += arrayResult[i];
   }   
   $("#subtotal_input").val(totalResult);                                                                                     console.log("Resultado todas las filas: " + totalResult);
}

function calcTotalInputsProducts() {
    var check = false;
    var subtotal = $("#subtotal_input").val();
    var inputDiscount = $("#discount_input").val();

    var subtotalWithDiscount = subtotal / (1+inputDiscount/100);
    $("#subtotal_discount_input").val(subtotalWithDiscount);
    
    var tax = (21/100) * subtotalWithDiscount;
    $("#tax_input").val(tax);

    var totalInputProduct = subtotalWithDiscount + tax;
    $("#total_input").val(totalInputProduct);
}

/**
 * Función que validará de forma individual los campos numéricos para el cálculo del importe de la tabla de entrada de productos
 * @param string selector 
 * @param float value 
 * @returns boolean chekValidate
 */
function validateFieldsInputs(selector, value) {
    var checkValidate = false;
    var pattern = /^(\d{1,3}(\,\d{3})*|(\d+))(\.\d{2})?$/;  // Expresión regular que evalua números con decimales (con punto y coma)

    if(isNaN(value)) { 
        checkKo(selector);
        $(".error_field").css("display", "block");
    }
    else if(selector.hasClass("amounts")) {       
        if(pattern.test(value) == false) {
            checkKo(selector);
            $(".error_amount_field").css("display", "block");
        }
        else {
            cleanCheck(selector);
            $(".error_amount_field").css("display", "none");
            checkValidate = true;
        }
    }
    else {
        cleanCheck(selector);
        $(".error_field").css("display", "none");
        checkValidate = true;
    }
    return checkValidate;
}



