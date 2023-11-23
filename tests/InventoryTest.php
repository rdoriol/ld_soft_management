<?php
    require_once './models/03-inventory.model.php';

    use PHPUnit\Framework\TestCase;

      /**
     * Clase de test que implementará pruebas unitarias de la clase InventoryModel
     */
    class InventoryTest extends TestCase {

        /**
         * Método que realizará prueba unitaria sobre método mdlCreateProduct de la clase InventoryModel
         */         
        public function testMdlCreateProduct() {

            $test = array(  "token" => "tokenTest",
                            "select_item_category" => "Test Category",
                            "or_original_product"  => "Q3040A",
                            "product_name" => "Toner test",
                            "product_description" => "Descripcióno test",
                            "sale_price_product" => "50"
                            );
            $result = InventoryModel::mdlCreateProduct("products", $test);   
            
            $this->assertNotNull($result);                     
        }       

        /**
         * Método que realizará prueba unitaria sobre método mdlToListProduct de la clase InventoryModel
         */         
        public function testMdlToListProduct() {
            $test = new stdClass();
            $test->id_product  = 99;
            $test->token_product = "tokenTest";
            $test->or_product  = "test or";
            $test->id_product_category  = 2;
            $test->name_product  = "test product";
            $test->description_product = "Descriptiono product";
            $test->units_product = 5;
            $test->last_unit_cost_product = 26;
            $test->sale_price_product = 26;
            $test->created_date_product = "26/11/2023";            
           
            $result = InventoryModel::mdlToListProduct("products", "token_product", "tokenTest");

            $this->assertEquals($test, $result[0]);
        }           

        /**
         * Método que realizará prueba unitaria sobre método mdlUpdateProduct de la clase InventoryModel
         */             
        public function testMdlUpdateProduct() {

            $test = array(  "token" => "tokenTest",
                            "select_item_category" => "Test Category update",
                            "or_original_product"  => "Q3040A",
                            "product_name" => "Toner test update",
                            "product_description" => "Descripción test",
                            "sale_price_product" => "25"
                            );
            $result = InventoryModel::mdlUpdateProduct("products", "token_product", "tokenTest", $test);   
            
            $this->assertNotNull($result);                     
        }               

        /**
         * Método que realizará prueba unitaria sobre método mdlUpdateStockProducts de la clase InventoryModel
         */         
        public function testMdlUpdateStockProducts() {

            $test = array(  "id_product" => "idTest",
                            "units_product" => 10,
                            "last_unit_cost_product" => 15                            
                            );
            $result = InventoryModel::mdlUpdateProduct("products", "id_product", "idTest", $test);   
            
            $this->assertNotNull($result);                     
        }  

    }