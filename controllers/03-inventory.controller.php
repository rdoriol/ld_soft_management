<?php
    require_once "04-inventoryValidations.controller.php";

     /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class InventoryController {

         /**
         * Método que recibirá datos del formulario Ficha Producto y los enviará a la base de datos mediante método del Modelo.
         * @param string $table
         */
        static public function ctrCreateProduct($table) {  
            $validationsOK = "ko";
            try {
                if(isset($_POST["btn_product_submit"])) {     
                    if(!empty($_POST["select_item_category"]) && !empty($_POST["or_original_product"]) && !empty($_POST["product_name"])) { 

                            // Método para comprobar valores coincidentes en base de datos.
                       $existsOrProduct =  InventaryValidationController::existInventoryField($table, "or_product", $_POST["or_original_product"]); 
    
                            // Método para validar formatos de campos del formulario.
                        //todo $validateFormatFields = ValidationController::validateFieldsFormats($_POST["supplier_nif"], $_POST["supplier_postal_code"], $_POST["supplier_phone"], $_POST["supplier_email"], $_POST["supplier_town"], $_POST["supplier_province"], $_POST["supplier_country"]); 
                       
                        if($existsOrProduct == "false") { 
                            $validationsOk = "ok"; 
                        }
                        else { 
                            echo "<div class='text-center alert-danger rounded'><p>La <b><i>Ref. Original</i></b> introducida ya existe en la base de datos.</p></div>";
                        }//todo SEGUIR POR AQUÍ

                        if($validationsOk == "ok") {
                            $token = md5(ucfirst($_POST["product_name"]) . "+" . strtoupper($_POST["or_original_product"])); // Se genera token para seguridad informática.

                            $data = array(  "token"=> $token,
                                            "select_item_category" => $_POST["select_item_category"],
                                            "or_original_product" => strtoupper($_POST["or_original_product"]),
                                            "product_name" => ucfirst($_POST["product_name"]),
                                            "product_description" => ucfirst($_POST["product_description"]),
                                            "sale_price_product" => $_POST["sale_price_product"]
                                             );
    
                            $createProduct = InventoryModel::mdlCreateProduct($table, $data);
                            return $createProduct;
                        }
                        else {
                            echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                        }
                        
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Categoría producto</li><li>Referencia original</li><li>Nombre Producto</li></ul></div>";
                    }
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateProduct(). Error: " . $ex->getMessage();
            }
        }

    

        /**
         * Método que recibirá solicitud de listado de la "Vista" y que se comunicará con el "Modelo" para obtener los datos de la base de datos.
         * @param $table string, $key string, $value(string, int)
         * @return $data array de objetos con datos de la base de datos. 
         */
        static public function ctrToListProduct($table, $key=null, $value=null) {  
            try {                
                if(isset($_POST["search"]) && $key == "full_list") {                      
                    $data = InventoryModel::mdlToListProduct($table);
                }
                else{                
                    $data = InventoryModel::mdlToListProduct($table, $key, $value);
                }                    
                    return $data;
            }
            catch(PDOException $ex) {
                echo "Error interno ctrToListProduct(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá solicitud de listado de la "Vista" y que se comunicará con el "Modelo" para obtener los datos de la base de datos.
         * @param $table string, $key string, $value(string, int)
         * @return $data array de objetos con datos de la base de datos. 
         */
        static public function ctrToListCategoryProduct($table, $key=null, $value=null) {  
            try {                
                if(isset($_POST["search"]) && $key == "full_list") {                      
                    $data = InventoryModel::mdlToListCategoryProduct($table);
                }
                else{                
                    $data = InventoryModel::mdlToListCategoryProduct($table, $key, $value);
                }                    
                    return $data;
            }
            catch(PDOException $ex) {
                echo "Error interno ctrToListCategoryProduct(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá datos de la "Vista" para enviarlos al "Modelo" para actualizar registros en la base de datos.
         * @param
         * @return
         */
        static public function ctrUpdateProduct($table, $key, $value) {         
            try {
                if(isset($_POST["btn_product_submit"]) && $key == "token_product") {  
                    if(!empty($_POST["select_item_category"]) && !empty($_POST["or_original_product"]) && !empty($_POST["product_name"])) {                           
    
                            // Bloque para comprobar que el token de la vista coincide con el token almacenado en la base de datos [seguridad informática]
                        $oldToken = InventoryModel::mdlToListProduct($table, $key, $value);
                        $checkToken = md5($oldToken[0]->name_product . "+" . $oldToken[0]->or_product);
                       
                        if($checkToken == $value) {       
                                // bloque para validaciones                            
                            //todo $validateFormatFields = ValidationController::validateFieldsFormats($_POST["supplier_nif"], $_POST["supplier_postal_code"], $_POST["supplier_phone"], $_POST["supplier_email"], $_POST["supplier_town"], $_POST["supplier_province"], $_POST["supplier_country"]); // Método para validar formatos de campos del formulario. 
                               
                           //todo if($validateFormatFields == "true" ) {  // TODO. Pendiente de mejora personal: Implementar validación de nombres coincidentes en base de datos (en función de si es cliente tipo particular o empresa)
        
                                $newToken = md5(ucwords($_POST["product_name"]) . "+" . strtoupper($_POST["or_original_product"])); // Se genera nuevo token para seguridad informática.
                                $data = array(  "newToken"=> $newToken,                                               
                                                "select_item_category" => $_POST["select_item_category"],
                                                "or_original_product" => strtoupper($_POST["or_original_product"]),
                                                "product_name" => ucfirst($_POST["product_name"]),
                                                "product_description" => ucfirst($_POST["product_description"]),
                                                "sale_price_product" => $_POST["sale_price_product"]
                                                );
                                
                                $updateProduct = InventoryModel::mdlUpdateProduct($table, $key, $value, $data);
                                return $updateProduct;
                            //todo }
                           //todo else {
                                //todo echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                           //todo  }
                        }
                        else {
                            echo "<div class='text-center alert-danger rounded'><p>Error. Tokens no coinciden</p></div>";
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p class='font-weight-bold'>No grabado.</p><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Categoría producto</li><li>Referencia original</li><li>Nombre Producto</li></ul></div>";
                    }
                }             
            }
            catch(PDOException $ex) {
                echo "Error interno ctrUpdateProduct. Error: " . $ex->getMessage();
            }
        }

        /**
         * Método que recibirá solicitud para eliminar de la "Vista" y se comunicará con "Modelo"para ejecturar la acción sobre la base de datos.
         */
        public function ctrDeleteProduct($table, $key, $value) {
            $check = "false";
            try {
                if(isset($_POST["delete_product"]) && $key == "token_product") {                                   
                    if(!empty($_POST["select_item_category"]) && !empty($_POST["or_original_product"]) && !empty($_POST["product_name"])) {              
                        $actualToken = InventoryModel::mdlToListProduct($table, $key, $value);
                        $checkToken = md5($actualToken[0]->name_product . "+" . $actualToken[0]->or_product);

                        if($checkToken == $value) {    
                            $deleteProduct = new CustomerModel();
                            $deleteProduct->mdlDeleteRegister($table, $key, $value); 
                                              
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
                echo "Error interno ctrDeleteProduct. Error: " . $ex->getMessage();
            }
        }

    }