<?php
    /**
     * Clase que contendrá la conexión con base de datos.
     */
    class Connection {
        /**
         * Método que realizará la conexión a base de datos (PDO).
         */
        public static function mdlConnect() {
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