<?php
        require_once "connection.model.php";

    /**
     * Clase que implentará métodos para realizar un CRUD completo en la tabla "inputs_product" de la base de datos.
     */
    class ProductInputModel { 

        /**
         * Método para crear/grabar entradas nuevas de productos al stock en la base de datos.
         * @param $table de tipo string, $data array con datos obtenidos de un formulario.
         * @return $check de tipo string.
         */
        static public function mdlCreateProductInput($table, $data) {
            $check = "false";
            $sql = "INSERT INTO $table VALUES (null, :token, :id_supplier_invoice, :input_number, :id_supplier, :id_product, :product_concept, :input_units, :unit_cost_product, :unit_discount_product, :total_row_input, null)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.                
                $stmt->bindParam(":token", $data["token_product_inputs"], PDO::PARAM_STR);   
                $stmt->bindParam(":id_supplier_invoice", $data["id_supplier_invoice"], PDO::PARAM_INT); //todo
                $stmt->bindParam(":input_number", $data["input_number"], PDO::PARAM_INT);             
                $stmt->bindParam(":id_supplier", $data["select_supplier"], PDO::PARAM_INT);                
                $stmt->bindParam(":id_product", $data["id_product_item"], PDO::PARAM_INT); 
                $stmt->bindParam(":product_concept", $data["product_name_item"], PDO::PARAM_STR);                 
                $stmt->bindParam(":input_units", $data["amount_item"], PDO::PARAM_INT);
                $stmt->bindParam(":unit_cost_product", $data["price_item"]);
                $stmt->bindParam(":unit_discount_product", $data["discount_item"]);
                $stmt->bindParam(":total_row_input", $data["total_item"]);
            
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
                echo "Error interno mdlCreateProductInput" . $ex->getMessage();
               // $stmt->close();
                //$stmt = null;
            }
            return $check;
        }
    

        /**
         * Método que asignará de forma automática números de entradas
         * @param string $table
         * @return int object
         */
        static public function mdltoListColumn($table, $value) {
            try {
                $sql = "SELECT MAX($value) AS '$value' FROM $table";
               
                $stmt = Connection::mdlConnect()->prepare($sql);

                if($stmt->execute() && $stmt->rowCount() > 0) {
                    return $stmt->fetchObject();
                }
            }
            catch(PDOException $ex) {
                echo "Error mdltoListInputProduct(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método creará registro con entrada completa (con resultados totales )de todos los productos
         */
        static public function mdlCreateSupplierInvoice($table, $data) {
            $check = "false";
            try {
                $sql = "INSERT INTO $table VALUES (null, :token_supplier_invoice, :id_supplier, :input_number, :invoice_date, :subtotal_input, :discount_input, :subtotal_with_discount, :tax_input, :total_input, null)";
                $stmt = Connection::mdlConnect()->prepare($sql);
                                
                $stmt->bindParam(":token_supplier_invoice", $data["token_supplier_invoices"], PDO::PARAM_STR);                
                $stmt->bindParam(":id_supplier", $data["select_supplier"], PDO::PARAM_INT);
                $stmt->bindParam(":input_number", $data["input_number"], PDO::PARAM_INT);
                $stmt->bindParam(":invoice_date", $data["input_product_created_date"]); //todo aqui?? el error
                $stmt->bindParam(":subtotal_input", $data["subtotal_input"]);
                $stmt->bindParam(":discount_input", $data["discount_input"]);
                $stmt->bindParam(":subtotal_with_discount", $data["subtotal_discount_input"]);
                $stmt->bindParam(":tax_input", $data["tax_input"]);
                $stmt->bindParam(":total_input", $data["total_input"]);

                if($stmt->execute()) {
                   $check = "true";
                }
                else {
                    print_r(Connection::mdlConnect->errorInfo());
                }
                return $check;              
            }
            catch(PDOException $ex) {
                echo "Error mdlCreateSupplierInvoice(). Error: " . $ex->getMessage();
            }
        }


        /**
         * Método para leer/consultar todos los datos de las tablas "inputs_product", "products", "suppliers" y "supplier_invoices" (INNER JOIN)
         * @param string $table, $key, $null
         * @return array de objetos @data
         */
        static public function mdlToListInventory($table, $key=null, $value=null) {
            $sql = "";
            try {
                if($key == null) {
                   $sql = "SELECT p.*, DATE_FORMAT(p.created_date_product, '%d/%m/%Y') AS created_date_product, s.*, DATE_FORMAT(s.created_date, '%d/%m/%Y') AS created_date, ip.*, DATE_FORMAT(ip.created_date_input, '%d/%m/%Y') AS created_date_input, si.*
                           FROM $table ip 
                           INNER JOIN products p ON p.id_product = ip.id_product
                           INNER JOIN suppliers s ON s.id = ip.id_supplier
                           /*INNER JOIN supplier_invoices si ON si.id_supplier = s.id  */                         
                           ORDER BY ip.input_number ASC";               
                }                       /*    //TODO-> SEGUIR POR AQUÍ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                            SELECT si.input_number, ip.id_input_product
                                            FROM supplier_invoices si
                                            INNER JOIN inputs_product ip ON ip.id_input_product = si.id_input_product
                                            ORDER BY si.input_number ASC

                                            SELECT p.*, DATE_FORMAT(p.created_date_product, '%d/%m/%Y') AS created_date_product, s.*, DATE_FORMAT(s.created_date, '%d/%m/%Y') AS created_date, ip.*, DATE_FORMAT(ip.created_date_input, '%d/%m/%Y') AS created_date_input, si.*
                           FROM inputs_product ip 
                           INNER JOIN products p ON p.id_product = ip.id_product
                           INNER JOIN suppliers s ON s.id = ip.id_supplier
                           INNER JOIN supplier_invoices si ON si.id_supplier = s.id                   
                          ORDER BY ip.input_number ASC*/
                            
                           

                else {
                    $sql = "SELECT p.*, DATE_FORMAT(p.created_date_product, '%d/%m/%Y') AS created_date_product, pc.* 
                            FROM $table p 
                            INNER JOIN product_categories pc ON p.id_product_category = pc.id_product_category
                            WHERE $key LIKE '%$value%' ORDER BY $key ASC"; 
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
                echo "Error interno mdlToListProduct" . $ex->getMessage();
            }
        }

    }