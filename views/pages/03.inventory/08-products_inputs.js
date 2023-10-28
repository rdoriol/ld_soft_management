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

                //Bloque para capturar el valor de los atributos id de los inputs, que previamente se crearon de forma dinámica (donde se mostrarán los datos)
           // var id_value = $(this).next().attr("id"); 
           $("#row_number_selected").val($(this).parent().parent().attr("class"));   // se captura y almacena en input oculto número de fila seleccionada                                               
        })

        /**
         * Función que mostrará datos de productos en fila de entradas al introducir en campo "Ref." id de un producto de la base de datos
         */
        $("#products_inputs_form .input_id").change(function() {
            $("#row_number_selected").val($(this).parent().parent().attr("class"));      // se captura y almacena en input oculto número de fila seleccionada  
            idValue = $(this).val();
            getRegisterProductAjax(idValue); // Se lanza función ubicada en 03.inventory/06-inventory.js
        })

        /**
         * Función que limpiará campos de una fila seleccionada
         */
        $("#products_inputs_form .delete_row_input").click(function(){
           
             var rowNumberDelete = $(this).parent().parent().attr("class");

            $("#id_product_item" + rowNumberDelete).val("");
            $("#product_name_item" + rowNumberDelete).val("");
            $("#amount_item" + rowNumberDelete).val("");
            $("#price_item" + rowNumberDelete).val("");
            $("#discount_item" + rowNumberDelete).val("");
            $("#total_item" + rowNumberDelete).val("");
        })


    })

 






