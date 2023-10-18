<?php
  $customerData = array();
  $particularCustomer; 
  $privateCustomer;
  
      // Condición para controlar si se muestran datos en el formulario o se muestra en blanco
    if(isset($_GET["token"]) && !empty($_GET["token"])) {                                      
      $customerData = CustomerController::ctrToList("customers", "token", $_GET["token"]);           
        // Condición para marcar opción radio ("Particular"/"Empresa") de cliente concreto. 
      if($customerData[0]->customer_type == "Particular") $particularCustomer = "checked"; else $privateCustomer = "checked";
    }

     // script javascript para lanzar ventana modal confirmando actualizaciones o eliminaciones.
    echo "<script>
    if(window.sessionStorage.getItem('modalAlert') == 'true') {
      $(function(){ 
        $('#success_modal').modal('show');
      });
      window.sessionStorage.setItem('modalAlert', 'false');
    }
  </script>"; 
      
?>


<h2 class="li_active_page rounded">Ficha Cliente</h2>

<form class="general_forms" id="new_customer_form" action="<?php $_SERVER['REQUEST_URI']; ?>" method="post" onsubmit= "">
  <h4 class="forms_subtitle rounded">Crear | Editar | Eliminar</h4>
    
         
  <ul class="d-flex justify-content-first">
    <li><button type="button" class="search_bar m-1 alert-info rounded" id="search_customer" onClick=""><i class="fa-solid fa-magnifying-glass"></i>&nbsp Buscar Cliente</button></li>
    <li><button type="button" class="print_bar m-1 alert-info rounded" id="print"><i class="fa-solid fa-print"></i>&nbspImprimir</button></li>
  </ul>
                                                   
  <fieldset class="d-flex justify-content-around"> <!-- CAMBIAR A ESTILO PROPIO CON CSS flex personalizado, no esta porquería -->
    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="customer_id">Id Cliente</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-list-ol forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_id" name="customer_id" placeholder="" disabled value="<?php echo $customerData[0]->id ?>" />
        </div>      
    </div>

    <div class="forms_fields" id="radio_forms_fields">
      <label class="forms_label" style="font-weight:600;">Tipo cliente</label>
      <div class="forms_inputs_fields">

        <label class="forms_label" for="private_customer">Particular</label>
        <input type="radio" class="forms_inputs" id="private_customer" name="customer_type" <?php echo $particularCustomer; ?> value="Particular"/>

        <label class="forms_label" for="company">Empresa</label>
        <input type="radio" class="forms_inputs" id="company" name="customer_type" <?php echo $privateCustomer; ?> value="Empresa"/>

      </div>      
    </div>

    <div class="forms_flex" >
      <div class="forms_fields">
        <label class="forms_label" for="created_date">Fecha registro</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-calendar-days forms_icons"></i>
          <input type="text" class="forms_inputs" id="created_date" name="created_date" placeholder="" disabled value="<?php echo $customerData[0]->created_date ?>" />
        </div>      
    </div>
  </fieldset>

  <fieldset class="">   

    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="customer_name">Nombre / Razón Social</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_name" name="customer_name" placeholder="Apellidos, Nombre / Empresa, S.L." value="<?php echo $customerData[0]->name_customer ?>" />
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_nifcif">NIF</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-address-card forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_nifcif" name="customer_nifcif" placeholder="00000000L / B00000000" value="<?php echo $customerData[0]->nif_cif ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_address">Dirección</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-house forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_address" name="customer_address" placeholder="'C/' 'Avda.' 'Plaza'" value="<?php echo $customerData[0]->address_customer ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_postal_code">Código Postal</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-envelopes-bulk forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_postal_code" name="customer_postal_code" placeholder="Ej: 41003" value="<?php echo $customerData[0]->postal_code ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_town">Ciudad</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-house forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_town" name="customer_town" placeholder="Ej: Alcalá de Henares" value="<?php echo $customerData[0]->town ?>">
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_province">Provincia</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-city forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_province" name="customer_province" placeholder="Ej: Madrid" value="<?php echo $customerData[0]->province ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_country">País</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-earth-americas forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_country" name="customer_country" placeholder="Ej: España" value="<?php echo $customerData[0]->country ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_phone">Teléfono</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-phone forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_phone" name="customer_phone" placeholder="Ej: 666999666" value="<?php echo $customerData[0]->phone ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_email">Correo electrónico</label>
        <div class="forms_inputs_fields">
          <i class="fa-sharp fa-solid fa-envelope forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_email" name="customer_email" placeholder="ejemplo@ejemplo.com" value="<?php echo $customerData[0]->email ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_contact_person">Persona de contacto</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-users forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_contact_person" name="customer_contact_person" placeholder="Apellidos, Nombre" value="<?php echo $customerData[0]->contact_person ?>"/>
        </div>      
      </div>
    </div>

                    <!-- input oculto que recibirá valor de token de subventana -->
    <input type="hidden" id="tokenCustomer" name="tokenCustomer" placeholder="tokenValue Subwindow" value="" /> 
                    <!-- ----------------------------------------------------------  -->

    <div class="btn-group p-3">
      <button type="submit" class="btn btn-primary mr-5" id="btn_customer_submit" name="customer_submit"><i class="fa-sharp fa-solid fa-pencil"></i>&nbsp Grabar</button> 
      <button type="button" role="link" class="btn btn-secondary mr-5" name="exit_customer" onClick="window.location='index.php?pages=01-newCustomer'"><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar registro</button>
      <button type="submit" class="btn btn-danger" name="delete_customer"><i class="fa-sharp fa-solid fa-trash-can"></i>&nbsp Eliminar registro</button> 
    </div>

                    <!-- Mensajes ocultos de validaciones y realización de operaciones -->
    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Operación realizada con éxito</p></div>
                   
    <div class='text-center alert-danger rounded name_field_duplicate'><p>El <i><b>Nombre/Razón Social</b></i> introducido ya existe en la base de datos.</p></div>
    <div class='text-center alert-danger rounded nif_field_duplicate'><p>El <i><b>NIF</b></i> introducido ya existe en la base de datos.</p></div>
    <div class='text-center alert-danger rounded error_format_nif'><p>El formato del campo <b><i>NIF</i></b> es erroneo<br>Ejemplos válidos: Dni 12345678X / Cif B12345678 / NIE X1234567S</p></div>
    <div class='text-center alert-danger rounded error_format_postal_code'><p>El formato del campo <b><i>Código Postal</i></b> es erroneo<br>Ejemplos válidos: 28081 / 41003</p></div>
    <div class='text-center alert-danger rounded error_format_phone'><p>El formato del campo <b><i>Teléfono</i></b> es erroneo<br>Ejemplos válidos: +34 666999333 / 666999333</p></div>
                     <!-- -------------------------------------------------------------  -->
                     
    <div class="modal fade" id="success_modal" role="dialog">  <!-- MODAL DE CONFIRMACIÓN DE OPERACIÓN bootstrap 4  -->
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
         
        $updateRegister = CustomerController::ctrUpdateRegister("customers", "token", $_GET["token"]);    // se lanza método para actualizar datos de clientes.

        $deleteRegister = new CustomerController(); 
        $checkDeleteRegister = $deleteRegister->ctrDeleteRegister("customers", "token", $_GET["token"]);   // se lanza método para eliminar registro concreto.
      }
      else if(isset($_POST["tokenCustomer"]) && !empty($_POST["tokenCustomer"])) {   
      
        $updateRegister = CustomerController::ctrUpdateRegister("customers", "token", $_POST["tokenCustomer"]);    // se lanza método para actualizar datos de clientes.

        $deleteRegister = new CustomerController(); 
        $checkDeleteRegister = $deleteRegister->ctrDeleteRegister("customers", "token", $_POST["tokenCustomer"]);   // se lanza método para eliminar registro concreto.
      }
      else {     
        $createRegister = CustomerController::ctrCreateRegister("customers"); // se lanza método para grabar datos de clientes.
      }
       
        /* Bloque condicional para lanzar ventana modal en función del éxito de la operación realizada
        ---------------------------------------------------------------------------------------------*/
      if($updateRegister == "true") { 

        $newToken = md5(ucwords($_POST["customer_name"] . "+" . strtoupper($_POST["customer_nifcif"])));   // Se genera nuevo token para poder recargar página con datos actualizados.        

          // 1º se guarda estado de la actualización/borrado en variable de sesión para a continuación poder lanzar ventana modal al recargar página.
          // 2º se refresca página con datos del registro actualizados. 
        echo "<script>
                window.sessionStorage.setItem('modalAlert', 'true');
                window.location.replace('index.php?pages=01-newCustomer&token=$newToken');
              </script>";   
      }
      else if($checkDeleteRegister == "true") {
            echo "<script>
                    window.sessionStorage.setItem('modalAlert', 'true'); 
                    window.location.replace('index.php?pages=01-newCustomer');
                  </script>"; 
      }
    ?>

    <?php
        /* Bloque condicional para borrar datos almacenados del formulario html una vez enviados.
        ----------------------------------------------------------------------------------------*/
      if($createRegister == "true" || $updateRegister == "true" || $checkDeleteRegister == "true") {
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