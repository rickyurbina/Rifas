<?php

require_once "conexion.php";

class SorteosModel {

  /* Funcion para agregar un sorteo con base en el arreglo "datosModel". Retorna un string con valor "success" si la inserción fue exitosa, retorna un string con valor "error" */
  public static function mdlAgregarSorteo($datosModel) {
    $statement = Conexion::conectar() -> prepare("INSERT INTO `sorteos` VALUES(null, :titulo, :subtitulo, :segundoLugar, :tercerLugar, :adicionales, :fecha, :noBoletos, :costoBoleto, :descripcion, :fotos);");

    $statement -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
    $statement -> bindParam(":subtitulo", $datosModel["subtitulo"], PDO::PARAM_STR);
    $statement -> bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
    $statement -> bindParam(":noBoletos", $datosModel["noBoletos"], PDO::PARAM_STR);
    $statement -> bindParam(":costoBoleto", $datosModel["costoBoleto"], PDO::PARAM_STR);
    $statement -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
    $statement -> bindParam(":fotos", $datosModel["fotos"], PDO::PARAM_STR);
    $statement -> bindParam(":segundoLugar",$datosModel["segundoLugar"],PDO::PARAM_STR);
    $statement -> bindParam(":tercerLugar",$datosModel["tercerLugar"],PDO::PARAM_STR);
    $statement -> bindParam(":adicionales", $datosModel["adicionales"], PDO::PARAM_STR);

    if ($statement -> execute()) {
      return "success";
    } else {
      return "error";
    }
  }

  public static function mdlBorrarSorteo($idSorteo) {
    $statement = Conexion::conectar() -> prepare("DELETE FROM `sorteos` WHERE `idSorteo` = :idSorteo;");

    $statement -> bindParam(":idSorteo", $idSorteo, PDO::PARAM_INT);

    if ($statement -> execute()) {
      return "success";
    } else {
      return "error";
    }
  }

  public static function mdlActualizarSorteo($datosModel) {

    $statement = Conexion::conectar() -> prepare("UPDATE `sorteos` SET `titulo` = :titulo, `subtitulo` = :subtitulo, `fecha` = :fecha, `noBoletos` = :noBoletos, `costoBoleto` = :costoBoleto, `descripcion` = :descripcion, `segundoLugar` = :segundoLugar,  `tercerLugar` = :tercerLugar, `adicionales` = :adicionales  WHERE `idSorteo` = :idSorteo;");

    $statement -> bindParam(":idSorteo", $datosModel["idSorteo"], PDO::PARAM_INT);
    $statement -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
    $statement -> bindParam(":subtitulo", $datosModel["subtitulo"], PDO::PARAM_STR);
    $statement -> bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
    $statement -> bindParam(":noBoletos", $datosModel["noBoletos"], PDO::PARAM_INT);
    $statement -> bindParam(":costoBoleto", $datosModel["costoBoleto"], PDO::PARAM_STR);
    $statement -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
    $statement -> bindParam(":segundoLugar",$datosModel["segundoLugar"],PDO::PARAM_STR);
    $statement -> bindParam(":tercerLugar",$datosModel["tercerLugar"],PDO::PARAM_STR);
    $statement -> bindParam(":adicionales", $datosModel["adicionales"], PDO::PARAM_STR);

    if ($statement -> execute()) {
      return "success";
    } else {
      return "error";
    }
  } 

  public static function mdlBuscarSorteo($idSorteo) {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM `sorteos` WHERE `idSorteo` = :idSorteo");

    $statement -> bindParam(":idSorteo", $idSorteo, PDO::PARAM_INT);

    $statement -> execute();

    return $statement -> fetch();
  }

  public static function mdlListarSorteos() {
   
    $statement = Conexion::conectar() -> prepare("SELECT sorteos.idSorteo, sorteos.titulo,(2000-(COUNT(boletos.idBoleto))) as faltan, sorteos.fecha, sorteos.costoBoleto FROM sorteos INNER JOIN boletos ON sorteos.idSorteo=boletos.idSorteo GROUP BY sorteos.idSorteo;");
    $statement -> execute();

    return $statement -> fetchAll();
  }
}
