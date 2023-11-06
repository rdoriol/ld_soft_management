<?php
   // require_once "04-inventory_validations.controller.php";

    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista (users y login) y enviándolos al Modelo.
     */
    class UserController { 

        /**
         * Método que realizará el login de un usuario, comprobará las credenciales introducidas y actuará según el resultado.
         */
         public function ctrToLogin() {
            $userValidation = "";
            try {
                if(isset($_POST["submitLogin"])) {
                    if(!empty($_POST["user_login"]) && !empty($_POST["pass"])) {
                            
                            // Se genera array asociativo con los datos obtenidos del formulario login
                        $data = array( "user"=> $_POST["user_login"],
                                       "pwd"=> crypt($_POST["pass"],'$2a$09$passwordLockeduseralt$'));      // crypt con salt Blowfish 
                                       
                            
                            // Se lanza método del modelo para comprobar datos recibidos con los existentes en la base de datos
                        $userValidation = UserModel::mdlToLogin($data);
                            
                            // En función del resultado recibido de $userValidation se avisará a usuario de errores o se dará visto bueno
                        if($userValidation == "userKo") {
                            echo "<div class='text-center alert-danger rounded login_empty_fields'><p>El <b>Usuario</b> introducido no existe en la base de datos.</p></div>";
                        }
                        else {  
                            $userData = UserModel::mdlToListUsers("users", "name_user" , $data["user"]); // Se almacenan datos del usuario 

                            if($userValidation == "pwdKo") {

                                    // Si la contraseña es erronea, se comprueba número de intentos erroneos del usuario (máximo 4 intentos fallidos)
                                
                                if($userData[0]->failed_attemps >= 3) {
                                    $passLocked = new UserModel();
                                    $passLocked->mdlUpdateFailedAttemps($userData[0]->token_user);
                                    echo "<div class='text-center alert-danger rounded login_empty_fields'><p>La <b>Contraseña</b> introducida no es correcta.</p><p>Número máximo de intentos superados. <b>Usuario bloqueado</b></p></div>";
                                }
                                else {
                                    $newAttempsNumber = $userData[0]->failed_attemps + 1;
                                    $attempNumber = new UserModel();
                                    $attempNumber->mdlUpdateFailedAttemps($userData[0]->token_user, $newAttempsNumber);
                                
                                    $remainingAttempts = 4 - $newAttempsNumber; // Intentos restantes
                                    echo "<div class='text-center alert-danger rounded login_empty_fields'><p>La <b>Contraseña</b> introducida no es correcta.</p><p>Dispone de $remainingAttempts intentos más.</p></div>";
                                }
                            }
                            else {                                         
                                $attempNumber = new UserModel();
                                $attempNumber->mdlUpdateFailedAttemps($userData[0]->token_user, 0);
                                $userValidation = "ok";

                                $_SESSION["loginCheck"] = "ok";
                                $_SESSION["user_name"] = $userData[0]->name_user;
                                header("location: index.php?pages=06-home");                                       
                                exit;                              
                            } 
                        }
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded login_empty_fields'><p>Los campos <b>Usuario</b> y <b>Contraseña</b> no pueden estar vacíos</p></div>";
                    }
                }
                return $userValidation;
            }
            catch(PDOException $ex) {
                echo "Error interno ctrToLogin()" . $ex->getMessage();
            }
        }
    }

