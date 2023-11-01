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
            $sql = "INSERT INTO $table VALUES (null,  :id_sppplier, :token, :input_number, :id_product, :product_name_item, :input_units, :unit_cost_product, :unit_discount_product, :total_row_input, null, null, null, null, null, null, null)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":token", $data["token"], PDO::PARAM_STR);
                $stmt->bindParam(":input_number", $data["??????"], PDO::PARAM_INT);
                $stmt->bindParam(":id_sppplier", $data["select_supplier"], PDO::PARAM_INT);                
                $stmt->bindParam(":id_product", $data["id_product_item"], PDO::PARAM_INT); 
                $stmt->bindParam(":product_name_item", $data["product_concept"], PDO::PARAM_STR);                 
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
                echo "Error interno mdlCreateProduct" . $ex->getMessage();
               // $stmt->close();
                //$stmt = null;
            }
            return $check;
        }




    }








