<?php 
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
         */
        static public function checkNif($nif) {
            $patternDni = "/^[0-9]{8}[A-Z]{1}$/";
            $patternCif;
            $patternNifM;
            $patternNie;
            $ckeck = "false";
            
            try {
                if(preg_match($patternDni, $nif) || preg_match($patternCif, $nif) || preg_match($patternNifM, $nif) || preg_match($patternNie, $nif)) {
                    $ckeck = "true";
                    echo "<script>console.log('correcto')</script>";
                }
                return $ckeck;
            }
            catch(PDOException $ex) {
                echo "Error interno checkNifCif(). Error: " . $ex->getMessage();
            }
        }

        /**
         * Método para comprobar campos del formulario coincidentes con registros ya existentes en base de datos.
         */
        static public function checkFieldPhp($table, $key, $value) {
            $check = "false";
            try {
                $matchValue1 = ValidationController::removeAccents($value);
                $matchValue1 = strtolower($matchValue1);

                $value2 = CustomerController::ctrToList($table, $key, $value);

                foreach($value2 as $item) {
                    $matchValue2 = ValidationController::removeAccents(strtolower($item->$key));

                    if(strcasecomp($matchValue1, $matchValue2) === 0) {
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
         * Método para validar por completo campos del formulario. 
         */
        public static function validateFields($table, $key, $value, $nif ) {
            $check = "false";
            try {
                $correctFormat = self::checkNif($nif);                      // método que comprueba si el formato de nif es correto.
                $existDb = self::checkFieldPhp($table, $key, $value);       // método que comrpueba si ya existe el valor en la base de datos.

                if($correctFormat == "true" || $existDb == "true") {
                    $check = "true";
                }
                return $ckeck;
            }
            catch(PDOException $ex) {
                echo "Error interno validateFields(). Error: " . $ex->getMessage();
            }
        }
    
    
    }
?>