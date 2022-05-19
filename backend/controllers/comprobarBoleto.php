<?php
require('./controllerBoletos.php');
require('../models/modelBoletos.php');

$noBoleto = $_POST["noBoleto"];

$controller = new BoletosController();
$idSorteo = BoletosModel::mdlObtenerSorteoActual();
$boleto = $controller -> ctrBuscarBoleto($noBoleto, $idSorteo["idSorteo"]);
print_r(json_encode($boleto));