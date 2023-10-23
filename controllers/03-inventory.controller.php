<?php
    require_once "04-inventory_validations.controller.php";

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
                            
                            // Se lanza método para validar formatos y campos coincidentes de los valores del formulario
                        $validationsOK = self::validateProductFields($table);

                        if($validationsOK == "ok") {
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
            $validationsUpdate = "ko";  
            try {
                if(isset($_POST["btn_product_submit"]) && $key == "token_product") {  
                    if(!empty($_POST["select_item_category"]) && !empty($_POST["or_original_product"]) && !empty($_POST["product_name"])) {                           
    
                            // Bloque para comprobar que el token de la vista coincide con el token almacenado en la base de datos [seguridad informática]
                        $oldToken = InventoryModel::mdlToListProduct($table, $key, $value);
                        $checkToken = md5(ucfirst($oldToken[0]->name_product) . "+" . strtoupper($oldToken[0]->or_product));
              
                        if($checkToken == $value) {       
                                // bloque para validaciones                            
                            $validationsUpdate = self::validateProductFields($table, $key, $value);
                               
                           if($validationsUpdate == "ok" ) { 
        
                                $newToken = md5(trim(ucfirst($_POST["product_name"])) . "+" . trim(strtoupper($_POST["or_original_product"]))); // Se genera nuevo token para seguridad informática.
             
                                $data = array(  "newToken"=> $newToken,                                               
                                                "select_item_category" => $_POST["select_item_category"],
                                                "or_original_product" => strtoupper($_POST["or_original_product"]),
                                                "product_name" => ucfirst($_POST["product_name"]),
                                                "product_description" => ucfirst($_POST["product_description"]),
                                                "sale_price_product" => $_POST["sale_price_product"]
                                                );
                                
                                $updateProduct = InventoryModel::mdlUpdateProduct($table, $key, $value, $data);
                                return $updateProduct;
                            }
                            else {
                                echo "<div class='text-center alert-warning rounded'><p class='font-weight-bold'>REGISTRO NO GRABADO</p></div>";
                            }
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

    

        /**
         * Método para lanzar validaciones de formatos y valores coincidentes en base de datos de los campos recibidos del formulario. 
         * Se lanzará exclusivamente desde el interior de los métodos para crear y actualizar de 03-inventory.controller
         * @param string @table
         * @return string $checkValidations,  $checkFormat1,  $checkFormat2
         */
        static public function validateProductFields($table, $key=null, $value=null) {
            $checkFormat1 = "ko";
            $checkFormat2 = "ko";
            $checkValidations = "ko";
            try {
                // La comprobación de que los valores recibidos no estén vacíos se realizará directamente en los métodos de crear y actualizar.
                        
                    // Bloque condicional para validar formatos
                if(is_numeric($_POST["product_name"]) || is_numeric($_POST["product_description"])) {
                    echo "<div class='text-center alert-danger rounded'><p>Los campos <b><i>Nombre Producto</i></b> y <b><i>Descripción Producto</i></b> deben contener caracteres alfanuméricos.</p></div>";
                }
                else {
                    $checkFormat1 = "ok";
                }
                if(!empty($_POST["sale_price_product"]) && !is_numeric($_POST["sale_price_product"])) {
                        echo "<div class='text-center alert-danger rounded'><p>El campo <b><i>Precio de venta</i></b> solo admite valores numéricos.</p></div>";
                }
                else {
                    $checkFormat2 = "ok";
                }

                    // Una vez superada validaciones de formatos. Bloque condicional para validar valores coincidentes en la base de datos
                    if($checkFormat1 == "ok" && $checkFormat2 == "ok"){   

                        // Se carga listado de registros en la tabla productos, que será de utilidad para el método de actualizar
                    $listProducts = self::ctrToListProduct($table, $key, $value);

                            // Se lanzan métodos para comprobar valores coincidentes en base de datos.
                    $existsOr =  InventoryValidationController::existInventoryField($table, "or_product", $_POST["or_original_product"]); 
                    $existsName = InventoryValidationController::existInventoryField($table, "name_product", $_POST["product_name"]);
                        
                    // Si los valores no coinciden con los de la base de datos o son del mmismo registro
                    if(($existsOr == "false" && $existsName == "false") || ($listProducts[0]->name_product == $_POST["product_name"] && $listProducts[0]->or_product == $_POST["or_original_product"]) ) { 
                        $checkValidations = "ok";                      
                    }
                    else if ($existsOr == "true" && $existsName == "false") {
                        if($listProducts[0]->or_product == $_POST["or_original_product"]) {
                            $checkValidations = "ok";
                        }
                        else {
                            echo "<div class='text-center alert-danger rounded'><p>La <b><i>Referencia Original</i></b> introducida ya existe en la base de datos.</p></div>";
                        }
                    }
                    else if($existsOr == "false" && $existsName == "true") {  
                        if($listProducts[0]->name_product == $_POST["product_name"]) {
                            $checkValidations = "ok";
                        }
                        else {
                            echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nombre Producto Original</i></b> introducido ya existe en la base de datos.</p></div>";
                        }  
                    }
                    else if($existsOr == "true" && $existsName == "true") {
                        if($listProducts[0]->name_product != $_POST["product_name"] && $listProducts[0]->or_product == $_POST["or_original_product"]) {
                            echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nombre Producto Original</i></b> introducido ya existe en la base de datos.</p></div>";
                        }
                        else if($listProducts[0]->name_product == $_POST["product_name"] && $listProducts[0]->or_product != $_POST["or_original_product"]) {
                            echo "<div class='text-center alert-danger rounded'><p>La <b><i>Referencia Original</i></b> introducida ya existe en la base de datos.</p></div>";
                        }
                        else if($listProducts[0]->name_product != $_POST["product_name"] && $listProducts[0]->or_product != $_POST["or_original_product"]) {
                            echo "<div class='text-center alert-danger rounded'><p>La <b><i>Referencia Original</i></b> introducida ya existe en la base de datos.</p></div>";
                            echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nombre Producto Original</i></b> introducido ya existe en la base de datos.</p></div>";
                        }
                        else {
                            $checkValidations = "ok";
                        }
                    }                                                                
                }                                 
                return $checkValidations;
            }
            catch(PDOException $ex) {
                echo "Error validateProductFields(). Error: " . $ex->getMessage();
            }
        }

    }   

