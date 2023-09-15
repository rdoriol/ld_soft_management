<h2 class="li_active_page rounded">Clientes</h2>

<form class="general_forms" id="new_customer_form" action="" method="post">
  <h2>Alta Cliente</h2>
  <fieldset class="">
    <div class="forms_flex">
      <div class="forms_fields">
        <label class="forms_label" for="customer_name">Nombre / Razón Social</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_name" name="customer_name" placeholder="Apellidos, Nombre"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_nifcif">NIF / CIF</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_nifcif" name="customer_nifcif" placeholder="00000000L / B00000000"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_type">Persona física / jurídica</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_type" name="customer_type" placeholder="seleccionar"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_address">Dirección</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_address" name="customer_address" placeholder="Calle/Avda."/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_postal_code">Código Postal</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-code forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_postal_code" name="customer_postal_code" placeholder="Ej: 41003"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_town">Población</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_town" name="customer_town" placeholder="Ej: "/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_province">Provincia</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_province" name="customer_province" placeholder="Ej: ¿un select?"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_country">País</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-user forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_country" name="customer_country" placeholder="Ej: ¿un select?"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_phone">Teléfono</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-phone forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_phone" name="customer_phone" placeholder="Ej: 666999666"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_email">Correo electrónico</label>
        <div class="forms_inputs_fields">
          <i class="fa-sharp fa-solid fa-envelope forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_email" name="customer_email" placeholder="ejemplo@ejemplo.com"/>
        </div>      
      </div>

      <div class="forms_fields">
        <label class="forms_label" for="customer_contact_person">Persona de contacto</label>
        <div class="forms_inputs_fields">
          <i class="fa-solid fa-users forms_icons"></i>
          <input type="text" class="forms_inputs" id="customer_contact_person" name="customer_contact_person" placeholder="Apellidos, Nombre"/>
        </div>      
      </div>
    </div>
    <button type="submit" class="forms_buttons">Grabar</button>




  </fieldset>














</form>




<!-- ------------------------------------------------------------------------------------------------ -->
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