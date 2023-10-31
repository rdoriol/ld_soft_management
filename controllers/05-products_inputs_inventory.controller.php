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
        static public function ctrCreateProductInput($table, $rowNumber=null) {  
            echo "entra";
            try {
                if(isset($_POST["btn_input_product_submit"])) { 
                  //  $rowNumber = $_POST["numbers_rows"];    // Se almacena en variable el array recibido del name "numbers_rows"
                  
                    
                 if(!empty($_POST["select_supplier"]) && !empty($_POST["id_product_item" . $rowNumber])/* && !empty($_POST["amount_item". $rowNumber]) && !empty($_POST["price_item" . $rowNumber])*/) {   
                    
                        /*$token = md5($_POST["select_supplier"]); // Se genera token para seguridad informática.
                                
                        $data = array(  "token"=> $token,
                                        "select_supplier" => $_POST["select_supplier"],
                                        //todo-> cumplimentar array asociativo con campos $_POST[] recibidos de la vista
                                            );

                        $createProductsInput = ProductInputModel::mdlCreateProductInput($table, $data);
                        return $createProductsInput; */
                        echo "hola generando";
                    
                       
                          
                        
                                        
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Proveedor</li><li>Ref.</li><li>Cant.</li><li>Precio (€).</li></ul></div>";
                    }
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateProductInput(). Error: " . $ex->getMessage();
            }
        }






    }