<?php 
    //require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/03-inventory.controller.php";
    require_once "../controllers/04-inventory_validations.controller.php";    
    
    require_once "../models/01-customers.model.php";
    require_once "../models/03-inventory.model.php";

    /**
    * Clase para validaciones vía Ajax con base de datos
    */
    class AjaxInventory {

        public $productFieldMatch;
        public $tokenProductValue;
        public$tokenProductDelete;

        /**
         * Método para comprobar con AJAX si el valor introducido en formulario ya existe en la base de datos.
         * @param string $table, string $key
         * @return echo fichero json con string $check
         */
        public function checkInventoryFieldAjax($table, $key) {
            $check = "false";
            try {      
                $value = $this->productFieldMatch;              // Se almacena en variable valor obtenido del formulario.   
                $tokenValue = $this->tokenProductDelete;        // Se almacena en variable valor token
                $check = InventoryValidationController::existInventoryField($table, $key, $value, $tokenValue);    // Se lanza función para comprobar coincidencias de campos existentes.                
                
                echo json_encode($check);
            }
            catch(PDOException $ex) {
                echo "Error interno checkFieldAjax(). Error: " . $ex->getMessage();
            }
         }

        /**
         * Función para eliminar registros vía AJAX
        */
        public function deleteProductAjax($table) {
            $check = "false";
            try {
                $token = $this->tokenProductDelete;
                $deleteProduct = new InventoryController();
                $check = $deleteProduct->ctrDeleteProduct22($table, "token_product", $token, "delete_product");
              
                echo json_encode($check);
            }
            catch(PDOException $ex) {
                echo "Error interno deleteProductAjax(). Error: " . $ex->getMessage();
            }
        }
    }


    /**
     * Objeto que recibirá valor del name del formulario y lanzará método checkInventoryFieldAjax()
     */
    if(isset($_POST["ref_name_form"]) && !empty($_POST["ref_name_form"])) { 
        $inventoryObject = new AjaxInventory();
        $inventoryObject->productFieldMatch = $_POST["ref_name_form"];
        $inventoryObject->tokenProductValue = $_POST["tokenProduct"];
        $inventoryObject->checkInventoryFieldAjax("products", "or_product");
    }
    else if(isset($_POST["product_name_form"]) && !empty($_POST["product_name_form"])) {
        $inventoryObject = new AjaxInventory();
        $inventoryObject->productFieldMatch = $_POST["product_name_form"];
        $inventoryObject->tokenProductValue = $_POST["product_name_form"];
        $inventoryObject->checkInventoryFieldAjax("products", "name_product");
    }

      /**
     * Objeto que recibirá valor token del formulario y lanzará método deleteProductAjax()
     */
    else if(isset($_POST["token_product_form"]) && !empty($_POST["token_product_form"])) {
        $inventoryDelete = new AjaxInventory();
        $inventoryDelete->tokenProductDelete = $_POST["token_product_form"];
        $inventoryDelete->deleteProductAjax("products");
    }