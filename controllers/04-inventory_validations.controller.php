<?php 
    require_once "validations_general.controller.php";
    
    /**
     * Clase para implementar métodos devalidaciones para carpeta "03.inventory"
     */
    class InventoryValidationController {

        static public function existInventoryField($table, $key, $value) {
            $check = "false";
            try {                   
                $matchValue1 = ValidationController::removeAccents($value);  
                $matchValue1 = strtolower($matchValue1);    // se convierte a minúsculas
                              
                $value2 = InventoryController::ctrToListProduct($table, $key, $value);   

                foreach($value2 as $item) {  
                    $matchValue2 = ValidationController::removeAccents(strtolower($item->$key)); 
                                                                                       
                    if(strcasecmp($matchValue1, $matchValue2) === 0) {    
                        $check = "true";    // valores coincidentes 
                    }
                }            
                return $check;
            }
            catch(PDOException $ex) {
                echo "error interno existInventoryField(). Error: " . $ex->getMessage();
            }
        }
    }