<?php
require('./controllerBoletos.php');
require('../models/modelBoletos.php');


$noBoleto = $_GET["noBoleto"];

$Controller = new BoletosController();

$cosa = $Controller -> ctlBuscarBoleto($noBoleto);

print_r(json_encode($cosa));