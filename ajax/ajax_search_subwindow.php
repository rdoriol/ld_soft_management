<?php
    require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/validations.controller.php";

    require_once "../models/01-customers.model.php";

    /**
     * Clase que enviará via AJAX registros de la base de datos a "01.customers/customers.js"
     */
class Search {

    public function toListDb($table, $key, $value) {
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
if(isset($_POST["token"]) && !empty($_POST["token"])) {

    $search = new Search();         
    $search->toListDb("customers", "token", $_POST["token"]);
}














