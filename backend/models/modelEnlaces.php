<?php

class EnlacesModel {

 

  public static function mdlEnlaces($enlaces) {
    $module = "";
    $listaEnlaces = [
      "agregarSorteo", 
      "lstSorteos", 
      "agregarUsuario", 
      "lstUsuarios", 
      "uptUsuario", 
      "agregarBoleto", 
      "uptBoleto", 
      "uptSorteo",
      "lstBoletosVendidos",
      "lstBoletosPendientes",
      "salir",
      "lstBoletosTotales"
    ];

    if ($enlaces === "index") {
      return "./components/dashboard.php";
    } else if (in_array($enlaces, $listaEnlaces)) {
      $module = "./components/" . $enlaces . ".php";
    }
    
    return $module;
  }
}
