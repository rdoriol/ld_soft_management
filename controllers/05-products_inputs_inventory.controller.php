<?php
   // require_once "04-inventory_validations.controller.php";

    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class ProductInputController { 

         /**
         * Método que recibirá datos del formulario Ficha Producto y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateProductInput($table) {  
           
            try {
                if(isset($_POST["btn_input_product_submit"])) { 
                    $rowsNumbers = $_POST["numbers_rows"]; // Se almacena array con los números de filas de las entradas de productos

                                // Se recorre array localizando las filas no vacías para lanzar método del modelo
                    foreach($rowsNumbers as $rowNumber) {                            
                                // Condición para desechar filas vacías
                        if(!empty($_POST["id_product_item" . $rowNumber])) {
                                // Condición para validar campos obligatorios
                            if(!empty($_POST["select_supplier"]) && !empty($_POST["amount_item". $rowNumber]) && !empty($_POST["price_item" . $rowNumber])) {   
                                
                                $token = md5($_POST["select_supplier" . "+" . $_POST["id_product_item"]]); // Se genera token para seguridad informática.
                                $data = array(  "token"=> $token,
                                                "select_supplier"=> $_POST["select_supplier"],
                                                "id_product_item"=> $_POST["id_product_item". $rowNumber],
                                                "product_name_item"=> $_POST["product_name_item". $rowNumber],
                                                "amount_item"=> $_POST["amount_item". $rowNumber],
                                                "price_item"=> $_POST["price_item". $rowNumber],
                                                "discount_item"=> $_POST["discount_item". $rowNumber],
                                                "total_item"=> $_POST["total_item". $rowNumber]
                                            );

                                            $createProductsInput = ProductInputModel::mdlCreateProductInput($table, $data);
                                           // return $createProductsInput;
                            }
                            else {
                                echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Proveedor</li><li>Ref.</li><li>Cant.</li><li>Precio (€).</li></ul></div>";
                                break;
                            }
                        }
                        
                        
                    }


                 
                    
                        /*
                                
                     

                         */      
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateProductInput(). Error: " . $ex->getMessage();
            }
        }






    }