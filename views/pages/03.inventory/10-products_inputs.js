 /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS - CÁLCULOS DE CAMPOS - VALIDACIONES INPUTS PRODUCTS
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

                // Se limpian unidades e importes calculados previamente, así como el token oculto previamente almacenado
            $("#amount_item" + rowNumber).val("0");  
            $("#total_item" + rowNumber).val("");
            $("#request_ajax").val("false"); 
            $("#tokenProduct").val("");
           
            
            getRegisterProductAjax(); // Se lanza función ubicada en 03.inventory/08-inventory.js   
                  
                // Si el id del producto no existe en la base de datos se limpian todos los campos de la fila y eliminan mensajes de error previos
            if($("#request_ajax").val() == "false") {  
                $("#id_product_item" + rowNumber).val("");  
                $("#product_name_item" + rowNumber).val("");  
                $("#price_item" + rowNumber).val(0);
                $("#amount_item" + rowNumber).val(0);  
                $("#total_item" + rowNumber).val("");
                cleanCheck("#amount_item" + rowNumber);
                cleanCheck("#price_item" + rowNumber);
                cleanCheck("#discount_item" + rowNumber);
                $(".error_amount_field").css("display", "none");
                $(".error_field").css("display", "none"); 
            }
        })

        /**
         * Función que eliminará campos de una fila seleccionada
         */
        $("#products_inputs_form .delete_row_input").click(function(){
           
             var rowNumberDelete = $(this).parent().parent().attr("class");
             cleanAllRow(rowNumberDelete);              
        })

        /**
         * Función que mostrará el resultado del cálculo de los productos de las filas
         */
        $("#products_inputs_form .amounts, #products_inputs_form .price, #products_inputs_form .discount, #discount_input").change(function(){
              
            var result = calcRow();                  // Se lanza función para calcular y mostrar importe total de fila seleccionada
                       
            if(result  < 0 || result > 0) { 
            calcSubtotalRows();                      // Se lanza función para calcular y mostrar importe subtotal de todas las filas
            calcTotalInputsProducts();               // Se lanza función para calcular y mostrar importe total de de las entradas de productos
            }
        }) 

        /**
         * Función que al hacer click en botón añadirá más líneas de productos
         */
        $("#btn_add_product_row").click(function() {                    
            $(".hidden_rows").css("display", "revert");
            $(".btn_add").css("display", "none");
            $(".btn_minus").css("display", "block");
        })
        
        /**
         * Función inversa a la anterior. Al hacer click en botón restará las líneas de productos añadidas anteriormente
         */
        $("#btn_delete_product_row").click(function() {                    
            $(".hidden_rows").css("display", "none");
            $(".btn_minus").css("display", "none");
            $(".btn_add").css("display", "block");                
        })
    
        /**
         * Función que comprobará campos vacíos antes de enviar los datos del formulario a backend php. Capturará el submit del form
         */
        $("#btn_input_product_submit").click(function(){
                // Se obtienen los valores introducidos en los diferentes campos obligatorios
            var supplier = $("#father_select_item_category").val();            
            var idProduct = $("#id_product_item1").val();
            var concept = $("#product_name_item1").val();
            var amount = $("#amount_item1").val();            
                // Se verifican los campos vacíos y se bloquea el envío del formulario
            if(supplier == "" || idProduct == "" || concept == "" || amount == 0) {
                $(".require_fields").css("display", "block");                
                return false;
            }
                // Si todo está correcto, se elimina mensaje de error previo y se deja enviar el submit
            else {
                $(".require_fields").css("display", "none");
            }    
        })
    

    })


        // Fin bloque JQuery --------------------------------------------

/**
 * Función que limpiará todos los campos de la fila seleccionada
 */
function cleanAllRow(rowNumber) {
        // Limpiezas de todos los campos de la fila
    $("#id_product_item" + rowNumber).val("");
    $("#product_name_item" + rowNumber).val("");
    $("#amount_item" + rowNumber).val(0);
    $("#price_item" + rowNumber).val(0);
    $("#discount_item" + rowNumber).val(0);
    $("#total_item" + rowNumber).val(0);
    $("#row_number_selected").val(""); 
    $("#request_ajax").val("false"); 
        // Si hubiera un valor almacenado en el array de la fila seleccionada se coloca a 0 para recalculo correcto. (arrayResult declarado en línea 150 de este archivo) (rowNumberDelete declarado en línea 54 de este archivo)
    arrayResult[rowNumber - 1] = 0;
    
        // Limpieza de mensajes de errores y advertencias
    cleanCheck("#amount_item" + rowNumber);
    cleanCheck("#price_item" + rowNumber);
    cleanCheck("#discount_item" + rowNumber);
    $(".error_amount_field").css("display", "none");
    $(".error_field").css("display", "none");    
        // Al limpiar todos los campos de una fila se recalculan los importes       
        calcRow();                  
        calcSubtotalRows();         
        calcTotalInputsProducts();  
}

 /**
  * Función que calculará el importe total de una fila producto.
 */
