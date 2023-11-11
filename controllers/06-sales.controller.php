<?php
    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class SalesController  { 

         /**
         * Método que recibirá datos del formulario Entrada Productos y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateCustomerInvoice($table) {                     
            $check = "false";
            
             try {            
                $tokenCustomerInvoices = md5($_POST["customer_number_inv"] . "+" . $_POST["output_number"]);
                $data = array(  "token_customer_invoice"=> $tokenCustomerInvoices,
                                "output_number"=> $_POST["output_number"],
                                "id_customer_ci"=> $_POST["customer_number_inv"],                                                                                           
                                "subtotal_invoice"=> $_POST["subtotal_invoice"],
                                "discount_invoice"=> $_POST["discount_invoice"],
                                "subtotal_with_discount"=> $_POST["subtotal_discount_invoice"],
                                "tax_invoice"=> $_POST["tax_invoice"],
                                "total_invoice"=> $_POST["total_invoice"]
                            );
 
                $createCustomerInvoice = SalesModel::mdlCreateCustomerInvoice($table, $data);
 
                if($createCustomerInvoice == "true") {
                    $check = "true";                                              
                } 
                
                return $check;  
                 
             }
             catch(PDOException $ex) {
                 echo "Error ctrupdateStockProducts(). Error: " . $ex->getMessage();
             }
         }

         /**
         * Método que recibirá datos del formulario Generar Factura y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateProductOutput($table) {                
           $check = "false";
           $data = array();
            try {
                if(isset($_POST["btn_output_product_submit"])) { 

                                        // Se verifican que el nº de cliente y la primera fila de producto no estén vacías
                    if(!empty($_POST["customer_number_inv"]) && !empty($_POST["id_product_item1"])) {   

                                        // Se lanza método para grabar salida de productos en tabla "customer_invoice" (Las tablas "customer_invoices" e "outputs_product" están interralacionadas sql)
                        self::ctrCreateCustomerInvoice("customer_invoices"); 
                                        // Se lista y captura el úlitmo "id_customer_invoice" para poder grabarlo en la tabla "outputs_product"
                        $idCustomerInvoiceValue = SalesModel::mdltoListOutputProducts("customer_invoices", "id_customer_invoice");
                        $idCustomerInvoice = $idCustomerInvoiceValue->id_customer_invoice;

                        $rowsNumbers = $_POST["numbers_rows"]; // Se almacena array con los números de filas de las entradas de productos
                    
                                    // Se recorre array localizando las filas no vacías para lanzar método del modelo
                        foreach($rowsNumbers as $rowNumber) {  

                                        // Condición para desechar filas vacías
                            if(!empty($_POST["id_product_item" . $rowNumber])) {       

                                        // Condición para validar campos obligatorios de cada fila
                                if(!empty($_POST["customer_number_inv"]) && !empty($_POST["product_name_item". $rowNumber]) && !empty($_POST["amount_item". $rowNumber]) && !empty($_POST["price_item". $rowNumber])) {   

                                        // Condición para validar formatos numéricos de campos de cada fila
                                    if(!is_numeric($_POST["amount_item". $rowNumber]) || !is_numeric($_POST["price_item" . $rowNumber]) || !is_numeric($_POST["discount_item" . $rowNumber])) {
                                        echo '<div class="text-center alert-danger rounded error_field"><p>Los campos <i><b>Cant., Precio y Desc.(%)</b></i> solo admiten caracteres numéricos.</p></div>';
                                    }
                                    else {
                                        $token_product_outputs = md5($_POST["customer_number_inv" . "+" . $_POST["id_product_item". $rowNumber]]); // Se genera token para seguridad informática.
                                    
                                        $data = array(  "token_product_outputs"=> $token_product_outputs,                           // Se genera array asociativo con los datos del formulario
                                                        "id_customer_invoice"=> $idCustomerInvoice, 
                                                        "output_number"=> $_POST["output_number"], 
                                                        "id_customer"=> $_POST["customer_number_inv"],                                             
                                                        "id_product_item"=>$_POST["id_product_item". $rowNumber],                                                
                                                        "product_name_item"=> $_POST["product_name_item". $rowNumber],
                                                        "amount_item"=> $_POST["amount_item". $rowNumber],
                                                        "price_item"=> $_POST["price_item". $rowNumber],
                                                        "discount_item"=> $_POST["discount_item". $rowNumber],
                                                        "total_item"=> $_POST["total_item". $rowNumber],                                               
                                                    );

                                                    $createProductsOutput = SalesModel::mdlCreateProductOutput($table, $data);     // Se lanza método para grabar líneas de productos entrantes 

                                                    if($createProductsOutput != "true") {
                                                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado a partir de la línea $rowNumber.</p></div>";
                                                        break;                                                
                                                    }
                                                    else {     
                                                            // Se lanza método para actualizar stock de los productos salientes en factura
                                                        InventoryModel::mdlUpdateStockProducts("products", $_POST["id_product_item". $rowNumber], $_POST["amount_item". $rowNumber]); 
                                                            
                                                        $check = "true";
                                                    }
                                    }
                                }
                                else {
                                    echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Cliente</li><li>Ref.</li><li>Cant.</li><li>Precio (€).</li></ul></div>";
                                    break;
                                }
                            }
                        }
                            // Se lanza página externa para generar pdf de la factura 
                        echo "<script>window.open('./pdf.php');</script>"; 
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Cliente</li><li>Ref.</li><li>Cant.</li><li>Precio (€).</li></ul></div>";
                    }
                }
                return $check;  
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateProductOutput(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que asignará de forma automática números de facturas
         * @param string $table
         * @return int $OutputNumber
         */
        static public function ctrGenerateOutPutNumber($table, $pdf=null) {
            try {
                $lastOutputputNumber =  SalesModel::mdltoListOutputProducts($table, "output_number");       

                if($pdf == null) {      // Si la llamada al método proviene del archivo "01-newInvoice.php"
                    $OutputNumber = $lastOutputputNumber->output_number + 1;     // Se suma uno al último número de factura exsitente en la base de datos
                    return $OutputNumber;
                }
                else {
                    return $lastOutputputNumber->output_number;
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrGenerateOutPutNumber(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá solicitud de listado de la "Vista" y que se comunicará con el "Modelo" para obtener los datos de la base de datos.
         * @param $table string, $key string, $value(string, int)
         * @return $data array de objetos con datos de la base de datos. 
         */
        static public function ctrToListOutputsProducts($table, $key=null, $value=null, $valueDate=null) {              
            try {                
                if(isset($_POST["search"]) && $key != ""){ 
                    if($key == "full_list") {                      
                        $data = SalesModel::mdlToListOutputsProducts($table);  
                    }
                    else if(!empty($valueDate) ) {
                        $data = SalesModel::mdlToListOutputsProducts($table, $key, $valueDate);
                    }
                    else {                
                        $data = SalesModel::mdlToListOutputsProducts($table, $key, $value);
                    }
                }
                else {  // Para consultas realizadas desde la página principal 01-newInvoice
                    $data = SalesModel::mdlToListOutputsProducts($table, $key, $value);
                }
                return $data;
            }
            catch(PDOException $ex) {
                echo "Error interno ctrToListOutputsProducts(). Error: " . $ex->getMessage();
            }
        }
}   



