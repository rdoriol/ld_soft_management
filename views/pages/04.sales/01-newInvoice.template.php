<?php
    $invoiceData = array();
    $readOnly = ""; 
    
      // Condición para controlar si se muestran datos en el formulario o se muestra en blanco
    if((isset($_GET["token"]) && !empty($_GET["token"])) /*|| (isset($_POST["tokenProduct"]) && !empty($_POST["tokenProduct"]))*/) {                                    
        
        $customerInvoiceData = SalesController::ctrToListOutputsProducts("customer_invoices", "token_customer_invoice", $_GET["token"]);     // Se llama a función para leer datos de la tabla "customer_invoices"      
        $outputInvoiceData = SalesController::ctrToListOutputsProducts("outputs_products", "op.id_customer_invoice ", $customerInvoiceData[0]->id_customer_invoice );    // Se llama a función para leer datos de la tabla "outputsproducts"      
        $readOnly = "readonly"; // variable que bloqueará todos los campos cuando se consulte una factura ya existente. (Las facturas no se pueden editar ni eliminar)
    }
     // script javascript para lanzar ventana modal confirmando actualizaciones o eliminaciones.
    echo "<script>
    if(window.sessionStorage.getItem('modalAlert') == 'true') {
      $(function(){ 
        $('#product_success_modal').modal('show');    // Se muestra ventana emergente informativa
      });
      window.sessionStorage.setItem('modalAlert', 'false');
    }
  </script>"; 
      
?>                      

<h2 class="li_active_page rounded">Ventas</h2>

