<?php
        require_once "connection.model.php";

    /**
     * Clase que implentará métodos para realizar un CRUD completo en la tabla "outputs_products" y "customer_invoices" de la base de datos.
     */
    class SalesModel {

         /**
         * Método creará registro con entrada completa (con resultados totales )de todos los productos
         */
        static public function mdlCreateCustomerInvoice($table, $data) {                      // todo DONE IT
            $check = "false";
            try {
                $sql = "INSERT INTO $table VALUES (null, :token_customer_invoice, :id_customer_ci, :output_number, :subtotal_invoice, :discount_invoice, :subtotal_with_discount, :tax_invoice, :total_invoice, null, null)";
                $stmt = Connection::mdlConnect()->prepare($sql);
                                
                $stmt->bindParam(":token_customer_invoice", $data["token_customer_invoice"], PDO::PARAM_STR);                
                $stmt->bindParam(":id_customer_ci", $data["id_customer_ci"], PDO::PARAM_INT);
                $stmt->bindParam(":output_number", $data["output_number"], PDO::PARAM_INT);                
                $stmt->bindParam(":subtotal_invoice", $data["subtotal_invoice"]);
                $stmt->bindParam(":discount_invoice", $data["discount_invoice"]);
                $stmt->bindParam(":subtotal_with_discount", $data["subtotal_with_discount"]);
                $stmt->bindParam(":tax_invoice", $data["tax_invoice"]);
                $stmt->bindParam(":total_invoice", $data["total_invoice"]);

                if($stmt->execute()) {
                   $check = "true";
                }
                else {
                    print_r(Connection::mdlConnect->errorInfo());
                }
                return $check;              
            }
            catch(PDOException $ex) {
                echo "Error mdlCreateCustomerInvoice(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para crear/grabar entradas nuevas de productos al stock en la base de datos.
         * @param $table de tipo string, $data array con datos obtenidos de un formulario.
         * @return $check de tipo string.
         */
        static public function mdlCreateProductOutput($table, $data) {             // todo DONE IT
            $check = "false";
            $sql = "INSERT INTO $table VALUES (null, :token, :id_customer_invoice, :output_number, :id_customer, :id_product, :product_concept, :output_units, :unit_sale_price, :unit_discount_product, :total_row_output, null)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.                
                $stmt->bindParam(":token", $data["token_product_outputs"], PDO::PARAM_STR);   
                $stmt->bindParam(":id_customer_invoice", $data["id_customer_invoice"], PDO::PARAM_INT); 
                $stmt->bindParam(":output_number", $data["output_number"], PDO::PARAM_INT);             
                $stmt->bindParam(":id_customer", $data["id_customer"], PDO::PARAM_INT);                
                $stmt->bindParam(":id_product", $data["id_product_item"], PDO::PARAM_INT); 
                $stmt->bindParam(":product_concept", $data["product_name_item"], PDO::PARAM_STR);                 
                $stmt->bindParam(":output_units", $data["amount_item"], PDO::PARAM_INT);
                $stmt->bindParam(":unit_sale_price", $data["price_item"]);
                $stmt->bindParam(":unit_discount_product", $data["discount_item"]);
                $stmt->bindParam(":total_row_output", $data["total_item"]);
            
                if($stmt->execute()) {
                    $check = "true";
                }
                else {
                    print_r(Connection::mdlConnect->errorInfo());
                }

               // $stmt->close();  // se deja comentado, genera problemas en la comunicación con base de datos
               // $stmt = null;
            }
            catch(PDOException $ex) {
                echo "Error interno mdlCreateProductOutput" . $ex->getMessage();
               // $stmt->close();
                //$stmt = null;
            }
            return $check;
        }

        /**
         * Método que listará la fila con el mayor valor indicado (asignará de forma automática números de facturas y capturará úlitmo registro grabado de customer_invoice) 
         * @param string $table
         * @return int object
         */
        static public function mdltoListOutputProducts($table, $key) {            //todo DONE IT
            try {
                $sql = "SELECT MAX($key) AS '$key' FROM $table";
               
                $stmt = Connection::mdlConnect()->prepare($sql);

                if($stmt->execute() && $stmt->rowCount() > 0) {
                    return $stmt->fetchObject();
                }
            }
            catch(PDOException $ex) {
                echo "Error mdltoListOutputProducts(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para leer/consultar todos los datos de las tablas "outputs_products", "products", "customers" y "customer_invoices" (INNER JOIN)
         * @param string $table, $key, $null
         * @return array de objetos @data
         */
        static public function mdlToListOutputsProducts($table, $key=null, $value=null) {                //todo  DEVELOPING
            $sql = "";
            try {
            if($key == null) {                                                  // Consulta para listar tabla completa de customer_invoices
                    $sql = "SELECT ci.*, DATE_FORMAT(ci.created_date_customer_invoice, '%d/%m/%Y') AS created_date_customer_invoice, c.*, DATE_FORMAT(c.created_date, '%d/%m/%Y') AS created_date
                            FROM customer_invoices ci                           
                            INNER JOIN customers c ON c.id = ci.id_customer_ci                            
                            ORDER BY ci.output_number ASC;";                   
                }
            else if($table == "outputs_products") {                             // Consulta para listar filas de productos en un número de factura concreto de la tabla outputs_products 
                    $sql = "SELECT op.*, DATE_FORMAT(op.created_date_output, '%d/%m/%Y') AS created_date_output, p.*, DATE_FORMAT(p.created_date_product, '%d/%m/%Y') AS created_date_product
                            FROM outputs_products op
                            INNER JOIN products p ON p.id_product = op.id_product_op
                            WHERE $key LIKE '%$value%'
                            ORDER BY $key ASC;";                                                           
                }
                else {                                                          // Consulta para listar datos de facturas concretas de la tabla customer_invoices
                    $sql = "SELECT ci.*, DATE_FORMAT(ci.created_date_customer_invoice, '%d/%m/%Y') AS created_date_customer_invoice, c.*, DATE_FORMAT(c.created_date, '%d/%m/%Y') AS created_date
                            FROM customer_invoices ci                           
                            INNER JOIN customers c ON c.id = ci.id_customer_ci
                            WHERE $key LIKE '%$value%'
                            ORDER BY $key ASC;";                               
                }

                $stmt = Connection::mdlConnect()->prepare($sql);
                if($stmt->execute() && $stmt->rowCount() > 0) {
                    while($rowItem = $stmt->fetchObject()) {
                        $data[] = $rowItem;
                    }
                    //$stmt->close();
                    //$stmt = null;
                    return $data;
                }
            }
            catch(PDOException $ex) {
                echo "Error interno mdlToListOutputsProducts()" . $ex->getMessage();
            }
        }

    }


     // No se cierra etiqueta php por seguridad



     /*
                    $sql = "SELECT *, DATE_FORMAT(created_date_output, '%d/%m/%Y') AS created_date_output
                            FROM $table
                            WHERE $key LIKE '%$value%'
                            ORDER BY $key ASC;";  
     */