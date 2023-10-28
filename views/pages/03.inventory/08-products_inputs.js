 /* BLOQUE SUBVENTANA BUSCADOR DE REGISTROS
    -----------------------------------------*/
    
    var productWindow; // variable que almacenará subventana abierta

    $(document).ready(function(){
    
        /**
         * Función que abrirá subventana (popUp) con buscador
         */   
        $(".search_icon").click(function(){             
            var options = "width=550px, height=500px, top=100px, left=500px, resizable=no, scrollbars=no, location=no, directories=no";
            productWindow = window.open("index.php?pages=05-inventoryPopUpSearch", "Búsqueda", options); 

                //Bloque para capturar el valor de los atributos id de los inputs, que previamente se crearon de forma dinámica (donde se mostrarán los datos)
           // var id_value = $(this).next().attr("id"); 
           // var rowNumber = $(this).parent().parent().attr("id");    console.log(rowNumber); // se captura número de fila
        
            
            
            
                                                           
        })

        /**
         * Función que mostrará datos de productos en tabla entrada movimientos al introducir id de un producto
         */
        $("#id_product_item1").change(function() {
            var idValue = $("#id_product_item1").val(); 
            getRegisterProductAjax(idValue); // Se lanza función ubicada en 03.inventory/06-inventory.js
        })


    })






