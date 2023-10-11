<?php 
    require_once "01-customers.controller.php";

    class ValidationController {

        /**
        * Método para eliminar tildes, símbolos de cualquier cadena y poder realizar comparaciones.
        */
        static public function removeAccents($string) {
            try {
                $string = str_replace(array("Á", "À", "Â", "Ä", "á", "à", "â", "ä", "ª"), array("A", "A", "A", "A", "a", "a", "a", "a", "a"), $string);
                $string = str_replace(array("É", "È", "Ê", "Ë", "é", "è", "ê", "ë"), array("E", "E", "E", "E", "e", "e", "e", "e"), $string);
                $string = str_replace(array("Í", "Ì", "Î", "Ï", "í", "ì", "î", "ï"), array("I", "I", "I", "I", "i", "i", "i", "i"), $string);
                $string = str_replace(array("Ó", "Ò", "Ô", "Ö", "ó", "ò", "ô", "ö"), array("O", "O", "O", "O", "o", "o", "o", "o"), $string);
                $string = str_replace(array("Ú", "Ù", "Û", "Ü", "ú", "ù", "û", "ü"), array("U", "U", "U", "U", "u", "u", "u", "u"), $string);
                $string = str_replace(array(".", ",", "-", "_", "'", " ", "&", "@"), "", $string);
                
                return $string;
            }
            catch(PDOException $ex) {
                echo "error interno removeAccents(). Error: " . $ex->getMessage();
            }  
        }

        /**
         * Método para validar formato de NIF
         * @param string $nif
         * @return string $check
         */
        static public function checkNif($nif) {
            $patternDni = "/^[0-9]{8}[A-Za-z]{1}$/";
            $patternCif;
            $patternNifM;
            $patternNie;
            $ckeck = "false";
            
            try {
                if(!preg_match($patternDni, $nif)/* || preg_match($patternCif, $nif) || preg_match($patternNifM, $nif) || preg_match($patternNie, $nif)*/) {
                    $ckeck = "true";
                }
                return $ckeck;
            }
            catch(PDOException $ex) {
                echo "Error interno checkNifCif(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para comprobar formato campo "Código Postal"
         * @param string $postalCode
         * @return string $check
         */
        static public function checkPostalCode($postalCode) {
            $check = "false";
            try {
                if(!is_numeric($postalCode) || strlen($postalCode) > 5) {
                    $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "error interno checkPostalCode(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para comprobar formato campo "Teléfono"
         * @param string $phone
         * @return string $check
         */
        static public function checkPhone($phone) {
            $check = "false";
            try {
                if(strlen($postalCode) > 13) {
                    $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "error interno checkPostalCode(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para comprobar formato campo "Correo Electrónico"
         * @param string $email
         * @return string $check
         */
        static public function checkEmail($email) {
            $check = "false";
            $patternEmail = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            try {
                if(!preg_match($patternEmail, $email)) {
                    $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "error interno checkPostalCode(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para comprobar campos del formulario coincidentes con registros ya existentes en base de datos.
         * @param strings $table, $key, $value 
         * @return string $check
         */
        static public function checkFieldPhp($table, $key, $value) {            
            $check = "false";
            try {
                $matchValue1 = self::removeAccents($value);  
                $matchValue1 = strtolower($matchValue1); 

                $value2 = CustomerController::ctrToList($table, $key, $value);   

                foreach($value2 as $item) {  
                    $matchValue2 = self::removeAccents(strtolower($item->$key)); 
                                                                                       
                    if(strcasecmp($matchValue1, $matchValue2) === 0) {
                        $check = "true";
                    }
                }                                                                      
                return $check;
            }
            catch(PDOException $ex) {
                echo "error interno checkFieldPhp(). Error: " . $ex->getMessage();
            }
        }
    
        /**
         * Método para validar por completo campos del formulario (formatos válidos, coindicencias de registros en base de datos, etc...)
         * @param strings $table, $nif, $customerNameValue, $customerNifValue
         * @return string $check
         */
        static public function validateExistsFields($table, $nameKey, $nifKey, $nameValue, $nifValue) {
            $check = "false";
            try {      
                $existsCustomerName = self::checkFieldPhp($table, $nameKey, $nameValue);    // método que comrpueba si ya existe el valor "nombre/razón social" en la base de datos.
                $existsNif = self::checkFieldPhp($table, $nifKey, $nifValue);               // método que comrpueba si ya existe el valor "NIF" en la base de datos.

                    // Bloque condicional para contemplar las distintas posiblidades con sus respectivos mensajes de avisos personalizados
                if($existsCustomerName == "false" && $existsNif == "false") {
                    $check = "true";
                }
                else {
                    if($existsCustomerName == "true") {
                        echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nombre/Razón Social</i></b> ($nameValue) introducido ya existe en la base de datos.</p></div>";
                    }
                    if($existsNif == "true") {
                        echo "<div class='text-center alert-danger rounded'><p>El <b><i>Nif</i></b> ($nifValue) introducido ya existe en la base de datos.</p></div>";
                    }                            
                }                                     
                return $check;
            }
            catch(PDOException $ex) {
                echo "Error interno validateFields(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para validar formatos de los campos del formulario
         * @param strings $nifValue, $postalCodeValue, $phoneValue, $emailValue
         * @return string $check
         */
        static public function validateFieldsFormats($nifValue, $postalCodeValue, $phoneValue, $emailValue) {
            $check = "false";
            try {
                $correctFormat = self::checkNif($nifValue);                    // método que comprueba si el formato de "NIF" es correto.
                $formatPostalCode = self::checkPostalCode($postalCodeValue);   // método que comrpueba si el formato del código postal es correcto.            
                $formatPhone = self::checkPhone($phoneValue);                  // método que comrpueba si el formato del teléfono es correcto.
                $formatEmail = self::checkEmail($emailValue);                  // método que comrpueba si el formato del correo electrónico es correcto.

                // Bloque condicional para contemplar las distintas posiblidades con sus respectivos mensajes de avisos personalizados
                if($correctFormat == "false" && $formatPostalCode == "false" && $formatPhone == "false" && $formatEmail == "false") {
                    $check = "true";
                }
                else {
                   if($correctFormat  == "true") {
                        echo "<div class='text-center alert-danger rounded'><p>El formato del campo <b><i>NIF</i></b> es erroneo<br>Ejemplos válidos: Dni 12345678X / Cif B12345678 / NIE X1234567S</p></div>";
                    }                    
                    if($formatPostalCode == "true") {
                        echo "<div class='text-center alert-danger rounded'><p>El formato del campo <b><i>Código Postal</i></b> es erroneo<br>Ejemplo válido: 28005</p></div>";
                    }    
                    if($formatEmail == "true") {
                        echo "<div class='text-center alert-danger rounded'><p>El formato del campo <b><i>Correo Electrónico</i></b> es erroneo<br>Ejemplo válido: usuario@ejemplo.com</p></div>";
                    }  
                    if($formatPhone == "true") {
                        echo "<div class='text-center alert-danger rounded'><p>El formato del campo <b><i>Teléfono</i></b> es erroneo<br>Ejemplos válidos: +34666999666 / +34 666999666 / 666999666</p></div>";
                    }              
                }                                     
                return $check;                
            }
            catch(PDOException $ex) {
                echo "Error interno validateFieldsFormats(). Error: " . $ex->getMessage();
                
            }
        }
    
    
    }
?>