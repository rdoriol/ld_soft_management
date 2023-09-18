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
        static public function mdlCreateCustomer($table, $data) {
            $check = "false";
            
            try {
                $stmt = Connection::mdlConnect()->prepare("INSERT INTO $table(token, name_customer, nif_cif, customer_type, address_customer, postal_code, town, province, country, phone, email, contact_person) VALUES (:token, :name_customer, :nif_cif, :customer_type, :address_customer, :postal_code, :town, :province, :country, :phone, :email, :contact_person)");
             
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

                $stmt->close();  //TODO PROBAR FUNCIONAMIENTO
                $stmt = null;
            }
            catch(PDOException $ex) {
                echo "error interno " . $ex->getMessage();
                $stmt->close();
                $stmt = null;
            }
            return $check;
        }
    }


    // No se cierra etiqueta php por seguridad informática.