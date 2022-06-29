<?php
if (isset($_GET["idEditar"])) {
  $idEditar = $_GET["idEditar"];
    
  $controllerSorteo = new SorteosController();

  $controllerSorteo -> ctrBuscarSorteo($idEditar);

  $controllerSorteo -> ctrActualizarSorteo($idEditar);

} else {
  print_r("Nada");
}


?>
