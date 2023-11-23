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
    class SupplierModel {        
      
        /**
         * Método para crear/grabar proveedores nuevos en la base de datos.
         * @param $table de tipo string, $data array con datos obtenidos de un formulario.
         * @return $check de tipo string.
         */
        static public function mdlCreateSupplier($table, $data) {
            $check = "false";
            $sql = "INSERT INTO $table VALUES (null, :token, :supplier_name, :supplier_nif, :supplier_address, :supplier_postal_code, :supplier_town, :supplier_province, :supplier_country, :supplier_phone, :supplier_email, :supplier_web, :supplier_contact_person, null)";

            try {
                $stmt = Connection::mdlConnect()->prepare($sql);
             
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":token", $data["token"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_name", $data["supplier_name"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_nif", $data["supplier_nif"], PDO::PARAM_STR);                
                $stmt->bindParam(":supplier_address", $data["supplier_address"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_postal_code", $data["supplier_postal_code"], PDO::PARAM_INT);
                $stmt->bindParam(":supplier_town", $data["supplier_town"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_province", $data["supplier_province"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_country", $data["supplier_country"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_phone", $data["supplier_phone"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_email", $data["supplier_email"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_web", $data["supplier_web"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_contact_person", $data["supplier_contact_person"], PDO::PARAM_STR);
            
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
                echo "error interno " . $ex->getMessage();
               // $stmt->close();
              //  $stmt = null;
            }
            return $check;
        }

        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------
         //todo-> Para LISTAR/LEER registros de la tabla "suppliers" se utiliza método "mdlToList()" implementado en la clase "CustomerModel" ("models/01-customers.model.php") 
        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------


         /**
         * Método que actualizará los datos de un registro concreto.
         * @param
         * @return
         */
        static public function mdlUpdateSupplier($table, $key, $value, $data) { 
            $check = "false";
            try {
                $updateString = "token = :newToken, name_supplier = :supplier_name, nif = :supplier_nif, address = :supplier_address, postal_code = :supplier_postal_code, town = :supplier_town, province = :supplier_province, country = :supplier_country, phone = :supplier_phone, email = :supplier_email, web = :supplier_web, contact_person = :supplier_contact_person";
                $sql = "UPDATE $table SET $updateString WHERE $key LIKE '%$value%'";
                $stmt = Connection::mdlConnect()->prepare($sql);
                
                    // bloque con función bindParam() para vincular variable oculta en prepare statement con el valor recibido del form.
                $stmt->bindParam(":newToken", $data["newToken"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_name", $data["supplier_name"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_nif", $data["supplier_nif"], PDO::PARAM_STR);                
                $stmt->bindParam(":supplier_address", $data["supplier_address"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_postal_code", $data["supplier_postal_code"], PDO::PARAM_INT);
                $stmt->bindParam(":supplier_town", $data["supplier_town"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_province", $data["supplier_province"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_country", $data["supplier_country"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_phone", $data["supplier_phone"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_email", $data["supplier_email"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_web", $data["supplier_web"], PDO::PARAM_STR);
                $stmt->bindParam(":supplier_contact_person", $data["supplier_contact_person"], PDO::PARAM_STR);

                if($stmt->execute()) {
                $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "<div class='text-center alert-danger rounded'><p>El <b><i>NIF</i></b> (" . $data['supplier_nif'] . ") introducido ya existe en la base de datos.<br><br><b>No permitido:</b> " . $ex->getMessage() . "</p></div>";
                return null;
            }
        }

        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------
         //todo-> Para ELIMINAR registros de la tabla "suppliers" se utiliza método "mdlDeleteRegister()" implementado en la clase "CustomerModel" ("models/01-customers.model.php") 
        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------

    }