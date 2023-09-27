<?php 
    require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/validations.controller.php";

    require_once "../models/01-customers.model.php";
    

    /**
    * 
    */
    class AjaxValidation {

        public $customerNameMatch;

        public function checkFieldAjax() {
            $check = "false";
            try {
                $value1 = $this->customerNameMatch;                             // Se almacena en variable valor obtenido del formulario.
                $matchValue1 = ValidationController::removeAccents($value1);    // Se eliminan tíldes, símbolos, espacios, etc del valor del formulario.
                $matchValue1 = strtolower($matchValue1);                        // Se convierte a minúsculas.

                $value2 = CustomerController::ctrToList("customers", "name_customer", $value1); // Se busca en base de datos valor coincidente con el obtenido del formulario.
                
                foreach($value2 as $matchValue2) {  // Se recorre array con los datos obtenidos de la base de datos.

                    $matchValue2 = ValidationController::removeAccents(strtolower($matchValue2->name_customer)); // Se eliminan tíldes, símbolos, espacios y se convierte a minúsculas los valores de la base de datos..
                
                    if(strcasecmp($matchValue1, $matchValue2) === 0) { // Se realiza comparación entre valores recibidos del formulario y base de datos.
                        $check = "true";
                    }                   
                }
                echo json_encode($check);
                // echo json_encode( "\nmatchVaule1: $matchValue1" . "\nmatchValue2: $matchValue2" . "\ncheck: $check");
            }
            catch(PDOException $ex) {
                echo "Error interno checkFieldAjax(). Error: " . $ex->getMessage();
            }           
        }
    }

    /**
     * Objeto que recibirá variable POST de "AJAX.js" y lanzará función php "checkhFieldAjax()".
     */
    if(isset($_POST["customerNameForm"])) {
        $ajaxObject = new AjaxValidation();
        $ajaxObject->customerNameMatch = $_POST["customerNameForm"];
        $ajaxObject->checkFieldAjax();
    }



    



  



?>