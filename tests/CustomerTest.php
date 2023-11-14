<?php
    require_once './models/01-customers.model.php';

    use PHPUnit\Framework\TestCase;

    /**
     * Clase de test que implementará pruebas unitarias de la clase Users
     */
    class CustomerTest extends TestCase {

        /**
         * Método que realizará prueba unitaria sobre método mdlCreateRegister de la clase CustomerModel
         */     
        public function testMdlCreateRegister() {

            $test = array(  "token" => "tokenTest",
                            "customer_name" => "Test Name",
                            "customer_nifcif"  => "28369741Ñ",
                            "customer_type" => "Particular",
                            "customer_address" => "C/ Valparaiso, 29",
                            "customer_postal_code" => "28005",
                            "customer_town" => "El Puerto de Santa María",            
                            "customer_province" => 'Cádiz',
                            "customer_country" => 'España',
                            "customer_phone" => '+34 612789324',
                            "customer_email" => 'testemail@g.com',
                            "customer_contact_person" => 'Renato'                            
                            );
            $result = CustomerModel::mdlCreateRegister("customers", $test);   
            
            $this->assertNotNull($result);                  
        }       

         /**
         * Método que realizará prueba unitaria sobre método mdlToList de la clase CustomerModel
         */ 
        public function testMdlToList() {   

            $test = new stdClass();
            $test->id = 85;
            $test->token = "tokenTest";
            $test->name_customer = "Test Name";
            $test->nif_cif = "28369741Ñ";
            $test->customer_type = "Particular";
            $test->address_customer = "C/ Valparaiso, 29";
            $test->postal_code = 28005;
            $test->town = "El Puerto de Santa María";
            $test->province = "Cádiz";
            $test->country = "España";
            $test->phone = "+34 612789324";
            $test->email = "testemail@g.com";
            $test->contact_person = "Renato";
            $test->created_date = "14/11/2023";
           
            $result = CustomerModel::mdlToList("customers", "token", "tokenTest");

            $this->assertEquals($test, $result[0]);
        }   

         /**
         * Método que realizará prueba unitaria sobre método mdlDeleteRegister de la clase CustomerModel
         */
        public function testMdlDeleteRegister() {

            $result = new CustomerModel();
            $result->mdlDeleteRegister("customers", "token", "tokenTest");

            $this->assertNotNull($result);  
        }
    }