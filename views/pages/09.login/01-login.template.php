<style>@import url("./css/styles_login.css");</style>

<script>    // Script js para limpiar datos almacenados en sessionStorage del navegador
  sessionStorage.setItem("submenuShowStore", "false"); 
</script>

<h1 class="text-center">Inicio Sesión</h1>

<div class="d-flex justify-content-center" id="login_template">

  <form class="p-5 rounded" action="" method="post">

    <div class="form-group">
        <label class="text-white" for="user_login">Usuario</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-sharp fa-solid fa-envelope"></i></span>
          </div>
          <input type="text" class="form-control forms_inputs input_text" placeholder="Introduzca usuario" id="user_login" name="user_login" value="" />
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="pass">Contraseña</label>
        <div class="input-group">          
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
          </div>
          <input type="password" class="form-control forms_inputs input_text" placeholder="Introduzca contraseña" id="pass" name="pass" value="" />
        </div>
    </div>
    <img class="eye_pwd" src="./images/login/show_icon.png" />
    
    <div class="text-center">
      <button type="submit" class="btn btn-primary mt-3 forms_inputs" name="submitLogin">Acceder</button>
    </div>
  </form>
</div>

<?php      // Se lanza método para comprobar credenciales del login
       $result = new UserController();
        $result->ctrToLogin();  
?>

<script>
    // Para limpiar historial de búsqueda del formulario en el navegador
  if(window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>


