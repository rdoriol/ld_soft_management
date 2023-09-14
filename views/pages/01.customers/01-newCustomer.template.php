<h2 class="li_active_page rounded">Clientes</h2>

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