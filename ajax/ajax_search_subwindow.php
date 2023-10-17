<?php
    require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/validations.controller.php";

    require_once "../models/01-customers.model.php";

    /**
     * Clase que enviará via AJAX registros de la base de datos a "01.customers/customers.js"
     */
    class Search {

        static public function toListDb($table, $key, $value) {
            $resultData = array();
            try {
                $resultData = CustomerController::ctrToList($table, $key, $value);
                echo json_encode($resultData);
            }
            catch(PDOException $ex) {
                echo "Error interno toListDb(). Error: " . $ex->getMessage();
            }
        }
    }
    
    /**
     * Objeto que recibirá datos del formulario AJAX generado en "01.customers/customers.js"
     */
    if(isset($_POST["tokenCustomer"]) && !empty($_POST["tokenCustomer"])) {
        $searchCustomer = new Search();         
        $searchCustomer->toListDb("customers", "token", $_POST["tokenCustomer"]);
    }
    /**
     * Objeto que recibirá datos del formulario AJAX generado en "02.suppliers/suppliers.js"
     */
    else if(isset($_POST["tokenSupplier"]) && !empty($_POST["tokenSupplier"])) { 
        $searchSupplier = new Search();
        $searchSupplier->toListDb("suppliers", "token", $_POST["tokenSupplier"]);
    }

    












