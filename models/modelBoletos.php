<?php

require_once "conexion.php";

class BoletosModel {

  public static function mdlBuscarBoleto($noBoleto){
    //$statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE noBoleto = :noBoleto AND idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`);");
    
    $statement = Conexion::conectar() -> prepare("SELECT boletos.idBoleto, boletos.idSorteo, boletos.nombre, boletos.telefono, boletos.estado, boletos.email, boletos.noBoleto, 
                                                 boletos.status, boletos.fecha, boletos.fechaPago, sorteos.fotos FROM boletos, sorteos WHERE boletos.noBoleto = :noBoleto 
                                                 AND (boletos.idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`))AND boletos.idSorteo = sorteos.idSorteo;");

    $statement -> bindParam(":noBoleto",$noBoleto,PDO::PARAM_INT);

    $statement -> execute();

    return $statement -> fetch();
  }

  public static function mdlListarBoletosOcupados() {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos`, (SELECT MAX(`idSorteo`) AS 'Maximo' FROM `sorteos` ) as maximo WHERE boletos.idSorteo = maximo ORDER BY noBoleto");
    
    $statement -> execute();

    return $statement -> fetchAll();
  }

  public static function mdlAgregarBoleto($datosModel){
    $statement = Conexion::conectar() -> prepare("INSERT INTO `boletos` VALUES (NULL,:idSorteo,:nombre,:telefono,:email,:noBoleto,:status);");

    $statement -> bindParam(":idSorteo",$datosModel["idSorteo"],PDO::PARAM_INT);
    $statement -> bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
    $statement -> bindParam(":telefono",$datosModel["telefono"], PDO::PARAM_STR);
    $statement -> bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
    $statement -> bindParam(":noBoleto",$datosModel["noBoleto"],PDO::PARAM_INT);
    $statement -> bindParam(":status",$datosModel["status"], PDO::PARAM_STR_CHAR);
    

    if($statement -> execute()){
      return "success";
    } else {
      return "error";
    }
  }

  public static function mdlComprobarBoletoDisponible($noBoleto) {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE `noBoleto` = :noBoleto AND idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`);");

    $statement -> bindParam(":noBoleto", $noBoleto, PDO::PARAM_INT);

    $statement -> execute();

    return $statement -> fetchAll();
  }
}