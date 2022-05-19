<?php

// require "conexion.php";

class ComprasModel {

  public static function mdlObtenerBoleto($noBoleto) {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE `noBoleto` = :noBoleto; ");
    $statement -> bindParam(":noBoleto", $noBoleto);
    $statement -> execute();

    return $statement -> fetch();
  }

  public static function mdlObtenerSorteoActual() {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM `sorteos` WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`) LIMIT 1;");
    $statement -> execute();
    return $statement -> fetch();
  }

  public static function mdlAgregarCompra($datosModel) {
    $statement = Conexion::conectar() -> prepare("SELECT idSorteo FROM `sorteos` WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`) LIMIT 1;");
    $statement -> execute();
    $sorteos = $statement -> fetch();

    // SELECT idSorteo FROM `sorteos` WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`) LIMIT 1;
    $statement = Conexion::conectar() -> prepare("INSERT INTO `boletos` VALUES (NULL, :idSorteo, :nombre, :telefono,:estado, :email, :noBoleto, 'N',:fecha, :fecha);");

    $statement -> bindParam(":idSorteo", $sorteos["idSorteo"], PDO::PARAM_INT);
    $statement -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
    $statement -> bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
    $statement -> bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
    $statement -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
    $statement -> bindParam(":noBoleto", $datosModel["noBoleto"], PDO::PARAM_INT);
    $statement -> bindParam(":fecha", $datosModel["fecha"],PDO::PARAM_STR);


    if ($statement -> execute()) {
      return "success";
    } else {
      print_r($statement -> errorInfo());

      return "error";
    }
  }

  public static function mdlConfirmarCompra($datosModel) {
    $statement = Conexion::conectar() -> prepare("INSERT INTO `boletos` VALUES(null, :idSorteo, :nombre, :telefono, :estado, :email, :noBoleto, 'L', :fecha, :fechaPago );");
  
    $statement -> bindParam(":idSorteo", $datosModel["idSorteo"], PDO::PARAM_INT);
    $statement -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
    $statement -> bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
    $statement -> bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
    $statement -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
    $statement -> bindParam(":noBoleto", $datosModel["noBoleto"], PDO::PARAM_INT);
    $statement -> bindParam(":fecha",$datosModel["fecha"],PDO::PARAM_STR);
    $statement -> bindParam(":fechaPago",$datosModel["fechaPago"],PDO::PARAM_STR);
    
    if ($statement -> execute()) {
      return "success";
    } else {
      return "error";
    }
  }

  public static function mdlBorrarCompra($noBoleto) {
    $statement = Conexion::conectar() -> prepare("DELETE FROM `boletos` WHERE `noBoleto` = :noBoleto;");

    $statement -> bindParam(":noBoleto", $noBoleto, PDO::PARAM_INT);

    if ($statement -> execute()) {
      return "success";
    } else {
      return "error";
    }
  }
}