function calcRow() {               
    // var checkCalcRow = false;
    var result = 0.00;
    var rowNumberValue =  $("#row_number_selected").val();                      // Se obtiene y almacena en variable número de fila  
    var amount = $("#amount_item" + rowNumberValue).val();                      // Se obtiene y almacena en variable número de unidades de producto
    var priceItem = parseFloat($("#price_item" + rowNumberValue).val());  
    var discount = parseFloat($("#discount_item" + rowNumberValue).val());  
                                                                                            
        // Bloque para validaciones de los valores obtenidos
    var checkAmount = validateFieldsInputs($("#amount_item" + rowNumberValue), amount);
    var checkDiscount = validateFieldsInputs($("#discount_item" + rowNumberValue), discount); 
    var checkPriceItem = validateFieldsInputs($("#price_item" + rowNumberValue), priceItem);     
                                                                        
    if(checkAmount == true && checkPriceItem == true && checkDiscount == true) {   
        
            // Se calcula el importe total de la fila 
        result += amount * priceItem / (1 + discount/100);                                          

            // Se muestra por pantalla resultado total del cálculo, redondeando a dos decimales
        $("#total_item" + rowNumberValue).val( (Math.round(result * 100) / 100).toFixed(2) );

            // Se activan botones submit de 02-productInput y 01-newInvoice
        $("#btn_input_product_submit").attr("type", "submit");              
        $("#btn_invoice_product_submit").attr("type", "submit");            
        
    }
    else {   
             // Se limpian cálculos 
        $("#total_item" + rowNumberValue).val("");  
        $("#subtotal_input").val("");
        $("#subtotal_discount_input").val("");
        $("#subtotal_discount_input").val("");
        $("#tax_input").val("");
        $("#total_input").val("");

        $("#btn_input_product_submit").attr("type", "button");              // Se desactiva botón submit de 02-productInput
        $("#btn_invoice_product_submit").attr("type", "button");            // Se desactiva botón submit de 01-newInovice
              
    }       

    return parseFloat(result);
}
   
var arrayResult = new Array(); // Se declara array para almacenar de forma asociativa los resultados de cada fila en función calcSubtotalRows() // todo

function calcSubtotalRows() {      
    var rowNumber = $("#row_number_selected").val();        // Se obtiene y almacena número de fila
    var totalResult = 0;
   
    arrayResult[rowNumber - 1] = $("#total_item" + rowNumber).val();
                                                                                       
   for(var i = 0; i < arrayResult.length; i++) {
        totalResult += parseFloat(arrayResult[i]);
   }   
   
    if(isNaN(totalResult)) {
        $("#subtotal_input").val(0);
    }
    else {
        $("#subtotal_input").val( (Math.round(totalResult * 100) / 100).toFixed(2) );
    }                                                  
}

function calcTotalInputsProducts() {
    var subtotal = $("#subtotal_input").val();
    var inputDiscount = $("#discount_input").val();

    validateFieldsInputs($("#discount_input"), inputDiscount);     // Se valida valor obtenido del campo Descuento (%) (para mostrar mensajes de error)

    var subtotalWithDiscount = parseFloat(subtotal / (1 + inputDiscount/100));  // Se calcula subtotal con descuento
    $("#subtotal_discount_input").val( (Math.round(subtotalWithDiscount * 100) / 100).toFixed(2) );
    
    var tax = (21/100) * parseFloat(subtotalWithDiscount);      // Se calculan impuestos
    $("#tax_input").val( (Math.round(tax * 100) / 100).toFixed(2) );

    var totalInputProduct = parseFloat(subtotalWithDiscount) + parseFloat(tax);    // Se calcula total del documento
    $("#total_input").val( (Math.round(totalInputProduct * 100) / 100).toFixed(2) );

    if($("#btn_input_product_submit").attr("type") == "submit") {                       // Si después de validaciones en otros métodos el botón de grabar sigue siendo submit
        
        if(isNaN(subtotalWithDiscount) || isNaN(tax) || isNaN(totalInputProduct)) {     // Se comprueba que todos los valores obtenidos sean números
            $("#subtotal_discount_input").val(0 );
            $("#tax_input").val( 0);
                                                                                    
                // Se desactivan botones submit de 02-productInput y 01-newInvoice
            $("#btn_input_product_submit").attr("type", "button");              
            $("#btn_invoice_product_submit").attr("type", "button");
        }
        else {
                // Se desactivan botones submit de 02-productInput y 01-newInvoice
            $("#btn_input_product_submit").attr("type", "submit");              
            $("#btn_invoice_product_submit").attr("type", "submit");            
        }
    }  
    
}

/**
 * Función que validará de forma individual los campos numéricos para el cálculo del importe de la tabla de entrada de productos
 * @param string selector 
 * @param float value 
 * @returns boolean chekValidate
 */
function validateFieldsInputs(selector, value) {
    var checkValidate = false;
  

    if(isNaN(value)) { 
        checkKo(selector);                                  
        $(".error_field").css("display", "block");
    }

    else {
        cleanCheck(selector);
        $(".error_field").css("display", "none"); 
        checkValidate = true;
    }
    return checkValidate;
}



