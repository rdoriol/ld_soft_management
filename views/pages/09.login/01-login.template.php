<style>@import url("./css/styles_login.css");</style>

<h1 class="text-center">Login</h1>

<div class="d-flex justify-content-center">

  <form class="p-5 rounded" action="" method="post">

    <div class="form-group">
        <label class="text-white" for="user_login">Usuario</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-sharp fa-solid fa-envelope"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Introduzca usuario" id="user_login" name="user_login" value="" />
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="pass">Contraseña</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Introduzca contraseña" id="pass" name="pass" value="" />
          
        </div>
    </div>
    
    <?php      
        //$result = new FormController();
        //$result->ctrToLogin();       
    ?>
    
    <div class="text-center">
      <button type="submit" class="btn btn-primary mt-3" name="submitIngreso">Acceder</button>
    </div>
  </form> 
</div>