<?php
    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class CustomerController {

        /**
         * Método que recibirá datos del formulario Ficha Clientes y los enviará a la base de datos mediante método del Modelo.
         * @param 
         */
        static public function ctrCreateRegister($table) {  // todo ¿MÉTODO UNIVERSAL?
            try {
                if(isset($_POST["customer_submit"])) {
                    if(!empty($_POST["customer_name"]) && !empty($_POST["customer_nifcif"])) {
                        $token = md5($_POST["customer_name"] . $_POST["customer_nifcif"]);
                        $data = array("token"=> $token,
                                    "customer_name" => $_POST["customer_name"],
                                    "customer_nifcif" => $_POST["customer_nifcif"],
                                    "customer_type" => $_POST["customer_type"],
                                    "customer_address" => $_POST["customer_address"],
                                    "customer_postal_code" => $_POST["customer_postal_code"],
                                    "customer_town" => $_POST["customer_town"],
                                    "customer_province" => $_POST["customer_province"],
                                    "customer_country" => $_POST["customer_country"],
                                    "customer_phone" => $_POST["customer_phone"],
                                    "customer_email" => $_POST["customer_email"],
                                    "customer_contact_person" => $_POST["customer_contact_person"]);

                        $createRegister = CustomerModel::mdlCreateRegister($table, $data);
                        return $createRegister;
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p>No grabado. <br> Campo/s vacíos</p></dv>";
                    }
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateCustomer(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá solicitud de listado de la "Vista" y que se comunicará con el "Modelo" para obtener los datos de la base de datos.
         * @param $table string, $key string, $value(string, int)
         * @return $data array de objetos con datos de la base de datos. 
         */
        static public function ctrToList($table, $key, $value=null) {  // todo MÉTODO UNIVERSAL
            try {
                //if(!empty($key) && (isset($_POST["search"]) || $key == "token")) {                         
                 //   if($key == "full_list") {                      
                 //       $data = CustomerModel::mdlToList($table);
                 //   }
                //    else{                
                        $data = CustomerModel::mdlToList($table, $key, $value);
                 //   }                    
                    return $data;
                //}
            }
            catch(PDOException $ex) {
                echo "Error interno ctrToList(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá datos de la "Vista" para enviarlos al "Modelo" para actualizar registros en la base de datos.
         * @param
         * @return
         */
        static public function ctrUpdateRegister($table, $key, $value) {
            try {
                if(isset($_POST["customer_submit"]) && $key = "token") {
                    if(!empty($_POST["customer_name"]) && !empty($_POST["customer_nifcif"])) {
                            
                            // Bloque para comprobar que el token de la vista coincide con el token almacenado en la base de datos [seguridad informática]
                        $oldToken = CustomerModel::mdlToList($table, $key, $value);
                        $checkToken = md5($oldToken[0]->name_customer . $oldToken[0]->nif_cif);
                       
                        if($checkToken == $value) {                        
                            $newToken = md5($_POST["customer_name"] . $_POST["customer_nifcif"]);
                            $data = array(  "newToken"=> $newToken,
                                            "customer_name" => $_POST["customer_name"],
                                            "customer_nifcif" => $_POST["customer_nifcif"],
                                            "customer_type" => $_POST["customer_type"],
                                            "customer_address" => $_POST["customer_address"],
                                            "customer_postal_code" => $_POST["customer_postal_code"],
                                            "customer_town" => $_POST["customer_town"],
                                            "customer_province" => $_POST["customer_province"],
                                            "customer_country" => $_POST["customer_country"],
                                            "customer_phone" => $_POST["customer_phone"],
                                            "customer_email" => $_POST["customer_email"],
                                            "customer_contact_person" => $_POST["customer_contact_person"]);
                            
                            $updateRegister =  CustomerModel::mdlUpdateRegister($table, $key, $value, $data);
                            return $updateRegister;
                        }
                        else {
                            echo "<div class='text-center alert-danger rounded'><p>Error. Tokens no coinciden</p></div>";
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p>Registro no grabado. <br> Campo/s vacíos</p></dv>";
                    }
                }             
            }
            catch(PDOException $ex) {
                echo "Error interno ctrUpdateRegister. Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá solicitud para eliminar de la "Vista" y se comunicará con "Modelo"para ejecturar la acción sobre la base de datos.
         */
        public function ctrDeleteRegister($table, $key, $value) {
            $check = "false";
            try {
                if(isset($_POST["delete_customer"]) && $key == "token") {                                   
                    if(!empty($_POST["customer_name"]) && !empty($_POST["customer_nifcif"])) {            
                        $actualToken = CustomerModel::mdlToList($table, $key, $value);
                        $checkToken = md5($actualToken[0]->name_customer . $actualToken[0]->nif_cif);

                        if($checkToken == $value) {    
                            $deleteRegister = new CustomerModel();
                            $deleteRegister->mdlDeleteRegister($table, $key, $value);                        
                            $check = "true";
                            return $check;
                        }
                        else {
                             echo "<div class='text-center alert-danger rounded'><p>Error. Tokens no coinciden</p></div>";
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p>Registro no eliminado. <br> Campo/s vacíos</p></dv>";
                    }
                }
                
            }
            catch(PDOException $ex) {
                echo "Error interno ctrDeleteRegister. Error: " . $ex->getMessage();
            }
        }


    }












   // No se cierra etiqueta php por seguridad informática.