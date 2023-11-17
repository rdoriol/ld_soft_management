<?php
   // require_once "04-inventory_validations.controller.php";

   /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   /*

    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class ProductInputController { 

         /**
         * Método que recibirá datos del formulario Entrada Productos y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateSupplierInvoice($table) {  
            $check = "false";
            
             try {            
                $token_supplier_invoices = md5($_POST["select_supplier"] . "+" . $_POST["input_number"]);
                $data = array(  "token_supplier_invoices"=> $token_supplier_invoices,
                                "input_number"=> $_POST["input_number"],
                                "select_supplier"=> $_POST["select_supplier"],
                                //"input_product_created_date"=> $_POST["input_product_created_date"],                                                                
                                "subtotal_input"=> $_POST["subtotal_input"],
                                "discount_input"=> $_POST["discount_input"],
                                "subtotal_discount_input"=> $_POST["subtotal_discount_input"],
                                "tax_input"=> $_POST["tax_input"],
                                "total_input"=> $_POST["total_input"]
                            );
 
                $createSupplierInvoice = ProductInputModel::mdlCreateSupplierInvoice($table, $data);
 
                if($createSupplierInvoice == "true") {
                    $check = "true";                                              
                } 
                
                return $check;  
                 
             }
             catch(PDOException $ex) {
                 echo "Error ctrupdateStockProducts(). Error: " . $ex->getMessage();
             }
         }

         /**
         * Método que recibirá datos del formulario Entrada Productos y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateProductInput($table) {  
           $check = "false";
           $data = array();
            try {
                if(isset($_POST["btn_input_product_submit"])) { 

                                        // Se verifica que la primera fila de entrada de productos no esté vacía
                    if(!empty($_POST["select_supplier"]) && !empty($_POST["amount_item1"])) {   

                                        // Se lanza método para grabar movimiento de entrada en tabla "supplier_invoice" (Las tablas "supplier_invoices" e "inputs_product" están interralacionadas sql)
                        self::ctrCreateSupplierInvoice("supplier_invoices"); 
                                        // Se lista y captura el úlitmo "id_supplier_invoice" para poder grabarlo en la tabla "inputs_product"
                        $idSupplierInvoiceValue = ProductInputModel::mdltoListColumn("supplier_invoices", "id_supplier_invoice");
                        $idSupplierInvoice = $idSupplierInvoiceValue->id_supplier_invoice;

                        $rowsNumbers = $_POST["numbers_rows"]; // Se almacena array con los números de filas de las entradas de productos
                    
                                    // Se recorre array localizando las filas no vacías para lanzar método del modelo
                        foreach($rowsNumbers as $rowNumber) {  

                                        // Condición para desechar filas vacías
                            if(!empty($_POST["id_product_item" . $rowNumber])) {       

                                        // Condición para validar campos obligatorios de cada fila
                                if(!empty($_POST["select_supplier"]) && !empty($_POST["amount_item". $rowNumber])) {   

                                        // Condición para validar formatos numéricos de campos de cada fila
                                    if(!is_numeric($_POST["amount_item". $rowNumber]) || !is_numeric($_POST["price_item" . $rowNumber]) || !is_numeric($_POST["discount_item" . $rowNumber])) {
                                        echo '<div class="text-center alert-danger rounded error_field"><p>Los campos <i><b>Cant., Precio y Desc.(%)</b></i> solo admiten caracteres numéricos.</p></div>';
                                    }
                                    else {
                                        $token_product_inputs = md5($_POST["select_supplier" . "+" . $_POST["id_product_item"]]); // Se genera token para seguridad informática.
                                    
                                        $data = array(  "token_product_inputs"=> $token_product_inputs,                           // Se genera array asociativo con los datos del formulario
                                                        "id_supplier_invoice"=> $idSupplierInvoice, 
                                                        "input_number"=> $_POST["input_number"],
                                                        "select_supplier"=> $_POST["select_supplier"],                                             
                                                        "id_product_item"=>$_POST["id_product_item". $rowNumber],                                                
                                                        "product_name_item"=> $_POST["product_name_item". $rowNumber],
                                                        "amount_item"=> $_POST["amount_item". $rowNumber],
                                                        "price_item"=> $_POST["price_item". $rowNumber],
                                                        "discount_item"=> $_POST["discount_item". $rowNumber],
                                                        "total_item"=> $_POST["total_item". $rowNumber],                                               
                                                    );

                                                    $createProductsInput = ProductInputModel::mdlCreateProductInput($table, $data);     // Se lanza método para grabar líneas de productos entrantes 

                                                    if($createProductsInput != "true") {
                                                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado a partir de la línea $rowNumber.</p></div>";
                                                        break;                                                
                                                    }
                                                    else {     
                                                            // Se lanza método para actualizar stock y precio de coste de los productos entrantes
                                                        InventoryModel::mdlUpdateStockProducts("products", $_POST["id_product_item". $rowNumber], $_POST["amount_item". $rowNumber], $_POST["price_item". $rowNumber]); 
                                                            
                                                        $check = "true";
                                                    }
                                    }
                                }
                                else {
                                    echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Proveedor</li><li>Ref.</li><li>Cant.</li><li>Precio (€).</li></ul></div>";
                                    break;
                                }
                            }
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Proveedor</li><li>Ref.</li><li>Cant.</li><li>Precio (€).</li></ul></div>";
                    }
                    return $check;  
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateProductInput(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que asignará de forma automática números de entradas
         * @param string $table
         * @return int $InputNumber
         */
        static public function ctrGenerateInputNumber($table) {
            try {
                $lastInputNumber =  ProductInputModel::mdltoListColumn($table, "input_number");       
                $InputNumber = $lastInputNumber->input_number + 1; 
                return $InputNumber;
            }
            catch(PDOException $ex) {
                echo "Error ctrGenerateInputNumber(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá solicitud de listado de la "Vista" y que se comunicará con el "Modelo" para obtener los datos de la base de datos.
         * @param $table string, $key string, $value(string, int)
         * @return $data array de objetos con datos de la base de datos. 
         */
        static public function ctrToListInputProduct($table, $key=null, $value=null, $valueDate=null) {  
            try {                
                if(isset($_POST["search"]) && $key != ""){ 
                    if($key == "full_list") {                      
                        $data = ProductInputModel::mdlToListInputsProducts($table);  
                    }
                    else if(!empty($valueDate) ) {
                        $data = ProductInputModel::mdlToListInputsProducts($table, $key, $valueDate);
                    }
                    else {                
                        $data = ProductInputModel::mdlToListInputsProducts($table, $key, $value);
                    }
                }
                else {  // Para consultas realizadas desde la ventana principal
                    $data = ProductInputModel::mdlToListInputsProducts($table, $key, $value);
                }
                return $data;
            }
            catch(PDOException $ex) {
                echo "Error interno ctrToListInputProduct(). Error: " . $ex->getMessage();
            }
        }




    }