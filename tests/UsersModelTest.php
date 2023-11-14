<?php
    require_once './models/10-users.model.php';

    use PHPUnit\Framework\TestCase;

    /**
     * Clase de test que implementará pruebas unitarias de la clase Users
     */
    class UsersModelTest extends TestCase {

        /**
         * Método que realizará prueba unitaria sobre método mdlToListUsers de la clase UsersModel
         */ 
        public function testMdlToListUsers() {

            $test = new stdClass();
            $test->id_user = "5";
            $test->token_user = "tokenTest";
            $test->id_employee = null;
            $test->name_user = "UserTest";
            $test->pwd = "pswTest";
            $test->id_user_role = "1";
            $test->failed_attemps = "2";
            $test->created_date_user = "14/11/2023";            
            $test->token_user_role = '13a34682158d608e566218dbc3ab1064';
            $test->name_user_role = 'superroot';

            $result = UserModel::mdlToListUsers("users", "id_user", 5);            

            $this->assertEquals($test, $result[0]);
        }   

         /**
         * Método que realizará prueba unitaria sobre método mdlUpdateUser de la clase UsersModel
         */
        public function testMdlUpdateFailedAttemps() {

            $test = new stdClass();
            
            $result = new UserModel();
            $result->mdlUpdateFailedAttemps("tokenTest", 2);

            $this->assertNotNull($result);
        }
    }

    