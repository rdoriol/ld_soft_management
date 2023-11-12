
<?php 

    require('fpdf/fpdf.php');

    require_once "./controllers/06-sales.controller.php";
    require_once "./models/05-sales.model.php";

    /**
     * Clase que sobreescribirá métodos de la clase padre FPDF
     */
    class Pdf extends FPDF {
                              
        /**
         * Método que sobreescribirá el Header por defecto de fpdf
         */
        function Header() {
                $this->SetFont("Helvetica","B",35);   
                $this->SetTextColor(69, 69, 69);
                $this->Cell(50, 12, "Factura", 0, 1, "C");

                $this->Image("./images/logo/logo_invoice.png", 157, 8);
                $this->Ln(20);

                $this->SetFont("Arial","B",14);  
                $this->SetTextColor(23, 48, 84);
                $this->Cell(0, 8, utf8_DECODE("LD SoftGestión, S.L."), 0, 1, "R");  
                $this->SetFont('Arial','B',9);   
                $this->Cell(0, 5, utf8_DECODE("B-41329635"), 0, 1, "R");   
                $this->Cell(0, 5, utf8_DECODE("C/ Amador de los Ríos, 19"), 0, 1, "R");   
                $this->Cell(0, 5, utf8_DECODE("41005 - Sevilla"), 0, 1, "R"); 
                $this->Cell(0, 5, utf8_DECODE("España"), 0, 1, "R"); 
        }

        /**
         * Método que sobreescribirá el Footer por defecto de fpdf
         */
        Function Footer() {
                $this->SetY(-50);

                $this->SetTextColor(69, 69, 69);
                $this->SetFont("Arial","BU",12);                
                $this->MultiCell(80, 10, utf8_DECODE("Formas de pago"), "LTR", "L"); 
                $this->SetFont("Arial","",11);
                $this->MultiCell(80, 6, utf8_DECODE("- Tarjeta"), "LR", "L");
                $this->MultiCell(80, 6, utf8_DECODE("- Recibo Domiciliado"), "LR", "L");
                $this->MultiCell(80, 6, utf8_DECODE("- Transferencia bancaria"), "LRB", "L");

                $this->SetY(-10);
                $this->Cell(0,10, utf8_DECODE("Página ").$this->PageNo()."",0,0,"C");
        }
    }
                                                

        // Se obtiene último número de factura generado
    $lastInvoiceNumber = SalesController::ctrGenerateOutPutNumber("customer_invoices", "true");

        // Se realiza consulta de los datos del último número de factura generado en tabla customer_invoice (array de objetos)
    $customerInvoice =  SalesController::ctrToListOutputsProducts("customer_invoices", "ci.output_number", $lastInvoiceNumber);

    // Se realiza consulta de los datos del último número de factura generado en tabla outputs_products (array de objetos)
    $productsInvoice =  SalesController::ctrToListOutputsProducts("outputs_products", "op.output_number", $lastInvoiceNumber);
   
    // Nombre de las columnas y ancho de las mísmas (array)
    $columns = array("Ref."=> 15 , "Concepto"=> 100 , "Cant"=> 13 , "Precio ($str)"=> 22, "Desc (%)"=> 18, "Total (€)"=> 26);           
    
    
        $pdf = new Pdf(); 

        $pdf->AddPage();

                /* Datos factura
                ------------------ */
        $pdf->SetTextColor(69, 69, 69);
        $pdf->SetFont("Arial","B",20);
        $pdf->Cell(0, 5, "Detalle factura", 0, 1, "L"); 
        $pdf->Ln();

        $pdf->SetFillColor(240,248,255);

        $pdf->SetFont("Arial","B", 10);
        $pdf->Cell(20, 5, utf8_DECODE("Nº Factura"), 0, 0, "L", "T");
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(15, 5, $customerInvoice[0]->output_number, 0, 0, "C");
       
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(15, 5, utf8_DECODE("Fecha"), 0, 0, "R", "T"); 
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(20, 5, $customerInvoice[0]->created_date_customer_invoice, 0, 1, "R");

        $pdf->SetFont("Arial","B", 10);
        $pdf->Cell(20, 5, utf8_DECODE("Nº Cliente"), 0, 0, "L", "T");
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(15, 5, $customerInvoice[0]->id_customer_ci, 0, 0, "C");
       
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(15, 5, utf8_DECODE("NIF"), 0, 0, "C", "T"); 
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(20, 5, $customerInvoice[0]->nif_cif, 0, 1, "L");
        
        $pdf->SetFont("Arial","B",10);        
        $pdf->Cell(20, 5, utf8_DECODE("Nombre"), 0, 0, "L", "T");
        $pdf->SetFont("Arial","",10);   
        $pdf->Cell(43, 5, utf8_DECODE($customerInvoice[0]->name_customer), 0, 1, "L");        
        
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(20, 5, utf8_DECODE("Dirección"), 0, 0, "L", "T");        
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(43, 5, utf8_DECODE($customerInvoice[0]->address_customer), 0, 1, "L"); 

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(20, 5, utf8_DECODE("C. Postal"), 0, 0, "L", "T"); 
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(43, 5, $customerInvoice[0]->postal_code, 0, 1, "L"); 

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(20, 5, utf8_DECODE("Localidad"), 0, 0, "L", "T"); 
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(43, 5, $customerInvoice[0]->town, 0, 1, "L"); 

        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(20, 5, utf8_DECODE("Provincia"), 0, 0, "L", "T"); 
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(43, 5, $customerInvoice[0]->province, 0, 1, "L"); 

        $pdf->Ln(8);

        /* Filas de productos
        --------------------- */
               

        $pdf->SetFont("Arial", "B", 11);
        foreach($columns as $columnItem => $columnValue) {
                $pdf->Cell($columnValue, 7, utf8_DECODE($columnItem), 1, 0, "C", "T");
        }

        $pdf->Ln();

        $pdf->SetFont("Arial", "", 10);

        foreach($productsInvoice as $item) {
                $pdf->Cell(15, 7, utf8_DECODE($item->id_product_op), "RBL", 0, "L");
                $pdf->Cell(100, 7, utf8_DECODE($item->product_concept), "RBL", 0, "L");
                $pdf->Cell(13, 7, utf8_DECODE($item->output_units), "RBL", 0, "C");
                $pdf->Cell(22, 7, utf8_DECODE($item->unit_sales_price), "RBL", 0, "R");
                $pdf->Cell(18, 7, utf8_DECODE($item->unit_discount_product_op), "RBL", 0, "R");
                $pdf->Cell(26, 7, utf8_DECODE($item->total_row_output), "RBL", 1, "R");
        }
        
        /* Totales de factura
        --------------------- */




       
        $pdf->Output();



 