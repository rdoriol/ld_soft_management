<?php
  $invoiceData = array();
   
      // Condición para controlar si se muestran datos en el formulario o se muestra en blanco
  /*if((isset($_GET["token"]) && !empty($_GET["token"])) || (isset($_POST["tokenProduct"]) && !empty($_POST["tokenProduct"]))) {                                    
    $inputProductData = InventoryController::ctrToListProduct("products", "token_product", $_GET["token"]);     // se llama a función para leer datos de la tabla "products"      
    $inputProductData = InventoryController::ctrToListProduct("products", "token_product", $_SESSION["tokenProduct"]);     // se llama a función para leer datos de la tabla "products"      
  }*/
     // script javascript para lanzar ventana modal confirmando actualizaciones o eliminaciones.
    echo "<script>
    if(window.sessionStorage.getItem('modalAlert') == 'true') {
      $(function(){ 
        $('#product_success_modal').modal('show');
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
            <li><button type="button" class="search_bar m-1 alert-info rounded" id="search_inputs_products"><i class="fa-solid fa-magnifying-glass"></i>&nbsp Historial de facturas</button></li>
            <li><button type="button" class="print_bar m-1 alert-info rounded" id="print_product"><i class="fa-solid fa-print"></i>&nbsp Imprimir</button></li>
        </ul>
                                                    
        <div class="forms_field flex_customer_field">
            <label class="forms_label" for="invoice_created_date" id="btn_input_search_customer" title="Cliente a facturar">Cliente a facturar</label>
            <div class="forms_inputs_fields">  
                <i class="fa-solid fa-magnifying-glass forms_icons search_icon_customer" title="Buscar cliente"></i>
                <input type="text" class="forms_inputs product_item_id input_id" id="id_customer_item" name="id_customer_item" placeholder="Nº cliente" value="" />
            </div>     
        </div>
    </div>
                                         <!-- --------------------------------------- --> 
          <?php 
            $inputNumber = ProductInputController::ctrGenerateInputNumber("inputs_product")  // Se lanza método para asignar número de entrada de forma automática //todo
          ?>
  <div class="invoice mt-5">
    <div class="d-flex justify-content-between ml-2">
            <div class="col-xs-10 ">
                <h1>Factura</h1>
            </div>
            <div class="d-flex mr-2">
            <div class="col-xs-2">
                    <img class="img img-responsive" src="" alt="Logo Empresa">
                </div>
                <div class="col-xs-10 pl-5 text-right">                
                    <h6><strong>LD SoftGestión, S.L.</strong></h6>
                    <h6>B41229499</h6>
                    <h6>C/ París, 59</h6>
                    <h6>41003 - Sevilla</h6>
                </div>
              
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">

        <div class="row text-center ml-2" style="margin-bottom: 2rem;">
            <div class="col-xs-6">
                <h3 class="text-left">Cliente</h3>

            <table class="text-left">
                <tr><th>Nº Cliente</th><td class="pl-1" id="customer_number_inv"></td></tr>
                <tr><th>Nombre</th><td id="customer_name_inv"></td></tr>
                <tr><th>NIF</th><td id="customer_nif_inv"></td></tr>
                <tr><th>Dirección</th><td id="customer_address_inv"></td></tr>
                <tr><th>C. Postal</th><td id="customer_postal_code_inv"></td></tr>
                <tr><th>Localidad</th><td id="customer_town_inv"></td></tr>
                <tr><th>Provincia</th><td id="customer_province_inv"></td></tr>
            </table>

            </div>      
        </div>

            <div class="col-xs-2 text-right mr-2">
                <strong>Fecha Factura</strong>
                <br> 
                <p>
                    <?php echo date("d/m/Y"); ?> <?php echo $invoiceData[0]->created_date_product; ?>
                <br>
                <strong>Nº Factura</strong>
                <br>
                <?php echo $inputNumber; ?>
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
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields div_id_product_item align_icon"><i class="fa-solid fa-magnifying-glass forms_icons search_icon" id="btn_input_search_product" title="Buscar producto"></i><input type="text" class="forms_inputs product_item_id input_id id_product_item_c'. $i .'" id="id_product_item'. $i .'" name="id_product_item'. $i .'" placeholder="Id producto" value="" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width product_name_item_c'.$i.'" id="product_name_item'.$i.'" name="product_name_item'.$i.'" placeholder="Nombre del producto" value="" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="number" class="forms_inputs inputs_width amounts amount_item_c'.$i.'" id="amount_item'.$i.'" name="amount_item'.$i.'" placeholder="0" value="0" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width price price_item_inv'.$i.'" id="price_item'.$i.'" name="price_item'.$i.'" placeholder="0 €" value="0" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="number" step="0.1" class="forms_inputs inputs_width discount" id="discount_item'.$i.'" name="discount_item'.$i.'" placeholder="0 %" value="0" /></div></td>
                                        <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width total_item_row" id="total_item'.$i.'" name="total_item'.$i.'" placeholder="0 €" readonly value="" /><button type="button" class="btn btn-danger btn-sm p-0 pl-1 pr-1 ml-1 delete_row_input" id="" ><i class="fa-sharp fa-solid fa-trash-can fa-2s"></i></button></div></td>
                                    </tr>';
                            }
                            // Bucle igual que el anterior pero oculto, será el usuario quien decida visualizarlo
                            for($i = 6; $i <= 10; $i++) { 
                            echo '<tr class="row_item hidden_rows"> 
                                    <input type="hidden" name="numbers_rows[]" value="' . $i . '">          <!-- input oculto que almacenará número de fila --> 
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields div_id_product_item align_icon"><i class="fa-solid fa-magnifying-glass forms_icons search_icon" id="btn_input_search_product" title="Buscar producto"></i><input type="text" class="forms_inputs product_item_id input_id" id="id_product_item'. $i .'" name="id_product_item'. $i .'" placeholder="Id producto" value="" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width" id="product_name_item'.$i.'" name="product_name_item'.$i.'" placeholder="Nombre del producto" value="" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="number" class="forms_inputs inputs_width amounts" id="amount_item'.$i.'" name="amount_item'.$i.'" placeholder="" value="0" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width price" id="price_item'.$i.'" name="price_item'.$i.'" placeholder="" value="0" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width discount" id="discount_item'.$i.'" name="discount_item'.$i.'" placeholder="" value="0" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width total_item_row" id="total_item'.$i.'" name="total_item'.$i.'" placeholder="0 €" readonly value="" /><button type="button" class="btn btn-danger btn-sm p-0 pl-1 pr-1 ml-1 delete_row_input" id="" ><i class="fa-sharp fa-solid fa-trash-can fa-2s"></i></button></div></td>
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
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" step="0.01"class="forms_inputs inputs_width number_input" id="subtotal_input" name="subtotal_input" placeholder="0 €" readonly value="" /></div></td>
                        </tr> 
                        <tr>
                            <td colspan="5" class="text-right">Descuento (%)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" step="0.01"class="forms_inputs inputs_width number_input" id="discount_input" name="discount_input" placeholder="0 %" value="" /></div></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">Subtotal con descuento (€)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" step="0.01"class="forms_inputs inputs_width number_input" id="subtotal_discount_input" name="subtotal_discount_input" placeholder="0 €" readonly value="" /></div></td>
                        </tr>  
                        <tr>
                            <td colspan="5" class="text-right">Impuestos (21%)</td>
                            <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" step="0.01"class="forms_inputs inputs_width number_input" id="tax_input" name="tax_input" placeholder="0 €" readonly value="" /></div></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right font-weight-bold">
                                <h4>Total (€)</h4></td>
                            <td class="total_field">
                                <h5><div class="forms_inputs_fields table_inputs_fields font-weight-bold"><input type="number" class="forms_inputs inputs_width number_input" id="total_input" name="total_input" placeholder="0 €" readonly value="" /></div></h5>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> <!-- End div invoice-->                                                 <!-- ELEMENTOS INPUTS OCULTOS -->

                        <!-- input oculto que recibirá valor de token de customer de subventana -->
        <input type="hidden" id="token_customer" name="token_customer" placeholder="token_customer Subwindow" value="<?php //echo $inputProductData[0]->token_input_product; ?>" /> 
                        <!-- input oculto que recibirá valor de token de subventana -->
        <input type="hidden" id="tokenInputs" name="tokenInputs" placeholder="tokenInputs Subwindow" value="<?php //echo $inputProductData[0]->token_input_product; ?>" /> 
                        <!-- input oculto para recibir/capturar valor token de subventana buscador para búsqueda de productos  -->
         <input type="hidden" id="tokenProduct" placeholder="tokenProduct Subwindow. Hide" value="" />
                        <!-- input oculto que almacenará valor de atributo "id" de la fila seleccionada -->
        <input type="hidden" id="row_number_selected" placeholder="nº fila seleccionada" value="" />
                        <!-- input oculto que almacenará chequeo de respuesta ajax de la fila seleccionada -->
        <input type="text" id="request_ajax" placeholder="request_ajax" value="false" />
                       
                                                 
                                                  <!-- -------------------------- -->

    <div class="btn-group p-3 ">
      <button type="submit" class="btn btn-primary mr-5" id="btn_invoice_product_submit" name="btn_input_product_submit"><i class="fa-solid fa-file-invoice-dollar"></i>&nbsp Facturar</button>
      <button type="button" role="link" class="btn btn-secondary mr-5" name="exit_input_product" onClick="window.location='index.php?pages=01-newInvoice'"><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar registro</button>      
    </div>

                    <!-- Mensajes ocultos de validaciones y realización de operaciones -->
    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Operación realizada con éxito</p></div>

    <div class="text-center alert-danger rounded error_field"><p>Los campos <i><b>Cant., Precio y Desc.(%)</b></i> solo admiten caracteres numéricos.</p></div>       
    
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
        /* Bloque condicional para grabar datos nuevos, actualizar o eliminar datos de un registro existente
        -----------------------------------------------------------------------------------------------------------------*/
      if(isset($_GET["token"]) && !empty($_GET["token"])) {                
                     
        $updateProduct = InventoryController::ctrUpdateProduct("products", "token_product", $_GET["token"]);    // se lanza método para actualizar datos de clientes.
      
        $deleteProduct = new InventoryController(); 
        $checkDeleteProduct = $deleteProduct->ctrDeleteProduct("products", "token_product", $_GET["token"]);   // se lanza método para eliminar registro concreto.
      }
      else if(isset($_POST["tokenProduct"]) && !empty($_POST["tokenProduct"])) {   
      
        $updateProduct = InventoryController::ctrUpdateProduct("products", "token_product", $_POST["tokenProduct"]);    // se lanza método para actualizar datos de proveedores.

        $deleteProduct = new InventoryController();   //todo-> Finalmente no se utilizará, esta acción se realizará via AJAX. Eliminar más adelante
        $checkDeleteProduct = $deleteProduct->ctrDeleteProduct("products", "token_product", $_POST["tokenProduct"]);   // se lanza método para eliminar registro concreto.
      }
      else {    

          // Se recorre el array "numbers_rows[]" del name de las filas de productos para verificar que filas se van a enviar al archivo controller para generar el movimiento de entrada del producto
        //foreach($_POST["numbers_rows"] as $item) {

          //if(!empty($_POST["id_product_item" . $item])) {   
            $createProductInput = ProductInputController::ctrCreateProductInput("inputs_product"); // se lanza método para grabar datos de entradas de productos.
          //}
        //}  
      }
       
        /* Bloque condicional para lanzar ventana modal en función del éxito de la operación realizada
        ---------------------------------------------------------------------------------------------*/
      if($updateProduct == "true") {                

        $newToken = md5(ucfirst($_POST["product_name"] . "+" . strtoupper($_POST["or_original_product"])));   // Se genera nuevo token para poder recargar página con datos actualizados.        

          // 1º se guarda estado de la actualización/borrado en variable de sesión para a continuación poder lanzar ventana modal al recargar página.
          // 2º se refresca página con datos del registro actualizado. 
        echo "<script>
                window.sessionStorage.setItem('modalAlert', 'true');
                window.location.replace('index.php?pages=02-productsInputs');
              </scrip>";   
      }
      else if($checkDeleteProduct == "true" || $createProductInput == "true") {
            echo "<script>
                    window.sessionStorage.setItem('modalAlert', 'true'); 
                    window.location.replace('index.php?pages=02-productsInputs');
                  </script>"; 
      }
    ?>

    <?php
        /* Bloque condicional para borrar datos almacenados del formulario html una vez enviados.
        ----------------------------------------------------------------------------------------*/
      if($createProductInput == "true" || $updateProduct == "true" || $checkDeleteRegister == "true") {
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }              
                document.getElementsByClassName('hide_alert')[0].style.display='block';
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

