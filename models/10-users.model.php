<?php
        require_once "connection.model.php";

    /**
     * Clase que implentará métodos para realizar un CRUD completo en la tabla "users" de la base de datos.
     */
    class UserModel {                      

        /**
         * Método que realizará consulta a la base de datos de las tablas "users" y "user_roles"
         * @param string $table, $key, $value
         * @return array $data
         */
        static public function mdlToListUsers($table, $key=null, $value=null) {
            $sql = "";
            try {
                if($key == null) {
                    $sql = "SELECT u.*, DATE_FORMAT(u.created_date_user, '%d/%m/%Y') AS created_date_user, ur.*
                            FROM $table u
                            INNER JOIN user_roles ur ON ur.id_user_role = u.id_user_role
                            ORDER BY u.id_user ASC";
                }
                else {
                    $sql = "SELECT u.*, DATE_FORMAT(u.created_date_user, '%d/%m/%Y') AS created_date_user, ur.*
                            FROM $table u
                            INNER JOIN user_roles ur ON ur.id_user_role = u.id_user_role
                            WHERE $key LIKE '%$value%'
                            ORDER BY $key ASC";
                }
                $stmt = Connection::mdlConnect()->prepare($sql);

                if($stmt->execute() && $stmt->rowCount() > 0) {
                    while($rowItem = $stmt->fetchObject()) {
                        $data[] = $rowItem;
                    }
                    return $data;
                }
            }
            catch(PDOException $ex) {
                echo "Error interno mdlToListUsers()" . $ex->getMessage();
            }
        }

        /**
         * Método que actualizará cualquier campo en la tabla "users"
         * @param int $attemptNumber
         */
        public function mdlUpdateUser($key, $value, $data) {
            $check = "false";
            try {
                $updateString = 
                $sql = "UPDATE users SET failed_attemps = :attemptNumber WHERE $key LIKE '%$value%'";

                $stmt = Connection::mdlConnect()->prepare($sql);
                $stmt->bindParam(":attemptNumber", $attemptNumber, PDO::PARAM_INT);

                if($stmt->execute()) {
                    $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "Error interno mdlUpdateFailedAttemps()" . $ex->getMessage();
            }
        }

        /**
         * Método que actualizará en la tabla "users" el número de intentos fallidos al hacer login
         * @param int $tokenValue $attemptNumber
         * @return string $check
         */
        public function mdlUpdateFailedAttemps($tokenValue, $attemptNumber=null) {
            $check = "false";            
            $sql = "";
            $bindParamString = "";
            try {
                if($attemptNumber == "") {
                    $passwordLocked = crypt('passwordLocked','$2a$09$passwordLockeduseralt$');              
                    $sql = "UPDATE users SET pwd = '$passwordLocked' WHERE token_user LIKE '%$tokenValue%'";
                  //  $bindParamString = "':pwd', $passwordLocked, PDO::PARAM_STR";
                }
                else {
                    $sql = "UPDATE users SET failed_attemps = $attemptNumber WHERE token_user LIKE '%$tokenValue%'";
                   // $bindParamString = '":attemptNumber", $attemptNumber, PDO::PARAM_INT';
                }

                $stmt = Connection::mdlConnect()->prepare($sql);
                //$stmt->bindParam($bindParamString);
                

                if($stmt->execute()) {
                    $check = "true";
                }
                return $check;
            }
            catch(PDOException $ex) {
                echo "Error interno mdlUpdateFailedAttemps()" . $ex->getMessage();
            }
        }

        /**
         * Método que validará usuario y contraseña recibidas del controlador haciendo una búsqueda en la base de datos
         * @param array $data
         * @return string $result
         */
        static public function mdlToLogin($data) {
            $result = "ko";
            try {
                $user = $data["user"];
                $pwd = $data["pwd"];

                $userData = self::mdlToListUsers("users", "name_user ", trim($user));
                if($userData[0]->name_user) {
                    if($userData[0]->pwd == $pwd) {
                        $result = "ok";
                    }
                    else {
                        $result = "pwdKo";
                    }
                }
                else {
                    $result = "userKo";
                }
                return $result;
            }
            catch(PDOException $ex) {
                echo "Error interno mdlToLogin()" . $ex->getMessage();
            }
        }















    }