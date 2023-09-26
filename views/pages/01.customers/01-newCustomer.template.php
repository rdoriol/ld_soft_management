<?php
  $customerData = array();
  $particularCustomer; 
  $privateCustomer;

      // Condición para controlar si se muestran datos en el formulario o se muestra en blanco
    if(isset($_GET["token"]) && !empty($_GET["token"])) {                                      
      $customerData = CustomerController::ctrToList("customers", "token", $_GET["token"]);  echo $_customerData[0]->id_customer;           
        // Condición para marcar opción radio ("Particular"/"Empresa") de cliente concreto. 
      if($customerData[0]->customer_type == "Particular") $particularCustomer = "checked"; else $privateCustomer = "checked";
    }
      
?>

<h2 class="li_active_page rounded">Clientes</h2>

<form class="general_forms" id="new_customer_form" action="" method="post" onsubmit= "">
  <h2>Alta Cliente</h2>

  <fieldset class="d-flex justify-content-around"> <!-- CAMBIAR A ESTILO PROPIO CON CSS flex personalizado, no esta porquería -->
    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="customer_id">Id Cliente</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_id" name="customer_id" placeholder="" disabled value="<?php echo $customerData[0]->id_customer ?>" />
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
          <i class="fa-solid fa-user forms_icons"></i>
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
          <input type="text" class="forms_inputs" id="customer_name" name="customer_name" placeholder="Apellidos, Nombre / Empresa, S.L." value="<?php echo $customerData[0]->name_customer ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_nifcif">NIF / CIF</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_nifcif" name="customer_nifcif" placeholder="00000000L / B00000000" value="<?php echo $customerData[0]->nif_cif ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_address">Dirección</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_address" name="customer_address" placeholder="'C/' 'Avda.' 'Plaza'" value="<?php echo $customerData[0]->address_customer ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_postal_code">Código Postal</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-code forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_postal_code" name="customer_postal_code" placeholder="Ej: 41003" value="<?php echo $customerData[0]->postal_code ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_town">Ciudad</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_town" name="customer_town" placeholder="Ej: Alcalá de Henares" value="<?php echo $customerData[0]->town ?>">
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_province">Provincia</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_province" name="customer_province" placeholder="Ej: Madrid" value="<?php echo $customerData[0]->province ?>"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_country">País</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
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
    <div class="btn-group p-3">
      <button type="submit" class="btn btn-primary mr-5" id="btn_customer_submit" name="customer_submit"><i class="fa-sharp fa-solid fa-pencil"></i>&nbsp Grabar</button> 
      <button type="submit" class="btn btn-secondary" name="delete_customer"><i class="fa-sharp fa-solid fa-trash-can"></i>&nbsp Eliminar registro</button> 
    </div>

    <div><p class="alert alert-success text-center hide_alert" id="alert_success">Acción realizada con éxito</p></div>

    <?php 
        // Bloque condicional para grabar datos de un cliente nuevo o actualizar datos de un registro existente.
      if(isset($_GET["token"]) && !empty($_GET["token"])) {        
        $updateRegister = CustomerController::ctrUpdateRegister("customers", "token", $_GET["token"]); // se lanza método para actualizar datos de clientes.

        $deleteRegister = new CustomerController(); // se lanza método para eliminar registro concreto.
        $checkDeleteRegister = $deleteRegister->ctrDeleteRegister("customers", "token", $_GET["token"]);

        if($updateRegister == "true" || $checkDeleteRegister == "true") {   
         
     
          echo "<script>window.location.replace('index.php?pages=01-newCustomer');</script>";  
          //echo "<script>document.getElementsByClassName('hide_alert')[0].style.display='block';</script>";
          
        }
      }
      else {
        $createRegister = CustomerController::ctrCreateRegister("customers"); // se lanza método para grabar datos de clientes.
        }

        // Sentencia condicional para borrar datos almacenados del formulario html una vez enviados.
      if($createRegister == "true") {
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




<!-- ----------------------------------------- ELIMINAR TODO LO QUE HAY A PARTIR DE AQUÍ ------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------ -->

<div class="d-flex-column">

  <form class="p-5 bg-dark9 rounded" action="" method="post">
                            <legend style="background-color: gold; font-weight: bold;">Alta Cliente</legend>
    <div class="form-group">
        <label class="text-white" for="nombre">Nombre</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Enter name" id="nombre" name="nombre">
        </div>
        
    </div>

    <div class="form-group">
        <label class="text-white" for="email">Correo Electrónico</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-sharp fa-solid fa-envelope"></i></span>
          </div>
          <input type="email" class="form-control" placeholder="Enter e-mail" id="emailRegistro" name="email">
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="pwd">Contraseña:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pwd">
        </div>
    </div>



    <div class="text-center">
      <button type="submit" class="btn btn-primary center" name="enviar">Enviar</button>
    </div>
  </form>

</div>