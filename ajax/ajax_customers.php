<?php 
    require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/validations.controller.php";

    require_once "../models/01-customers.model.php";
    

    /**
    * 
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
     * Objeto que recibirá variable POST de "AJAX.js" y lanzará función php "checkhFieldAjax()".
     */
    if(isset($_POST["name_customer_form"]) && !empty($_POST["name_customer_form"])) {
        $ajaxObject = new AjaxValidation();
        $ajaxObject->customerFieldMatch = $_POST["name_customer_form"];
        $ajaxObject->checkFieldAjax("customers", "name_customer");
       
    }

    if(isset($_POST["name_nif_form"]) && !empty($_POST["name_nif_form"])) {
        $ajaxObject = new AjaxValidation();
        $ajaxObject->customerFieldMatch = $_POST["name_nif_form"];
        $ajaxObject->checkFieldAjax("customers", "nif_cif");
       
    }




    



  



?>