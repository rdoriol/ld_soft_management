<?php  
   /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   /*

    /**
     * Clase que conectará la vista base.template.php con index.php
     */
    class BaseTemplateController {

        /**
         * Función que incluirá el fichero con la plantilla base de todas las páginaa (base.template.php)
         */
        function ctrGetBaseTemplate() {
            include "./views/00-base.template.php";
        }
     }

// Por motivos de seguridad informática no cierro etiqueta php