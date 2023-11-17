<?php 
    require_once "validations_general.controller.php";

   /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   /*
    
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
                            $check = "true";    // valor coincidente con otro registro de la base de datos (no se permite)
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