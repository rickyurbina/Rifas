<?php
    $idEdita= $_GET["idEdita"]
?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5>Agregar usuario</h5>
        </div>
        <div class="card-body">

          <form class="theme-form" method="POST">
            
            <?php
                $controllerUsuarios = new UsuariosController();
                $controllerUsuarios -> ctrBuscarUsuario($idEdita);
                $controllerUsuarios -> ctrActualizaUsuario($idEdita);
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>