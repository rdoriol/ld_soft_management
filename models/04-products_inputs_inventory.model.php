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
            $sql = "INSERT INTO $table VALUES (null, :token, :id_sppplier, :id_product, :input_units, :unit_cost_product, :unit_discount_product, :total_row_input, :subtotal_inputs, :discount_input, :subtotal_with_discount, :tax_input, :total_input, null, :created_date_input)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":token", $data[""], PDO::PARAM_STR);
                $stmt->bindParam(":id_sppplier", $data[""], PDO::PARAM_INT);
                $stmt->bindParam(":id_product", $data[""], PDO::PARAM_INT);                
                $stmt->bindParam(":input_units", $data[""], PDO::PARAM_INT);
                $stmt->bindParam(":unit_cost_product", $data[""]);
                $stmt->bindParam(":unit_discount_product", $data[""]);
                $stmt->bindParam(":total_row_input", $data[""]);
                $stmt->bindParam(":subtotal_inputs", $data[""]);
                $stmt->bindParam(":discount_input", $data[""]);
                $stmt->bindParam(":subtotal_with_discount", $data[""]);
                $stmt->bindParam(":tax_input", $data[""]);
                $stmt->bindParam(":total_input", $data[""]);
                $stmt->bindParam(":created_date_input", $data[""]);
            
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








