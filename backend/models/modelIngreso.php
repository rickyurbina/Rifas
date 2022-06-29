<?php

class ModelIngreso {
  public static function mdlIngresar($datosModel) {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM `usuarios` WHERE `email` = :cajaCorreo");

    $statement -> bindParam(":cajaCorreo", $datosModel["cajaCorreo"], PDO::PARAM_STR);
    $statement -> execute();

    return $statement -> fetch();
  }
}
