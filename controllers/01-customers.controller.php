<?php
    require_once "validations_general.controller.php";

    /**
     * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
     */ /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   */
    
    
    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class CustomerController {

        /**
         * Método que recibirá datos del formulario Ficha Clientes y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateRegister($table) {  
            try {
                if(isset($_POST["customer_submit"])) {     
                    if(!empty($_POST["customer_name"]) && !empty($_POST["customer_nifcif"]) && !empty($_POST["customer_type"])) {  

                            // Método para comprobar valores coincidentes en base de datos.
                        $validateExistsFields =  ValidationController::validateExistsFields($table, "name_customer", "nif_cif", $_POST["customer_name"], $_POST["customer_nifcif"]); 
                           
                            // Método para validar formatos de campos del formulario.
                        $validateFormatFields = ValidationController::validateFieldsFormats($_POST["customer_nifcif"], $_POST["customer_postal_code"], $_POST["customer_phone"], $_POST["customer_email"], $_POST["customer_town"], $_POST["customer_province"], $_POST["customer_country"]); 
                       
                        if($validateExistsFields == "true" && $validateFormatFields == "true") {                                                                             
                            $token = md5(ucwords($_POST["customer_name"]) . "+" . strtoupper($_POST["customer_nifcif"])); // Se genera token para seguridad informática.
                            
                            $data = array(  "token"=> $token,
                                            "customer_name" => ucwords($_POST["customer_name"]),
                                            "customer_nifcif" => strtoupper($_POST["customer_nifcif"]),
                                            "customer_type" => $_POST["customer_type"],
                                            "customer_address" => $_POST["customer_address"],
                                            "customer_postal_code" => $_POST["customer_postal_code"],
                                            "customer_town" => ucwords($_POST["customer_town"]),
                                            "customer_province" => ucfirst($_POST["customer_province"]),
                                            "customer_country" => ucwords($_POST["customer_country"]),
                                            "customer_phone" => $_POST["customer_phone"],
                                            "customer_email" => strtolower($_POST["customer_email"]),
                                            "customer_contact_person" => ucwords($_POST["customer_contact_person"]) );

                            $createRegister = CustomerModel::mdlCreateRegister($table, $data);
                            return $createRegister;
                        }
                        else {
                            echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Tipo cliente</li><li>Nombre / Razón Social</li><li>NIF</li></ul></div>";
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
        static public function ctrToList($table, $key, $value=null) {  // todo MÉTODO UNIVERSAL PARA TODA LA APLICACIÓN
            try {                
                if(isset($_POST["search"]) && $key == "full_list") {                      
                    $data = CustomerModel::mdlToList($table);
                }
                else{                
                    $data = CustomerModel::mdlToList($table, $key, $value);
                }                    
                    return $data;
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
            $validationsOk = "ko";              
            try {
                if(isset($_POST["customer_submit"]) && $key = "token") {            
                    if(!empty($_POST["customer_name"]) && !empty($_POST["customer_nifcif"]) && !empty($_POST["customer_type"])) {                                   
    
                            // Bloque para comprobar que el token de la vista coincide con el token almacenado en la base de datos [seguridad informática]
                        $oldToken = CustomerModel::mdlToList($table, $key, $value);
                        $checkToken = md5($oldToken[0]->name_customer . "+" . $oldToken[0]->nif_cif);
                       
                        if($checkToken == $value) {     
                                // BLOQUE PARA VALIDACIONES DE FORMATOS DE LOS CAMPOS Y COINCIDENCIAS DE VALORES EN BASE DE DATOS     ---------------              
                                                
                            $validateFormatFields = ValidationController::validateFieldsFormats($_POST["customer_nifcif"], $_POST["customer_postal_code"], $_POST["customer_phone"], $_POST["customer_email"], $_POST["customer_town"], $_POST["customer_province"], $_POST["customer_country"]); // Método para validar formatos de campos del formulario. 
                                
                            if($validateFormatFields == "true") {   
                                    // Al ser los formatos correctos, a continuación se contemplan las distintas posibilades de coincidencias de valores en la base de datos
                                if($oldToken[0]->name_customer == $_POST["customer_name"] && $oldToken[0]->nif_cif == $_POST["customer_nifcif"]) {                                      
                                    $validationsOk = "ok";
                                }
                                else if(($oldToken[0]->name_customer != $_POST["customer_name"] && $oldToken[0]->nif_cif == $_POST["customer_nifcif"])) {
                                    $checkName = ValidationController::checkFieldPhp($table, "name_customer",  $_POST["customer_name"] ); // método para validar coincidencias en campo nombre
                                    if($checkName == "false") {
                                        $validationsOk = "ok";
                                    }
                                    else {
                                        echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nombre/Razón Social</i></b> introducido ya existe en la base de datos.</p></div>";
                                        echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                                    }
                                }
                                else if(($oldToken[0]->name_customer == $_POST["customer_name"] && $oldToken[0]->nif_cif != $_POST["customer_nifcif"])) {
                                    $checkNif = ValidationController::checkFieldPhp($table, "nif_cif",  $_POST["customer_nifcif"]); // método para validar coincidencias en campo NIF
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
                            // En función del resultado almacenado en la variable $validationsOk se llamará al método para actulizar o no
                        if($validationsOk == "ok") {
                            $newToken = md5(ucwords($_POST["customer_name"]) . "+" . strtoupper($_POST["customer_nifcif"])); // Se genera nuevo token para seguridad informática.
                            $data = array(  "newToken"=> $newToken,
                                            "customer_name" => ucwords($_POST["customer_name"]),
                                            "customer_nifcif" => strtoupper($_POST["customer_nifcif"]),
                                            "customer_type" => $_POST["customer_type"],
                                            "customer_address" => $_POST["customer_address"],
                                            "customer_postal_code" => $_POST["customer_postal_code"],
                                            "customer_town" => ucwords($_POST["customer_town"]),
                                            "customer_province" => ucfirst($_POST["customer_province"]),
                                            "customer_country" => ucwords($_POST["customer_country"]),
                                            "customer_phone" => $_POST["customer_phone"],
                                            "customer_email" => strtolower($_POST["customer_email"]),
                                            "customer_contact_person" => ucwords($_POST["customer_contact_person"]) );
                            
                            $updateRegister = CustomerModel::mdlUpdateRegister($table, $key, $value, $data);
                            return $updateRegister;      
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Tipo cliente</li><li>Nombre / Razón Social</li><li>NIF</li></ul></div>";
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
        public function ctrDeleteRegister($table, $key, $value, $nameAjax=null) {
            $check = "false";
            try {
                if((isset($_POST["delete_customer"]) || $nameAjax == "delete_customer_ajax") && $key == "token") {                                   
                    if((!empty($_POST["customer_name"]) && !empty($_POST["customer_nifcif"])) || $nameAjax == "delete_customer_ajax") {            
                        $actualToken = CustomerModel::mdlToList($table, $key, $value);
                        $checkToken = md5($actualToken[0]->name_customer . "+" . $actualToken[0]->nif_cif);

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