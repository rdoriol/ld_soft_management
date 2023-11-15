<?php

 //require_once "../controllers/01-customers.controller.php";
 require_once "../controllers/02-suppliers.controller.php"; 
 
 require_once "../models/01-customers.model.php";
 

   /**
    * Clase para validaciones vía Ajax con base de datos
    */
    class AjaxSupplier {

        public $tokenSupplierDelete;     

        /**
         * Función para eliminar registros vía AJAX
        */
        public function deleteSupplierAjax($table) {
            $check = "false";
            try {
                $token = $this->tokenSupplierDelete;
                $deleteSupplier = new SupplierController(); 
                $check = $deleteSupplier->ctrDeleteSupplierAjax($table, "token", $token);
              
                echo json_encode($check);
            }
            catch(PDOException $ex) {
                echo "Error interno deleteSupplierAjax(). Error: " . $ex->getMessage();
            }
        }
    }

    /**
     * Objeto que recibirá valor token del formulario y lanzará método deleteSupplierAjax()
     */
    if(isset($_POST["token_supplier_form"]) && !empty($_POST["token_supplier_form"])) {
        $supplierDelete = new AjaxSupplier();
        $supplierDelete->tokenSupplierDelete = $_POST["token_supplier_form"];
        $supplierDelete->deleteSupplierAjax("suppliers");
    }