<?php
    include "validation.controller.php";

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
                        //todo $validateExistsFields =  ValidationController::validateExistsFields($table, "name_customer", "nif_cif", $_POST["customer_name"], $_POST["customer_nifcif"]); 
                           
                            // Método para validar formatos de campos del formulario.
                        //todo $validateFormatFields = ValidationController::validateFieldsFormats($_POST["customer_nifcif"], $_POST["customer_postal_code"], $_POST["customer_phone"], $_POST["customer_email"], $_POST["customer_town"], $_POST["customer_province"], $_POST["customer_country"]); 
                       
                        //todo if($validateExistsFields == "true" && $validateFormatFields == "true") {                                                                             
                            $token = md5(ucwords($_POST["supplier_name"]) . "+" . strtoupper($_POST["supplier_nif"])); // Se genera token para seguridad informática.
                            
                            $data = array(  "token"=> $token,
                                            "supplier_name" => ucwords($_POST["supplier_name"]),
                                            "supplier_nif" => strtoupper($_POST["supplier_nif"]),
                                            "supplier_address" => $_POST["supplier_address"],
                                            "supplier_postal_code" => $_POST["supplier_postal_code"],
                                            "supplier_town" => ucwords($_POST["supplier_town"]),
                                            "supplier_province" => ucfirst($_POST["supplier_province"]),
                                            "supplier_country" => ucwords($_POST["supplier_country"]),
                                            "supplier_phone" => $_POST["supplier_phone"],
                                            "supplier_email" => strtolower($_POST["supplier_email"]),
                                            "supplier_web" => strtolower($_POST["supplier_web"]),
                                            "supplier_contact_person" => ucwords($_POST["supplier_contact_person"]) );

                            $createRegister = SupplierModel::mdlCreateSupplier($table, $data);
                            return $createRegister;
                       //todo }
                        // todo else {
                            // todo echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                        // todo }
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








    }