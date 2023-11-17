<?php

   /**
    * Se protege fichero modelo.php. Si alguien intenta acceder al fichero directamente se el reenvía a página de error
    */  /*
    if(!defined("CON_CONTROLADOR")) 
    {   header("location: ../index.php?pages=error");
        echo "Fichero no accesible";
        die();
    }   */
    
    /**
     * Clase que contendrá la conexión con base de datos.
     */
    class Connection {
        /**
         * Método que realizará la conexión a base de datos (PDO).
         */
        static public function mdlConnect() {
            $host = "localhost";
            $db = "ld_soft_gestion";
            $user = "Roberto15";
            $pwd = "Zcaracola10r";
            try {                
                $db = new PDO("mysql: host=$host; dbname=$db", $user, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));  
            }
            catch(PDOException $ex) {
                echo "Error de conexión a base de datos. Error: " . $ex->getMessage();
                return null;
            }
            return $db;
        }
    }

// No se cierra etiqueta php por seguridad informática