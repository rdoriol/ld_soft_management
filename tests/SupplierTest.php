<?php
    require_once './models/02-suppliers.model.php';

    use PHPUnit\Framework\TestCase;

    /**
     * Clase de test que implementará pruebas unitarias de la clase Users
     */
    class SupplierTest extends TestCase {

        /**
         * Método que realizará prueba unitaria sobre método mdlCreateSupplier de la clase SupplierModel
         */     
        public function testMdlCreateSupplier() {

            $test = array(  "token" => "tokenTest",
                            "supplier_name" => "Test Name",
                            "supplier_nif"  => "A91369852",
                            "supplier_address" => "C/ Valparaiso, 29",
                            "supplier_postal_code" => "28005",
                            "supplier_town" => "El Puerto de Santa María",            
                            "supplier_province" => 'Cádiz',
                            "supplier_country" => 'España',
                            "supplier_phone" => '+34 612789324',
                            "supplier_email" => 'testemail@g.com',
                            "supplier_web" => 'https://www.testsplier.es',            
                            "supplier_contact_person" => 'Renato'                       
                            );
            $result = SupplierModel::mdlCreateSupplier("suppliers", $test);   
            
            $this->assertNotNull($result);                  
        }       

         /**
         * Método que realizará prueba unitaria sobre método mdlUpdateSupplier de la clase SupplierModel
         */     
        public function testMdlUpdateSupplier() {

            $test = array(  "token" => "tokenTest",
                            "supplier_name" => "Test Name",
                            "supplier_nif"  => "A91369852",
                            "supplier_address" => "C/ Tornado",
                            "supplier_postal_code" => "41005",
                            "supplier_town" => "Sevilla",            
                            "supplier_province" => 'Sevilla',
                            "supplier_country" => 'España',
                            "supplier_phone" => '+34 612789324',
                            "supplier_email" => 'testemail@g.com',
                            "supplier_web" => 'https://www.testsplier.es',            
                            "supplier_contact_person" => 'Ronualdo'                       
                            );
            $result = SupplierModel::mdlUpdateSupplier("suppliers","token", "tokenTest", $test);   
            
            $this->assertNotNull($result);                  
        }       

        

    }

