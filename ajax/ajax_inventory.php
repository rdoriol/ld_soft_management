<?php 
    require_once "../controllers/03-inventory.controller.php";
    require_once "../controllers/04-inventory_validations.controller.php";    
    
    require_once "../models/03-inventory.model.php";

    /**
    * Clase para validaciones vía Ajax con base de datos
    */
    class AjaxInventoryValidation {

        public $productFieldMatch;

        /**
         * Método para comprobar con AJAX si el valor introducido en formulario ya existe en la base de datos.
         * @param string $table, string $key
         * @return echo fichero json con string $check
         */
        public function checkInventoryFieldAjax($table, $key) {
            $check = "false";
            try {      
                $value = $this->productFieldMatch;     // Se almacena en variable valor obtenido del formulario.        
                $check = InventoryValidationController::existInventoryField($table, $key, $value);    // Se lanza función para comprobar coincidencias de campos existentes.                
                echo json_encode($check);
            }
            catch(PDOException $ex) {
                echo "Error interno checkFieldAjax(). Error: " . $ex->getMessage();
            }
         }
    }

    /**
     * Objeto que recibirá valor del name del formulario y lanzará método checkInventoryFieldAjax()
     */
    if(isset($_POST["ref_name_form"]) && !empty($_POST["ref_name_form"])) { 
        $inventoryObject = new AjaxInventoryValidation();
        $inventoryObject->productFieldMatch = $_POST["ref_name_form"]; 
        $inventoryObject->checkInventoryFieldAjax("products", "or_product");
    }