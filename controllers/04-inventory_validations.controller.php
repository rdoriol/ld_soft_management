<?php 
    require_once "validations_general.controller.php";
    
    /**
     * Clase para implementar métodos devalidaciones para carpeta "03.inventory"
     */
    class InventoryValidationController {

        static public function existInventoryField($table, $key, $value, $tokenValueForm=null) {
            $check = "false";
            try {                   
                $matchValue1 = ValidationController::removeAccents($value);  
                $matchValue1 = strtolower($matchValue1);    // se convierte a minúsculas
                              
                $value2 = InventoryController::ctrToListProduct($table, $key, $value);   

                foreach($value2 as $item) {  
                    $matchValue2 = ValidationController::removeAccents(strtolower($item->$key)); 
                    
                                                                                       
                    if(strcasecmp($matchValue1, $matchValue2) === 0) {    
                        $valueToken = $item->token_product;
                        if($valueToken != $tokenValueForm) {
                            $check = "true";    // valores coincidentes con otro registro de la base de datos
                        }
                    }
                }            
                return $check;
            }
            catch(PDOException $ex) {
                echo "error interno existInventoryField(). Error: " . $ex->getMessage();
            }
        }
    }