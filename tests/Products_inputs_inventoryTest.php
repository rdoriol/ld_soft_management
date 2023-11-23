<?php
    require_once './models/04-products_inputs_inventory.model.php';

    use PHPUnit\Framework\TestCase;

    /**
     * Clase de test que implementará pruebas unitarias de la clase ProductInputModel
     */
    class Products_inputs_inventoryTest extends TestCase {

        /**
         * Método que realizará prueba unitaria sobre método mdlCreateSupplierInvoice de la clase ProductInputModel
         */     
        public function testMdlCreateSupplierInvoice() {

            $test = array(  "token_supplier_invoices" => "tokenTest",
                            "select_supplier" => "Test supplier",
                            "input_number"  => 90,
                            "subtotal_input" => 50,
                            "discount_input" => 0,
                            "subtotal_discount_input" => 50,            
                            "tax_input" => 10.50,
                            "total_input" => 60.50                      
                            );
            $result = ProductInputModel::mdlCreateSupplierInvoice("supplier_invoices", $test);   
            
            $this->assertNotNull($result);                  
        }       

         /**
         * Método que realizará prueba unitaria sobre método mdlCreateSupplierInvoice de la clase ProductInputModel
         */     
        public function testMdlCreateProductInput() {

            $test = array(  "token_product_inputs" => "tokenTest",
                            "id_supplier_invoice" => "id supplier_supplier",
                            "input_number"  => 90,
                            "select_supplier" => 50,
                            "id_product_item" => 5,
                            "product_name_item" => "test input product",            
                            "amount_item" => 1,
                            "price_item" => 60.50,
                            "discount_item" => 0,
                            "total_item" => 60.50                     
                            );
            $result = ProductInputModel::mdlCreateProductInput("inputs_product", $test);   
            
            $this->assertNotNull($result);                  
        }       

        /**
         * Método que realizará prueba unitaria sobre método mdlToListInputsProducts de la clase ProductInputModel
         */         
        public function testMdlToListInputsProducts() {
            $test = new stdClass();
            $test->id_input_product   = 99;
            $test->token_input_product = "tokenTest";
            $test->id_supplier_invoice   = 5;
            $test->input_number  = 50;
            $test->id_supplier   = 5;
            $test->id_product  = 10;
            $test->product_concept = "test";
            $test->input_units = 10;
            $test->unit_cost_product = 26;
            $test->unit_discount_product = 0; 
            $test->total_row_input = 26; 
            $test->created_date_input = "26/11/2023";           
           
            $result = ProductInputModel::mdlToListInputsProducts("inputs_products", "token_product", "tokenTest");

            $this->assertEquals($test, $result[0]);
        }         

    }