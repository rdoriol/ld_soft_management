<?php 
    require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/validations_general.controller.php";

    require_once "../models/01-customers.model.php";
    

    /**
    * Clase para validaciones vía Ajax con base de datos
    */
    class AjaxValidation {

        public $customerFieldMatch;

        /**
         * Método para comprobar con AJAX si el valor introducido en formulario ya existe en la base de datos.
         * @param string $table, string $key
         * @return echo fichero json con string $check
         */
        public function checkFieldAjax($table, $key) {
            $check = "false";
            try {
                $value = $this->customerFieldMatch;     // Se almacena en variable valor obtenido del formulario.        
                $check = ValidationController::checkFieldPhp($table, $key, $value);    // Se lanza función para comprobar coincidencias de campos existentes.                
                echo json_encode($check);               
            }
            catch(PDOException $ex) {
                echo "Error interno checkFieldAjax(). Error: " . $ex->getMessage();
            }           
        }
    }



    /**
     * Bloque para llamar a función Ajax según el name del formulario recibido
     */

            // Se captura el name recibido y se almacena en variable para itilizarla en una condición switch case
    foreach(array_keys($_POST) as $name) {
        $postName = $name;
    }     
                
    switch ($postName) {
           
        // Bloque que recibirá variable $_POST y lanzará función php "checkhFieldAjax" para tabla Customers
        case "name_customer_form":
            $ajaxObject = new AjaxValidation();
            $ajaxObject->customerFieldMatch = $_POST["name_customer_form"];
            $ajaxObject->checkFieldAjax("customers", "name_customer");
            break;
        case "name_nif_form":
            $ajaxObject = new AjaxValidation();
            $ajaxObject->customerFieldMatch = $_POST["name_nif_form"];
            $ajaxObject->checkFieldAjax("customers", "nif_cif");
            break;
            
            // Bloque que recibirá variable $_POST y lanzará función php "checkhFieldAjax" para tabla Suppliers
        case "name_supplier_form":
            $ajaxObject = new AjaxValidation();
            $ajaxObject->customerFieldMatch = $_POST["name_supplier_form"];
            $ajaxObject->checkFieldAjax("suppliers", "name_supplier");
            break;
        case "nif_supplier_form":
            $ajaxObject = new AjaxValidation();
            $ajaxObject->customerFieldMatch = $_POST["nif_supplier_form"];
            $ajaxObject->checkFieldAjax("suppliers", "nif");
            break;

        defautl: echo "no se ha recibido valor name";

    }
    
    




    



  



?>