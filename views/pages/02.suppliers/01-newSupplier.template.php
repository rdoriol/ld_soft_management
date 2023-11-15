<?php
  $supplierData = array();
    
      // Condición para controlar si se muestran datos en el formulario o se muestra en blanco
    if((isset($_GET["token"]) && !empty($_GET["token"])) || (isset($_POST["tokenSupplier"]) && !empty($_POST["tokenSupplier"]))) {                                      
      $supplierData = CustomerController::ctrToList("suppliers", "token", $_GET["token"]);            // se llama a método si existe variable GET["token"]
    }
?>

<script>   // script javascript para lanzar ventana modal confirmando actualizaciones o eliminaciones.
    if(window.sessionStorage.getItem('modalAlert') == 'true') {
      $(function(){ 
        $('#supplier_success_modal').modal('show');
      });
      window.sessionStorage.setItem('modalAlert', 'false');
    }
  </script>


<h2 class="li_active_page rounded">Ficha Proveedores</h2>

<form class="general_forms" id="new_supplier_form" action="<?php $_SERVER['REQUEST_URI']; ?>" method="post" onsubmit= "">
  <h4 class="forms_subtitle rounded">Altas | Modificar | Eliminar</h4>
    
         
  <ul class="d-flex justify-content-first"> 
    <li><button type="button" class="search_bar m-1 alert-info rounded" id="search_supplier" onClick=""><i class="fa-solid fa-magnifying-glass"></i>&nbsp Buscar Proveedor</button></li>
    <li><button type="button" class="print_bar m-1 alert-info rounded" id="print_supplier"><i class="fa-solid fa-print"></i>&nbspImprimir</button></li>
  </ul>
                                                   
  <fieldset class="box_1 box_1_supplier"> 
    <div class="forms_flex forms_flex_supplier">
      <div class="forms_fields">
        <label class="forms_label" for="supplier_id">Id Proveedor</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-list-ol forms_icons"></i>
          <input type="text" class="forms_inputs input_ids" id="supplier_id" name="supplier_id" placeholder="auto" disabled value="<?php echo $supplierData[0]->id ?>" />
        </div>      
    </div>

    <div class="forms_flex" >
      <div class="forms_fields forms_flex_supplier">
        <label class="forms_label" for="supplier_created_date">Fecha registro</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-calendar-days forms_icons"></i>
          <input type="text" class="forms_inputs input_date" id="supplier_created_date" name="supplier_created_date" placeholder="auto" disabled value="<?php echo $supplierData[0]->created_date ?>" />
        </div>      
    </div>
  </fieldset>

  <hr>

  <fieldset class="flex_box">   

    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="supplier_name">Nombre Proveedor</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs input_name" id="supplier_name" name="supplier_name" placeholder="Empresa, S.L." value="<?php echo $supplierData[0]->name_supplier ?>" />
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_nif">NIF</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-address-card forms_icons"></i>
          <input type="text" class="forms_inputs input_nif" id="supplier_nif" name="supplier_nif" placeholder="00000000L / B00000000" value="<?php echo $supplierData[0]->nif ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_address">Dirección</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-house forms_icons"></i>
          <input type="text" class="forms_inputs input_address" id="supplier_address" name="supplier_address" placeholder="C/ Avda. Plaza" value="<?php echo $supplierData[0]->address ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_postal_code">Código Postal</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-envelopes-bulk forms_icons"></i>
          <input type="text" class="forms_inputs input_postal_code_supplier" id="supplier_postal_code" name="supplier_postal_code" placeholder="Ej: 41003" value="<?php echo $supplierData[0]->postal_code ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_town">Ciudad</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-tree-city forms_icons"></i>
          <input type="text" class="forms_inputs input_town" id="supplier_town" name="supplier_town" placeholder="Ej: Villaluenga del Rosario" value="<?php echo $supplierData[0]->town ?>">
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_province">Provincia</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-city forms_icons"></i>
          <input type="text" class="forms_inputs input_province_supplier" id="supplier_province" name="supplier_province" placeholder="Ej: Cádiz" value="<?php echo $supplierData[0]->province ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_country">País</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-earth-americas forms_icons"></i>
          <input type="text" class="forms_inputs input_country_supplier" id="supplier_country" name="supplier_country" placeholder="Ej: España" value="<?php echo $supplierData[0]->country ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_phone">Teléfono</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-phone forms_icons"></i>
          <input type="text" class="forms_inputs input_phone_supplier" id="supplier_phone" name="supplier_phone" placeholder="Ej: 666999666 / +34 666333555" value="<?php echo $supplierData[0]->phone ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_email">Correo electrónico</label>
        <div class="forms_inputs_fields">
          <i class="fa-sharp fa-solid fa-envelope forms_icons"></i>
          <input type="text" class="forms_inputs input_email_supplier" id="supplier_email" name="supplier_email" placeholder="proveedor@ejemplo.com" value="<?php echo $supplierData[0]->email ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_web">Web corporativa</label>
        <div class="forms_inputs_fields">
          <i class="fa-sharp fa-solid fa-globe forms_icons"></i>
          <input type="text" class="forms_inputs input_web" id="supplier_web" name="supplier_web" placeholder="https://www.proveedor.com" value="<?php echo $supplierData[0]->web ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="supplier_contact_person">Persona de contacto</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-users forms_icons"></i>
          <input type="text" class="forms_inputs input_contact_person" id="supplier_contact_person" name="supplier_contact_person" placeholder="Apellidos, Nombre" value="<?php echo $supplierData[0]->contact_person ?>"/>
        </div>      
      </div>
    </div>
                <!-- input oculto que recibirá valor de token de ventana principal y subventana buscador -->    
    <input type="hidden" id="tokenSupplier" name="tokenSupplier" placeholder="tokenValue Subwindow" value="<?php echo $supplierData[0]->token; ?>" /> 
                <!-- ------------------------------------------------------- -->

    <div class="btn-group p-3">
      <button type="submit" class="btn btn-primary mr-5" id="btn_supplier_submit" name="supplier_submit"><i class="fa-sharp fa-solid fa-pencil"></i>&nbsp Grabar</button> 
      <button type="button" role="link" class="btn btn-secondary mr-5" name="exit_supplier" onClick="window.location='index.php?pages=01-newSupplier'"><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar</button>
      <button type="submit" class="btn btn-danger" id="btn_supplier_delete" name="delete_supplier"><i class="fa-sharp fa-solid fa-trash-can"></i>&nbsp Eliminar</button> 
    </div>

                    <!-- Mensajes ocultos de validaciones y realización de operaciones -->
    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Operación realizada con éxito</p></div>
                   
    <div class='text-center alert-danger rounded name_field_duplicate'><p>El <i><b>Nombre</b></i> introducido ya existe en la base de datos.</p></div>
    <div class='text-center alert-danger rounded nif_field_duplicate'><p>El <i><b>NIF</b></i> introducido ya existe en la base de datos.</p></div>
    <div class='text-center alert-danger rounded error_format_nif'><p>El formato del campo <b><i>NIF</i></b> es erroneo<br>Ejemplos válidos: Dni 12345678X / Cif B12345678 / NIE X1234567S</p></div>
    <div class='text-center alert-danger rounded error_format_postal_code'><p>El formato del campo <b><i>Código Postal</i></b> es erroneo<br>Ejemplos válidos: 28081 / 41003</p></div>
                     <!-- -------------------------------------------------------------  -->
                     
    <div class="modal fade" id="supplier_success_modal" role="dialog">  <!-- MODAL DE CONFIRMACIÓN DE OPERACIÓN bootstrap 4  -->
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
                     
        $updateSupplier = SupplierController::ctrUpdateSupplier("suppliers", "token", $_GET["token"]);    // se lanza método para actualizar datos de clientes.
      
        $deleteSupplier = new SupplierController(); 
        $checkDeleteSupplier = $deleteSupplier->ctrDeleteSupplier("suppliers", "token", $_GET["token"]);   // se lanza método para eliminar registro concreto.
      }
      else if(isset($_POST["tokenSupplier"]) && !empty($_POST["tokenSupplier"])) {   
      
        $updateSupplier = SupplierController::ctrUpdateSupplier("suppliers", "token", $_POST["tokenSupplier"]);    // se lanza método para actualizar datos de proveedores.

        $deleteSupplier = new SupplierController(); 
        $checkDeleteSupplier = $deleteSupplier->ctrDeleteSupplier("suppliers", "token", $_POST["tokenSupplier"]);   // se lanza método para eliminar registro concreto.
      }
      else {     
        $createSupplier = SupplierController::ctrCreateSupplier("suppliers"); // se lanza método para grabar datos de proveedor.
      }
       
        /* Bloque condicional para lanzar ventana modal en función del éxito de la operación realizada
        ---------------------------------------------------------------------------------------------*/
      if($updateSupplier) {  

        $newToken = md5(trim(ucwords($_POST["supplier_name"]) . "+" . trim(strtoupper($_POST["supplier_nif"]))));   // Se genera nuevo token para poder recargar página con datos actualizados.        

          // 1º se guarda estado de la actualización/borrado en variable de sesión para a continuación poder lanzar ventana modal al recargar página.
          // 2º se refresca página con datos del registro actualizados. 
        echo "<script>
                window.sessionStorage.setItem('modalAlert', 'true');                
                window.location.replace('index.php?pages=01-newSupplier&token=$newToken');
              </script>";   
      }
      else if($checkDeleteSupplier == "true" || $createSupplier == "true") {
            echo "<script>
                    window.sessionStorage.setItem('modalAlert', 'true'); 
                    window.location.replace('index.php?pages=01-newSupplier');
                  </script>"; 
      }
    ?>

    <?php
        /* Bloque condicional para borrar datos almacenados del formulario html una vez enviados.
        ----------------------------------------------------------------------------------------*/
      if($createSupplier == "true" || $updateSupplier == "true" || $checkDeleteRegister == "true") {
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