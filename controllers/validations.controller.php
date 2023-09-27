<?php 
    class ValidationController {

        /**
        * Función para eliminar tildes, símbolos de cualquier cadena y poder realizar comparaciones.
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
    }
?>