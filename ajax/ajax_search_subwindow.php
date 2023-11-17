<?php
    require_once "../controllers/01-customers.controller.php";
    require_once "../controllers/03-inventory.controller.php";
    require_once "../controllers/05-products_inputs_inventory.controller.php"; 
    require_once "../controllers/06-sales.controller.php";  
    require_once "../controllers/validations_general.controller.php";

    require_once "../models/01-customers.model.php";
    require_once "../models/03-inventory.model.php";
    require_once "../models/04-products_inputs_inventory.model.php";
    require_once "../models/05-sales.model.php";   

      /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   */
    /**
     * Clase que enviará via AJAX registros de la base de datos al documento HTML, pasando previamente por ficheros .js
     */
    class Search {

        /**
         * Método que leera datos de la base de datos para enviarlos a "01.customers/customers.js" y "02.suppliers/suppliers.js", para a continuación renderizarlos vía AJAX
         */
        static public function toListDb($table, $key, $value) {
            $resultData = array();
            try {
                switch ($key) {
                    case "token":
                        $resultData = CustomerController::ctrToList($table, $key, $value);
                        break;
                    case "token_product":
                        $resultData = InventoryController::ctrToListProduct($table, $key, $value);
                        break;
                    case "id_product":
                        $resultData = InventoryController::ctrToListProduct($table, $key, $value);                        
                        break; 
                    case "token_supplier_invoice":
                        $dataSupplierInvoice = ProductInputController::ctrToListInputProduct($table, $key, $value);                             // Se lanza método para obtener datos de tabla sql supplier_invoice
                        $inputNumber = $dataSupplierInvoice[0]->input_number;                                                                   // De la tabla anterior se obtiene el número de movimiento (input_number)
                        $dataInputsProducts = ProductInputController::ctrToListInputProduct("inputs_product", "input_number", $inputNumber);    // Se lanza método para obtener datos de tabla sql inputs_product con clausula WHERE $inputNumber
                        
                        $resultData = array ($dataSupplierInvoice, $dataInputsProducts);                                                        // Se genera array con datos en otros 2 arrays para enviarlo como respuesta a getRegisterInputsProductsAjax()
                        break;
                    case "id":
                        $resultData = CustomerController::ctrToList($table, $key, $value);
                        break;
                    case "ci.token_customer_invoice":
                        $dataCustomerInvoice = SalesController::ctrToListOutputsProducts($table, $key, $value);                                   // Se lanza método para obtener datos de tabla sql customer_invoice
                        $outputNumber = $dataCustomerInvoice[0]->output_number;                                                                   // De la tabla anterior se obtiene el número de movimiento (output_number)
                        $dataOutputInvoice = SalesController::ctrToListOutputsProducts("outputs_products", "op.output_number", $outputNumber);    // Se lanza método para obtener datos de tabla sql outputs_product con clausula WHERE $outputNumber
                       
                        $resultData = array ($dataCustomerInvoice, $dataOutputInvoice);                                                           // Se genera array con datos en otros 2 arrays para enviarlo como respuesta a getRegisterOutputsProductsAjax()
                        break;
                    default:
                       echo "No se ha recibido campo ni valor a buscar";
                }                
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
     /**
     * Objeto que recibirá datos del formulario AJAX generado en "03.inventory/inventory.js"
     */
    else if(isset($_POST["tokenProduct"]) && !empty($_POST["tokenProduct"])) {
        $searchProduct = new Search();
        $searchProduct->toListDb("products", "token_product", $_POST["tokenProduct"]);
    }

    /**
     * Objeto que recibirá datos del formulario AJAX generado en "03.inventory/products_inputs.js"
     */
    else if(isset($_POST["idProduct"]) && !empty($_POST["idProduct"])) {
        $searchProduct = new Search();
        $searchProduct->toListDb("products", "id_product", $_POST["idProduct"]);
    }

    /**
     * Objeto que recibirá datos del formulario AJAX generado en "03.inventory/products_inputs.js"
     */
     else if(isset($_POST["tokenInputs"]) && !empty($_POST["tokenInputs"])) {
        $searchProduct2 = new Search();
        $searchProduct2->toListDb("supplier_invoices", "token_supplier_invoice", $_POST["tokenInputs"]);
    }
 
    /**
     * Objeto que recibirá datos del formulario AJAX generado en "03.inventory/products_inputs.js"
     */
    else if(isset($_POST["idCustomer"]) && !empty($_POST["idCustomer"])) {
        $searchProduct3 = new Search();
        $searchProduct3->toListDb("customers", "id", $_POST["idCustomer"]);
    }

     /**
     * Objeto que recibirá datos del formulario AJAX generado en "11.inventory/products_inputs.js"
     */
    else if(isset($_POST["tokenOutputs"]) && !empty($_POST["tokenOutputs"])) {
        $searchProduct4 = new Search();
        $searchProduct4->toListDb("customer_invoices", "ci.token_customer_invoice", $_POST["tokenOutputs"]);
    }

    












