<?php
    require_once "validations_general.controller.php";

     /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class SupplierController {

         /**
         * Método que recibirá datos del formulario Ficha Proveedores y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateSupplier($table) {  
            try {
                if(isset($_POST["supplier_submit"])) {     
                    if(!empty($_POST["supplier_name"]) && !empty($_POST["supplier_nif"]) && !empty($_POST["supplier_address"]) && !empty($_POST["supplier_postal_code"]) && !empty($_POST["supplier_town"]) && !empty($_POST["supplier_province"])) {  

                            // Método para comprobar valores coincidentes en base de datos.
                        $validateExistsFields =  ValidationController::validateExistsFields($table, "name_supplier", "nif", $_POST["supplier_name"], $_POST["supplier_nif"]); 
                           
                            // Método para validar formatos de campos del formulario.
                        $validateFormatFields = ValidationController::validateFieldsFormats($_POST["supplier_nif"], $_POST["supplier_postal_code"], $_POST["supplier_phone"], $_POST["supplier_email"], $_POST["supplier_town"], $_POST["supplier_province"], $_POST["supplier_country"]); 
                       
                        if($validateExistsFields == "true" && $validateFormatFields == "true") {                                                                             
                            $token = md5(trim(ucwords($_POST["supplier_name"])) . "+" . trim(strtoupper($_POST["supplier_nif"]))); // Se genera token para seguridad informática.
                            
                            $data = array(  "token"=> $token,
                                            "supplier_name" => trim(ucwords($_POST["supplier_name"])),
                                            "supplier_nif" => trim(strtoupper($_POST["supplier_nif"])),
                                            "supplier_address" => trim($_POST["supplier_address"]),
                                            "supplier_postal_code" => trim($_POST["supplier_postal_code"]),
                                            "supplier_town" => trim(ucwords($_POST["supplier_town"])),
                                            "supplier_province" => trim(ucfirst($_POST["supplier_province"])),
                                            "supplier_country" => trim(ucwords($_POST["supplier_country"])),
                                            "supplier_phone" => trim($_POST["supplier_phone"]),
                                            "supplier_email" => trim(strtolower($_POST["supplier_email"])),
                                            "supplier_web" => trim(strtolower($_POST["supplier_web"])),
                                            "supplier_contact_person" => trim(ucwords($_POST["supplier_contact_person"])) 
                                        );

                            $createRegister = SupplierModel::mdlCreateSupplier($table, $data);
                            return $createRegister;
                       }
                        else {
                            echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Nombre proveedor</li><li>NIF</li><li>Dirección</li><li>Código Postal</li><li>Ciudad</li><li>Provincia</li></ul></div>";
                    }
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateCustomer(). Error: " . $ex->getMessage();
            }
        }


        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            //todo-> Para LISTAR/LEER registros de la tabla "suppliers" se utiliza método "ctrToList()" implementado en la clase "CustomerController" ("controllers/01-customers.controller.php")
        // --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------   


         /**
         * Método que recibirá datos de la "Vista" para enviarlos al "Modelo" para actualizar registros en la base de datos.
         * @param
         * @return
         */
        static public function ctrUpdateSupplier($table, $key, $value) {        // Nota: método excesivamente grande, dividir en dos.
            $validationsOk = "ko"; 
            try {
                if(isset($_POST["supplier_submit"]) && $key = "token") {
                    if(!empty($_POST["supplier_name"]) && !empty($_POST["supplier_nif"]) && !empty($_POST["supplier_address"]) && !empty($_POST["supplier_postal_code"]) && !empty($_POST["supplier_town"]) && !empty($_POST["supplier_province"])) {                           
    
                            // Bloque para comprobar que el token de la vista coincide con el token almacenado en la base de datos [seguridad informática]
                        $oldToken = CustomerModel::mdlToList($table, $key, $value);
                        $checkToken = md5($oldToken[0]->name_supplier . "+" . $oldToken[0]->nif);
                       
                        if($checkToken == $value) {       
                              // BLOQUE PARA VALIDACIONES DE FORMATOS DE LOS CAMPOS Y COINCIDENCIAS DE VALORES EN BASE DE DATOS     ---------------              
                            $validateFormatFields = ValidationController::validateFieldsFormats($_POST["supplier_nif"], $_POST["supplier_postal_code"], $_POST["supplier_phone"], $_POST["supplier_email"], $_POST["supplier_town"], $_POST["supplier_province"], $_POST["supplier_country"]); // Método para validar formatos de campos del formulario. 
                               
                            if($validateFormatFields == "true" ) {
                                        // Al ser los formatos correctos, a continuación se contemplan las distintas posibilades de coincidencias de valores en la base de datos
                                if($oldToken[0]->name_supplier == $_POST["supplier_name"] && $oldToken[0]->nif == $_POST["supplier_nif"]) {                                      
                                    $validationsOk = "ok";
                                }
                                else if(($oldToken[0]->name_supplier != $_POST["supplier_name"] && $oldToken[0]->nif == $_POST["supplier_nif"])) {
                                    $checkName = ValidationController::checkFieldPhp($table, "name_supplier",  $_POST["supplier_name"] ); // método para validar coincidencias en campo nombre
                                    if($checkName == "false") {
                                        $validationsOk = "ok";
                                    }
                                    else {
                                        echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nombre</i></b> introducido ya existe en la base de datos.</p></div>";
                                        echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                                    }
                                }
                                else if(($oldToken[0]->name_supplier == $_POST["supplier_name"] && $oldToken[0]->nif != $_POST["supplier_nif"])) {
                                    $checkNif = ValidationController::checkFieldPhp($table, "nif",  $_POST["supplier_nif"]); // método para validar coincidencias en campo NIF
                                    if($checkNif == "false") {
                                        $validationsOk = "ok";
                                    }
                                    else {
                                        echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nif</i></b> introducido ya existe en la base de datos.</p></div>";
                                        echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                                    }
                                }
                            }             // FIN BLOQUE PARA VALIDACIONES       ------------------------------------------   
                        
                        }
                        else {
                            echo "<div class='text-center alert-danger rounded'><p>Error. Tokens no coinciden</p></div>";
                        }

                        if($validationsOk == "ok") {
                            $newToken = md5(trim(ucwords($_POST["supplier_name"])) . "+" . trim(strtoupper($_POST["supplier_nif"]))); // Se genera nuevo token para seguridad informática.
                            $data = array(  "newToken"=> $newToken,
                                            "supplier_name" => trim(ucwords($_POST["supplier_name"])),
                                            "supplier_nif" => trim(strtoupper($_POST["supplier_nif"])),
                                            "supplier_address" => trim($_POST["supplier_address"]),
                                            "supplier_postal_code" => trim($_POST["supplier_postal_code"]),
                                            "supplier_town" => trim(ucwords($_POST["supplier_town"])),
                                            "supplier_province" => trim(ucfirst($_POST["supplier_province"])),
                                            "supplier_country" => trim(ucwords($_POST["supplier_country"])),
                                            "supplier_phone" => trim($_POST["supplier_phone"]),
                                            "supplier_email" => trim(strtolower($_POST["supplier_email"])),
                                            "supplier_web" => trim(strtolower($_POST["supplier_web"])),
                                            "supplier_contact_person" => trim(ucwords($_POST["supplier_contact_person"])) 
                                        );
                            
                            $updateSupplier = SupplierModel::mdlUpdateSupplier($table, $key, $value, $data);
                            return $updateSupplier;     
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Nombre proveedor</li><li>NIF</li><li>Dirección</li><li>Código Postal</li><li>Ciudad</li><li>Provincia</li></ul></div>";
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
        public function ctrDeleteSupplier($table, $key, $value) {
            $check = "false";
            try {
                if(isset($_POST["delete_supplier"]) && $key == "token") {                                   
                    if(!empty($_POST["supplier_name"]) && !empty($_POST["supplier_nif"])) {            
                        $actualToken = CustomerModel::mdlToList($table, $key, $value);
                        $checkToken = md5($actualToken[0]->name_supplier . "+" . $actualToken[0]->nif);

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