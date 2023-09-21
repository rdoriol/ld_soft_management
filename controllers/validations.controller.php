<?php 
    class ValidationController {

    /**
        * Función para eliminar tildes, símbolos de cualquier cadena.
        */
        public function removeAccents($string) {
            // $string = str_replace(array("Á", "À", "Â", "Ä", "á", "à", "â", "ä", "ª"), array("A", "A", "A", "A", "a", "a", "a", "a", "a"), $string);
            $string = str_replace(array(".", ",", "-", "_", "'", " ", "&", "@"), "", $string);
                                                                                                    echo $string;
            return $string;
        }
    }
?>