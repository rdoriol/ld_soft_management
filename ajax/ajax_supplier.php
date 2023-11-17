<?php

    //require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/02-suppliers.controller.php"; 
    
    require_once "../models/01-customers.model.php";

   /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   /*

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