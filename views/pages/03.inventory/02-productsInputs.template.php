<?php
 
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

<h2 class="li_active_page rounded">Entradas Productos</h2>

<form class="general_forms" id="products_inputs_form" action="" method="post" onsubmit="">
  <h4 class="forms_subtitle rounded">Movimientos de entradas</h4>
    
                                            <!-- Lista de botones "Buscar" e "Imprimir" -->
  <ul class="d-flex justify-content-first"> 
    <li><button type="button" class="search_bar m-1 alert-info rounded" id="search_inputs_products"><i class="fa-solid fa-magnifying-glass"></i>&nbsp Historial de entradas</button></li>
    <li><button type="button" class="print_bar m-1 alert-info rounded" id="print_product"><i class="fa-solid fa-print"></i>&nbspImprimir</button></li>
  </ul>
                                            <!-- --------------------------------------- -->      

  <fieldset class="d-flex justify-content-around"> <!-- //todo-> CAMBIAR A ESTILO PROPIO CON CSS flex personalizado -->
    <div class="forms_flex">
      <div class="forms_fields">
          <?php 
            $inputNumber = ProductInputController::ctrGenerateInputNumber("inputs_product")  // Se lanza método para asignar número de entrada de forma automática
          ?>
        <label class="forms_label" for="input_prodcut_id">Nº Entrada</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-list-ol forms_icons"></i>
          <input type="text" class="forms_inputs" id="input_number" name="input_number" placeholder="auto" readonly value="<?php echo $inputNumber; ?>" />         
        </div>      
      </div>

      <div class="forms_fields">
          <label class="forms_label" for="product_created_date">Fecha entrada</label>
          <div class="forms_inputs_fields">
            <i class="fa-solid fa-calendar-days forms_icons"></i>
            <input type="text" class="forms_inputs" id="input_product_created_date" name="input_product_created_date" placeholder="auto" disabled value="<?php echo date("d/m/Y"); ?>" />
          </div>     
      </div>

    <div class="forms_fields">
        <label class="forms_label" for="father_select_supplier">Proveedor</label>
        <div class="forms_inputs_fields">
            <i class="fa-solid fa-house forms_icons"></i> 

            <select class="" id="father_select_supplier" name="select_supplier"> 
                <option id="select_supplier" value="" selected></option>
               
                <?php                  
                  $selectCategory = CustomerController::ctrToList("suppliers", null); // Select con proveedores almacenados en la tabla "suppliers" de la base de datos
                  foreach($selectCategory as $item):
                ?>

                <option value="<?php echo $item->id; ?>"><?php echo $item->name_supplier; ?></option>
               <?php endforeach; ?>
            </select>
        </div>      
      </div>
      
  </fieldset>

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
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields div_id_product_item align_icon"><i class="fa-solid fa-magnifying-glass forms_icons search_icon" id="btn_input_search_product" title="Buscar producto"></i><input type="text" class="forms_inputs product_item_id input_id" id="id_product_item'. $i .'" name="id_product_item'. $i .'" placeholder="Id producto" value="" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width" id="product_name_item'.$i.'" name="product_name_item'.$i.'" placeholder="Nombre del producto" value="" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="number" class="forms_inputs inputs_width amounts" id="amount_item'.$i.'" name="amount_item'.$i.'" placeholder="0" value="0" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width price" id="price_item'.$i.'" name="price_item'.$i.'" placeholder="0 €" value="0" /></div></td>
                                    <td class="'. $i .'"><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width discount" id="discount_item'.$i.'" name="discount_item'.$i.'" placeholder="0 %" value="0" /></div></td>
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
                        <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input" id="subtotal_input" name="subtotal_input" placeholder="0 €" readonly value="" /></div></td>
                    </tr> 
                    <tr>
                        <td colspan="5" class="text-right">Descuento (%)</td>
                        <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input discount_document" id="discount_input" name="discount_input" placeholder="0 %" value="" /></div></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Subtotal con descuento (€)</td>
                        <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input" id="subtotal_discount_input" name="subtotal_discount_input" placeholder="0 €" readonly value="" /></div></td>
                    </tr>  
                    <tr>
                        <td colspan="5" class="text-right">Impuestos (21%)</td>
                        <td><div class="forms_inputs_fields table_inputs_fields"><input type="text" class="forms_inputs inputs_width number_input" id="tax_input" name="tax_input" placeholder="0 €" readonly value="" /></div></td>
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
                                                  <!-- ELEMENTOS INPUTS OCULTOS -->

                        <!-- input oculto que recibirá valor de token de subventana -->
        <input type="hidden" id="tokenInputs" name="tokenInputs" placeholder="tokenInputs Subwindow" value="<?php //echo $inputProductData[0]->token_input_product; ?>" /> 
                        <!-- input oculto para recibir/capturar valor token de subventana buscador para búsqueda de productos  -->
         <input type="hidden" id="tokenProduct" placeholder="tokenProduct Subwindow. Hide" value="" />
                        <!-- input oculto que almacenará valor de atributo "id" de la fila seleccionada -->
        <input type="hidden" id="row_number_selected" placeholder="nº fila seleccionada" value="" />
                        <!-- input oculto que almacenará chequeo de respuesta ajax de la fila seleccionada -->
        <input type="hidden" id="request_ajax" placeholder="respuesta ajax" value="false" />
                                                 
                                                  <!-- -------------------------- -->

    <div class="btn-group p-3 ">
      <button type="submit" class="btn btn-primary mr-5" id="btn_input_product_submit" name="btn_input_product_submit"><i class="fa-sharp fa-solid fa-pencil"></i>&nbsp Grabar</button>
      <button type="button" role="link" class="btn btn-secondary mr-5" name="exit_input_product" onClick="window.location='index.php?pages=02-productsInputs'"><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar registro</button>      
    </div>

                    <!-- Mensajes ocultos de validaciones y realización de operaciones -->
    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Operación realizada con éxito</p></div>

    <div class="text-center alert-danger rounded error_price_field"><p>El campo <i><b>Precio</b></i> solo admite caracteres numéricos.</p></div>

    <div class="text-center alert-danger rounded error_discount_field"><p>El campo <i><b>Desc.(%)</b></i> solo admite caracteres numéricos.</p></div>

    <div class="text-center alert-danger rounded error_discount_document_field"><p>El campo <i><b>Descuento (%)</b></i> solo admite caracteres numéricos.</p></div>

    <div class="text-center alert-danger rounded error_amount_field"><p>El campo <i><b>Cant.</b></i> solo admiten caracteres numéricos sin decimales.</p></div>
    
    <div class='text-center alert-danger rounded require_fields'><p class='font-weight-bold'>Los siguientes campos son obligatorios:</p><ul><li>Proveedor</li><li>Ref.</li><li>Concepto</li><li>Cant.</li><li>Precio (€)</li></ul></div>

    <div class='text-center alert-danger rounded submit_disabled'><p class='font-weight-bold'>No se pueden realizar modificaciones en Movimientos de Entradas de Productos.</p><br><p>En caso de necesitar modifcaciones debe tener privilegios de superusuario.</p></div>
    
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
        /* // Se lanza método para grabar datos de entradas de productos.  
        -----------------------------------------------------------------------------------------------------------------*/
   
       $createProductInput = ProductInputController::ctrCreateProductInput("inputs_product");      
      
       
        /* Bloque condicional para lanzar ventana modal en función del éxito de la operación realizada
        ---------------------------------------------------------------------------------------------*/    

          // 1º se guarda estado de la actualización/borrado en variable de sesión para a continuación poder lanzar ventana modal al recargar página.
          // 2º se refresca página con datos del registro actualizado. 
      if($createProductInput == "true") {
            echo "<script>
                    window.sessionStorage.setItem('modalAlert', 'true'); 
                    window.location.replace('index.php?pages=02-productsInputs');
                  </script>"; 
      }
    ?>

    <?php
        /* Bloque condicional para borrar datos almacenados del formulario html una vez enviados.
        ----------------------------------------------------------------------------------------*/
      if($createProductInput == "true") {
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

