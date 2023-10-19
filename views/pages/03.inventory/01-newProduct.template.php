<?php
  $productData = array();
    //$categoryProductData = array();
      // Condición para controlar si se muestran datos en el formulario o se muestra en blanco
    if(isset($_GET["token"]) && !empty($_GET["token"])) {                                    
      $productData = InventoryController::ctrToListProduct("products", "token_product", $_GET["token"]);     // se llama a función para leer datos de la tabla "products"      
    }       

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


<h2 class="li_active_page rounded">Ficha Productos</h2>

<form class="general_forms" id="new_supplier_form" action="<?php $_SERVER['REQUEST_URI']; ?>" method="post" onsubmit="">
  <h4 class="forms_subtitle rounded">Altas | Modificar | Eliminar</h4>
    
                                            <!-- Lista de botones "Buscar" e "Imprimir" -->
  <ul class="d-flex justify-content-first"> 
    <li><button type="button" class="search_bar m-1 alert-info rounded" id="search_product" onClick=""><i class="fa-solid fa-magnifying-glass"></i>&nbsp Buscar Producto</button></li>
    <li><button type="button" class="print_bar m-1 alert-info rounded" id="print_product"><i class="fa-solid fa-print"></i>&nbspImprimir</button></li>
  </ul>
                                            <!-- --------------------------------------- -->      

  <fieldset class="d-flex justify-content-around"> <!-- //todo-> CAMBIAR A ESTILO PROPIO CON CSS flex personalizado -->
    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="product_id">Id Producto</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-list-ol forms_icons"></i>
          <input type="text" class="forms_inputs" id="product_id" name="product_id" placeholder="" disabled value="<?php echo $productData[0]->id_product ?>" />
        </div>      
    </div>

    <div class="forms_fields">
        <label class="forms_label" for="product_category">Categoría Producto</label>
        <div class="forms_inputs_fields">
            <i class="fa-solid fa-house forms_icons"></i> 

            <select class="" id="" name="select_item_category"> <?php echo "hola"; ?> <!-- //todo-> DUDA PELUDA DONDE SE COLOCA EL id para recibir dato AJAX -->
                <option id="select_item_category" value="<?php echo $productData[0]->id_product_category; ?>" selected><?php echo $productData[0]->name_product_category; ?></option>
                <?php                  // Select con categoría de productos almacenada en la tabla "product_categories" de la base de datos
                  $selectCategory = InventoryController::ctrToListCategoryProduct("product_categories", null);                                     
                  foreach($selectCategory as $item):
                ?>
                <option value="<?php echo $item->id_product_category; ?>"><?php echo $item->name_product_category; ?></option>
               <?php endforeach; ?>
            </select>
        </div>      
      </div>

    <div class="forms_flex" >
      <div class="forms_fields">
        <label class="forms_label" for="product_created_date">Fecha registro</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-calendar-days forms_icons"></i>
          <input type="text" class="forms_inputs" id="product_created_date" name="product_created_date" placeholder="" disabled value="<?php echo $productData[0]->created_date_product ?>" />
        </div>      
    </div>
  </fieldset>

  <fieldset class="">   

    <div class="forms_flex">
        <div class="forms_fields">
        <label class="forms_label" for="or_original_product">Referencia Original</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-address-card forms_icons"></i>
          <input type="text" class="forms_inputs" id="or_original_product" name="or_original_product" placeholder="C2540A" value="<?php echo $productData[0]->or_product ?>"/>
        </div>      
      </div> 

      <div class="forms_fields">
        <label class="forms_label" for="product_name">Nombre Producto</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="product_name" name="product_name" placeholder="Tóner laser HP" value="<?php echo $productData[0]->name_product ?>" />
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="product_description">Descripción producto</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-envelopes-bulk forms_icons"></i>
          <input type="text" class="forms_inputs" id="product_description" name="product_description" placeholder="Ej: Compatible con impresoras..." value="<?php echo $productData[0]->description_product ?>"/>
        </div>      
      </div>
    </div>

    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="product_unit">Unidades</label>  
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-tree-city forms_icons"></i>
          <input type="text" class="forms_inputs" id="product_unit" name="product_unit" placeholder="" disabled value="<?php echo $productData[0]->units_product ?>">
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="last_cost_product">Último coste producto</label> 
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-city forms_icons"></i>
          <input type="text" class="forms_inputs" id="last_cost_product" name="last_cost_product" placeholder="" disabled value="<?php echo $productData[0]->last_unit_cost_product ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="sale_price_product">Precio de venta</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-earth-americas forms_icons"></i>
          <input type="text" class="forms_inputs" id="sale_price_product" name="sale_price_product" placeholder="" value="<?php echo $productData[0]->sale_price_product ?>"/>
        </div>      
      </div>     

      <div class="forms_fields">
        <label class="forms_label" for="supplier_product">Proveedores</label> <!-- // todo-> Se alimenta de tabla de movimiento de entradas o de product_suppliers?? -->
        <div class="forms_inputs_fields">
            <i class="fa-solid fa-house forms_icons"></i> 

            <select class="" id="" name="supplier_product">
                <option vaule="" selected hidden="true">suministrado por</option>
                <?php   /*                    //todo Select con categoría de productos almacenada en la tabla "product_categories" de la base de datos
                    $selectCategory = CustomerController::ctrToList("product_categories", null);                                     
                    foreach($selectCategory as $item):*/
                ?>
                <option disabled value="<?php// echo $item->id; ?>"><?php //echo $item->name_product_category; ?></option>
               <?php// endforeach ?>
            </select>
        </div>      
      </div>

                <!-- input oculto que recibirá valor de token de subventana -->
        <input type="hidden" id="tokenProduct" name="tokenProduct" placeholder="tokenValue Subwindow" value="" /> 
                <!-- ------------------------------------------------------- -->
    </div>
    <div class="btn-group p-3 ">
      <button type="submit" class="btn btn-primary mr-5" id="btn_product_submit" name="btn_product_submit"><i class="fa-sharp fa-solid fa-pencil"></i>&nbsp Grabar</button> 
      <button type="button" role="link" class="btn btn-secondary mr-5" name="exit_product" onClick="window.location='index.php?pages=01-newProduct'"><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar registro</button>
      <button type="submit" class="btn btn-danger" name="delete_product"><i class="fa-sharp fa-solid fa-trash-can"></i>&nbsp Eliminar registro</button> 
    </div>

                    <!-- Mensajes ocultos de validaciones y realización de operaciones -->
    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Operación realizada con éxito</p></div>
                   
    <div class='text-center alert-danger rounded name_field_duplicate'><p>El <i><b>Nombre</b></i> introducido ya existe en la base de datos.</p></div>
    
    <div class='text-center alert-danger rounded error_format_nif'><p>El formato del campo <b><i>NIF</i></b> es erroneo<br>Ejemplos válidos: Dni 12345678X / Cif B12345678 / NIE X1234567S</p></div>
    
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
        /* Bloque condicional para grabar datos de un cliente nuevo, actualizar o eliminar datos de un registro existente
        -----------------------------------------------------------------------------------------------------------------*/
      if(isset($_GET["token"]) && !empty($_GET["token"])) {                
                     
        $updateProduct = InventoryController::ctrUpdateProduct("products", "token_product", $_GET["token"]);    // se lanza método para actualizar datos de clientes.
      
        $deleteProduct = new InventoryController(); 
        $checkDeleteProduct = $deleteProduct->ctrDeleteProduct("products", "token_product", $_GET["token"]);   // se lanza método para eliminar registro concreto.
      }
      else if(isset($_POST["tokenProduct"]) && !empty($_POST["tokenProduct"])) {   
      
        $updateProduct = InventoryController::ctrUpdateProduct("products", "token_product", $_POST["tokenProduct"]);    // se lanza método para actualizar datos de proveedores.

        $deleteProduct = new InventoryController(); 
        $checkDeleteProduct = $deleteProduct->ctrDeleteProduct("products", "token_product", $_POST["tokenProduct"]);   // se lanza método para eliminar registro concreto.
      }
      else {     
        $createProduct = InventoryController::ctrCreateProduct("products"); // se lanza método para grabar datos de proveedor.
      }
       
        /* Bloque condicional para lanzar ventana modal en función del éxito de la operación realizada
        ---------------------------------------------------------------------------------------------*/
      if($updateProduct == "true") { 

        $newToken = md5(ucwords($_POST["product_name"] . "+" . strtoupper($_POST["or_original_product"])));   // Se genera nuevo token para poder recargar página con datos actualizados.        

          // 1º se guarda estado de la actualización/borrado en variable de sesión para a continuación poder lanzar ventana modal al recargar página.
          // 2º se refresca página con datos del registro actualizados. 
        echo "<script>
                window.sessionStorage.setItem('modalAlert', 'true');
                window.location.replace('index.php?pages=01-newProduct&token=$newToken');
              </script>";   
      }
      else if($checkDeleteProduct == "true") {
            echo "<script>
                    window.sessionStorage.setItem('modalAlert', 'true'); 
                    window.location.replace('index.php?pages=01-newProduct');
                  </script>"; 
      }
    ?>

    <?php
        /* Bloque condicional para borrar datos almacenados del formulario html una vez enviados.
        ----------------------------------------------------------------------------------------*/
      if($createProduct == "true" || $updateProduct == "true" || $checkDeleteRegister == "true") {
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
