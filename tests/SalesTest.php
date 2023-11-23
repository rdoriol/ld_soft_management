<?php
    require_once './models/05-sales.model.php';

    use PHPUnit\Framework\TestCase;

    /**
     * Clase de test que implementará pruebas unitarias de la clase ProductInputModel
     */
    class SalesTest extends TestCase {

        /**
         * Método que realizará prueba unitaria sobre método mdlCreateCustomerInvoice de la clase SalesModel.php
         */     
        public function testMdlCreateCustomerInvoice() {

            $test = array(  "token_customer_invoice" => "tokenTest",
                            "id_customer_ci" => "Test customer",
                            "output_number"  => 90,
                            "subtotal_invoice" => 50,
                            "discount_invoice" => 0,
                            "subtotal_with_discount" => 50,            
                            "tax_invoice" => 10.50,
                            "total_invoice" => 60.50                      
                            );
            $result = SalesModel::mdlCreateCustomerInvoice("customer_invoices", $test);   
            
            $this->assertNotNull($result);                  
        }       

         /**
         * Método que realizará prueba unitaria sobre método mdlCreateProductOutput de la clase SalesModel
         */     
        public function testMdlCreateProductOutput() {

            $test = array(  "token_product_outputs" => "tokenTest",
                            "id_customer_invoice" => "id supplier_supplier",
                            "output_number"  => 90,
                            "id_customer" => 50,
                            "id_product_item" => 5,
                            "product_name_item" => "test input product",            
                            "amount_item" => 1,
                            "price_item" => 60.50,
                            "discount_item" => 0,
                            "total_item" => 60.50                     
                            );
            $result = SalesModel::mdlCreateProductOutput("outputs_product", $test);   
            
            $this->assertNotNull($result);                  
        }       

        /**
         * Método que realizará prueba unitaria sobre método mdltoListOutputProducts de la clase SalesModel
         */         
        public function testMdltoListOutputProducts() {
            $test = new stdClass();
            $test->id_output_product    = 99;
            $test->token_output_product = "tokenTest";
            $test->id_customer_invoice   = 5;
            $test->output_number  = 50;
            $test->id_customer_op    = 5;
            $test->id_product_op   = 10;
            $test->product_concept = "test";
            $test->output_units = 10;
            $test->unit_sales_price = 26;
            $test->unit_discount_product_op = 0; 
            $test->total_row_output = 26; 
            $test->created_date_output = "26/11/2023";           
           
            $result = SalesModel::mdltoListOutputProducts("outputs_products", "token_output_product", "tokenTest");

            $this->assertEquals($test, $result[0]);
        }         

    }