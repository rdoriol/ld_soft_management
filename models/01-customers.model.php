<?php
    require_once "connection.model.php";

    /**
     * Clase que implentará métodos para realizar un CRUD completo en la tabla "Customers" de la base de datos.
     */
    class CustomerModel {

        /**
         * Método para crear/grabar clientes nuevos en la base de datos.
         * @param $table de tipo string, $data array con datos obtenidos de un formulario.
         * @return $check de tipo string.
         */
        static public function mdlCreateRegister($table, $data) {
            $check = "false";
            $sql = "INSERT INTO $table VALUES (null, :token, :name_customer, :nif_cif, :customer_type, :address_customer, :postal_code, :town, :province, :country, :phone, :email, :contact_person, null)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":token", $data["token"], PDO::PARAM_STR);
                $stmt->bindParam(":name_customer", $data["customer_name"], PDO::PARAM_STR);
                $stmt->bindParam(":nif_cif", $data["customer_nifcif"], PDO::PARAM_STR);
                $stmt->bindParam(":customer_type", $data["customer_type"], PDO::PARAM_STR);
                $stmt->bindParam(":address_customer", $data["customer_address"], PDO::PARAM_STR);
                $stmt->bindParam(":postal_code", $data["customer_postal_code"], PDO::PARAM_INT);
                $stmt->bindParam(":town", $data["customer_town"], PDO::PARAM_STR);
                $stmt->bindParam(":province", $data["customer_province"], PDO::PARAM_STR);
                $stmt->bindParam(":country", $data["customer_country"], PDO::PARAM_STR);
                $stmt->bindParam(":phone", $data["customer_phone"], PDO::PARAM_STR);
                $stmt->bindParam(":email", $data["customer_email"], PDO::PARAM_STR);
                $stmt->bindParam(":contact_person", $data["customer_contact_person"], PDO::PARAM_STR);
            
                if($stmt->execute()) {
                    $check = "true";
                }
                else {
                    print_r(Connection::mdlConnect->errorInfo());
                }

               // $stmt->close();  //TODO PROBAR FUNCIONAMIENTO
               // $stmt = null;
            }
            catch(PDOException $ex) {
                echo "error interno " . $ex->getMessage();
                $stmt->close();
                $stmt = null;
            }
            return $check;
        }

        /**
         * Método que listará los datos de la tabla seleccionada por el usuario.
         * @param
         * @return
         */
        static public function mdlToList($table, $key=null, $value=null) {
            $sql = "";
            try {                                         
                                                                                        var_dump($key);
                                                                                        var_dump($value);
                if($key == null) {
                    $sql = "SELECT *, DATE_FORMAT(created_date, '%d/%m/%Y') AS created_date FROM $table ORDER BY id_customer ASC";
                }
                else {
                    $sql = "SELECT * FROM $table WHERE $key LIKE '%$value%' ORDER BY $key ASC";
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
                echo "error interno mdlToList(). Error: " . $ex->getMessage();
                $stmt->close();
                $stmt = null;
            }
        }

        /**
         * Método que actualizará los datos de un registro concreto.
         * @param
         * @return
         */
        static public function mdlUpdateRegister($table, $key, $value, $data) { // todo MÉTODO UNIVERSAL 
            $check = "false";
            try {
                $updateString = "token = :newToken, name_customer = :name_customer, nif_cif = :nif_cif, customer_type = :customer_type, address_customer = :address_customer, postal_code = :postal_code, town = :town, province = :province, country = :country, phone = :phone, email = :email, contact_person = :contact_person";
                $sql = "UPDATE $table SET $updateString WHERE $key LIKE '%$value%'";
                $stmt = Connection::mdlConnect()->prepare($sql);
                
                // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":newToken", $data["newToken"], PDO::PARAM_STR);
                $stmt->bindParam(":name_customer", $data["customer_name"], PDO::PARAM_STR);
                $stmt->bindParam(":nif_cif", $data["customer_nifcif"], PDO::PARAM_STR);
                $stmt->bindParam(":customer_type", $data["customer_type"], PDO::PARAM_STR);
                $stmt->bindParam(":address_customer", $data["customer_address"], PDO::PARAM_STR);
                $stmt->bindParam(":postal_code", $data["customer_postal_code"], PDO::PARAM_INT);
                $stmt->bindParam(":town", $data["customer_town"], PDO::PARAM_STR);
                $stmt->bindParam(":province", $data["customer_province"], PDO::PARAM_STR);
                $stmt->bindParam(":country", $data["customer_country"], PDO::PARAM_STR);
                $stmt->bindParam(":phone", $data["customer_phone"], PDO::PARAM_STR);
                $stmt->bindParam(":email", $data["customer_email"], PDO::PARAM_STR);
                $stmt->bindParam(":contact_person", $data["customer_contact_person"], PDO::PARAM_STR);

                if($stmt->execute()) {
                $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "Error interno mdlUpdateRegister. Error: " . $ex->getMessage();
                return null;
            }
        }




    }


    // No se cierra etiqueta php por seguridad informática.