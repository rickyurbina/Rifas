<!DOCTYPE html>
<html>
<?php
include "./components/head.php";
?>

<body>
  <?php
  require "./controllers/controllerCompras.php";
  require "./models/conexion.php";
  require "./models/modelCompras.php";

  $controllerCompras = new ComprasController();

  $controllerCompras->ctrConfirmarCompra();
  $controllerCompras->ctrEliminarCompra();

  ?>
</body>

</html>