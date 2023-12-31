<?php   
    require_once "connection.model.php";

   /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   */

    /**
     * Clase que implentará métodos para realizar un CRUD completo en la tabla "Suppliers" de la base de datos.
     */
    class InventoryModel {        
      
        /**
         * Método para crear/grabar productos nuevos en la base de datos.
         * @param $table de tipo string, $data array con datos obtenidos de un formulario.
         * @return $check de tipo string.
         */
        static public function mdlCreateProduct($table, $data) {
            $check = "false";
            $sql = "INSERT INTO $table VALUES (null, :token, :or_original_product, :select_item_category, :product_name, :product_description, null, null, :sale_price_product, null)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":token", $data["token"], PDO::PARAM_STR);
                $stmt->bindParam(":select_item_category", $data["select_item_category"], PDO::PARAM_INT);
                $stmt->bindParam(":or_original_product", $data["or_original_product"], PDO::PARAM_STR);                
                $stmt->bindParam(":product_name", $data["product_name"], PDO::PARAM_STR);
                $stmt->bindParam(":product_description", $data["product_description"], PDO::PARAM_STR);
                $stmt->bindParam(":sale_price_product", $data["sale_price_product"]);
            
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
                echo "Error interno mdlCreateProduct" . $ex->getMessage();
               // $stmt->close();
                //$stmt = null;
            }
            return $check;
        }

        /**
         * Método para leer/consultar todos los datos de las tablas "products" y "products_suppliers" (INNER JOIN)
         * @param string $table, $key, $null
         * @return array de objetos @data
         */
        static public function mdlToListProduct($table, $key=null, $value=null) {
            $sql = "";
            try {
                if($key == null) {
                   $sql = "SELECT p.*, DATE_FORMAT(p.created_date_product, '%d/%m/%Y') AS created_date_product, pc.* 
                           FROM $table p 
                           INNER JOIN product_categories pc ON p.id_product_category = pc.id_product_category
                           ORDER BY p.id_product ASC";
                }
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

        /**
         * Método para leer/consultar todos los datos de las tablas "products" y "products_suppliers" (INNER JOIN)
         * @param string $table, $key, $null
         * @return array de objetos @data
         */
        static public function mdlToListCategoryProduct($table, $key=null, $value=null) {
            $sql = "";
            try {
                if($key == null) {
                   $sql = "SELECT *, DATE_FORMAT(created_date, '%d/%m/%Y') AS created_date FROM $table ORDER BY id_product_category ASC";
                }
                else {
                    $sql = "SELECT *, DATE_FORMAT(created_date, '%d/%m/%Y') AS created_date FROM $table WHERE $key LIKE '%$value%' ORDER BY $key ASC"; 
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
                echo "Error interno mdlToListCategoryProduct" . $ex->getMessage();
            }
        }

        /**
         * Método que actualizará los datos de un registro concreto.
         * @param
         * @return
         */
        static public function mdlUpdateProduct($table, $key, $value, $data) { 
            $check = "false";
            try {
                $updateString = "token_product = :newToken, or_product = :or_original_product, id_product_category = :select_item_category, name_product = :product_name, description_product = :product_description, sale_price_product = :sale_price_product";
                $sql = "UPDATE $table SET $updateString WHERE $key LIKE '%$value%'";
                $stmt = Connection::mdlConnect()->prepare($sql);
                
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":newToken", $data["newToken"], PDO::PARAM_STR);               
                $stmt->bindParam(":select_item_category", $data["select_item_category"], PDO::PARAM_INT);
                $stmt->bindParam(":or_original_product", $data["or_original_product"], PDO::PARAM_STR);                
                $stmt->bindParam(":product_name", $data["product_name"], PDO::PARAM_STR);
                $stmt->bindParam(":product_description", $data["product_description"], PDO::PARAM_STR);
                $stmt->bindParam(":sale_price_product", $data["sale_price_product"]);

                if($stmt->execute()) {
                $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "<div class='text-center alert-danger rounded'><p>La <b><i>Referencia Original</i></b> (" . $data['or_original_product'] . ") introducida ya existe en la base de datos.<br><br><b>No permitido:</b> " . $ex->getMessage() . "</p></div>";
                return null;
            }
        }

        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------
            //todo-> Para ELIMINAR registros de la tabla "products" se utiliza método "mdlDeleteRegister()" implementado en la clase "CustomerModel" ("models/01-customers.model.php") 
        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------

        /**
         * Método para actualizar stock y precio de coste de los productos ya existentes para "entradas de productos" o unicamente stock para "opción generar facturas"
         */
        static public function mdlUpdateStockProducts($table, $idValue, $amount, $costPrice=null) {
            $check = "false";
            try {
                    // Se obtiene número de unidades de productos existentes en la base de datos
                $product = self::mdlToListProduct($table, "id_product", $idValue);
                $numberUnitsProduct = $product[0]->units_product;

                    // Condición para actualización si proviene de "Entrada de Productos" (unidades y precio)
                if(isset($costPrice) && !empty($costPrice)) {

                        // Al número de unidades actuales se le suman las que se van añadir
                    $currentNumberUnits = $amount + $numberUnitsProduct;
                    
                        // Se realiza actualización del producto
                    $updateString = "units_product = :units_product,  last_unit_cost_product = :last_unit_cost_product";
                    $sql = "UPDATE $table SET $updateString WHERE id_product = $idValue";
                    $stmt = Connection::mdlConnect()->prepare($sql);

                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                    $stmt->bindParam(":units_product", $currentNumberUnits, PDO::PARAM_INT);               
                    $stmt->bindParam(":last_unit_cost_product", $costPrice);

                    $check = "true";
                }

                    // En caso contrario, la actualización se realizaría unicamente para unidades de producto, que proviene de "Generar Factura"
                else {
                        // Si el número de unidades de producto existente en la base de datos es superior a la cantidad que se le va a dar salida en factura
                    if($numberUnitsProduct >= $amount) {
                            // Al número de unidades actuales se le restan las que salen al ser facturadas
                        $currentNumberUnits = $numberUnitsProduct - $amount;

                            // Se realiza actualización del producto
                        $updateString = "units_product = :units_product";
                        $sql = "UPDATE $table SET $updateString WHERE id_product = $idValue";
                        $stmt = Connection::mdlConnect()->prepare($sql);

                            // Función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                        $stmt->bindParam(":units_product", $currentNumberUnits, PDO::PARAM_INT);    
                        $check = "true"; 
                    }
                }
                if($check == "true") {
                    if($stmt->execute()) {
                        $check = "true";
                    }
                    else {
                        $check = "false";
                    }
                }
                
                return $check;
            }
            catch(PDOException $ex) {
                echo "Error interno updateStockProducts()" . $ex->getMessage();       
            }
        }

    }







   