<form class="general_forms" id="products_inputs_form" action="" method="post" onsubmit="">
  <h4 class="forms_subtitle rounded">Generar factura</h4>
    
                                            <!-- Lista de botones "Buscar facturas", "Imprimir", "Buscar clientes" -->
    <div class="d-flex justify-content-between flex_customer_field_father">
        <ul class="d-flex justify-content-first"> 
            <li><button type="button" class="search_bar m-1 alert-info rounded" id="search_invoice_history"><i class="fa-solid fa-magnifying-glass"></i>&nbsp Historial de facturas</button></li>
            <li><button type="button" class="print_bar m-1 alert-info rounded" id="print_product"><i class="fa-solid fa-print"></i>&nbsp Imprimir</button></li>
        </ul>
                                                    
        <div class="forms_field flex_customer_field">
            <label class="forms_label" for="invoice_created_date" id="btn_input_search_customer" title="Cliente a facturar">Cliente a facturar</label>
            <div class="forms_inputs_fields">  
                <i class="fa-solid fa-magnifying-glass forms_icons search_icon_customer<?php echo $readOnly; ?>" id="searchCustomerInvoiceIcon" title="Buscar cliente"></i>
                <input type="text" class="forms_inputs product_item_id input_id" id="id_customer_item" name="id_customer_item" placeholder="Nº cliente" <?php echo $readOnly; ?> value="" />
            </div>     
        </div>
    </div>
                                         <!-- --------------------------------------- --> 

                                       
         
  <div class="document mt-5" id="invoice">                                <!---------------------------- DIV INVOICE --------------------------------> 
        <div class="col-xs-10">
            <h1>Factura</h1>
        </div>
        <hr>
        <div class="d-flex justify-content-between">

        <div class="row text-center ml-2" style="margin-bottom: 2rem;">
            <div class="col-xs-6">
                <h3 class="text-left">Cliente</h3>

            <table class="text-left">
                <input type="hidden" id="customer_number_inv_hidden" name="customer_number_inv" placeholder="customer_number_inv" value="<?php echo ""; ?>" /> <!-- input oculto para poder capturar valor $outputNumber-->
                <tr><th>Nº Cliente</th><td class="pl-1" id="customer_number_inv"><?php echo $customerInvoiceData[0]->id_customer_ci; ?></td></tr> 
                <tr><th>Nombre</th><td id="customer_name_inv"><?php echo $customerInvoiceData[0]->name_customer; ?></td></tr>
                <tr><th>NIF</th><td id="customer_nif_inv"><?php echo $customerInvoiceData[0]->nif_cif; ?></td></tr>
                <tr><th>Dirección</th><td id="customer_address_inv"><?php echo $customerInvoiceData[0]->address_customer; ?></td></tr>
                <tr><th>C. Postal</th><td id="customer_postal_code_inv"><?php echo $customerInvoiceData[0]->postal_code; ?></td></tr>
                <tr><th>Localidad</th><td id="customer_town_inv"><?php echo $customerInvoiceData[0]->town; ?></td></tr>
                <tr><th>Provincia</th><td id="customer_province_inv"><?php echo $customerInvoiceData[0]->province; ?></td></tr>
            </table>

            </div>      
        </div>        
              
        <div class="col-xs-2 text-right mr-2">
            <strong>Fecha Factura</strong>
            <br> 
            <p id="output_number">
                <?php   
                    if(isset($_GET["token"]) && !empty($_GET["token"])) {
                        echo $customerInvoiceData[0]->created_date_customer_invoice;      // Para mostrar datos de facturas del historial
                    }
                    else {
                        echo date("d/m/Y");     // En caso contrario se obtiene y muestra fecha del sistema
                    }                    
                ?> 
            </p>                 
            <strong>Nº Factura</strong>
            <br>
            <p id="output_invoice_created_date">
                <?php  
                    if(isset($_GET["token"]) && !empty($_GET["token"])) {
                        echo $customerInvoiceData[0]->output_number;                       // Para mostrar datos de facturas del historial
                    }
                    else {
                        $outputNumber = SalesController::ctrGenerateOutPutNumber("outputs_products");  // Se lanza método para asignar número de factura de forma automática. 
                        echo $outputNumber; 
                    }  
                ?>
                <input type="hidden" id="output_number" name="output_number" value="<?php echo $outputNumber; ?>" /> <!-- input oculto para poder capturar por php valor $outputNumber (nº factura) -->
            </p>
        </div>
            
        </div>            

    <fieldset class="">   

        <div class="row_table">
            <div class="col-xs-9">
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="ref" title="Referencia / Id producto">Ref.</th>
                            <th class="desc">Concepto</th>
                            <th class="cant" title="Cantidad">Cant.</th>
                            <th class="pr">Precio (€)</th>
                            <th class="des" title="Descuento %">Desc.(%)</th>
                            <th class="total">Total (€)</th>
                        </tr>
                    </thead>          
                    <tbody class="rows_items">  
                        <?php              
                            //  Bucle para generar mismo tipo de columnas modificando unicamente el id y name del elemento html input          
                            for($i = 1; $i <= 5; $i++) {                        
                                echo '<tr class="row_item">    
                                        <input type="hidden" name="numbers_rows[]" value="' . $i . '">      <!-- input oculto que almacenará número de fila -->                   
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields div_id_product_item align_icon"><i class="fa-solid fa-magnifying-glass forms_icons search_icon'. $readOnly .'" id="btn_input_search_product" title="Buscar producto"></i><input type="text" class="forms_inputs product_item_id input_id id_product_item_c'. $i .'" id="id_product_item'. $i .'" name="id_product_item'. $i .'" placeholder="Id producto" '. $readOnly .' value="' . $outputInvoiceData[$i-1]->id_product_op . '" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width product_name_item_c'.$i.'" id="product_name_item'.$i.'" name="product_name_item'.$i.'" placeholder="Nombre del producto" '. $readOnly .' value="' . $outputInvoiceData[$i-1]->name_product . '" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="number" class="forms_inputs inputs_width amounts amount_item_c'.$i.'" id="amount_item'.$i.'" name="amount_item'.$i.'" placeholder="0" '. $readOnly .' value="'. $outputInvoiceData[$i-1]->output_units .'" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width price price_item_inv'.$i.'" id="price_item'.$i.'" name="price_item'.$i.'" placeholder="0 €" '. $readOnly .' value="'. $outputInvoiceData[$i-1]->unit_sales_price .'" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width discount" id="discount_item'.$i.'" name="discount_item'.$i.'" placeholder="0 %" '. $readOnly .' value="0"'. $outputInvoiceData[$i-1]->unit_discount_product_op .'" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width total_item_row" id="total_item'.$i.'" name="total_item'.$i.'" placeholder="0 €" readonly value="'. $outputInvoiceData[$i-1]->total_row_output .'" /><button type="button" class="btn btn-danger btn-sm p-0 pl-1 pr-1 ml-1 delete_row_input" id="" ><i class="fa-sharp fa-solid fa-trash-can fa-2s"></i></button></div></td>
                                    </tr>';
                            }
                            // Bucle igual que el anterior pero oculto, será el usuario quien decida visualizarlo
                            for($i = 6; $i <= 10; $i++) { 
                                echo '<tr class="row_item hidden_rows"> 
                                <input type="hidden" name="numbers_rows[]" value="' . $i . '">      <!-- input oculto que almacenará número de fila -->                   
                                <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields div_id_product_item align_icon"><i class="fa-solid fa-magnifying-glass forms_icons search_icon'. $readOnly .'" id="btn_input_search_product" title="Buscar producto"></i><input type="text" class="forms_inputs product_item_id input_id id_product_item_c'. $i .'" id="id_product_item'. $i .'" name="id_product_item'. $i .'" placeholder="Id producto" '. $readOnly .' value="' . $outputInvoiceData[$i-1]->id_product_op . '" /></div></td>
                                <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width product_name_item_c'.$i.'" id="product_name_item'.$i.'" name="product_name_item'.$i.'" placeholder="Nombre del producto" value="' . $outputInvoiceData[$i-1]->name_product . '" /></div></td>
                                <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="number" class="forms_inputs inputs_width amounts amount_item_c'.$i.'" id="amount_item'.$i.'" name="amount_item'.$i.'" placeholder="0" '. $readOnly .' value="'. $outputInvoiceData[$i-1]->output_units .'" /></div></td>
                                <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width price price_item_inv'.$i.'" id="price_item'.$i.'" name="price_item'.$i.'" placeholder="0 €" '. $readOnly .' value="'. $outputInvoiceData[$i-1]->unit_sales_price .'" /></div></td>
                                <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width discount" id="discount_item'.$i.'" name="discount_item'.$i.'" placeholder="0 %" '. $readOnly .' value="0"'. $outputInvoiceData[$i-1]->unit_discount_product_op .'" /></div></td>
                                <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width total_item_row" id="total_item'.$i.'" name="total_item'.$i.'" placeholder="0 €" readonly value="'. $outputInvoiceData[$i-1]->total_row_output .'" /><button type="button" class="btn btn-danger btn-sm p-0 pl-1 pr-1 ml-1 delete_row_input" id="" ><i class="fa-sharp fa-solid fa-trash-can fa-2s"></i></button></div></td>
                                    </tr>';
                            } 
                        ?>
                            

                    </tbody>
                    <tfoot>
                        <tr>   
                            <td>
                            <div colspan="1"><button type="button" class="btn btn-primary mr-5 btn_add" id="btn_add_product_row" name="" title="Añadir líneas de productos"><i class="fa-sharp fa-solid fa-plus"></i></button></div>
                            <div colspan="1"><button type="button" class="btn btn-primary mr-5 btn_minus" id="btn_delete_product_row" name="" title="Eliminar líneas de productos"><i class="fa-sharp fa-solid fa-minus"></i></button></div>  
                            </td>
                            <td colspan="4" class="text-right">Subtotal (€)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input" id="subtotal_input" name="subtotal_invoice" placeholder="0 €" readonly value="<?php echo $customerInvoiceData[0]->subtotal_invoice; ?>" /></div></td>
                        </tr> 
                        <tr>
                            <td colspan="5" class="text-right">Descuento (%)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input discount_document" id="discount_input" name="discount_invoice" placeholder="0 %" <?php echo $readOnly; ?> value="<?php echo $customerInvoiceData[0]->discount_invoice; ?>" /></div></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">Subtotal con descuento (€)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input" id="subtotal_discount_input" name="subtotal_discount_invoice" placeholder="0 €" readonly value="<?php echo $customerInvoiceData[0]->subtotal_with_discount_invoice; ?>" /></div></td>
                        </tr>  
                        <tr>
                            <td colspan="5" class="text-right">Impuestos (21%)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input" id="tax_input" name="tax_invoice" placeholder="0 €" readonly value="<?php echo $customerInvoiceData[0]->tax_invoice; ?>" /></div></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right font-weight-bold">
                                <h4>Total (€)</h4></td>
                            <td class="total_field">
                                <h5><div class="forms_inputs_fields table_inputs_fields font-weight-bold"><input type="text" class="forms_inputs inputs_width number_input" id="total_input" name="total_invoice" placeholder="0 €" readonly value="<?php echo $customerInvoiceData[0]->total_invoice; ?>" /></div></h5>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>                                                  <!---------------------------- END DIV INVOICE -------------------------------->     

                                                            <!-- ELEMENTOS INPUTS OCULTOS -->

                        <!-- input oculto que recibirá valor de token de customer de subventana -->
        <input type="hidden" id="token_customer" name="token_customer" placeholder="token_customer Subwindow" value="<?php //echo $inputProductData[0]->token_input_product; ?>" /> 
                        <!-- input oculto que recibirá valor de token de subventana -->
        <input type="hidden" id="tokenOutputs" name="tokenOutputs" placeholder="tokenOutputs Subwindow" value="<?php //echo $inputProductData[0]->token_input_product; ?>" /> 
                        <!-- input oculto para recibir/capturar valor token de subventana buscador para búsqueda de productos  -->
         <input type="hidden" id="tokenProduct" placeholder="tokenProduct Subwindow. Hide" value="" />
                        <!-- input oculto que almacenará valor de atributo "id" de la fila seleccionada -->
        <input type="hidden" id="row_number_selected" placeholder="nº fila seleccionada" value="" />
                        <!-- input oculto que almacenará chequeo de respuesta ajax de la fila seleccionada -->
        <input type="hidden" id="request_ajax" placeholder="request_ajax" value="false" />
                       
                                                 
                                                  <!-- -------------------------- -->

    <div class="btn-group p-3 ">      
      <button type="submit" class="btn btn-primary mr-5" id="btn_invoice_product_submit" name="btn_output_product_submit"><i class="fa-solid fa-file-invoice-dollar"></i>&nbsp Facturar</button>
      <a href="./pdf.php" target="_blank" class="btn btn-dark mr-5" id="btn_invoice_pdf"><i class="fa-solid fa-file-pdf"></i>&nbsp Copia factura</a>
      <button type="button" role="link" class="btn btn-secondary mr-5" name="exit_input_product" onClick="window.location='index.php?pages=01-newInvoice'"><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar registro</button>    
    </div>

                    <!-- Mensajes ocultos de validaciones y realización de operaciones -->
    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Operación realizada con éxito</p></div>

    <div class="text-center alert-danger rounded error_price_field"><p>El campo <i><b>Precio</b></i> solo admite caracteres numéricos.</p></div>

    <div class="text-center alert-danger rounded error_discount_field"><p>El campo <i><b>Desc.(%)</b></i> solo admite caracteres numéricos.</p></div>
    
    <div class="text-center alert-danger rounded error_discount_document_field"><p>El campo <i><b>Descuento (%)</b></i> solo admite caracteres numéricos.</p></div>

    <div class='text-center alert-danger rounded require_fields'><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Cliente</li><li>Ref.</li><li>Concepto</li><li>Cant.</li><li>Precio (€)</li></ul></div>

    <div class='text-center alert-danger rounded submit_disabled'><p class='font-weight-bold'>No se pueden realizar modificaciones de Facturas.</p><br><p>En caso de necesitar modifcaciones debe tener privilegios de superusuario.</p></div>
    
                     <!-- -------------------------------------------------------------  -->
                     
    <div class="modal fade" id="product_success_modal" role="dialog">  <!-- MODAL DE CONFIRMACIÓN DE OPERACIÓN bootstrap 4  -->
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">                 
                  <h4 class="modal-title">Operación realizada con éxito</h4>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
    </div>

    <?php 
        // Se lanza método para grabar datos de Generar Factura.
      $createProductOutput = SalesController::ctrCreateProductOutput("outputs_products"); 
 
        /* Bloque condicional para borrar datos almacenados del formulario html una vez enviados.
        ----------------------------------------------------------------------------------------*/
      if($createProductOutput == "true"/* || $updateProduct == "true" || $checkDeleteRegister == "true"*/) {
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }   
                window.sessionStorage.setItem('modalAlert', 'true');        // Se almacena valor en sesión para que se utilice al refrescar página
                window.location.replace('index.php?pages=01-newInvoice');   // Se refresca página
                
              </script>";
      }
      else {
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }
              </script>";
      }
    ?>

  </fieldset>

</form>           

