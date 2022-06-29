<?php 
require_once "./models/conexion.php";
require_once "./controllers/controllerIngreso.php";
require_once "./models/modelIngreso.php";

include "./modules/head.php"; 
?>

<body>

  <div class="row h-75" style="margin: auto">
    <div class="card mx-auto my-auto login">
      <div class="card-header text-center">
        <h3>Iniciar sesión</h3>
        <p>Ingrese su correo y contraseña</p>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="cajaCorreo">Correo electrónico:</label>
                <input type="email" name="cajaCorreo" id="cajaCorreo" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="cajaPassword">Contraseña:</label>
                <input type="password" name="cajaPassword" id="cajaPassword" class="form-control" required>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col">
              <button class="btn btn-block btn-primary" type="submit">Aceptar</button>
            </div>
          </div>
        </form>
        <?php 
          $ingreso = new ControllerIngreso();
          $ingreso -> ctrIngresar();
        ?>
      </div>
    </div>
  </div>

</body>
<?php include "./modules/footer.php" ?>